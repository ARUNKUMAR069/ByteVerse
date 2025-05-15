<?php
// filepath: c:\xampp\htdocs\new2\admin\admin-logout.php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database and auth functions if needed for logout logging
require_once 'includes/database.php';
require_once 'includes/functions.php';

// Log the logout activity if the user was logged in
if (isset($_SESSION['admin_user_id'])) {
    $userId = $_SESSION['admin_user_id'];
    $db = new Database();
    $conn = $db->getConnection();
    
    // Log the logout action
    $query = "INSERT INTO activity_log (user_id, action, entity, details, ip_address) 
              VALUES (:user_id, 'logout', 'auth', 'User logged out', :ip)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt->bindParam(':ip', $ip);
    $stmt->execute();
}

// Clear all session variables
$_SESSION = array();

// If using session cookies, delete the session cookie
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
header("Location: admin-login.php");
exit();
?>