<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Include database connection
require_once '../includes/db-config.php';

$admin_id = $_SESSION['admin_id'];

// Mark all messages as read
$conn->query("UPDATE contact_messages SET is_read = 1 WHERE is_read = 0");

// Log the action
$activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                VALUES (?, 'mark_all_read', 'Marked all notifications as read', ?)";
$stmt = $conn->prepare($activity_sql);
$ip = $_SERVER['REMOTE_ADDR'];
$stmt->bind_param("is", $admin_id, $ip);
$stmt->execute();

// Return success response
header('Content-Type: application/json');
echo json_encode(['success' => true]);
?>
