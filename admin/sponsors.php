<?php
require_once 'includes/header.php';

// Process actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);
    
    if ($action === 'approve') {
        $sql = "UPDATE sponsors SET status = 'active' WHERE sponsor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Log activity
        $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                      VALUES (?, 'sponsor_approval', 'Approved sponsor ID: ".$id."', ?)";
        $activity_stmt = $conn->prepare($activity_sql);
        $ip = $_SERVER['REMOTE_ADDR'];
        $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
        $activity_stmt->execute();
        
        // Redirect to avoid resubmission
        header('Location: sponsors.php');
        exit;
    } elseif ($action === 'reject') {
        $sql = "UPDATE sponsors SET status = 'inactive' WHERE sponsor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Log activity
        $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                      VALUES (?, 'sponsor_rejection', 'Rejected sponsor ID: ".$id."', ?)";
        $activity_stmt = $conn->prepare($activity_sql);
        $ip = $_SERVER['REMOTE_ADDR'];
        $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
        $activity_stmt->execute();
        
        // Redirect to avoid resubmission
        header('Location: sponsors.php');
        exit;
    } elseif ($action === 'view') {
        // Fetch the sponsor details for viewing
        $sql = "SELECT * FROM sponsors WHERE sponsor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $sponsor = $result->fetch_assoc();
    } elseif ($action === 'delete') {
        // Delete the sponsor
        $sql = "DELETE FROM sponsors WHERE sponsor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Log activity
        $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                      VALUES (?, 'delete_sponsor', 'Deleted sponsor ID: ".$id."', ?)";
        $activity_stmt = $conn->prepare($activity_sql);
        $ip = $_SERVER['REMOTE_ADDR'];
        $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
        $activity_stmt->execute();
        
        // Redirect to avoid resubmission
        header('Location: sponsors.php');
        exit;
    }
}

