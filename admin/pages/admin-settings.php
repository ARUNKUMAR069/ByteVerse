<?php
// filepath: c:\xampp\htdocs\new2\admin\pages\admin-settings.php

// Require authentication
require_once '../includes/auth-check.php';
require_once '../includes/database.php';
require_once '../includes/functions.php';

// Only admin and manager roles can access settings
if (!in_array($_SESSION['admin_role'], ['admin', 'manager'])) {
    $_SESSION['admin_alert'] = [
        'type' => 'danger', 
        'message' => 'You do not have permission to access this page'
    ];
    header("Location: ../admin-dashboard.php");
    exit();
}

// Initialize database connection
$database = new Database();
$conn = $database->getConnection();

// Get current settings
$query = "SELECT * FROM admin_settings WHERE setting_key IN 
         ('event_name', 'event_date_start', 'event_date_end', 'registration_open', 
          'max_team_size', 'min_team_size', 'registration_fee', 'support_email', 
          'contact_phone', 'event_location', 'email_notifications')";
$stmt = $conn->prepare($query);
$stmt->execute();

$settings = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Default values if settings don't exist
$default_settings = [
    'event_name' => 'ByteVerse 1.0',
    'event_date_start' => '2025-08-22',
    'event_date_end' => '2025-08-23',
    'registration_open' => 'yes',
    'max_team_size' => '5',
    'min_team_size' => '3',
    'registration_fee' => '500',
    'support_email' => 'support@byteverse.com',
    'contact_phone' => '+91 9876543210',
    'event_location' => 'Tech Campus, Innovate City',
    'email_notifications' => 'yes'
];

// Merge with defaults
foreach ($default_settings as $key => $value) {
    if (!isset($settings[$key])) {
        $settings[$key] = $value;
    }
}

// Process general settings update
if (isset($_POST['update_general_settings'])) {
    $event_name = filter_input(INPUT_POST, 'event_name', FILTER_SANITIZE_STRING);
    $event_date_start = filter_input(INPUT_POST, 'event_date_start', FILTER_SANITIZE_STRING);
    $event_date_end = filter_input(INPUT_POST, 'event_date_end', FILTER_SANITIZE_STRING);
    $registration_open = filter_input(INPUT_POST, 'registration_open', FILTER_SANITIZE_STRING);
    $max_team_size = filter_input(INPUT_POST, 'max_team_size', FILTER_SANITIZE_NUMBER_INT);
    $min_team_size = filter_input(INPUT_POST, 'min_team_size', FILTER_SANITIZE_NUMBER_INT);
    $registration_fee = filter_input(INPUT_POST, 'registration_fee', FILTER_SANITIZE_NUMBER_INT);
    
    // Validate inputs
    $errors = [];
    if (empty($event_name)) {
        $errors[] = "Event name cannot be empty";
    }
    
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $event_date_start)) {
        $errors[] = "Start date must be in yyyy-mm-dd format";
    }
    
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $event_date_end)) {
        $errors[] = "End date must be in yyyy-mm-dd format";
    }
    
    if ($event_date_start > $event_date_end) {
        $errors[] = "Start date cannot be after end date";
    }
    
    if (!is_numeric($max_team_size) || $max_team_size < 1) {
        $errors[] = "Maximum team size must be a positive number";
    }
    
    if (!is_numeric($min_team_size) || $min_team_size < 1) {
        $errors[] = "Minimum team size must be a positive number";
    }
    
    if ($min_team_size > $max_team_size) {
        $errors[] = "Minimum team size cannot be greater than maximum team size";
    }
    
    if (!is_numeric($registration_fee) || $registration_fee < 0) {
        $errors[] = "Registration fee must be a non-negative number";
    }
    
    // If no errors, update settings
    if (empty($errors)) {
        try {
            $conn->beginTransaction();
            
            // Update settings
            $settings_to_update = [
                'event_name' => $event_name,
                'event_date_start' => $event_date_start,
                'event_date_end' => $event_date_end,
                'registration_open' => $registration_open,
                'max_team_size' => $max_team_size,
                'min_team_size' => $min_team_size,
                'registration_fee' => $registration_fee
            ];
            
            foreach ($settings_to_update as $key => $value) {
                $query = "INSERT INTO admin_settings (setting_key, setting_value) 
                          VALUES (:key, :value)
                          ON DUPLICATE KEY UPDATE setting_value = :value";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':key', $key);
                $stmt->bindParam(':value', $value);
                $stmt->execute();
            }
            
            $conn->commit();
            
            // Log activity
            logAdminActivity($_SESSION['admin_user_id'], 'update', 'settings', null, 'Updated general settings');
            
            $_SESSION['admin_alert'] = [
                'type' => 'success',
                'message' => 'General settings updated successfully'
            ];
            
            // Update local settings array
            foreach ($settings_to_update as $key => $value) {
                $settings[$key] = $value;
            }
            
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Error updating settings: ' . $e->getMessage()
            ];
        }
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Please correct the following errors: ' . implode(', ', $errors)
        ];
    }
}

