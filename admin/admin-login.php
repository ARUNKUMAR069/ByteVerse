<?php
session_start();
require_once 'includes/db-config.php';

// Check if already logged in
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        // Query to check user credentials
        $sql = "SELECT * FROM admin_users WHERE admin_username = ? AND admin_status = 'active' LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['admin_password'])) {
                // Set session variables
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user['admin_id'];
                $_SESSION['admin_username'] = $user['admin_username'];
                $_SESSION['admin_fullname'] = $user['admin_fullname'];
                $_SESSION['admin_role'] = $user['admin_role'];
                
                // Update last login time
                $update_sql = "UPDATE admin_users SET last_login = NOW() WHERE admin_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("i", $user['admin_id']);
                $update_stmt->execute();
                
                // Log activity
                $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                                VALUES (?, 'login', 'Admin login successful', ?)";
                $activity_stmt = $conn->prepare($activity_sql);
                $ip = $_SERVER['REMOTE_ADDR'];
                $activity_stmt->bind_param("is", $user['admin_id'], $ip);
                $activity_stmt->execute();
                
                // Redirect to dashboard
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid password';
            }
        } else {
            $error = 'Username not found or account inactive';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | ByteVerse 1.0</title>
    <link rel="stylesheet" href="assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <div class="logo-text">Byte<span>Verse</span></div>
                    <div class="logo-version">1.0</div>
                </div>
                <h1>Admin Portal</h1>
                <p>Enter your credentials to access the admin dashboard</p>
            </div>
            
            <?php if(!empty($error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="" class="login-form">
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        <span>Username</span>
                    </label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        <span>Password</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                
                <div class="form-group remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                
                <button type="submit" class="login-button">
                    <span>Login</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
                
                <div class="login-footer">
                    <a href="../index.php">Return to main site</a>
                </div>
            </form>
        </div>
        
        <div class="login-decoration">
            <div class="cyber-circuit"></div>
            <div class="glow-effects"></div>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.querySelector('.password-toggle i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
