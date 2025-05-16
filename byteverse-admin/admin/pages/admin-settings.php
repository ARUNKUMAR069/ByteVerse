<?php
// filepath: c:\xampp\htdocs\byteverse-admin\admin\pages\admin-settings.php

// Include required files
require_once '../includes/auth-check.php';
require_once '../includes/admin-database.php';
require_once '../includes/admin-functions.php';

// Initialize database connection
$database = new AdminDatabase();
$conn = $database->getConnection();

// Check if user is logged in
if (!$auth->isLoggedIn()) {
    header("Location: admin-index.php");
    exit;
}

// Set page title
$page_title = "Admin Settings";
include '../components/admin-header.php';
?>

<div class="admin-settings">
    <h1 class="admin-settings-title">Admin Settings</h1>
    <form id="settings-form" method="POST" action="update-settings.php">
        <div class="form-group">
            <label for="site-name">Site Name</label>
            <input type="text" id="site-name" name="site_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="site-email">Site Email</label>
            <input type="email" id="site-email" name="site_email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="registration-status">Registration Status</label>
            <select id="registration-status" name="registration_status" class="form-control">
                <option value="open">Open</option>
                <option value="closed">Closed</option>
            </select>
        </div>
        <button type="submit" class="admin-btn">Save Settings</button>
    </form>
</div>

<?php include '../components/admin-footer.php'; ?>