// Process contact settings update
if (isset($_POST['update_contact_settings'])) {
    $support_email = filter_input(INPUT_POST, 'support_email', FILTER_SANITIZE_EMAIL);
    $contact_phone = filter_input(INPUT_POST, 'contact_phone', FILTER_SANITIZE_STRING);
    $event_location = filter_input(INPUT_POST, 'event_location', FILTER_SANITIZE_STRING);
    $email_notifications = filter_input(INPUT_POST, 'email_notifications', FILTER_SANITIZE_STRING);
    
    // Validate inputs
    $errors = [];
    if (!filter_var($support_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    
    // If no errors, update settings
    if (empty($errors)) {
        try {
            $conn->beginTransaction();
            
            // Update settings
            $settings_to_update = [
                'support_email' => $support_email,
                'contact_phone' => $contact_phone,
                'event_location' => $event_location,
                'email_notifications' => $email_notifications
            ];
            
            foreach ($settings_to_update as $key => $value) {
                $query = "INSERT INTO admin_settings (setting_key, setting_value) 
                          VALUES (:key, :value)
                          ON DUPLICATE KEY UPDATE setting_value = :value";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':key', $key);
                $stmt->bindParam(':value', $value);
                $stmt->execute();
            }
            
            $conn->commit();
            
            // Log activity
            logAdminActivity($_SESSION['admin_user_id'], 'update', 'settings', null, 'Updated contact settings');
            
            $_SESSION['admin_alert'] = [
                'type' => 'success',
                'message' => 'Contact settings updated successfully'
            ];
            
            // Update local settings array
            foreach ($settings_to_update as $key => $value) {
                $settings[$key] = $value;
            }
            
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Error updating settings: ' . $e->getMessage()
            ];
        }
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Please correct the following errors: ' . implode(', ', $errors)
        ];
    }
}

// Process password change
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate inputs
    $errors = [];
    if (empty($current_password)) {
        $errors[] = "Current password is required";
    }
    
    if (empty($new_password)) {
        $errors[] = "New password is required";
    } elseif (strlen($new_password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    
    if ($new_password !== $confirm_password) {
        $errors[] = "New passwords do not match";
    }
    
    // If no errors, check current password and update
    if (empty($errors)) {
        // Get user's current password
        $query = "SELECT password FROM admin_users WHERE id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['admin_user_id']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($current_password, $user['password'])) {
            // Hash new password
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update password
            $query = "UPDATE admin_users SET password = :password WHERE id = :user_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $password_hash);
            $stmt->bindParam(':user_id', $_SESSION['admin_user_id']);
            
            if ($stmt->execute()) {
                // Log activity
                logAdminActivity($_SESSION['admin_user_id'], 'update', 'users', $_SESSION['admin_user_id'], 'Changed password');
                
                $_SESSION['admin_alert'] = [
                    'type' => 'success',
                    'message' => 'Password changed successfully'
                ];
            } else {
                $_SESSION['admin_alert'] = [
                    'type' => 'danger',
                    'message' => 'Error changing password'
                ];
            }
        } else {
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Current password is incorrect'
            ];
        }
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Please correct the following errors: ' . implode(', ', $errors)
        ];
    }
}

// Page title
$pageTitle = "Admin Settings";
$breadcrumbs = [
    ['link' => '../admin-dashboard.php', 'text' => 'Dashboard'],
    ['link' => '', 'text' => 'Settings']
];

