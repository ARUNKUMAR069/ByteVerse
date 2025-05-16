<?php
// filepath: c:\xampp\htdocs\new2\admin\pages\admin-users.php

// Require authentication
require_once '../includes/auth-check.php';
require_once '../includes/database.php';
require_once '../includes/functions.php';

// Only admin role can access user management
if ($_SESSION['admin_role'] !== 'admin') {
    $_SESSION['admin_alert'] = [
        'type' => 'danger', 
        'message' => 'You do not have permission to access user management'
    ];
    header("Location: ../admin-dashboard.php");
    exit();
}

// Initialize database connection
$database = new Database();
$conn = $database->getConnection();

// Process user deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $user_id = $_GET['delete'];
    
    // Prevent deleting your own account
    if ($user_id == $_SESSION['admin_user_id']) {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'You cannot delete your own account'
        ];
    } else {
        try {
            // Check if it's the last admin account
            $admin_check_query = "SELECT COUNT(*) FROM admin_users WHERE role = 'admin' AND id != :user_id";
            $admin_check_stmt = $conn->prepare($admin_check_query);
            $admin_check_stmt->bindParam(':user_id', $user_id);
            $admin_check_stmt->execute();
            
            if ($admin_check_stmt->fetchColumn() > 0) {
                // Delete user
                $query = "DELETE FROM admin_users WHERE id = :user_id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':user_id', $user_id);
                
                if ($stmt->execute()) {
                    // Log activity
                    logAdminActivity($_SESSION['admin_user_id'], 'delete', 'users', $user_id, 'Deleted user');
                    
                    $_SESSION['admin_alert'] = [
                        'type' => 'success',
                        'message' => 'User deleted successfully'
                    ];
                } else {
                    $_SESSION['admin_alert'] = [
                        'type' => 'danger',
                        'message' => 'Error deleting user'
                    ];
                }
            } else {
                $_SESSION['admin_alert'] = [
                    'type' => 'danger',
                    'message' => 'Cannot delete the last admin account'
                ];
            }
        } catch (PDOException $e) {
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }
    }
    
    // Redirect to prevent resubmission
    header("Location: admin-users.php");
    exit();
}

// Process user status toggle
if (isset($_GET['toggle_status']) && is_numeric($_GET['toggle_status'])) {
    $user_id = $_GET['toggle_status'];
    
    // Prevent toggling your own account
    if ($user_id == $_SESSION['admin_user_id']) {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'You cannot deactivate your own account'
        ];
    } else {
        try {
            // Get current status
            $status_query = "SELECT status FROM admin_users WHERE id = :user_id";
            $status_stmt = $conn->prepare($status_query);
            $status_stmt->bindParam(':user_id', $user_id);
            $status_stmt->execute();
            
            $current_status = $status_stmt->fetchColumn();
            $new_status = ($current_status == 'active') ? 'inactive' : 'active';
            
            // Check if it's the last admin account
            if ($new_status == 'inactive') {
                $admin_check_query = "SELECT COUNT(*) FROM admin_users WHERE role = 'admin' AND status = 'active' AND id != :user_id";
                $admin_check_stmt = $conn->prepare($admin_check_query);
                $admin_check_stmt->bindParam(':user_id', $user_id);
                $admin_check_stmt->execute();
                
                if ($admin_check_stmt->fetchColumn() == 0) {
                    $_SESSION['admin_alert'] = [
                        'type' => 'danger',
                        'message' => 'Cannot deactivate the last active admin account'
                    ];
                    header("Location: admin-users.php");
                    exit();
                }
            }
            
            // Update status
            $query = "UPDATE admin_users SET status = :status WHERE id = :user_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':status', $new_status);
            $stmt->bindParam(':user_id', $user_id);
            
            if ($stmt->execute()) {
                // Log activity
                $action_detail = 'Changed user status to ' . $new_status;
                logAdminActivity($_SESSION['admin_user_id'], 'update', 'users', $user_id, $action_detail);
                
                $_SESSION['admin_alert'] = [
                    'type' => 'success',
                    'message' => 'User status updated successfully'
                ];
            } else {
                $_SESSION['admin_alert'] = [
                    'type' => 'danger',
                    'message' => 'Error updating user status'
                ];
            }
        } catch (PDOException $e) {
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }
    }
    
    // Redirect to prevent resubmission
    header("Location: admin-users.php");
    exit();
}

