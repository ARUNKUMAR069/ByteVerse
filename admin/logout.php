<?php
// Start session
session_start();

// Include database connection
require_once 'includes/db-config.php';

// Log the logout activity if user is logged in
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                    VALUES (?, 'logout', 'Admin logged out successfully', ?)";
    $stmt = $conn->prepare($activity_sql);
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt->bind_param("is", $admin_id, $ip);
    $stmt->execute();
}

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit;
?>
