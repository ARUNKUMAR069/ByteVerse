<?php
// filepath: c:\xampp\htdocs\new2\admin\admin-profile.php

// Include required files
require_once 'includes/auth-check.php';
require_once 'includes/admin-database.php';
require_once 'includes/admin-functions.php';

// Initialize database and auth
$database = new AdminDatabase();
$auth = new AdminAuth($database);

// Check if user is logged in
if (!$auth->isLoggedIn()) {
    header("Location: admin-index.php");
    exit;
}

$conn = $database->getConnection();
$userId = $_SESSION['admin_user_id'];

// Process profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $fullname = adminSanitizeInput($_POST['fullname']);
    $email = adminSanitizeInput($_POST['email']);
    $bio = adminSanitizeInput($_POST['bio'] ?? '');
    
    // Handle avatar upload
    $avatar = $_SESSION['admin_avatar']; // Keep existing avatar by default
    
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/avatars/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileExt = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($fileExt, $allowedExts)) {
            $fileName = 'avatar_' . $userId . '_' . time() . '.' . $fileExt;
            $targetFile = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                // Delete old avatar if exists and not default
                if ($avatar && $avatar != 'default.png' && file_exists($uploadDir . $avatar)) {
                    unlink($uploadDir . $avatar);
                }
                
                $avatar = $fileName;
            }
        }
    }
    
    // Update profile in database
    $query = "UPDATE admin_users SET 
              admin_fullname = :fullname, 
              admin_email = :email, 
              admin_bio = :bio,
              admin_avatar = :avatar
              WHERE admin_id = :id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':avatar', $avatar);
    $stmt->bindParam(':id', $userId);
    
    if ($stmt->execute()) {
        // Update session data
        $_SESSION['admin_fullname'] = $fullname;
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_avatar'] = $avatar;
        
        logAdminActivity($userId, 'update', 'user', $userId, 'Profile updated');
        
        $_SESSION['admin_alert'] = [
            'type' => 'success',
            'message' => 'Profile updated successfully'
        ];
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Failed to update profile'
        ];
    }
    
    header("Location: admin-profile.php");
    exit;
}

// Process password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    // Validate passwords
    if ($newPassword !== $confirmPassword) {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'New passwords do not match'
        ];
    } elseif (strlen($newPassword) < 8) {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Password must be at least 8 characters long'
        ];
    } else {
        // Change password using auth method
        if ($auth->changePassword($userId, $currentPassword, $newPassword)) {
            $_SESSION['admin_alert'] = [
                'type' => 'success',
                'message' => 'Password changed successfully'
            ];
        } else {
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Current password is incorrect'
            ];
        }
    }
    
    header("Location: admin-profile.php");
    exit;
}

// Get user data
$query = "SELECT * FROM admin_users WHERE admin_id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Set page title
$page_title = "My Profile";
include 'components/admin-header.php';
?>