include '../components/admin-header.php';
?>

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title"><?php echo $pageTitle; ?></h1>
        <div class="admin-breadcrumb">
            <?php foreach ($breadcrumbs as $index => $crumb): ?>
                <div class="admin-breadcrumb-item <?php echo empty($crumb['link']) ? 'active' : ''; ?>">
                    <?php if (!empty($crumb['link'])): ?>
                        <a href="<?php echo $crumb['link']; ?>"><?php echo $crumb['text']; ?></a>
                    <?php else: ?>
                        <?php echo $crumb['text']; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['admin_alert'])): ?>
<div class="admin-alert admin-alert-<?php echo $_SESSION['admin_alert']['type']; ?>">
    <div class="admin-alert-icon">
        <?php if ($_SESSION['admin_alert']['type'] === 'success'): ?>
            <i class="fas fa-check-circle"></i>
        <?php elseif ($_SESSION['admin_alert']['type'] === 'danger'): ?>
            <i class="fas fa-exclamation-circle"></i>
        <?php endif; ?>
    </div>
    <div class="admin-alert-content">
        <div class="admin-alert-message"><?php echo $_SESSION['admin_alert']['message']; ?></div>
    </div>
</div>
<?php unset($_SESSION['admin_alert']); endif; ?>

<div class="admin-content">
    <!-- Settings Tabs -->
    <div class="admin-tabs-container">
        <div class="admin-tabs">
            <a href="#general" class="admin-tab active" data-tab="general">General Settings</a>
            <a href="#contact" class="admin-tab" data-tab="contact">Contact & Notifications</a>
            <a href="#password" class="admin-tab" data-tab="password">Change Password</a>
            <?php if ($_SESSION['admin_role'] === 'admin'): ?>
            <a href="#backup" class="admin-tab" data-tab="backup">Database Backup</a>
            <?php endif; ?>
        </div>
        
        <!-- General Settings Tab -->
        <div id="general" class="admin-tab-content active">
            <div class="admin-form-container">
                <h2 class="admin-form-title">General Event Settings</h2>
                
                <form method="post" action="">
                    <div class="admin-form-grid">
                        <div class="admin-form-group col-span-12">
                            <label class="admin-form-label" for="event_name">Event Name</label>
                            <input type="text" id="event_name" name="event_name" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['event_name']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="event_date_start">Event Start Date</label>
                            <input type="date" id="event_date_start" name="event_date_start" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['event_date_start']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="event_date_end">Event End Date</label>
                            <input type="date" id="event_date_end" name="event_date_end" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['event_date_end']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="registration_open">Registration Status</label>
                            <select id="registration_open" name="registration_open" class="admin-form-select">
                                <option value="yes" <?php echo $settings['registration_open'] === 'yes' ? 'selected' : ''; ?>>Open</option>
                                <option value="no" <?php echo $settings['registration_open'] === 'no' ? 'selected' : ''; ?>>Closed</option>
                            </select>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="registration_fee">Registration Fee (₹)</label>
                            <input type="number" id="registration_fee" name="registration_fee" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['registration_fee']); ?>" min="0">
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="min_team_size">Minimum Team Size</label>
                            <input type="number" id="min_team_size" name="min_team_size" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['min_team_size']); ?>" min="1" max="10">
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="max_team_size">Maximum Team Size</label>
                            <input type="number" id="max_team_size" name="max_team_size" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['max_team_size']); ?>" min="1" max="10">
                        </div>
                    </div>
                    
                    <div class="admin-form-actions">
                        <button type="submit" name="update_general_settings" class="admin-btn admin-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Contact Settings Tab -->
        <div id="contact" class="admin-tab-content">
            <div class="admin-form-container">
                <h2 class="admin-form-title">Contact & Notification Settings</h2>
                
                <form method="post" action="">
                    <div class="admin-form-grid">
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="support_email">Support Email</label>
                            <input type="email" id="support_email" name="support_email" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['support_email']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="contact_phone">Contact Phone</label>
                            <input type="text" id="contact_phone" name="contact_phone" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['contact_phone']); ?>">
                        </div>
                        
                        <div class="admin-form-group col-span-12">
                            <label class="admin-form-label" for="event_location">Event Location</label>
                            <input type="text" id="event_location" name="event_location" class="admin-form-input" 
                                   value="<?php echo htmlspecialchars($settings['event_location']); ?>">
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="email_notifications">Email Notifications</label>
                            <select id="email_notifications" name="email_notifications" class="admin-form-select">
                                <option value="yes" <?php echo $settings['email_notifications'] === 'yes' ? 'selected' : ''; ?>>Enabled</option>
                                <option value="no" <?php echo $settings['email_notifications'] === 'no' ? 'selected' : ''; ?>>Disabled</option>
                            </select>
                            <p class="admin-form-help">When enabled, the system will send email notifications for registrations, sponsor inquiries, etc.</p>
                        </div>
                    </div>
                    
                    <div class="admin-form-actions">
                        <button type="submit" name="update_contact_settings" class="admin-btn admin-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Password Change Tab -->
        <div id="password" class="admin-tab-content">
            <div class="admin-form-container">
                <h2 class="admin-form-title">Change Your Password</h2>
                
                <form method="post" action="">
                    <div class="admin-form-grid">
                        <div class="admin-form-group col-span-12">
                            <label class="admin-form-label" for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password" class="admin-form-input" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" class="admin-form-input" 
                                   pattern=".{8,}" title="Password must be at least 8 characters" required>
                            <p class="admin-form-help">Password must be at least 8 characters long</p>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label" for="confirm_password">Confirm New Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="admin-form-input" required>
                        </div>
                    </div>
                    
                    <div class="admin-form-actions">
                        <button type="submit" name="change_password" class="admin-btn admin-btn-primary">
                            <i class="fas fa-key"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <?php if ($_SESSION['admin_role'] === 'admin'): ?>
        <!-- Database Backup Tab -->
        <div id="backup" class="admin-tab-content">
            <div class="admin-form-container">
                <h2 class="admin-form-title">Database Backup</h2>
                
                <p>You can create a backup of the database to prevent data loss. The backup file will be downloaded to your computer.</p>
                
                <div class="admin-card" style="margin: 20px 0;">
                    <h3>Available Backups</h3>
                    
                    <?php
                    $backup_dir = '../backups/';
                    if (is_dir($backup_dir)) {
                        $files = scandir($backup_dir);
                        $backups = array_filter($files, function($file) {
                            return pathinfo($file, PATHINFO_EXTENSION) === 'sql';
                        });
                        
                        if (!empty($backups)) {
                            echo '<table class="admin-table" style="margin-top: 15px;">';
                            echo '<thead><tr><th>Backup File</th><th>Date</th><th>Size</th><th>Actions</th></tr></thead>';
                            echo '<tbody>';
                            
                            foreach ($backups as $backup) {
                                $file_path = $backup_dir . $backup;
                                $file_size = filesize($file_path);
                                $file_date = date("Y-m-d H:i:s", filemtime($file_path));
                                
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($backup) . '</td>';
                                echo '<td>' . $file_date . '</td>';
                                echo '<td>' . formatFileSize($file_size) . '</td>';
                                echo '<td class="admin-table-action">';
                                echo '<a href="../backups/' . urlencode($backup) . '" download class="admin-btn admin-btn-sm admin-btn-primary">Download</a>';
                                echo ' <a href="?delete_backup=' . urlencode($backup) . '" class="admin-btn admin-btn-sm admin-btn-danger" onclick="return confirm(\'Are you sure you want to delete this backup?\')">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            
                            echo '</tbody></table>';
                        } else {
                            echo '<p>No backups available.</p>';
                        }
                    } else {
                        echo '<p>Backup directory not found. Please create a "backups" directory with write permissions.</p>';
                    }
                    ?>
                </div>
                
                <div class="admin-form-actions">
                    <a href="../includes/backup.php" class="admin-btn admin-btn-primary">
                        <i class="fas fa-database"></i> Create New Backup
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.admin-tab');
    const tabContents = document.querySelectorAll('.admin-tab-content');
    
    // Check if there's a tab in the URL hash
    const hashTab = window.location.hash.substring(1);
    if (hashTab) {
        // Find the tab by its data-tab attribute
        const targetTab = document.querySelector(`.admin-tab[data-tab="${hashTab}"]`);
        if (targetTab) {
            // Trigger click on the tab
            targetTab.click();
        }
    }
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Add active class to current tab and content
            const tabId = this.getAttribute('data-tab');
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
            
            // Update URL hash
            window.location.hash = tabId;
        });
    });
    
    // Form validation for password change
    const passwordForm = document.querySelector('form[name="change_password"]');
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');
    
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            if (newPassword.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Passwords do not match');
                confirmPassword.focus();
            }
        });
    }
});
</script>

<?php include '../components/admin-footer.php'; ?>