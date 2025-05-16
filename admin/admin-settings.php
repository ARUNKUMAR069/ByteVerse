<?php
// filepath: c:\xampp\htdocs\new2\admin\admin-settings.php

// Include required files
require_once 'includes/auth-check.php';
require_once 'includes/admin-database.php';
require_once 'includes/admin-functions.php';

// Check if user has permission to access settings
if (!in_array($_SESSION['admin_role'], ['admin', 'super_admin', 'manager'])) {
    $_SESSION['admin_alert'] = [
        'type' => 'danger', 
        'message' => 'You do not have permission to access this page'
    ];
    header("Location: admin-dashboard.php");
    exit();
}

// Initialize database connection
$database = new AdminDatabase();
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

// Process settings update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_settings'])) {
    $updated = true;
    
    // General settings
    $updateSettings = [
        'event_name' => adminSanitizeInput($_POST['event_name']),
        'event_date_start' => adminSanitizeInput($_POST['event_date_start']),
        'event_date_end' => adminSanitizeInput($_POST['event_date_end']),
        'registration_open' => isset($_POST['registration_open']) ? 'yes' : 'no',
        'max_team_size' => (int)$_POST['max_team_size'],
        'min_team_size' => (int)$_POST['min_team_size'],
        'registration_fee' => (float)$_POST['registration_fee'],
        'support_email' => adminSanitizeInput($_POST['support_email']),
        'contact_phone' => adminSanitizeInput($_POST['contact_phone']),
        'event_location' => adminSanitizeInput($_POST['event_location']),
        'email_notifications' => isset($_POST['email_notifications']) ? 'yes' : 'no'
    ];
    
    // Update each setting
    foreach ($updateSettings as $key => $value) {
        $updateQuery = "INSERT INTO admin_settings (setting_key, setting_value) 
                       VALUES (:key, :value) 
                       ON DUPLICATE KEY UPDATE setting_value = :value";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':key', $key);
        $updateStmt->bindParam(':value', $value);
        
        if (!$updateStmt->execute()) {
            $updated = false;
        }
    }
    
    if ($updated) {
        logAdminActivity($_SESSION['admin_user_id'], 'update', 'settings', null, 'Updated system settings');
        $_SESSION['admin_alert'] = [
            'type' => 'success',
            'message' => 'Settings updated successfully'
        ];
        
        // Update settings array with new values
        $settings = $updateSettings;
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Failed to update some settings'
        ];
    }
}

// Database backup
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_backup'])) {
    // Database configuration
    $db_config = [
        'host' => 'localhost',
        'name' => 'byteverse',
        'user' => 'root',
        'pass' => ''
    ];
    
    // Create backup directory if it doesn't exist
    $backup_dir = 'backups/';
    if (!is_dir($backup_dir)) {
        mkdir($backup_dir, 0755, true);
    }
    
    // Generate backup file name
    $date = date("Y-m-d-H-i-s");
    $backup_file = $backup_dir . 'byteverse_backup_' . $date . '.sql';
    
    // Command to execute
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Windows
        $cmd = "mysqldump -h {$db_config['host']} -u {$db_config['user']}" . 
              (empty($db_config['pass']) ? "" : " -p{$db_config['pass']}") . 
              " {$db_config['name']} > \"$backup_file\"";
    } else {
        // Linux/Unix/Mac
        $cmd = "mysqldump -h {$db_config['host']} -u {$db_config['user']}" . 
              (empty($db_config['pass']) ? "" : " -p{$db_config['pass']}") . 
              " {$db_config['name']} > \"$backup_file\" 2>&1";
    }
    
    // Execute command
    exec($cmd, $output, $return_var);
    
    // Check if backup was successful
    if ($return_var === 0) {
        // Log activity
        logAdminActivity($_SESSION['admin_user_id'], 'create', 'backup', null, 'Created database backup');
        
        $_SESSION['admin_alert'] = [
            'type' => 'success',
            'message' => 'Database backup created successfully'
        ];
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Failed to create database backup: ' . implode(" ", $output)
        ];
    }
}