// Process add user form
if (isset($_POST['add_user'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate inputs
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $username)) {
        $errors[] = "Username must be 4-20 characters and contain only letters, numbers, and underscores";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($full_name)) {
        $errors[] = "Full name is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    if (!in_array($role, ['admin', 'manager', 'editor', 'viewer'])) {
        $errors[] = "Invalid role selected";
    }
    
    // Check if username or email already exists
    if (empty($errors)) {
        $check_query = "SELECT COUNT(*) FROM admin_users WHERE username = :username OR email = :email";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bindParam(':username', $username);
        $check_stmt->bindParam(':email', $email);
        $check_stmt->execute();
        
        if ($check_stmt->fetchColumn() > 0) {
            $errors[] = "Username or email already exists";
        }
    }
    
    // If no errors, add user
    if (empty($errors)) {
        try {
            // Hash password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user
            $query = "INSERT INTO admin_users (username, password, email, full_name, role) 
                     VALUES (:username, :password, :email, :full_name, :role)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password_hash);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':role', $role);
            
            if ($stmt->execute()) {
                // Log activity
                $new_user_id = $conn->lastInsertId();
                logAdminActivity($_SESSION['admin_user_id'], 'create', 'users', $new_user_id, 'Created new user account');
                
                $_SESSION['admin_alert'] = [
                    'type' => 'success',
                    'message' => 'User added successfully'
                ];
            } else {
                $_SESSION['admin_alert'] = [
                    'type' => 'danger',
                    'message' => 'Error adding user'
                ];
            }
        } catch (PDOException $e) {
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Please correct the following errors: ' . implode(', ', $errors)
        ];
    }
}

// Process edit user form
if (isset($_POST['edit_user']) && isset($_POST['user_id'])) {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    
    // Validate inputs
    $errors = [];
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($full_name)) {
        $errors[] = "Full name is required";
    }
    
    if (!in_array($role, ['admin', 'manager', 'editor', 'viewer'])) {
        $errors[] = "Invalid role selected";
    }
    
    // Check if it's the last admin account
    if ($role != 'admin') {
        // Get current role
        $role_query = "SELECT role FROM admin_users WHERE id = :user_id";
        $role_stmt = $conn->prepare($role_query);
        $role_stmt->bindParam(':user_id', $user_id);
        $role_stmt->execute();
        $current_role = $role_stmt->fetchColumn();
        
        if ($current_role == 'admin') {
            $admin_check_query = "SELECT COUNT(*) FROM admin_users WHERE role = 'admin' AND id != :user_id";
            $admin_check_stmt = $conn->prepare($admin_check_query);
            $admin_check_stmt->bindParam(':user_id', $user_id);
            $admin_check_stmt->execute();
            
            if ($admin_check_stmt->fetchColumn() == 0) {
                $errors[] = "Cannot change role of the last admin account";
            }
        }
    }
    
    // Check if email already exists (excluding the current user)
    if (empty($errors)) {
        $check_query = "SELECT COUNT(*) FROM admin_users WHERE email = :email AND id != :user_id";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bindParam(':email', $email);
        $check_stmt->bindParam(':user_id', $user_id);
        $check_stmt->execute();
        
        if ($check_stmt->fetchColumn() > 0) {
            $errors[] = "Email already exists";
        }
    }
    
    // If no errors, update user
    if (empty($errors)) {
        try {
            // Update user
            $query = "UPDATE admin_users SET email = :email, full_name = :full_name, role = :role 
                      WHERE id = :user_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':user_id', $user_id);
            
            if ($stmt->execute()) {
                // Log activity
                logAdminActivity($_SESSION['admin_user_id'], 'update', 'users', $user_id, 'Updated user account');
                
                // Update session if the user is updating their own account
                if ($user_id == $_SESSION['admin_user_id']) {
                    $_SESSION['admin_email'] = $email;
                    $_SESSION['admin_full_name'] = $full_name;
                    $_SESSION['admin_role'] = $role;
                }
                
                $_SESSION['admin_alert'] = [
                    'type' => 'success',
                    'message' => 'User updated successfully'
                ];
            } else {
                $_SESSION['admin_alert'] = [
                    'type' => 'danger',
                    'message' => 'Error updating user'
                ];
            }
        } catch (PDOException $e) {
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Please correct the following errors: ' . implode(', ', $errors)
        ];
    }
}

