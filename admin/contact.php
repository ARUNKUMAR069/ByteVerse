<?php
require_once 'includes/header.php';

// Check if viewing a specific message
$view_message = isset($_GET['view']) && is_numeric($_GET['view']) ? intval($_GET['view']) : null;

// Mark message as read if viewing
if ($view_message) {
    $mark_read_sql = "UPDATE contact_messages SET is_read = 1 WHERE message_id = ?";
    $mark_read_stmt = $conn->prepare($mark_read_sql);
    $mark_read_stmt->bind_param("i", $view_message);
    $mark_read_stmt->execute();
    
    // Log activity
    $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                    VALUES (?, 'read_message', 'Read message ID: ".$view_message."', ?)";
    $activity_stmt = $conn->prepare($activity_sql);
    $ip = $_SERVER['REMOTE_ADDR'];
    $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
    $activity_stmt->execute();
}

// Process bulk actions
if (isset($_POST['bulk_action']) && isset($_POST['message_ids'])) {
    $action = $_POST['bulk_action'];
    $ids = $_POST['message_ids'];
    
    if (!empty($ids)) {
        if ($action === 'mark_read') {
            $ids_str = implode(',', array_map('intval', $ids));
            $mark_read_sql = "UPDATE contact_messages SET is_read = 1 WHERE message_id IN ($ids_str)";
            $conn->query($mark_read_sql);
            
            // Log activity
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                            VALUES (?, 'bulk_mark_read', 'Marked ".count($ids)." messages as read', ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
            $activity_stmt->execute();
        } elseif ($action === 'delete') {
            $ids_str = implode(',', array_map('intval', $ids));
            $delete_sql = "DELETE FROM contact_messages WHERE message_id IN ($ids_str)";
            $conn->query($delete_sql);
            
            // Log activity
            $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                            VALUES (?, 'bulk_delete', 'Deleted ".count($ids)." messages', ?)";
            $activity_stmt = $conn->prepare($activity_sql);
            $ip = $_SERVER['REMOTE_ADDR'];
            $activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
            $activity_stmt->execute();
        }
    }
    
    // Redirect to remove POST data
    safe_redirect('contact.php');
    exit;
}

// Get messages or specific message
if ($view_message) {
    $sql = "SELECT * FROM contact_messages WHERE message_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $view_message);
    $stmt->execute();
    $message_result = $stmt->get_result();
    $message = $message_result->fetch_assoc();
} else {
    // Pagination setup
    $limit = 10;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page - 1) * $limit;
    
    // Filter setup
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
    $where_clause = ($filter === 'unread') ? 'WHERE is_read = 0' : '';
    
    // Count total messages
    $count_sql = "SELECT COUNT(*) as total FROM contact_messages $where_clause";
    $count_result = $conn->query($count_sql);
    $total_messages = $count_result->fetch_assoc()['total'];
    $total_pages = ceil($total_messages / $limit);
    
    // Get messages for current page
    $sql = "SELECT * FROM contact_messages $where_clause ORDER BY created_at DESC LIMIT $offset, $limit";
    $messages_result = $conn->query($sql);
}
?>

<div class="content">
    <?php if ($view_message && $message): ?>
        <!-- Single Message View -->
        <div class="message-view">
            <div class="card-actions mb-4">
                <a href="contact.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Messages
                </a>
                <div class="flex-grow"></div>
                <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="btn btn-primary">
                    <i class="fas fa-reply"></i> Reply
                </a>
            </div>
            
            <div class="message-detail-card">
                <div class="message-detail-header">
                    <h3><?php echo htmlspecialchars($message['name']); ?></h3>
                    <div class="message-meta">
                        <div class="message-meta-item">
                            <i class="fas fa-envelope"></i>
                            <span><?php echo htmlspecialchars($message['email']); ?></span>
                        </div>
                        <?php if (!empty($message['phone'])): ?>
                        <div class="message-meta-item">
                            <i class="fas fa-phone"></i>
                            <span><?php echo htmlspecialchars($message['phone']); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="message-meta-item">
                            <i class="fas fa-clock"></i>
                            <span><?php echo date('F j, Y g:i A', strtotime($message['created_at'])); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="message-detail-content">
                    <?php echo nl2br(htmlspecialchars($message['message'])); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Messages List View -->
        <div class="card-header with-actions">
            <h2><i class="fas fa-envelope"></i> Contact Messages</h2>
            
            <div class="filter-actions">
                <div class="btn-group">
                    <a href="contact.php?filter=all" class="btn <?php echo $filter === 'all' ? 'btn-primary' : 'btn-light'; ?>">All</a>
                    <a href="contact.php?filter=unread" class="btn <?php echo $filter === 'unread' ? 'btn-primary' : 'btn-light'; ?>">Unread</a>
                </div>
            </div>
        </div>
        
        <div class="content-card">
            <form method="POST" action="">
                <div class="bulk-actions mb-4">
                    <select name="bulk_action" class="form-select">
                        <option value="">Bulk Actions</option>
                        <option value="mark_read">Mark as Read</option>
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
                                <th>Sender</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($messages_result) && $messages_result->num_rows > 0): ?>
                                <?php while($row = $messages_result->fetch_assoc()): ?>
                                    <tr class="<?php echo $row['is_read'] ? '' : 'unread-row'; ?>">
                                        <td>
                                            <input type="checkbox" name="message_ids[]" value="<?php echo $row['message_id']; ?>" class="message-checkbox">
                                        </td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td class="message-preview">
                                            <?php echo htmlspecialchars(substr($row['message'], 0, 50)); ?>
                                            <?php echo strlen($row['message']) > 50 ? '...' : ''; ?>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                                        <td>
                                            <?php if ($row['is_read']): ?>
                                                <span class="status-badge status-read">Read</span>
                                            <?php else: ?>
                                                <span class="status-badge status-unread">Unread</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="contact.php?view=<?php echo $row['message_id']; ?>" class="btn-icon" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="btn-icon" title="Reply">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                                <a href="#" class="btn-icon btn-delete" data-id="<?php echo $row['message_id']; ?>" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No messages found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>
            
            <?php if (isset($total_pages) && $total_pages > 1): ?>
                <div class="pagination-container">
                    <ul class="pagination">
                        <?php if ($page > 1): ?>
                            <li>
                                <a href="contact.php?page=<?php echo $page - 1; ?>&filter=<?php echo $filter; ?>" class="pagination-link">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li>
                                <a href="contact.php?page=<?php echo $i; ?>&filter=<?php echo $filter; ?>" 
                                   class="pagination-link <?php echo $i === $page ? 'active' : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($page < $total_pages): ?>
                            <li>
                                <a href="contact.php?page=<?php echo $page + 1; ?>&filter=<?php echo $filter; ?>" class="pagination-link">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal" id="delete-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Delete Message</h2>
            <button class="modal-close" id="close-delete-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this message? This action cannot be undone.</p>
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
    const messageCheckboxes = document.querySelectorAll('.message-checkbox');
    
    if (selectAll) {
        selectAll.addEventListener('change', function() {
            messageCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        });
    }
    
    // Delete message modal
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
        confirmDelete.href = `contact.php?action=delete&id=${id}`;
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
});
</script>

<?php require_once 'includes/footer.php'; ?>
