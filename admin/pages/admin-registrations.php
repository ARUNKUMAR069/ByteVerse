<?php
// filepath: c:\xampp\htdocs\new2\admin\pages\admin-registrations.php

// Require authentication
require_once '../includes/auth-check.php';
require_once '../includes/admin-database.php';
require_once '../includes/admin-functions.php';

// Add responsive styles
?>
<style>
    @media (max-width: 768px) {
        .admin-table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 15px;
        }
        
        .admin-table td, .admin-table th {
            white-space: nowrap;
        }
        
        .admin-table-action {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }
        
        .admin-page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .admin-header-actions {
            margin-top: 10px;
            align-self: flex-end;
        }
        
        .admin-form-grid {
            grid-template-columns: 1fr !important;
        }
        
        .admin-form-group.col-span-3,
        .admin-form-group.col-span-6 {
            grid-column: span 1 !important;
        }
    }

    /* Mobile-specific fixes */
    @media (max-width: 576px) {
        .admin-btn-icon {
            padding: 6px !important;
        }
        
        .admin-table td {
            padding: 8px 6px;
            font-size: 0.85rem;
        }

        .admin-pagination-item {
            width: 30px;
            height: 30px;
        }
    }
    
    /* Enhanced modal styles */
    .admin-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1050;
        overflow-y: auto;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .admin-modal.active {
        opacity: 1;
    }

    .admin-modal-content {
        background-color: var(--admin-card-bg);
        margin: 50px auto;
        max-width: 800px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-20px);
        transition: transform 0.3s ease;
        max-height: calc(100vh - 100px);
        display: flex;
        flex-direction: column;
    }

    .admin-modal.active .admin-modal-content {
        transform: translateY(0);
    }

    @media (max-width: 576px) {
        .admin-modal-content {
            width: 95%;
            margin: 20px auto;
        }
    }
</style>
<?php

// Initialize database connection
$database = new Database();
$conn = $database->getConnection();

// Process actions (approve, reject, delete)
if (isset($_POST['action']) && isset($_POST['registration_id'])) {
    $action = $_POST['action'];
    $registration_id = $_POST['registration_id'];
    $admin_id = $_SESSION['admin_user_id'];
    
    switch ($action) {
        case 'approve':
            $query = "UPDATE registrations SET reg_status = 'approved', approved_by = :admin_id, approved_at = NOW() 
                      WHERE reg_id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->bindParam(':id', $registration_id);
            
            if ($stmt->execute()) {
                // Send approval email
                $reg_query = "SELECT * FROM registrations WHERE reg_id = :id";
                $reg_stmt = $conn->prepare($reg_query);
                $reg_stmt->bindParam(':id', $registration_id);
                $reg_stmt->execute();
                $registration = $reg_stmt->fetch(PDO::FETCH_ASSOC);
                
                $to = $registration['leader_email'];
                $subject = "ByteVerse Hackathon - Registration Approved";
                $message = "Dear " . $registration['team_leader'] . ",\n\n";
                $message .= "We're thrilled to inform you that your team \"" . $registration['team_name'] . "\" has been approved for ByteVerse Hackathon!\n\n";
                $message .= "Please complete the payment process to confirm your spot.\n\n";
                $message .= "Looking forward to seeing your innovative solutions!\n\n";
                $message .= "Best regards,\nByteVerse Team";
                
                mail($to, $subject, $message);
                logAdminActivity($_SESSION['admin_user_id'], 'approve', 'registration', $registration_id, 'Registration approved');
                $_SESSION['admin_alert'] = ['type' => 'success', 'message' => 'Registration approved successfully'];
            } else {
                $_SESSION['admin_alert'] = ['type' => 'danger', 'message' => 'Failed to approve registration'];
            }
            break;
            
        case 'reject':
            $query = "UPDATE registrations SET reg_status = 'rejected', approved_by = :admin_id, approved_at = NOW() 
                      WHERE reg_id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->bindParam(':id', $registration_id);
            
            if ($stmt->execute()) {
                // Send rejection email
                $reg_query = "SELECT * FROM registrations WHERE reg_id = :id";
                $reg_stmt = $conn->prepare($reg_query);
                $reg_stmt->bindParam(':id', $registration_id);
                $reg_stmt->execute();
                $registration = $reg_stmt->fetch(PDO::FETCH_ASSOC);
                
                $to = $registration['leader_email'];
                $subject = "ByteVerse Hackathon - Registration Status";
                $message = "Dear " . $registration['team_leader'] . ",\n\n";
                $message .= "Thank you for your interest in ByteVerse Hackathon.\n\n";
                $message .= "After reviewing your application, we regret to inform you that we cannot approve your registration at this time.\n\n";
                $message .= "Please feel free to reach out if you have any questions.\n\n";
                $message .= "Best regards,\nByteVerse Team";
                
                mail($to, $subject, $message);
                logAdminActivity($_SESSION['admin_user_id'], 'reject', 'registration', $registration_id, 'Registration rejected');
                $_SESSION['admin_alert'] = ['type' => 'success', 'message' => 'Registration rejected successfully'];
            } else {
                $_SESSION['admin_alert'] = ['type' => 'danger', 'message' => 'Failed to reject registration'];
            }
            break;
            
        case 'delete':
            $query = "DELETE FROM registrations WHERE reg_id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $registration_id);
            
            if ($stmt->execute()) {
                logAdminActivity($_SESSION['admin_user_id'], 'delete', 'registration', $registration_id, 'Registration deleted');
                $_SESSION['admin_alert'] = ['type' => 'success', 'message' => 'Registration deleted successfully'];
            } else {
                $_SESSION['admin_alert'] = ['type' => 'danger', 'message' => 'Failed to delete registration'];
            }
            break;
    }
    
    // Fixed redirect path
    header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
    exit();
}

