<?php
ob_start();
require_once 'includes/header.php';
require_once 'includes/contact-crud.php';

// Initialize CRUD handler
$contactCrud = new ContactCrud($conn);

// Get message if ID is provided
$message = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $messageId = intval($_GET['id']);
    $message = $contactCrud->getById($messageId);
    
    if (!$message) {
        // Message not found, redirect to contact list
        header('Location: contact.php');
        exit;
    }
    
    // Mark message as read
    if (!$message['is_read']) {
        $contactCrud->markAsRead($messageId);
        $message['is_read'] = 1;
    }
} else {
    // No message ID provided, redirect to contact list
    header('Location: contact.php');
    exit;
}

// Handle email sending
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'] ?? '';
    $replyMessage = $_POST['reply_message'] ?? '';
    
    // Validate
    if (empty($subject)) {
        $errors[] = 'Subject is required';
    }
    
    if (empty($replyMessage)) {
        $errors[] = 'Message is required';
    }
    
    if (empty($errors)) {
        // In a real application, you would send an email here
        // For this example, we'll just log it
        
        $sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                VALUES (?, 'reply_message', ?, ?)";
        $stmt = $conn->prepare($sql);
        $ip = $_SERVER['REMOTE_ADDR'];
        $description = "Replied to message ID: {$messageId} from {$message['email']}";
        $stmt->bind_param("iss", $_SESSION['admin_id'], $description, $ip);
        $stmt->execute();
        
        $success = true;
    }
}
?>

<div class="content">
    <div class="card-header">
        <h2><i class="fas fa-reply"></i> Reply to Message</h2>
    </div>
    
    <div class="content-card">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <p><strong>Error:</strong> Please fix the following issues:</p>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>
                    <p>Your reply has been sent successfully!</p>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="message-original">
            <h3 class="section-title">Original Message</h3>
            
            <div class="message-details">
                <div class="message-meta">
                    <div class="meta-item">
                        <span class="meta-label">From:</span>
                        <span class="meta-value"><?php echo htmlspecialchars($message['name']); ?> (<?php echo htmlspecialchars($message['email']); ?>)</span>
                    </div>
                    
                    <?php if (!empty($message['phone'])): ?>
                    <div class="meta-item">
                        <span class="meta-label">Phone:</span>
                        <span class="meta-value"><?php echo htmlspecialchars($message['phone']); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="meta-item">
                        <span class="meta-label">Date:</span>
                        <span class="meta-value"><?php echo date('F j, Y g:i A', strtotime($message['created_at'])); ?></span>
                    </div>
                </div>
                
                <div class="message-content">
                    <p class="mb-0"><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                </div>
            </div>
        </div>
        
        <div class="reply-form mt-6">
            <h3 class="section-title">Your Reply</h3>
            
            <form method="POST">
                <div class="form-group">
                    <label for="subject" class="input-label field-required">Subject</label>
                    <input type="text" class="form-input" id="subject" name="subject" value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : 'Re: ByteVerse Inquiry'; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="reply_message" class="input-label field-required">Message</label>
                    <textarea class="form-textarea" id="reply_message" name="reply_message" rows="10" required><?php echo isset($_POST['reply_message']) ? htmlspecialchars($_POST['reply_message']) : ''; ?></textarea>
                </div>
                
                <div class="form-actions">
                    <a href="contact.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Messages
                    </a>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Send Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
require_once 'includes/footer.php';
ob_end_flush();
?>
