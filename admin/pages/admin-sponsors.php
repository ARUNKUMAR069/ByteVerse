<?php
// filepath: c:\xampp\htdocs\new2\admin\pages\admin-sponsors.php

// Require authentication
require_once '../includes/auth-check.php';
require_once '../includes/database.php';
require_once '../includes/functions.php';

// Initialize database connection
$database = new Database();
$conn = $database->getConnection();

// Process actions (approve, reject, delete)
if (isset($_POST['action']) && isset($_POST['sponsor_id'])) {
    $action = $_POST['action'];
    $sponsor_id = $_POST['sponsor_id'];
    $admin_id = $_SESSION['admin_user_id'];
    
    switch ($action) {
        case 'approve':
            $query = "UPDATE sponsors SET status = 'approved', approved_by = :admin_id, approved_at = NOW() 
                      WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->bindParam(':id', $sponsor_id);
            
            if ($stmt->execute()) {
                // Send approval email
                $sponsor_query = "SELECT * FROM sponsors WHERE id = :id";
                $sponsor_stmt = $conn->prepare($sponsor_query);
                $sponsor_stmt->bindParam(':id', $sponsor_id);
                $sponsor_stmt->execute();
                $sponsor = $sponsor_stmt->fetch(PDO::FETCH_ASSOC);
                
                $to = $sponsor['email'];
                $subject = "ByteVerse Hackathon - Sponsorship Approved";
                $message = "Dear " . $sponsor['contact_name'] . ",\n\n";
                $message .= "We're excited to inform you that " . $sponsor['company_name'] . "'s sponsorship application for ByteVerse Hackathon has been approved!\n\n";
                $message .= "Our team will reach out to you shortly to discuss next steps and provide more details about your " . ucfirst($sponsor['tier']) . " tier sponsorship benefits.\n\n";
                $message .= "Thank you for supporting innovation and technology!\n\n";
                $message .= "Best regards,\nByteVerse Team";
                
                mail($to, $subject, $message);
                logActivity($conn, $admin_id, 'approve', 'sponsor', $sponsor_id, 'Sponsorship approved');
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Sponsorship approved successfully'];
            } else {
                $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Failed to approve sponsorship'];
            }
            break;
            
        case 'reject':
            $query = "UPDATE sponsors SET status = 'rejected', approved_by = :admin_id, approved_at = NOW() 
                      WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->bindParam(':id', $sponsor_id);
            
            if ($stmt->execute()) {
                // Send rejection email
                $sponsor_query = "SELECT * FROM sponsors WHERE id = :id";
                $sponsor_stmt = $conn->prepare($sponsor_query);
                $sponsor_stmt->bindParam(':id', $sponsor_id);
                $sponsor_stmt->execute();
                $sponsor = $sponsor_stmt->fetch(PDO::FETCH_ASSOC);
                
                $to = $sponsor['email'];
                $subject = "ByteVerse Hackathon - Sponsorship Application Status";
                $message = "Dear " . $sponsor['contact_name'] . ",\n\n";
                $message .= "Thank you for your interest in sponsoring ByteVerse Hackathon.\n\n";
                $message .= "After careful consideration, we regret to inform you that we are unable to approve your sponsorship application at this time.\n\n";
                $message .= "We appreciate your support and would be happy to discuss other opportunities in the future.\n\n";
                $message .= "Best regards,\nByteVerse Team";
                
                mail($to, $subject, $message);
                logActivity($conn, $admin_id, 'reject', 'sponsor', $sponsor_id, 'Sponsorship rejected');
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Sponsorship rejected successfully'];
            } else {
                $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Failed to reject sponsorship'];
            }
            break;
            
        case 'delete':
            $query = "DELETE FROM sponsors WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $sponsor_id);
            
            if ($stmt->execute()) {
                logActivity($conn, $admin_id, 'delete', 'sponsor', $sponsor_id, 'Sponsorship deleted');
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Sponsorship deleted successfully'];
            } else {
                $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Failed to delete sponsorship'];
            }
            break;
    }
    
    header("Location: admin-sponsors.php");
    exit();
}

