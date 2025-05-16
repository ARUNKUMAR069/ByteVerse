<?php
// filepath: c:\xampp\htdocs\new2\admin\admin-index.php

// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['admin_user_id'])) {
    header("Location: admin-dashboard.php");
    exit;
}

// Include database and functions
require_once 'includes/admin-database.php';
require_once 'includes/admin-functions.php';

// Initialize variables
$error = '';
$username = '';

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate input
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        // Attempt login
        $database = new AdminDatabase();
        $auth = new AdminAuth($database);
        
        if ($auth->login($username, $password)) {
            // Redirect to dashboard or saved URL
            $redirect = $_SESSION['admin_redirect_url'] ?? 'admin-dashboard.php';
            unset($_SESSION['admin_redirect_url']);
            
            header("Location: $redirect");
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ByteVerse</title>
    <link rel="stylesheet" href="assets/css/admin-styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="admin-login-body">
    <div class="admin-login-container">
        <div class="admin-login-logo">
            <span class="admin-logo-text">Byte<span class="admin-highlight">Verse</span></span>
        </div>
        
        <div class="admin-login-card">
            <div class="admin-login-header">
                <h1>Admin Login</h1>
                <p>Enter your credentials to access the admin panel</p>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="admin-alert admin-alert-danger">
                    <div class="admin-alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="admin-alert-content">
                        <div class="admin-alert-message"><?php echo $error; ?></div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['admin_login_error'])): ?>
                <div class="admin-alert admin-alert-danger">
                    <div class="admin-alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="admin-alert-content">
                        <div class="admin-alert-message"><?php echo $_SESSION['admin_login_error']; ?></div>
                    </div>
                </div>
                <?php unset($_SESSION['admin_login_error']); ?>
            <?php endif; ?>
            
            <form method="POST" action="" class="admin-login-form">
                <div class="admin-form-group">
                    <label class="admin-form-label" for="username">Username</label>
                    <div class="admin-input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" class="admin-form-input" 
                               placeholder="Enter your username" value="<?php echo htmlspecialchars($username); ?>" required autofocus>
                    </div>
                </div>
                
                <div class="admin-form-group">
                    <label class="admin-form-label" for="password">Password</label>
                    <div class="admin-input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="admin-form-input" 
                               placeholder="Enter your password" required>
                    </div>
                </div>
                
                <div class="admin-login-options">
                    <div class="admin-form-check">
                        <input type="checkbox" id="remember" name="remember" class="admin-form-checkbox">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="admin-forgot-password.php" class="admin-link">Forgot password?</a>
                </div>
                
                <button type="submit" class="admin-btn admin-btn-primary admin-btn-block">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>
        
        <div class="admin-login-footer">
            &copy; <?php echo date('Y'); ?> ByteVerse Hackathon Admin Panel
        </div>
    </div>
</body>
</html>