// Set page title
$page_title = "System Settings";
include 'components/admin-header.php';
?>

<div class="admin-content">
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">System Settings</h1>
            <div class="admin-breadcrumb">
                <a href="admin-dashboard.php" class="admin-breadcrumb-item">Dashboard</a>
                <span class="admin-breadcrumb-item active">Settings</span>
            </div>
        </div>
    </div>
    
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
    
    <!-- Settings Tabs -->
    <div class="admin-card">
        <div class="admin-card-header">
            <ul class="admin-tabs">
                <li class="admin-tab-item active" data-tab="general">
                    <i class="fas fa-cog"></i> General
                </li>
                <li class="admin-tab-item" data-tab="registration">
                    <i class="fas fa-users"></i> Registration
                </li>
                <li class="admin-tab-item" data-tab="contact">
                    <i class="fas fa-envelope"></i> Contact
                </li>
                <li class="admin-tab-item" data-tab="backup">
                    <i class="fas fa-database"></i> Backup
                </li>
            </ul>
        </div>
        <div class="admin-card-body">
            <form method="POST" class="admin-form-validation">
                <!-- General Settings Tab -->
                <div class="admin-tab-content active" id="general-tab">
                    <div class="admin-form-grid">
                        <div class="admin-form-group col-span-12">
                            <label class="admin-form-label">Event Name</label>
                            <input type="text" name="event_name" class="admin-form-input" value="<?php echo htmlspecialchars($settings['event_name']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label">Start Date</label>
                            <input type="date" name="event_date_start" class="admin-form-input" value="<?php echo htmlspecialchars($settings['event_date_start']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label">End Date</label>
                            <input type="date" name="event_date_end" class="admin-form-input" value="<?php echo htmlspecialchars($settings['event_date_end']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-12">
                            <label class="admin-form-label">Event Location</label>
                            <input type="text" name="event_location" class="admin-form-input" value="<?php echo htmlspecialchars($settings['event_location']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <div class="admin-form-check">
                                <input type="checkbox" id="registration_open" name="registration_open" class="admin-form-check-input" <?php echo $settings['registration_open'] === 'yes' ? 'checked' : ''; ?>>
                                <label for="registration_open" class="admin-form-check-label">Registrations Open</label>
                            </div>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <div class="admin-form-check">
                                <input type="checkbox" id="email_notifications" name="email_notifications" class="admin-form-check-input" <?php echo $settings['email_notifications'] === 'yes' ? 'checked' : ''; ?>>
                                <label for="email_notifications" class="admin-form-check-label">Enable Email Notifications</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Registration Settings Tab -->
                <div class="admin-tab-content" id="registration-tab" style="display: none;">
                    <div class="admin-form-grid">
                        <div class="admin-form-group col-span-4">
                            <label class="admin-form-label">Minimum Team Size</label>
                            <input type="number" name="min_team_size" class="admin-form-input" value="<?php echo htmlspecialchars($settings['min_team_size']); ?>" min="1" max="10" required>
                        </div>
                        
                        <div class="admin-form-group col-span-4">
                            <label class="admin-form-label">Maximum Team Size</label>
                            <input type="number" name="max_team_size" class="admin-form-input" value="<?php echo htmlspecialchars($settings['max_team_size']); ?>" min="1" max="10" required>
                        </div>
                        
                        <div class="admin-form-group col-span-4">
                            <label class="admin-form-label">Registration Fee (₹)</label>
                            <input type="number" name="registration_fee" class="admin-form-input" value="<?php echo htmlspecialchars($settings['registration_fee']); ?>" min="0" required>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Settings Tab -->
                <div class="admin-tab-content" id="contact-tab" style="display: none;">
                    <div class="admin-form-grid">
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label">Support Email</label>
                            <input type="email" name="support_email" class="admin-form-input" value="<?php echo htmlspecialchars($settings['support_email']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label">Contact Phone</label>
                            <input type="text" name="contact_phone" class="admin-form-input" value="<?php echo htmlspecialchars($settings['contact_phone']); ?>" required>
                        </div>
                    </div>
                </div>
                
                <!-- Backup Tab -->
                <div class="admin-tab-content" id="backup-tab" style="display: none;">
                    <div class="admin-form-group">
                        <p style="margin-bottom: 15px;">Database backups allow you to save a copy of your entire database, which can be restored in case of data loss or corruption.</p>
                        
                        <?php
                        // Get list of existing backups
                        $backups = [];
                        $backup_dir = 'backups/';
                        if (is_dir($backup_dir)) {
                            $files = scandir($backup_dir);
                            foreach ($files as $file) {
                                if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'sql') {
                                    $backups[] = [
                                        'name' => $file,
                                        'size' => filesize($backup_dir . $file),
                                        'date' => date('Y-m-d H:i:s', filemtime($backup_dir . $file))
                                    ];
                                }
                            }
                            
                            // Sort by date (newest first)
                            usort($backups, function($a, $b) {
                                return strtotime($b['date']) - strtotime($a['date']);
                            });
                        }
                        ?>
                        
                        <div style="margin-bottom: 20px;">
                            <button type="submit" name="create_backup" class="admin-btn admin-btn-primary">
                                <i class="fas fa-download"></i> Create New Backup
                            </button>
                        </div>
                        
                        <?php if (count($backups) > 0): ?>
                            <div class="admin-table-responsive">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th>Filename</th>
                                            <th>Created</th>
                                            <th>Size</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($backups as $backup): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($backup['name']); ?></td>
                                                <td><?php echo date('M d, Y h:i A', strtotime($backup['date'])); ?></td>
                                                <td><?php echo formatFileSize($backup['size']); ?></td>
                                                <td>
                                                    <div class="admin-table-action">
                                                        <a href="<?php echo $backup_dir . $backup['name']; ?>" class="admin-btn admin-btn-sm admin-btn-icon" download>
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <a href="api/delete-backup.php?file=<?php echo urlencode($backup['name']); ?>" class="admin-btn admin-btn-sm admin-btn-danger admin-btn-icon" onclick="return confirm('Are you sure you want to delete this backup?');">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="admin-empty-state">
                                <div class="admin-empty-state-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <h3>No backups found</h3>
                                <p>Create a new backup to protect your data.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Submit button - shown for all tabs except backup -->
                <div class="admin-form-actions" id="settings-actions">
                    <input type="hidden" name="update_settings" value="1">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Tab switching logic
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.admin-tab-item');
    const tabContents = document.querySelectorAll('.admin-tab-content');
    const settingsActions = document.getElementById('settings-actions');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Hide all tab contents
            tabContents.forEach(content => {
                content.style.display = 'none';
            });
            
            // Show selected tab content
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId + '-tab').style.display = 'block';
            
            // Hide submit button on backup tab
            if (tabId === 'backup') {
                settingsActions.style.display = 'none';
            } else {
                settingsActions.style.display = 'flex';
            }
        });
    });
});
</script>

<style>
/* Tabs styling */
.admin-tabs {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    border-bottom: 1px solid var(--admin-divider);
}

.admin-tab-item {
    padding: 10px 15px;
    margin-right: 5px;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    transition: var(--admin-transition);
    color: var(--admin-text-dim);
}

.admin-tab-item:hover {
    color: var(--admin-primary);
}

.admin-tab-item.active {
    color: var(--admin-primary);
    border-bottom-color: var(--admin-primary);
}

.admin-tab-item i {
    margin-right: 5px;
}

@media (max-width: 768px) {
    .admin-tabs {
        flex-wrap: wrap;
    }
    
    .admin-tab-item {
        flex: 1;
        text-align: center;
        font-size: 0.85rem;
        padding: 10px 5px;
    }
    
    .admin-tab-item i {
        margin-right: 3px;
    }
}

@media (max-width: 576px) {
    .admin-tab-item {
        font-size: 0.75rem;
    }
}
</style>

<?php include 'components/admin-footer.php'; ?>