// Process reset password form
if (isset($_POST['reset_password']) && isset($_POST['user_id'])) {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate inputs
    $errors = [];
    
    if (empty($new_password)) {
        $errors[] = "Password is required";
    } elseif (strlen($new_password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    
    if ($new_password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    // If no errors, reset password
    if (empty($errors)) {
        try {
            // Hash password
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update password
            $query = "UPDATE admin_users SET password = :password WHERE id = :user_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $password_hash);
            $stmt->bindParam(':user_id', $user_id);
            
            if ($stmt->execute()) {
                // Log activity
                logAdminActivity($_SESSION['admin_user_id'], 'update', 'users', $user_id, 'Reset user password');
                
                $_SESSION['admin_alert'] = [
                    'type' => 'success',
                    'message' => 'Password reset successfully'
                ];
            } else {
                $_SESSION['admin_alert'] = [
                    'type' => 'danger',
                    'message' => 'Error resetting password'
                ];
            }
        } catch (PDOException $e) {
            $_SESSION['admin_alert'] = [
                'type' => 'danger',
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }
    } else {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'Please correct the following errors: ' . implode(', ', $errors)
        ];
    }
}

// Fetch all users
$query = "SELECT * FROM admin_users ORDER BY id ASC";
$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Page title
$pageTitle = "User Management";
$breadcrumbs = [
    ['link' => '../admin-dashboard.php', 'text' => 'Dashboard'],
    ['link' => '', 'text' => 'User Management']
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
    <div>
        <button class="admin-btn admin-btn-primary" data-modal="add-user-modal">
            <i class="fas fa-user-plus"></i> Add New User
        </button>
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
    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Last Login</th>
                    <th style="width: 160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <?php 
                                $role_badges = [
                                    'admin' => 'admin-status active',
                                    'manager' => 'admin-status',
                                    'editor' => 'admin-status',
                                    'viewer' => 'admin-status'
                                ];
                                echo '<span class="' . $role_badges[$user['role']] . '">' . ucfirst($user['role']) . '</span>';
                                ?>
                            </td>
                            <td>
                                <?php
                                $status_badges = [
                                    'active' => 'admin-status active',
                                    'inactive' => 'admin-status inactive'
                                ];
                                echo '<span class="' . $status_badges[$user['status']] . '">' . ucfirst($user['status']) . '</span>';
                                ?>
                            </td>
                            <td><?php echo $user['last_login'] ? date('Y-m-d H:i', strtotime($user['last_login'])) : 'Never'; ?></td>
                            <td class="admin-table-action">
                                <button class="admin-btn admin-btn-sm admin-btn-primary edit-user-btn" 
                                        data-id="<?php echo $user['id']; ?>"
                                        data-username="<?php echo htmlspecialchars($user['username']); ?>"
                                        data-fullname="<?php echo htmlspecialchars($user['full_name']); ?>"
                                        data-email="<?php echo htmlspecialchars($user['email']); ?>"
                                        data-role="<?php echo $user['role']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                
                                <?php if ($user['id'] != $_SESSION['admin_user_id']): ?>
                                    <a href="?toggle_status=<?php echo $user['id']; ?>" class="admin-btn admin-btn-sm <?php echo $user['status'] == 'active' ? 'admin-btn-danger' : 'admin-btn-success'; ?>"
                                       onclick="return confirm('Are you sure you want to <?php echo $user['status'] == 'active' ? 'deactivate' : 'activate'; ?> this user?')">
                                        <i class="fas fa-<?php echo $user['status'] == 'active' ? 'ban' : 'check'; ?>"></i> 
                                        <?php echo $user['status'] == 'active' ? 'Deactivate' : 'Activate'; ?>
                                    </a>
                                    
                                    <button class="admin-btn admin-btn-sm admin-btn-secondary reset-password-btn"
                                            data-id="<?php echo $user['id']; ?>"
                                            data-username="<?php echo htmlspecialchars($user['username']); ?>">
                                        <i class="fas fa-key"></i>
                                    </button>
                                    
                                    <a href="?delete=<?php echo $user['id']; ?>" class="admin-btn admin-btn-sm admin-btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div id="add-user-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Add New User</h3>
            <button class="admin-modal-close">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form method="post" action="" id="add-user-form">
                <div class="admin-form-group">
                    <label class="admin-form-label" for="username">Username</label>
                    <input type="text" id="username" name="username" class="admin-form-input" required
                           pattern="^[a-zA-Z0-9_]{4,20}$" 
                           title="Username must be 4-20 characters and contain only letters, numbers, and underscores">
                    <p class="admin-form-help">4-20 characters, letters, numbers, and underscores only</p>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="admin-form-input" required>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="admin-form-input" required>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="role">Role</label>
                    <select id="role" name="role" class="admin-form-select" required>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="editor">Editor</option>
                        <option value="viewer" selected>Viewer</option>
                    </select>
                    <p class="admin-form-help">
                        Admin: Full access to all features<br>
                        Manager: Can manage content but not users<br>
                        Editor: Can edit content but not approve/delete<br>
                        Viewer: Read-only access
                    </p>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="admin-form-input" required
                           minlength="8" title="Password must be at least 8 characters long">
                    <p class="admin-form-help">Minimum 8 characters</p>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="admin-form-input" required>
                </div>
                
                <div class="admin-form-actions">
                    <button type="button" class="admin-btn admin-btn-secondary cancel-modal">Cancel</button>
                    <button type="submit" name="add_user" class="admin-btn admin-btn-primary">
                        <i class="fas fa-save"></i> Add User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="edit-user-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Edit User</h3>
            <button class="admin-modal-close">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form method="post" action="" id="edit-user-form">
                <input type="hidden" id="edit_user_id" name="user_id">
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="edit_username">Username</label>
                    <input type="text" id="edit_username" class="admin-form-input" disabled>
                    <p class="admin-form-help">Username cannot be changed</p>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="edit_full_name">Full Name</label>
                    <input type="text" id="edit_full_name" name="full_name" class="admin-form-input" required>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="edit_email">Email</label>
                    <input type="email" id="edit_email" name="email" class="admin-form-input" required>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="edit_role">Role</label>
                    <select id="edit_role" name="role" class="admin-form-select" required>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="editor">Editor</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>
                
                <div class="admin-form-actions">
                    <button type="button" class="admin-btn admin-btn-secondary cancel-modal">Cancel</button>
                    <button type="submit" name="edit_user" class="admin-btn admin-btn-primary">
                        <i class="fas fa-save"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div id="reset-password-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Reset User Password</h3>
            <button class="admin-modal-close">&times;</button>
        </div>
        <div class="admin-modal-body">
            <form method="post" action="" id="reset-password-form">
                <input type="hidden" id="reset_user_id" name="user_id">
                
                <div class="admin-form-group">
                    <p>You are about to reset the password for <strong id="reset_username"></strong>.</p>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="admin-form-input" required
                           minlength="8" title="Password must be at least 8 characters long">
                    <p class="admin-form-help">Minimum 8 characters</p>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="confirm_new_password">Confirm New Password</label>
                    <input type="password" id="confirm_new_password" name="confirm_password" class="admin-form-input" required>
                </div>
                
                <div class="admin-form-actions">
                    <button type="button" class="admin-btn admin-btn-secondary cancel-modal">Cancel</button>
                    <button type="submit" name="reset_password" class="admin-btn admin-btn-primary">
                        <i class="fas fa-key"></i> Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal functionality
    const modals = document.querySelectorAll('.admin-modal');
    const modalTriggers = document.querySelectorAll('[data-modal]');
    const modalCloses = document.querySelectorAll('.admin-modal-close, .cancel-modal');
    
    // Open modal
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal');
            document.getElementById(modalId).classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close modal
    modalCloses.forEach(close => {
        close.addEventListener('click', function() {
            const modal = this.closest('.admin-modal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
    
    // Close modal when clicking outside
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });
    
    // Edit user button
    const editButtons = document.querySelectorAll('.edit-user-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const username = this.getAttribute('data-username');
            const fullName = this.getAttribute('data-fullname');
            const email = this.getAttribute('data-email');
            const role = this.getAttribute('data-role');
            
            document.getElementById('edit_user_id').value = userId;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_full_name').value = fullName;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            
            document.getElementById('edit-user-modal').classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Reset password button
    const resetButtons = document.querySelectorAll('.reset-password-btn');
    resetButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const username = this.getAttribute('data-username');
            
            document.getElementById('reset_user_id').value = userId;
            document.getElementById('reset_username').textContent = username;
            
            document.getElementById('reset-password-modal').classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Password confirmation validation
    const addUserForm = document.getElementById('add-user-form');
    const resetPasswordForm = document.getElementById('reset-password-form');
    
    if (addUserForm) {
        addUserForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match');
            }
        });
    }
    
    if (resetPasswordForm) {
        resetPasswordForm.addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmNewPassword = document.getElementById('confirm_new_password').value;
            
            if (newPassword !== confirmNewPassword) {
                e.preventDefault();
                alert('Passwords do not match');
            }
        });
    }
});
</script>

<?php include '../components/admin-footer.php'; ?>