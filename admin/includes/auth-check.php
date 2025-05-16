<?php
// filepath: c:\xampp\htdocs\new2\admin\includes\auth-check.php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['admin_user_id']) || empty($_SESSION['admin_user_id'])) {
    // Store the current URL to redirect back after login
    $_SESSION['admin_redirect_url'] = $_SERVER['REQUEST_URI'];
    
    // Redirect to login page
    header("Location: admin-index.php");
    exit;
}

// Get current page for permission check
$current_page = basename($_SERVER['PHP_SELF']);

// Define page permissions
$page_permissions = [
    'admin-users.php' => ['super_admin', 'admin'],
    'admin-settings.php' => ['super_admin', 'admin', 'manager'],
    'admin-logs.php' => ['super_admin', 'admin'],
    'admin-sponsors.php' => ['super_admin', 'admin', 'manager', 'editor'],
    'admin-registrations.php' => ['super_admin', 'admin', 'manager', 'editor'],
    'admin-backup.php' => ['super_admin', 'admin']
];

// Check if current page requires specific permission
if (isset($page_permissions[$current_page])) {
    $required_roles = $page_permissions[$current_page];
    $user_role = $_SESSION['admin_role'];
    
    if (!in_array($user_role, $required_roles)) {
        $_SESSION['admin_alert'] = [
            'type' => 'danger',
            'message' => 'You do not have permission to access this page'
        ];
        
        // Redirect to dashboard
        header("Location: admin-dashboard.php");
        exit;
    }
}

// Check if user account is still active
if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] !== 'active') {
    // Clear session
    session_unset();
    session_destroy();
    
    // Start new session for message
    session_start();
    $_SESSION['admin_login_error'] = "Your account has been deactivated. Please contact the administrator.";
    
    // Redirect to login
    header("Location: admin-index.php");
    exit;
}

// Update last activity time
$_SESSION['admin_last_activity'] = time();

// Optional: Check for session timeout (e.g., 30 minutes)
if (isset($_SESSION['admin_last_activity']) && (time() - $_SESSION['admin_last_activity'] > 1800)) {
    // Clear session
    session_unset();
    session_destroy();
    
    // Start new session for message
    session_start();
    $_SESSION['admin_login_error'] = "Your session has expired. Please login again.";
    
    // Redirect to login
    header("Location: admin-index.php");
    exit;
}