// Process bulk actions
if (isset($_POST['bulk_action']) && isset($_POST['sponsor_ids'])) {
    $action = $_POST['bulk_action'];
    $ids = $_POST['sponsor_ids'];
    
    if (!empty($ids)) {
        if ($action === 'approve') {
            $ids_str = implode(',', array_map('intval', $ids));
            $approve_sql = "UPDATE sponsors SET status = 'active' WHERE sponsor_id IN ($ids_str)";
            $conn->query($approve_sql);
            
            // Log activity
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                          VALUES (?, 'bulk_approve_sponsors', 'Approved ".count($ids)." sponsors', ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
            $activity_stmt->execute();
        } elseif ($action === 'reject') {
            $ids_str = implode(',', array_map('intval', $ids));
            $reject_sql = "UPDATE sponsors SET status = 'inactive' WHERE sponsor_id IN ($ids_str)";
            $conn->query($reject_sql);
            
            // Log activity
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                          VALUES (?, 'bulk_reject_sponsors', 'Rejected ".count($ids)." sponsors', ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
            $activity_stmt->execute();
        } elseif ($action === 'delete') {
            $ids_str = implode(',', array_map('intval', $ids));
            $delete_sql = "DELETE FROM sponsors WHERE sponsor_id IN ($ids_str)";
            $conn->query($delete_sql);
            
            // Log activity
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                          VALUES (?, 'bulk_delete_sponsors', 'Deleted ".count($ids)." sponsors', ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
            $activity_stmt->execute();
        }
    }
    
    // Redirect to remove POST data
    header('Location: sponsors.php');
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
} elseif ($filter === 'inactive') {
    $where_clause = "WHERE status = 'inactive'";
}

// Search functionality
$search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
if (!empty($search_term)) {
    $search_clause = "WHERE (name LIKE '%".mysqli_real_escape_string($conn, $search_term)."%' 
                     OR company LIKE '%".mysqli_real_escape_string($conn, $search_term)."%'
                     OR email LIKE '%".mysqli_real_escape_string($conn, $search_term)."%')";
    $where_clause = empty($where_clause) ? $search_clause : $where_clause . " AND " . substr($search_clause, 6);
}

// Count total sponsors
$count_sql = "SELECT COUNT(*) as total FROM sponsors $where_clause";
$count_result = $conn->query($count_sql);
$total_sponsors = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_sponsors / $limit);

// Get sponsors for current page
$sql = "SELECT * FROM sponsors $where_clause ORDER BY created_at DESC LIMIT $offset, $limit";
$sponsors_result = $conn->query($sql);
?>

<div class="content">
    <!-- Sponsor Details Modal (shown when viewing a sponsor) -->
    <?php if(isset($sponsor)): ?>
    <div class="modal show" id="view-modal">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h2>Sponsor Details</h2>
                <a href="sponsors.php" class="modal-close">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <div class="modal-body">
                <div class="registration-details">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="section-title">Company Information</h3>
                            <div class="detail-group">
                                <label>Company Name:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($sponsor['company']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Website:</label>
                                <div class="detail-value">
                                    <?php if($sponsor['website']): ?>
                                        <a href="<?php echo htmlspecialchars($sponsor['website']); ?>" target="_blank">
                                            <?php echo htmlspecialchars($sponsor['website']); ?>
                                        </a>
                                    <?php else: ?>
                                        Not provided
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="detail-group">
                                <label>Sponsorship Tier:</label>
                                <div class="detail-value">
                                    <?php
                                    $tier = $sponsor['tier'];
                                    $tier_names = [
                                        'alpha_partner' => 'Alpha Partner',
                                        'hype_sponsor' => 'Hype Sponsor',
                                        'boost_sponsor' => 'Boost Sponsor',
                                        'vibe_sponsor' => 'Vibe Sponsor',
                                        'crew_sponsor' => 'Crew Sponsor',
                                        'green_soul' => 'Green Soul',
                                        'mystery_drop' => 'Mystery Drop Partner'
                                    ];
                                    echo isset($tier_names[$tier]) ? $tier_names[$tier] : ucfirst(str_replace('_', ' ', $tier));
                                    ?>
                                </div>
                            </div>
                            <div class="detail-group">
                                <label>Contribution Amount:</label>
                                <div class="detail-value">₹<?php echo number_format($sponsor['contribution'], 2); ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="section-title">Contact Information</h3>
                            <div class="detail-group">
                                <label>Contact Person:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($sponsor['name']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Email:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($sponsor['email']); ?></div>
                            </div>
                            <div class="detail-group">
                                <label>Phone:</label>
                                <div class="detail-value"><?php echo htmlspecialchars($sponsor['phone'] ?? 'Not provided'); ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(!empty($sponsor['description'])): ?>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h3 class="section-title">Additional Information</h3>
                            <div class="detail-group">
                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($sponsor['description'])); ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="row mt-4">
                        <div class="col-6">
                            <h3 class="section-title">Logo</h3>
                            <div class="detail-group">
                                <?php if($sponsor['logo']): ?>
                                    <div class="logo-preview">
                                        <img src="../assets/images/sponsors/<?php echo htmlspecialchars($sponsor['logo']); ?>" 
                                            alt="<?php echo htmlspecialchars($sponsor['company']); ?> logo" class="sponsor-logo-img">
                                    </div>
                                <?php else: ?>
                                    <div class="detail-value">No logo provided</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="section-title">Status Information</h3>
                            <div class="detail-group">
                                <label>Status:</label>
                                <div class="detail-value">
                                    <span class="status-badge status-<?php echo strtolower($sponsor['status']); ?>">
                                        <?php echo ucfirst($sponsor['status']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="detail-group">
                                <label>Created On:</label>
                                <div class="detail-value"><?php echo date('F j, Y g:i A', strtotime($sponsor['created_at'])); ?></div>
                            </div>
                            <?php if($sponsor['updated_at']): ?>
                            <div class="detail-group">
                                <label>Last Updated:</label>
                                <div class="detail-value"><?php echo date('F j, Y g:i A', strtotime($sponsor['updated_at'])); ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row full-width">
                    <div class="col-4">
                        <?php if($sponsor['status'] === 'pending'): ?>
                        <a href="sponsors.php?action=approve&id=<?php echo $sponsor['sponsor_id']; ?>" class="btn btn-success full-width">
                            <i class="fas fa-check"></i> Approve
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-4">
                        <?php if($sponsor['status'] === 'pending'): ?>
                        <a href="sponsors.php?action=reject&id=<?php echo $sponsor['sponsor_id']; ?>" class="btn btn-danger full-width">
                            <i class="fas fa-times"></i> Reject
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-4">
                        <a href="mailto:<?php echo $sponsor['email']; ?>" class="btn btn-primary full-width">
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
        <h2><i class="fas fa-handshake"></i> Sponsors Management</h2>
        
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
                <a href="sponsors.php?filter=all" class="btn <?php echo $filter === 'all' ? 'btn-primary' : 'btn-light'; ?>">All</a>
                <a href="sponsors.php?filter=pending" class="btn <?php echo $filter === 'pending' ? 'btn-primary' : 'btn-light'; ?>">Pending</a>
                <a href="sponsors.php?filter=active" class="btn <?php echo $filter === 'active' ? 'btn-primary' : 'btn-light'; ?>">Active</a>
                <a href="sponsors.php?filter=inactive" class="btn <?php echo $filter === 'inactive' ? 'btn-primary' : 'btn-light'; ?>">Inactive</a>
            </div>
        </div>
    </div>
    
    <div class="content-card">
        <div class="sponsor-stats">
            <div class="stat-group">
                <div class="stat-item">
                    <div class="stat-value"><?php echo number_format($total_sponsors); ?></div>
                    <div class="stat-label">Total Sponsors</div>
                </div>
                
                <?php
                // Get counts for different statuses
                $status_counts = [];
                $status_sql = "SELECT status, COUNT(*) as count FROM sponsors GROUP BY status";
                $status_result = $conn->query($status_sql);
                while ($row = $status_result->fetch_assoc()) {
                    $status_counts[$row['status']] = $row['count'];
                }
                
                // Get sum of contributions
                $sum_sql = "SELECT SUM(contribution) as total FROM sponsors WHERE status = 'active'";
                $sum_result = $conn->query($sum_sql);
                $total_contribution = $sum_result->fetch_assoc()['total'] ?? 0;
                ?>
                
                <div class="stat-item">
                    <div class="stat-value"><?php echo number_format($status_counts['pending'] ?? 0); ?></div>
                    <div class="stat-label">Pending</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-value"><?php echo number_format($status_counts['active'] ?? 0); ?></div>
                    <div class="stat-label">Active</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-value">₹<?php echo number_format($total_contribution); ?></div>
                    <div class="stat-label">Total Contributions</div>
                </div>
            </div>
            
            <div class="export-section">
                <button type="button" id="export-csv-btn" class="btn btn-secondary">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <a href="add-sponsor.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Sponsor
                </a>
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
                            <th>Company</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Tier</th>
                            <th>Contribution</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($sponsors_result && $sponsors_result->num_rows > 0): ?>
                            <?php while($row = $sponsors_result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="sponsor_ids[]" value="<?php echo $row['sponsor_id']; ?>" class="sponsor-checkbox">
                                    </td>
                                    <td><?php echo htmlspecialchars($row['company']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <?php
                                        $tier = $row['tier'];
                                        $tier_names = [
                                            'alpha_partner' => 'Alpha Partner',
                                            'hype_sponsor' => 'Hype Sponsor',
                                            'boost_sponsor' => 'Boost Sponsor',
                                            'vibe_sponsor' => 'Vibe Sponsor',
                                            'crew_sponsor' => 'Crew Sponsor',
                                            'green_soul' => 'Green Soul',
                                            'mystery_drop' => 'Mystery Drop Partner'
                                        ];
                                        echo isset($tier_names[$tier]) ? $tier_names[$tier] : ucfirst(str_replace('_', ' ', $tier));
                                        ?>
                                    </td>
                                    <td>₹<?php echo number_format($row['contribution'], 2); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo strtolower($row['status']); ?>">
                                            <?php echo ucfirst($row['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="sponsors.php?action=view&id=<?php echo $row['sponsor_id']; ?>" class="btn-icon" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if($row['status'] === 'pending'): ?>
                                            <a href="sponsors.php?action=approve&id=<?php echo $row['sponsor_id']; ?>" class="btn-icon text-success" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <a href="sponsors.php?action=reject&id=<?php echo $row['sponsor_id']; ?>" class="btn-icon text-danger" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </a>
                                            <?php endif; ?>
                                            <a href="mailto:<?php echo $row['email']; ?>" class="btn-icon" title="Email">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                            <a href="#" class="btn-icon btn-delete" data-id="<?php echo $row['sponsor_id']; ?>" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">No sponsors found</td>
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
                    <a href="sponsors.php?page=<?php echo $page - 1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">
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
                    <a href="sponsors.php?page=1&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">1</a>
                </li>
                <?php 
                    if ($start_page > 2): 
                        echo '<li><span class="pagination-ellipsis">...</span></li>';
                    endif;
                endif;
                
                for ($i = $start_page; $i <= $end_page; $i++): ?>
                <li>
                    <a href="sponsors.php?page=<?php echo $i; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" 
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
                    <a href="sponsors.php?page=<?php echo $total_pages; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link"><?php echo $total_pages; ?></a>
                </li>
                <?php endif; ?>
                
                <?php if ($page < $total_pages): ?>
                <li>
                    <a href="sponsors.php?page=<?php echo $page + 1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">
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
            <h2>Delete Sponsor</h2>
            <button class="modal-close" id="close-delete-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this sponsor? This action cannot be undone.</p>
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
    const sponsorCheckboxes = document.querySelectorAll('.sponsor-checkbox');
    
    if (selectAll) {
        selectAll.addEventListener('change', function() {
            sponsorCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        });
    }
    
    // Delete sponsor modal
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
        confirmDelete.href = `sponsors.php?action=delete&id=${id}`;
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
            window.location.href = `export-sponsors.php?filter=${filter}&search=${encodeURIComponent(search)}`;
        });
    }
});
</script>

<?php require_once 'includes/footer.php'; ?>