// Handle add/edit sponsor
if (isset($_POST['save_sponsor'])) {
    $sponsor_id = isset($_POST['sponsor_id']) ? $_POST['sponsor_id'] : null;
    $company_name = $_POST['company_name'];
    $contact_name = $_POST['contact_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $tier = $_POST['tier'];
    $message = $_POST['message'];
    $admin_id = $_SESSION['admin_user_id'];
    
    // Validate inputs
    if (empty($company_name) || empty($contact_name) || empty($email) || empty($phone) || empty($tier)) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'All required fields must be filled'];
        header("Location: admin-sponsors.php");
        exit();
    }
    
    // Check if we're updating or adding new sponsor
    if ($sponsor_id) {
        // Update existing sponsor
        $query = "UPDATE sponsors SET 
                  company_name = :company_name, 
                  contact_name = :contact_name, 
                  email = :email, 
                  phone = :phone, 
                  website = :website, 
                  tier = :tier, 
                  message = :message 
                  WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $sponsor_id);
        $action = 'update';
        $success_message = 'Sponsor updated successfully';
    } else {
        // Add new sponsor
        $query = "INSERT INTO sponsors 
                  (company_name, contact_name, email, phone, website, tier, message, status) 
                  VALUES 
                  (:company_name, :contact_name, :email, :phone, :website, :tier, :message, 'pending')";
        $stmt = $conn->prepare($query);
        $action = 'create';
        $success_message = 'Sponsor added successfully';
    }
    
    // Bind common parameters
    $stmt->bindParam(':company_name', $company_name);
    $stmt->bindParam(':contact_name', $contact_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':website', $website);
    $stmt->bindParam(':tier', $tier);
    $stmt->bindParam(':message', $message);
    
    if ($stmt->execute()) {
        if (!$sponsor_id) {
            $sponsor_id = $conn->lastInsertId();
        }
        logActivity($conn, $admin_id, $action, 'sponsor', $sponsor_id, $action == 'update' ? 'Sponsor updated' : 'Sponsor created');
        $_SESSION['alert'] = ['type' => 'success', 'message' => $success_message];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Failed to save sponsor'];
    }
    
    header("Location: admin-sponsors.php");
    exit();
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Filtering
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$tier_filter = isset($_GET['tier']) ? $_GET['tier'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Base query
$query = "SELECT * FROM sponsors WHERE 1=1";
$count_query = "SELECT COUNT(*) FROM sponsors WHERE 1=1";
$params = [];

// Add filters to query
if (!empty($status_filter)) {
    $query .= " AND status = :status";
    $count_query .= " AND status = :status";
    $params[':status'] = $status_filter;
}

if (!empty($tier_filter)) {
    $query .= " AND tier = :tier";
    $count_query .= " AND tier = :tier";
    $params[':tier'] = $tier_filter;
}

if (!empty($search)) {
    $query .= " AND (company_name LIKE :search OR contact_name LIKE :search OR email LIKE :search)";
    $count_query .= " AND (company_name LIKE :search OR contact_name LIKE :search OR email LIKE :search)";
    $params[':search'] = "%$search%";
}

// Order by
$query .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
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
$sponsors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Page title
$page_title = "Manage Sponsors";
include '../components/admin-header.php';
?>

<div class="admin-content">
    <!-- Alert messages -->
    <?php if (isset($_SESSION['alert'])): ?>
        <div class="admin-alert admin-alert-<?php echo $_SESSION['alert']['type']; ?>">
            <div class="admin-alert-icon">
                <i class="fas fa-<?php echo $_SESSION['alert']['type'] == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
            </div>
            <div class="admin-alert-content">
                <div class="admin-alert-message"><?php echo $_SESSION['alert']['message']; ?></div>
            </div>
        </div>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>

    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Sponsors Management</h1>
            <div class="admin-breadcrumb">
                <a href="../admin-dashboard.php" class="admin-breadcrumb-item">Dashboard</a>
                <span class="admin-breadcrumb-item active">Sponsors</span>
            </div>
        </div>
        <div class="admin-header-actions">
            <a href="#" class="admin-btn admin-btn-primary" onclick="showAddSponsorModal()">
                <i class="fas fa-plus"></i> Add Sponsor
            </a>
            <a href="#" class="admin-btn admin-btn-secondary" onclick="exportToCSV()">
                <i class="fas fa-download"></i> Export CSV
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card" style="margin-bottom: 20px;">
        <form method="GET" action="" class="admin-form-grid">
            <div class="admin-form-group col-span-6">
                <label class="admin-form-label">Search</label>
                <input type="text" name="search" class="admin-form-input" placeholder="Company, contact name or email" value="<?php echo htmlspecialchars($search); ?>">
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
                <label class="admin-form-label">Tier</label>
                <select name="tier" class="admin-form-select">
                    <option value="">All Tiers</option>
                    <option value="platinum" <?php echo $tier_filter == 'platinum' ? 'selected' : ''; ?>>Platinum</option>
                    <option value="gold" <?php echo $tier_filter == 'gold' ? 'selected' : ''; ?>>Gold</option>
                    <option value="silver" <?php echo $tier_filter == 'silver' ? 'selected' : ''; ?>>Silver</option>
                    <option value="bronze" <?php echo $tier_filter == 'bronze' ? 'selected' : ''; ?>>Bronze</option>
                </select>
            </div>
            <div class="admin-form-group col-span-12" style="margin-bottom: 0; display: flex; justify-content: flex-end; gap: 10px;">
                <a href="admin-sponsors.php" class="admin-btn admin-btn-outline">Reset</a>
                <button type="submit" class="admin-btn admin-btn-primary">Filter</button>
            </div>
        </form>
    </div>

    <!-- Sponsors Table -->
    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Contact</th>
                    <th>Tier</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($sponsors) > 0): ?>
                    <?php foreach ($sponsors as $sponsor): ?>
                        <tr>
                            <td><?php echo $sponsor['id']; ?></td>
                            <td>
                                <?php echo htmlspecialchars($sponsor['company_name']); ?>
                                <?php if ($sponsor['website']): ?>
                                    <br><small><a href="<?php echo htmlspecialchars($sponsor['website']); ?>" target="_blank" class="admin-link"><?php echo htmlspecialchars($sponsor['website']); ?></a></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($sponsor['contact_name']); ?><br>
                                <small><?php echo htmlspecialchars($sponsor['email']); ?></small>
                            </td>
                            <td>
                                <span class="admin-tier-badge <?php echo strtolower($sponsor['tier']); ?>">
                                    <?php echo ucfirst($sponsor['tier']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="admin-status <?php echo strtolower($sponsor['status']); ?>">
                                    <?php echo ucfirst($sponsor['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('d M Y', strtotime($sponsor['created_at'])); ?></td>
                            <td>
                                <div class="admin-table-action">
                                    <!-- View details -->
                                    <button class="admin-btn admin-btn-sm admin-btn-icon" 
                                            onclick="viewSponsor(<?php echo $sponsor['id']; ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    
                                    <!-- Edit -->
                                    <button class="admin-btn admin-btn-sm admin-btn-secondary admin-btn-icon" 
                                            onclick="editSponsor(<?php echo $sponsor['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Approve -->
                                    <?php if ($sponsor['status'] == 'pending'): ?>
                                        <form method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to approve this sponsor?');">
                                            <input type="hidden" name="action" value="approve">
                                            <input type="hidden" name="sponsor_id" value="<?php echo $sponsor['id']; ?>">
                                            <button type="submit" class="admin-btn admin-btn-sm admin-btn-success admin-btn-icon">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <!-- Reject -->
                                    <?php if ($sponsor['status'] == 'pending'): ?>
                                        <form method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to reject this sponsor?');">
                                            <input type="hidden" name="action" value="reject">
                                            <input type="hidden" name="sponsor_id" value="<?php echo $sponsor['id']; ?>">
                                            <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger admin-btn-icon">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <!-- Delete -->
                                    <form method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this sponsor? This action cannot be undone.');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="sponsor_id" value="<?php echo $sponsor['id']; ?>">
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
                        <td colspan="7" style="text-align: center;">No sponsors found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="admin-pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&status=<?php echo $status_filter; ?>&tier=<?php echo $tier_filter; ?>&search=<?php echo urlencode($search); ?>" class="admin-pagination-item">
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
                <a href="?page=<?php echo $i; ?>&status=<?php echo $status_filter; ?>&tier=<?php echo $tier_filter; ?>&search=<?php echo urlencode($search); ?>" 
                   class="admin-pagination-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&status=<?php echo $status_filter; ?>&tier=<?php echo $tier_filter; ?>&search=<?php echo urlencode($search); ?>" class="admin-pagination-item">
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

<!-- Sponsor Details Modal -->
<div id="sponsor-view-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Sponsor Details</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('sponsor-view-modal')">&times;</button>
        </div>
        <div class="admin-modal-body" id="sponsor-details">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- Add/Edit Sponsor Modal -->
<div id="sponsor-edit-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="sponsor-modal-title">Add New Sponsor</h3>
            <button type="button" class="admin-modal-close" onclick="closeModal('sponsor-edit-modal')">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form method="POST" id="sponsor-form">
                <input type="hidden" name="save_sponsor" value="1">
                <input type="hidden" name="sponsor_id" id="edit-sponsor-id">
                
                <div class="admin-form-grid">
                    <div class="admin-form-group col-span-6">
                        <label class="admin-form-label">Company Name*</label>
                        <input type="text" name="company_name" id="edit-company-name" class="admin-form-input" required>
                    </div>
                    
                    <div class="admin-form-group col-span-6">
                        <label class="admin-form-label">Contact Person*</label>
                        <input type="text" name="contact_name" id="edit-contact-name" class="admin-form-input" required>
                    </div>
                    
                    <div class="admin-form-group col-span-6">
                        <label class="admin-form-label">Email*</label>
                        <input type="email" name="email" id="edit-email" class="admin-form-input" required>
                    </div>
                    
                    <div class="admin-form-group col-span-6">
                        <label class="admin-form-label">Phone*</label>
                        <input type="text" name="phone" id="edit-phone" class="admin-form-input" required>
                    </div>
                    
                    <div class="admin-form-group col-span-6">
                        <label class="admin-form-label">Website</label>
                        <input type="url" name="website" id="edit-website" class="admin-form-input" placeholder="https://">
                    </div>
                    
                    <div class="admin-form-group col-span-6">
                        <label class="admin-form-label">Sponsorship Tier*</label>
                        <select name="tier" id="edit-tier" class="admin-form-select" required>
                            <option value="">Select Tier</option>
                            <option value="platinum">Platinum</option>
                            <option value="gold">Gold</option>
                            <option value="silver">Silver</option>
                            <option value="bronze">Bronze</option>
                        </select>
                    </div>
                    
                    <div class="admin-form-group col-span-12">
                        <label class="admin-form-label">Additional Information</label>
                        <textarea name="message" id="edit-message" class="admin-form-textarea" rows="4"></textarea>
                    </div>
                </div>
                
                <div class="admin-form-actions">
                    <button type="button" class="admin-btn admin-btn-outline" onclick="closeModal('sponsor-edit-modal')">Cancel</button>
                    <button type="submit" class="admin-btn admin-btn-primary">Save Sponsor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Show add sponsor modal
function showAddSponsorModal() {
    // Reset form
    document.getElementById('sponsor-form').reset();
    document.getElementById('edit-sponsor-id').value = '';
    document.getElementById('sponsor-modal-title').textContent = 'Add New Sponsor';
    
    // Show modal
    document.getElementById('sponsor-edit-modal').style.display = 'block';
}

// View sponsor details
function viewSponsor(id) {
    fetch(`../api/get-sponsor.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Format sponsor details HTML
                let detailsHtml = `
                    <div class="admin-details-section">
                        <h4>Company Information</h4>
                        <div class="admin-details-grid">
                            <div class="admin-details-item">
                                <span class="admin-details-label">Company Name</span>
                                <span class="admin-details-value">${data.sponsor.company_name}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Tier</span>
                                <span class="admin-details-value">
                                    <span class="admin-tier-badge ${data.sponsor.tier}">
                                        ${data.sponsor.tier.charAt(0).toUpperCase() + data.sponsor.tier.slice(1)}
                                    </span>
                                </span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Status</span>
                                <span class="admin-details-value">
                                    <span class="admin-status ${data.sponsor.status}">
                                        ${data.sponsor.status.charAt(0).toUpperCase() + data.sponsor.status.slice(1)}
                                    </span>
                                </span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Website</span>
                                <span class="admin-details-value">
                                    ${data.sponsor.website ? `<a href="${data.sponsor.website}" target="_blank" class="admin-link">${data.sponsor.website}</a>` : 'Not provided'}
                                </span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Submitted On</span>
                                <span class="admin-details-value">${new Date(data.sponsor.created_at).toLocaleString()}</span>
                            </div>
                        </div>
                    </div>

                    <div class="admin-details-section">
                        <h4>Contact Information</h4>
                        <div class="admin-details-grid">
                            <div class="admin-details-item">
                                <span class="admin-details-label">Contact Person</span>
                                <span class="admin-details-value">${data.sponsor.contact_name}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Email</span>
                                <span class="admin-details-value">${data.sponsor.email}</span>
                            </div>
                            <div class="admin-details-item">
                                <span class="admin-details-label">Phone</span>
                                <span class="admin-details-value">${data.sponsor.phone}</span>
                            </div>
                        </div>
                    </div>
                `;

                // Add message if available
                if (data.sponsor.message) {
                    detailsHtml += `
                        <div class="admin-details-section">
                            <h4>Additional Information</h4>
                            <p>${data.sponsor.message}</p>
                        </div>
                    `;
                }

                // Add approval info if approved
                if (data.sponsor.status === 'approved' && data.sponsor.approved_at) {
                    detailsHtml += `
                        <div class="admin-details-section">
                            <h4>Approval Information</h4>
                            <div class="admin-details-grid">
                                <div class="admin-details-item">
                                    <span class="admin-details-label">Approved By</span>
                                    <span class="admin-details-value">${data.approver_name || 'Unknown'}</span>
                                </div>
                                <div class="admin-details-item">
                                    <span class="admin-details-label">Approved On</span>
                                    <span class="admin-details-value">${new Date(data.sponsor.approved_at).toLocaleString()}</span>
                                </div>
                            </div>
                        </div>
                    `;
                }

                // Set HTML and open modal
                document.getElementById('sponsor-details').innerHTML = detailsHtml;
                document.getElementById('sponsor-view-modal').style.display = 'block';
            } else {
                alert('Error loading sponsor details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load sponsor details');
        });
}

// Edit sponsor
function editSponsor(id) {
    fetch(`../api/get-sponsor.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fill form with sponsor data
                document.getElementById('edit-sponsor-id').value = data.sponsor.id;
                document.getElementById('edit-company-name').value = data.sponsor.company_name;
                document.getElementById('edit-contact-name').value = data.sponsor.contact_name;
                document.getElementById('edit-email').value = data.sponsor.email;
                document.getElementById('edit-phone').value = data.sponsor.phone;
                document.getElementById('edit-website').value = data.sponsor.website || '';
                document.getElementById('edit-tier').value = data.sponsor.tier;
                document.getElementById('edit-message').value = data.sponsor.message || '';
                
                // Update modal title
                document.getElementById('sponsor-modal-title').textContent = 'Edit Sponsor';
                
                // Show modal
                document.getElementById('sponsor-edit-modal').style.display = 'block';
            } else {
                alert('Error loading sponsor data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load sponsor data');
        });
}

// Close modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Export to CSV
function exportToCSV() {
    window.location.href = '../api/export-sponsors.php<?php 
        echo !empty($status_filter) ? "?status=$status_filter" : ""; 
        echo !empty($tier_filter) ? (!empty($status_filter) ? "&tier=$tier_filter" : "?tier=$tier_filter") : "";
        echo !empty($search) ? ((!empty($status_filter) || !empty($tier_filter)) ? "&search=$search" : "?search=$search") : "";
    ?>';
}

// Close modals when clicking outside
window.onclick = function(event) {
    if (event.target.className === 'admin-modal') {
        event.target.style.display = 'none';
    }
};
</script>

<?php include '../components/admin-footer.php'; ?>