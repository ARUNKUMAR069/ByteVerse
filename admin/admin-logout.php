<?php
// filepath: c:\xampp\htdocs\new2\admin\admin-logout.php

// Start session
session_start();

// Include auth class
require_once 'includes/admin-database.php';
require_once 'includes/admin-functions.php';

// Log logout activity if user is logged in
if (isset($_SESSION['admin_user_id'])) {
    $database = new AdminDatabase();
    $auth = new AdminAuth($database);
    $auth->logout();
} else {
    // Just clear session if no user is logged in
    session_unset();
    session_destroy();
}

// Redirect to login page
header("Location: admin-index.php");
exit;