<?php
require_once 'includes/header.php';

// Process actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);
    
    if ($action === 'approve') {
        $sql = "UPDATE registrations SET status = 'active' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Log activity
        $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                      VALUES (?, 'approve_registration', 'Approved registration ID: ".$id."', ?)";
        $activity_stmt = $conn->prepare($activity_sql);
        $ip = $_SERVER['REMOTE_ADDR'];
        $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
        $activity_stmt->execute();
        
        // Redirect to avoid resubmission
        header('Location: registrations.php');
        exit;
    } elseif ($action === 'reject') {
        $sql = "UPDATE registrations SET status = 'rejected' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Log activity
        $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                      VALUES (?, 'reject_registration', 'Rejected registration ID: ".$id."', ?)";
        $activity_stmt = $conn->prepare($activity_sql);
        $ip = $_SERVER['REMOTE_ADDR'];
        $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
        $activity_stmt->execute();
        
        // Redirect to avoid resubmission
        header('Location: registrations.php');
        exit;
    } elseif ($action === 'view') {
        // Fetch the registration details for viewing
        $sql = "SELECT * FROM registrations WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $registration = $result->fetch_assoc();
    } elseif ($action === 'delete') {
        // Delete the registration
        $sql = "DELETE FROM registrations WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Log activity
        $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                      VALUES (?, 'delete_registration', 'Deleted registration ID: ".$id."', ?)";
        $activity_stmt = $conn->prepare($activity_sql);
        $ip = $_SERVER['REMOTE_ADDR'];
        $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
        $activity_stmt->execute();
        
        // Redirect to avoid resubmission
        header('Location: registrations.php');
        exit;
    }
}