<div class="admin-content">
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">My Profile</h1>
            <div class="admin-breadcrumb">
                <a href="admin-dashboard.php" class="admin-breadcrumb-item">Dashboard</a>
                <span class="admin-breadcrumb-item active">My Profile</span>
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
    
    <div class="admin-grid-row">
        <!-- Profile Information -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Profile Information</h2>
            </div>
            <div class="admin-card-body">
                <form method="POST" enctype="multipart/form-data" class="admin-form-validation">
                    <div class="admin-form-grid">
                        <div class="admin-form-group col-span-12" style="text-align: center; margin-bottom: 20px;">
                            <div style="position: relative; width: 120px; height: 120px; margin: 0 auto;">
                                <div class="admin-user-avatar" style="width: 120px; height: 120px; font-size: 3rem;">
                                    <?php if (isset($user['admin_avatar']) && !empty($user['admin_avatar'])): ?>
                                    <img src="uploads/avatars/<?php echo $user['admin_avatar']; ?>" alt="User Avatar">
                                    <?php else: ?>
                                    <i class="fas fa-user-circle"></i>
                                    <?php endif; ?>
                                </div>
                                <label for="avatar-upload" style="position: absolute; bottom: 0; right: 0; background-color: var(--admin-primary); color: white; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" id="avatar-upload" name="avatar" style="display: none;" accept="image/*">
                            </div>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label">Full Name</label>
                            <input type="text" name="fullname" class="admin-form-input" value="<?php echo htmlspecialchars($user['admin_fullname']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label">Email</label>
                            <input type="email" name="email" class="admin-form-input" value="<?php echo htmlspecialchars($user['admin_email']); ?>" required>
                        </div>
                        
                        <div class="admin-form-group col-span-12">
                            <label class="admin-form-label">Bio</label>
                            <textarea name="bio" class="admin-form-textarea"><?php echo htmlspecialchars($user['admin_bio'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label">Username</label>
                            <input type="text" class="admin-form-input" value="<?php echo htmlspecialchars($user['admin_username']); ?>" disabled>
                            <div style="font-size: 0.8125rem; color: var(--admin-text-dim); margin-top: 5px;">Username cannot be changed</div>
                        </div>
                        
                        <div class="admin-form-group col-span-6">
                            <label class="admin-form-label">Role</label>
                            <input type="text" class="admin-form-input" value="<?php echo adminGetRoleName($user['admin_role']); ?>" disabled>
                        </div>
                    </div>
                    
                    <div class="admin-form-actions">
                        <input type="hidden" name="update_profile" value="1">
                        <button type="submit" class="admin-btn admin-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Change Password -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Change Password</h2>
            </div>
            <div class="admin-card-body">
                <form method="POST" class="admin-form-validation">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Current Password</label>
                        <input type="password" name="current_password" class="admin-form-input" required>
                    </div>
                    
                    <div class="admin-form-group">
                        <label class="admin-form-label">New Password</label>
                        <input type="password" name="new_password" class="admin-form-input" required minlength="8">
                        <div style="font-size: 0.8125rem; color: var(--admin-text-dim); margin-top: 5px;">Password must be at least 8 characters long</div>
                    </div>
                    
                    <div class="admin-form-group">
                        <label class="admin-form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="admin-form-input" required minlength="8">
                    </div>
                    
                    <div class="admin-form-actions">
                        <input type="hidden" name="change_password" value="1">
                        <button type="submit" class="admin-btn admin-btn-primary">
                            <i class="fas fa-key"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Account Activity -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Account Activity</h2>
        </div>
        <div class="admin-card-body">
            <?php
            // Get recent activity
            $activity_query = "SELECT * FROM admin_logs WHERE admin_id = :admin_id ORDER BY log_time DESC LIMIT 10";
            $activity_stmt = $conn->prepare($activity_query);
            $activity_stmt->bindParam(':admin_id', $userId);
            $activity_stmt->execute();
            $activities = $activity_stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            
            <?php if (count($activities) > 0): ?>
                <div class="admin-activity-log">
                    <?php foreach($activities as $activity): ?>
                        <div class="admin-activity-item">
                            <div class="admin-activity-icon">
                                <?php
                                $icon = 'info-circle';
                                switch($activity['log_action']) {
                                    case 'create': $icon = 'plus-circle'; break;
                                    case 'update': $icon = 'edit'; break;
                                    case 'delete': $icon = 'trash-alt'; break;
                                    case 'login': $icon = 'sign-in-alt'; break;
                                    case 'logout': $icon = 'sign-out-alt'; break;
                                }
                                ?>
                                <i class="fas fa-<?php echo $icon; ?>"></i>
                            </div>
                            <div class="admin-activity-details">
                                <div class="admin-activity-text">
                                    <?php echo ucfirst($activity['log_action']); ?>d 
                                    <?php echo $activity['log_entity']; ?>
                                    <?php if ($activity['entity_id']): ?>
                                    <span class="admin-activity-entity">#<?php echo $activity['entity_id']; ?></span>
                                    <?php endif; ?>
                                    <?php if ($activity['log_details']): ?>
                                    <div style="font-size: 0.85rem; margin-top: 3px;">
                                        <?php echo htmlspecialchars($activity['log_details']); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="admin-activity-time">
                                    <?php echo date('M d, Y h:i A', strtotime($activity['log_time'])); ?>
                                    <span style="font-size: 0.75rem; margin-left: 5px;">
                                        <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($activity['ip_address']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="admin-empty-state">
                    <div class="admin-empty-state-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3>No activity yet</h3>
                    <p>Your activity will be logged and displayed here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Preview avatar image before upload
document.getElementById('avatar-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const avatarContainer = document.querySelector('.admin-user-avatar');
            avatarContainer.innerHTML = `<img src="${e.target.result}" alt="Avatar Preview">`;
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php include 'components/admin-footer.php'; ?>