// Handle payment status update
if (isset($_POST['update_payment']) && isset($_POST['registration_id'])) {
    $registration_id = $_POST['registration_id'];
    $payment_status = $_POST['payment_status'];
    $admin_id = $_SESSION['admin_user_id'];
    
    $query = "UPDATE registrations SET payment_status = :status WHERE reg_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':status', $payment_status);
    $stmt->bindParam(':id', $registration_id);
    
    if ($stmt->execute()) {
        logAdminActivity($_SESSION['admin_user_id'], 'update', 'registration', $registration_id, "Payment status updated to $payment_status");
        $_SESSION['admin_alert'] = ['type' => 'success', 'message' => 'Payment status updated successfully'];
    } else {
        $_SESSION['admin_alert'] = ['type' => 'danger', 'message' => 'Failed to update payment status'];
    }
    
    // Fixed redirect path
    header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
    exit();
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Filtering
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$domain_filter = isset($_GET['domain']) ? $_GET['domain'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Base query
$query = "SELECT * FROM registrations WHERE 1=1";
$count_query = "SELECT COUNT(*) FROM registrations WHERE 1=1";
$params = [];

// Add filters to query - FIXED COLUMN NAMES
if (!empty($status_filter)) {
    $query .= " AND reg_status = :status";
    $count_query .= " AND reg_status = :status";
    $params[':status'] = $status_filter;
}

if (!empty($domain_filter)) {
    $query .= " AND project_domain = :domain";
    $count_query .= " AND project_domain = :domain";
    $params[':domain'] = $domain_filter;
}

if (!empty($search)) {
    $query .= " AND (team_name LIKE :search OR team_leader LIKE :search OR leader_email LIKE :search)";
    $count_query .= " AND (team_name LIKE :search OR team_leader LIKE :search OR leader_email LIKE :search)";
    $params[':search'] = "%$search%";
}

// Order by
$query .= " ORDER BY reg_created DESC LIMIT :limit OFFSET :offset";
$params[':limit'] = $limit;
$params[':offset'] = $offset;

// Execute count query
$count_stmt = $conn->prepare($count_query);
foreach ($params as $key => $value) {
    if ($key != ':limit' && $key != ':offset') {
        $count_stmt->bindValue($key, $value);
    }
}
$count_stmt->execute();
$total_records = $count_stmt->fetchColumn();
$total_pages = ceil($total_records / $limit);

// Execute main query
$stmt = $conn->prepare($query);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->execute();
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get domain options
$domain_query = "SELECT DISTINCT project_domain FROM registrations";
$domain_stmt = $conn->prepare($domain_query);
$domain_stmt->execute();
$domains = $domain_stmt->fetchAll(PDO::FETCH_COLUMN);

// Page title
$page_title = "Manage Registrations";
include '../components/admin-header.php';
?>

<div class="admin-content">
    <!-- Alert messages -->
    <?php if (isset($_SESSION['admin_alert'])): ?>
        <div class="admin-alert admin-alert-<?php echo $_SESSION['admin_alert']['type']; ?>">
            <div class="admin-alert-icon">
                <i class="fas fa-<?php echo $_SESSION['admin_alert']['type'] == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
            </div>
            <div class="admin-alert-content">
                <div class="admin-alert-message"><?php echo $_SESSION['admin_alert']['message']; ?></div>
            </div>
        </div>
        <?php unset($_SESSION['admin_alert']); ?>
    <?php endif; ?>

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Team Registrations</h1>
            <div class="admin-breadcrumb">
                <a href="../admin-dashboard.php" class="admin-breadcrumb-item">Dashboard</a>
                <span class="admin-breadcrumb-item active">Registrations</span>
            </div>
        </div>
        <div class="admin-header-actions">
            <a href="#" class="admin-btn admin-btn-primary" onclick="exportToCSV()">
                <i class="fas fa-download"></i> Export CSV
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card" style="margin-bottom: 20px;">
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="admin-form-grid">
            <div class="admin-form-group col-span-6">
                <label class="admin-form-label">Search</label>
                <input type="text" name="search" class="admin-form-input" placeholder="Team name, leader name or email" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="admin-form-group col-span-3">
                <label class="admin-form-label">Status</label>
                <select name="status" class="admin-form-select">
                    <option value="">All Status</option>
                    <option value="pending" <?php echo $status_filter == 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="approved" <?php echo $status_filter == 'approved' ? 'selected' : ''; ?>>Approved</option>
                    <option value="rejected" <?php echo $status_filter == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </div>
            <div class="admin-form-group col-span-3">
                <label class="admin-form-label">Domain</label>
                <select name="domain" class="admin-form-select">
                    <option value="">All Domains</option>
                    <?php foreach ($domains as $domain): ?>
                        <option value="<?php echo htmlspecialchars($domain); ?>" <?php echo $domain_filter == $domain ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($domain); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="admin-form-group col-span-12" style="margin-bottom: 0; display: flex; justify-content: flex-end; gap: 10px;">
                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="admin-btn admin-btn-outline">Reset</a>
                <button type="submit" class="admin-btn admin-btn-primary">Filter</button>
            </div>
        </form>
    </div>

    <!-- Registrations Table with Responsive Wrapper -->
    <div class="admin-table-responsive">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Team Name</th>
                        <th>Leader</th>
                        <th>Domain</th>
                        <th>Members</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($registrations) > 0): ?>
                        <?php foreach ($registrations as $registration): ?>
                            <tr>
                                <td><?php echo $registration['reg_id']; ?></td>
                                <td><?php echo htmlspecialchars($registration['team_name']); ?></td>
                                <td>
                                    <?php echo htmlspecialchars($registration['team_leader']); ?><br>
                                    <small><?php echo htmlspecialchars($registration['leader_email']); ?></small>
                                </td>
                                <td><?php echo htmlspecialchars($registration['project_domain']); ?></td>
                                <td><?php echo $registration['member_count']; ?></td>
                                <td>
                                    <span class="admin-status <?php echo strtolower($registration['payment_status']); ?>">
                                        <?php echo ucfirst($registration['payment_status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="admin-status <?php echo strtolower($registration['reg_status']); ?>">
                                        <?php echo ucfirst($registration['reg_status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d M Y', strtotime($registration['reg_created'])); ?></td>
                                <td>
                                    <div class="admin-table-action">
                                        <!-- View details -->
                                        <button class="admin-btn admin-btn-sm admin-btn-icon" 
                                                onclick="viewRegistration(<?php echo $registration['reg_id']; ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <!-- Approve -->
                                        <?php if ($registration['reg_status'] == 'pending'): ?>
                                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="display: inline-block;" 
                                                  onsubmit="return confirm('Are you sure you want to approve this registration?');">
                                                <input type="hidden" name="action" value="approve">
                                                <input type="hidden" name="registration_id" value="<?php echo $registration['reg_id']; ?>">
                                                <button type="submit" class="admin-btn admin-btn-sm admin-btn-success admin-btn-icon">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        
                                        <!-- Reject -->
                                        <?php if ($registration['reg_status'] == 'pending'): ?>
                                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="display: inline-block;" 
                                                  onsubmit="return confirm('Are you sure you want to reject this registration?');">
                                                <input type="hidden" name="action" value="reject">
                                                <input type="hidden" name="registration_id" value="<?php echo $registration['reg_id']; ?>">
                                                <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger admin-btn-icon">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        
                                        <!-- Update Payment -->
                                        <button class="admin-btn admin-btn-sm admin-btn-secondary admin-btn-icon" 
                                                onclick="updatePayment(<?php echo $registration['reg_id']; ?>, '<?php echo $registration['payment_status']; ?>')">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </button>
                                        
                                        <!-- Delete -->
                                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="display: inline-block;" 
                                              onsubmit="return confirm('Are you sure you want to delete this registration? This action cannot be undone.');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="registration_id" value="<?php echo $registration['reg_id']; ?>">
                                            <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger admin-btn-icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">No registrations found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="admin-pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&status=<?php echo $status_filter; ?>&domain=<?php echo $domain_filter; ?>&search=<?php echo urlencode($search); ?>" class="admin-pagination-item">
                    <i class="fas fa-chevron-left"></i>
                </a>
            <?php else: ?>
                <span class="admin-pagination-item disabled">
                    <i class="fas fa-chevron-left"></i>
                </span>
            <?php endif; ?>

            <?php
            $start_page = max(1, $page - 2);
            $end_page = min($total_pages, $start_page + 4);
            if ($end_page - $start_page < 4) {
                $start_page = max(1, $end_page - 4);
            }
            ?>

            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                <a href="?page=<?php echo $i; ?>&status=<?php echo $status_filter; ?>&domain=<?php echo $domain_filter; ?>&search=<?php echo urlencode($search); ?>" 
                   class="admin-pagination-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&status=<?php echo $status_filter; ?>&domain=<?php echo $domain_filter; ?>&search=<?php echo urlencode($search); ?>" class="admin-pagination-item">
                    <i class="fas fa-chevron-right"></i>
                </a>
            <?php else: ?>
                <span class="admin-pagination-item disabled">
                    <i class="fas fa-chevron-right"></i>
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Registration Details Modal -->
<div id="registration-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Registration Details</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('registration-modal')">&times;</button>
        </div>
        <div class="admin-modal-body" id="registration-details">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- Payment Status Modal -->
<div id="payment-modal" class="admin-modal">
    <div class="admin-modal-content" style="max-width: 400px;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Update Payment Status</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('payment-modal')">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form method="POST" id="payment-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="registration_id" id="payment-registration-id">
                <input type="hidden" name="update_payment" value="1">
                
                <div class="admin-form-group">
                    <label class="admin-form-label">Payment Status</label>
                    <select name="payment_status" class="admin-form-select" id="payment-status-select">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                
                <div class="admin-form-actions">
                    <button type="button" class="admin-btn admin-btn-outline" onclick="closeModal('payment-modal')">Cancel</button>
                    <button type="submit" class="admin-btn admin-btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// View registration details with improved functionality
function viewRegistration(id) {
    document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    
    fetch(`../api/get-registration.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Format registration details HTML
                let detailsHtml = `
                    <div class="admin-details-section">
                        <h4>Team Information</h4>
                        <div class="admin-details-grid">
                            <div class="admin-details-item">
                                <span class="admin-details-label">Team Name</span>
                                <span class="admin-details-value">${data.registration.team_name}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Domain</span>
                                <span class="admin-details-value">${data.registration.project_domain}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Members</span>
                                <span class="admin-details-value">${data.registration.member_count}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">College</span>
                                <span class="admin-details-value">${data.registration.college_name || 'Not specified'}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Status</span>
                                <span class="admin-details-value">
                                    <span class="admin-status ${data.registration.reg_status}">
                                        ${data.registration.reg_status.charAt(0).toUpperCase() + data.registration.reg_status.slice(1)}
                                    </span>
                                </span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Payment</span>
                                <span class="admin-details-value">
                                    <span class="admin-status ${data.registration.payment_status}">
                                        ${data.registration.payment_status.charAt(0).toUpperCase() + data.registration.payment_status.slice(1)}
                                    </span>
                                </span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Registered On</span>
                                <span class="admin-details-value">${new Date(data.registration.reg_created).toLocaleString()}</span>
                            </div>
                        </div>
                    </div>

                    <div class="admin-details-section">
                        <h4>Team Leader</h4>
                        <div class="admin-details-grid">
                            <div class="admin-details-item">
                                <span class="admin-details-label">Name</span>
                                <span class="admin-details-value">${data.registration.team_leader}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Email</span>
                                <span class="admin-details-value">${data.registration.leader_email}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Phone</span>
                                <span class="admin-details-value">${data.registration.leader_phone}</span>
                            </div>
                        </div>
                    </div>
                `;

                // Display team members if available
                if (data.registration.member_details) {
                    try {
                        const members = JSON.parse(data.registration.member_details);
                        if (members.length > 0) {
                            detailsHtml += `
                                <div class="admin-details-section">
                                    <h4>Team Members</h4>
                                    <table class="admin-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            `;

                            members.forEach((member, index) => {
                                detailsHtml += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${member.name}</td>
                                        <td>${member.email}</td>
                                        <td>${member.phone || 'N/A'}</td>
                                    </tr>
                                `;
                            });

                            detailsHtml += `
                                        </tbody>
                                    </table>
                                </div>
                            `;
                        }
                    } catch (e) {
                        console.error("Error parsing members data", e);
                    }
                }

                // Display project idea if available
                if (data.registration.project_idea) {
                    detailsHtml += `
                        <div class="admin-details-section">
                            <h4>Project Idea</h4>
                            <p>${data.registration.project_idea}</p>
                        </div>
                    `;
                }

                // Set HTML and open modal
                document.getElementById('registration-details').innerHTML = detailsHtml;
                const modal = document.getElementById('registration-modal');
                modal.style.display = 'block';
                modal.classList.add('active'); // Add active class for animation
            } else {
                alert('Error loading registration details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load registration details');
        });
}

// Update payment status with improved functionality
function updatePayment(id, currentStatus) {
    document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    
    document.getElementById('payment-registration-id').value = id;
    document.getElementById('payment-status-select').value = currentStatus;
    
    const modal = document.getElementById('payment-modal');
    modal.style.display = 'block';
    modal.classList.add('active'); // Add active class for animation
}

// Close modal with animation
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('active');
    
    // Wait for animation to complete
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = ''; // Re-enable scrolling
    }, 300);
}

// Export to CSV with fixed path
function exportToCSV() {
    window.location.href = '../api/export-registrations.php<?php 
        echo !empty($status_filter) ? "?status=$status_filter" : ""; 
        echo !empty($domain_filter) ? (!empty($status_filter) ? "&domain=$domain_filter" : "?domain=$domain_filter") : "";
        echo !empty($search) ? ((!empty($status_filter) || !empty($domain_filter)) ? "&search=$search" : "?search=$search") : "";
    ?>';
}

// Improved modal background click handling
window.onclick = function(event) {
    if (event.target.classList.contains('admin-modal')) {
        closeModal(event.target.id);
    }
};
</script>

<?php include '../components/admin-footer.php'; ?>