// Process bulk actions
if (isset($_POST['bulk_action']) && isset($_POST['registration_ids'])) {
    $action = $_POST['bulk_action'];
    $ids = $_POST['registration_ids'];
    
    if (!empty($ids)) {
        if ($action === 'approve') {
            $ids_str = implode(',', array_map('intval', $ids));
            $approve_sql = "UPDATE registrations SET status = 'active' WHERE id IN ($ids_str)";
            $conn->query($approve_sql);
            
            // Log activity
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                          VALUES (?, 'bulk_approve', 'Approved ".count($ids)." registrations', ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
            $activity_stmt->execute();
        } elseif ($action === 'reject') {
            $ids_str = implode(',', array_map('intval', $ids));
            $reject_sql = "UPDATE registrations SET status = 'rejected' WHERE id IN ($ids_str)";
            $conn->query($reject_sql);
            
            // Log activity
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                          VALUES (?, 'bulk_reject', 'Rejected ".count($ids)." registrations', ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
            $activity_stmt->execute();
        } elseif ($action === 'delete') {
            $ids_str = implode(',', array_map('intval', $ids));
            $delete_sql = "DELETE FROM registrations WHERE id IN ($ids_str)";
            $conn->query($delete_sql);
            
            // Log activity
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                          VALUES (?, 'bulk_delete', 'Deleted ".count($ids)." registrations', ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
            $activity_stmt->execute();
        }
    }
    
    // Redirect to remove POST data
    header('Location: registrations.php');
    exit;
}

// Pagination setup
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Filter setup
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$where_clause = '';

if ($filter === 'pending') {
    $where_clause = "WHERE status = 'pending'";
} elseif ($filter === 'active') {
    $where_clause = "WHERE status = 'active'";
} elseif ($filter === 'rejected') {
    $where_clause = "WHERE status = 'rejected'";
}

// Search functionality
$search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
if (!empty($search_term)) {
    $search_clause = "WHERE (name LIKE '%".mysqli_real_escape_string($conn, $search_term)."%' 
                     OR email LIKE '%".mysqli_real_escape_string($conn, $search_term)."%'
                     OR team_name LIKE '%".mysqli_real_escape_string($conn, $search_term)."%')";
    $where_clause = empty($where_clause) ? $search_clause : $where_clause . " AND " . substr($search_clause, 6);
}

// Count total registrations
$count_sql = "SELECT COUNT(*) as total FROM registrations $where_clause";
$count_result = $conn->query($count_sql);
$total_registrations = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_registrations / $limit);

// Get registrations for current page
$sql = "SELECT * FROM registrations $where_clause ORDER BY created_at DESC LIMIT $offset, $limit";
$registrations_result = $conn->query($sql);
?>

<div class="content">
    <!-- Registration Details Modal (shown when viewing a registration) -->
    <?php if(isset($registration)): ?>
    <div class="modal show" id="view-modal">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h2>Registration Details</h2>
                <a href="registrations.php" class="modal-close">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <div class="modal-body">
                <div class="registration-details">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="section-title">Team Information</h3>
                            <div class="detail-group">
                                <label>Team Name:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($registration['team_name']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Team Size:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($registration['team_size']); ?> members</div>
                            </div>
                            <div class="detail-group">
                                <label>Institution:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($registration['institution']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Challenge Track:</label>
                                <div class="detail-value">
                                    <?php
                                    $track = $registration['challenge_track'];
                                    $track_names = [
                                        'ai_ml' => 'AI/ML Solutions',
                                        'blockchain' => 'Blockchain Innovation',
                                        'ar_vr' => 'AR/VR Experiences',
                                        'iot' => 'IoT & Hardware',
                                        'open_innovation' => 'Open Innovation'
                                    ];
                                    echo isset($track_names[$track]) ? $track_names[$track] : ucfirst(str_replace('_', ' ', $track));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="section-title">Team Leader</h3>
                            <div class="detail-group">
                                <label>Name:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($registration['name']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Email:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($registration['email']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Phone:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($registration['phone']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Role:</label>
                                <div class="detail-value">
                                    <?php 
                                    $role = $registration['role'];
                                    $role_names = [
                                        'frontend' => 'Frontend Developer',
                                        'backend' => 'Backend Developer',
                                        'fullstack' => 'Full Stack Developer',
                                        'mobile' => 'Mobile Developer',
                                        'ui_ux' => 'UI/UX Designer',
                                        'ml_ai' => 'ML/AI Engineer',
                                        'devops' => 'DevOps Engineer',
                                        'project_manager' => 'Project Manager',
                                        'other' => 'Other'
                                    ];
                                    echo isset($role_names[$role]) ? $role_names[$role] : ucfirst(str_replace('_', ' ', $role));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <h3 class="section-title">Project Information</h3>
                            <div class="detail-group">
                                <label>Project Title:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($registration['project_title']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Project Description:</label>
                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($registration['project_description'])); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Technologies:</label>
                                <div class="detail-value">
                                    <?php
                                    $technologies = json_decode($registration['technologies'], true) ?: [];
                                    foreach ($technologies as $tech) {
                                        echo '<span class="tech-tag">' . htmlspecialchars(ucfirst(str_replace('_', ' ', $tech))) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-6">
                            <h3 class="section-title">Payment Information</h3>
                            <div class="detail-group">
                                <label>Payment Status:</label>
                                <div class="detail-value">
                                    <span class="status-badge status-<?php echo strtolower($registration['payment_status']); ?>">
                                        <?php echo ucfirst($registration['payment_status']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="detail-group">
                                <label>Payment ID:</label>
                                <div class="detail-value"><?php echo $registration['payment_id'] ?: 'N/A'; ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="section-title">Registration Status</h3>
                            <div class="detail-group">
                                <label>Status:</label>
                                <div class="detail-value">
                                    <span class="status-badge status-<?php echo strtolower($registration['status']); ?>">
                                        <?php echo ucfirst($registration['status']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="detail-group">
                                <label>Registered On:</label>
                                <div class="detail-value"><?php echo date('F j, Y g:i A', strtotime($registration['created_at'])); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row full-width">
                    <div class="col-4">
                        <?php if($registration['status'] === 'pending'): ?>
                        <a href="registrations.php?action=approve&id=<?php echo $registration['id']; ?>" class="btn btn-success full-width">
                            <i class="fas fa-check"></i> Approve
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-4">
                        <?php if($registration['status'] === 'pending'): ?>
                        <a href="registrations.php?action=reject&id=<?php echo $registration['id']; ?>" class="btn btn-danger full-width">
                            <i class="fas fa-times"></i> Reject
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-4">
                        <a href="mailto:<?php echo $registration['email']; ?>" class="btn btn-primary full-width">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop show"></div>
    <?php endif; ?>

    <div class="card-header with-actions">
        <h2><i class="fas fa-user-plus"></i> Team Registrations</h2>
        
        <div class="filter-actions">
            <form action="" method="GET" class="search-form">
                <div class="search-group">
                    <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search_term); ?>">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            
            <div class="btn-group">
                <a href="registrations.php?filter=all" class="btn <?php echo $filter === 'all' ? 'btn-primary' : 'btn-light'; ?>">All</a>
                <a href="registrations.php?filter=pending" class="btn <?php echo $filter === 'pending' ? 'btn-primary' : 'btn-light'; ?>">Pending</a>
                <a href="registrations.php?filter=active" class="btn <?php echo $filter === 'active' ? 'btn-primary' : 'btn-light'; ?>">Active</a>
                <a href="registrations.php?filter=rejected" class="btn <?php echo $filter === 'rejected' ? 'btn-primary' : 'btn-light'; ?>">Rejected</a>
            </div>
        </div>
    </div>
    
    <div class="content-card">
        <div class="registration-stats">
            <div class="stat-group">
                <div class="stat-item">
                    <div class="stat-value"><?php echo number_format($total_registrations); ?></div>
                    <div class="stat-label">Total Registrations</div>
                </div>
                
                <?php
                // Get counts for different statuses
                $status_counts = [];
                $status_sql = "SELECT status, COUNT(*) as count FROM registrations GROUP BY status";
                $status_result = $conn->query($status_sql);
                while ($row = $status_result->fetch_assoc()) {
                    $status_counts[$row['status']] = $row['count'];
                }
                ?>
                
                <div class="stat-item">
                    <div class="stat-value"><?php echo number_format($status_counts['pending'] ?? 0); ?></div>
                    <div class="stat-label">Pending</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-value"><?php echo number_format($status_counts['active'] ?? 0); ?></div>
                    <div class="stat-label">Approved</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-value"><?php echo number_format($status_counts['rejected'] ?? 0); ?></div>
                    <div class="stat-label">Rejected</div>
                </div>
            </div>
            
            <div class="export-section">
                <button type="button" id="export-csv-btn" class="btn btn-secondary">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
            </div>
        </div>
        
        <form method="POST" action="">
            <div class="bulk-actions mb-4">
                <select name="bulk_action" class="form-select">
                    <option value="">Bulk Actions</option>
                    <option value="approve">Approve</option>
                    <option value="reject">Reject</option>
                    <option value="delete">Delete</option>
                </select>
                
                <button type="submit" class="btn btn-secondary">Apply</button>
            </div>
            
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="30px">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th>Team Name</th>
                            <th>Team Lead</th>
                            <th>Email</th>
                            <th>Challenge Track</th>
                            <th>Team Size</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Registered On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($registrations_result && $registrations_result->num_rows > 0): ?>
                            <?php while($row = $registrations_result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="registration_ids[]" value="<?php echo $row['id']; ?>" class="registration-checkbox">
                                    </td>
                                    <td><?php echo htmlspecialchars($row['team_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <?php
                                        $track = $row['challenge_track'];
                                        $track_names = [
                                            'ai_ml' => 'AI/ML',
                                            'blockchain' => 'Blockchain',
                                            'ar_vr' => 'AR/VR',
                                            'iot' => 'IoT',
                                            'open_innovation' => 'Open Innovation'
                                        ];
                                        echo isset($track_names[$track]) ? $track_names[$track] : ucfirst(str_replace('_', ' ', $track));
                                        ?>
                                    </td>
                                    <td><?php echo $row['team_size']; ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo strtolower($row['payment_status']); ?>">
                                            <?php echo ucfirst($row['payment_status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge status-<?php echo strtolower($row['status']); ?>">
                                            <?php echo ucfirst($row['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="registrations.php?action=view&id=<?php echo $row['id']; ?>" class="btn-icon" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if($row['status'] === 'pending'): ?>
                                            <a href="registrations.php?action=approve&id=<?php echo $row['id']; ?>" class="btn-icon text-success" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <a href="registrations.php?action=reject&id=<?php echo $row['id']; ?>" class="btn-icon text-danger" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </a>
                                            <?php endif; ?>
                                            <a href="mailto:<?php echo $row['email']; ?>" class="btn-icon" title="Email">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                            <a href="#" class="btn-icon btn-delete" data-id="<?php echo $row['id']; ?>" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">No registrations found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
        
        <?php if ($total_pages > 1): ?>
        <div class="pagination-container">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                <li>
                    <a href="registrations.php?page=<?php echo $page - 1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php 
                // Show a limited number of page links
                $start_page = max(1, min($page - 2, $total_pages - 4));
                $end_page = min($total_pages, max($page + 2, 5));
                
                if ($start_page > 1): ?>
                <li>
                    <a href="registrations.php?page=1&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">1</a>
                </li>
                <?php 
                    if ($start_page > 2): 
                        echo '<li><span class="pagination-ellipsis">...</span></li>';
                    endif;
                endif;
                
                for ($i = $start_page; $i <= $end_page; $i++): ?>
                <li>
                    <a href="registrations.php?page=<?php echo $i; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" 
                       class="pagination-link <?php echo $i === $page ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
                <?php endfor; 
                
                if ($end_page < $total_pages): 
                    if ($end_page < $total_pages - 1): 
                        echo '<li><span class="pagination-ellipsis">...</span></li>';
                    endif;
                ?>
                <li>
                    <a href="registrations.php?page=<?php echo $total_pages; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link"><?php echo $total_pages; ?></a>
                </li>
                <?php endif; ?>
                
                <?php if ($page < $total_pages): ?>
                <li>
                    <a href="registrations.php?page=<?php echo $page + 1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal" id="delete-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Delete Registration</h2>
            <button class="modal-close" id="close-delete-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this registration? This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" id="cancel-delete">Cancel</button>
            <a href="#" id="confirm-delete" class="btn btn-danger">Delete</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox
    const selectAll = document.getElementById('select-all');
    const registrationCheckboxes = document.querySelectorAll('.registration-checkbox');
    
    if (selectAll) {
        selectAll.addEventListener('change', function() {
            registrationCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        });
    }
    
    // Delete registration modal
    const deleteModal = document.getElementById('delete-modal');
    const closeDeleteModal = document.getElementById('close-delete-modal');
    const cancelDelete = document.getElementById('cancel-delete');
    const confirmDelete = document.getElementById('confirm-delete');
    const modalBackdrop = document.getElementById('modal-backdrop');
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
    let deleteId = null;
    
    function showDeleteModal(id) {
        deleteId = id;
        deleteModal.classList.add('show');
        modalBackdrop.classList.add('show');
        confirmDelete.href = `registrations.php?action=delete&id=${id}`;
    }
    
    function hideDeleteModal() {
        deleteModal.classList.remove('show');
        modalBackdrop.classList.remove('show');
        deleteId = null;
    }
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            showDeleteModal(id);
        });
    });
    
    if (closeDeleteModal) {
        closeDeleteModal.addEventListener('click', hideDeleteModal);
    }
    
    if (cancelDelete) {
        cancelDelete.addEventListener('click', hideDeleteModal);
    }
    
    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', hideDeleteModal);
    }
    
    // Export to CSV functionality
    const exportCsvBtn = document.getElementById('export-csv-btn');
    if (exportCsvBtn) {
        exportCsvBtn.addEventListener('click', function() {
            // Get current filter and search parameters
            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter') || 'all';
            const search = urlParams.get('search') || '';
            
            // Redirect to export endpoint with current filters
            window.location.href = `export-registrations.php?filter=${filter}&search=${encodeURIComponent(search)}`;
        });
    }
});
</script>

<?php require_once 'includes/footer.php'; ?>
