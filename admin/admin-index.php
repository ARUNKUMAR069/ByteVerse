
<?php
// Start session
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: admin-dashboard.php");
    exit;
}

// Include database and auth classes
require_once 'includes/admin-database.php';
require_once 'includes/admin-auth.php';
require_once 'includes/admin-functions.php';

// Initialize database and create tables if needed
$database = new AdminDatabase();
$database->initializeTables();

// Initialize auth
$auth = new AdminAuth($database);

// Process login form
$error_message = '';
$login_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !adminVerifyCSRFToken($_POST['csrf_token'])) {
        $error_message = 'Invalid request. Please try again.';
    } else {
        // Get input data
        $username = adminSanitizeInput($_POST['username']);
        $password = $_POST['password']; // Don't sanitize password
        
        // Attempt login
        $login_result = $auth->login($username, $password);
        
        if ($login_result['success']) {
            // Redirect to dashboard
            header("Location: admin-dashboard.php");
            exit;
        } else {
            $error_message = $login_result['message'];
        }
    }
}

// Generate CSRF token
$csrf_token = adminGenerateCSRFToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteVerse Admin - Login</title>
    
    <!-- Admin styles -->
    <link rel="stylesheet" href="assets/css/admin-styles.css">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&family=Chakra+Petch:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="admin-login-body">
    <div class="admin-login-container">
        <div class="admin-login-card">
            <div class="admin-login-header">
                <h1 class="admin-login-title">Byte<span class="admin-highlight">Verse</span> Admin</h1>
                <p class="admin-login-subtitle">Access restricted area</p>
            </div>
            
            <?php if (!empty($error_message)): ?>
            <div class="admin-alert admin-alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo $error_message; ?></span>
            </div>
            <?php endif; ?>
            
            <form class="admin-login-form" method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                
                <div class="admin-form-group">
                    <label for="username">Username</label>
                    <div class="admin-input-icon-wrapper">
                        <i class="fas fa-user admin-input-icon"></i>
                        <input type="text" id="username" name="username" class="admin-input" placeholder="Enter your username" required autofocus>
                    </div>
                </div>
                
                <div class="admin-form-group">
                    <label for="password">Password</label>
                    <div class="admin-input-icon-wrapper">
                        <i class="fas fa-lock admin-input-icon"></i>
                        <input type="password" id="password" name="password" class="admin-input" placeholder="Enter your password" required>
                        <button type="button" class="admin-password-toggle" onclick="togglePasswordVisibility()">
                            <i class="fas fa-eye" id="passwordToggleIcon"></i>
                        </button>
                    </div>
                </div>
                
                <div class="admin-form-group admin-form-checkbox">
                    <input type="checkbox" id="remember" name="remember" class="admin-checkbox">
                    <label for="remember">Remember me</label>
                </div>
                
                <div class="admin-form-group">
                    <button type="submit" class="admin-button admin-button-primary admin-button-block">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>
            </form>
            
            <div class="admin-login-footer">
                <p><a href="../index.php">Return to Website</a></p>
                <p>ByteVerse Hackathon &copy; <?php echo date('Y'); ?></p>
            </div>
        </div>
    </div>
    
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordToggleIcon = document.getElementById('passwordToggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggleIcon.classList.remove('fa-eye');
                passwordToggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggleIcon.classList.remove('fa-eye-slash');
                passwordToggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>