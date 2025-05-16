<?php
// API endpoint to check for new notifications
require_once '../includes/db-config.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

// Get notifications count
$unread_count = 0;
$notifications = [];

// Get unread messages
$unread_messages_sql = "SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0";
$unread_messages_result = $conn->query($unread_messages_sql);
if ($unread_messages_result && $unread_messages_result->num_rows > 0) {
    $unread_messages = $unread_messages_result->fetch_assoc()['count'];
    if ($unread_messages > 0) {
        $notifications[] = [
            'type' => 'message',
            'count' => $unread_messages,
            'text' => "$unread_messages unread " . ($unread_messages == 1 ? "message" : "messages"),
            'url' => 'contact.php'
        ];
        $unread_count += $unread_messages;
    }
}

// Get pending registrations
$pending_reg_sql = "SELECT COUNT(*) as count FROM registrations WHERE status = 'pending'";
$pending_reg_result = $conn->query($pending_reg_sql);
if ($pending_reg_result && $pending_reg_result->num_rows > 0) {
    $pending_reg = $pending_reg_result->fetch_assoc()['count'];
    if ($pending_reg > 0) {
        $notifications[] = [
            'type' => 'registration',
            'count' => $pending_reg,
            'text' => "$pending_reg pending " . ($pending_reg == 1 ? "registration" : "registrations"),
            'url' => 'registrations.php?filter=pending'
        ];
        $unread_count += $pending_reg;
    }
}

// Get pending sponsors
$pending_sponsor_sql = "SELECT COUNT(*) as count FROM sponsors WHERE status = 'pending'";
$pending_sponsor_result = $conn->query($pending_sponsor_sql);
if ($pending_sponsor_result && $pending_sponsor_result->num_rows > 0) {
    $pending_sponsor = $pending_sponsor_result->fetch_assoc()['count'];
    if ($pending_sponsor > 0) {
        $notifications[] = [
            'type' => 'sponsor',
            'count' => $pending_sponsor,
            'text' => "$pending_sponsor pending " . ($pending_sponsor == 1 ? "sponsor" : "sponsors"),
            'url' => 'sponsors.php?filter=pending'
        ];
        $unread_count += $pending_sponsor;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode([
    'unread_count' => $unread_count,
    'notifications' => $notifications
]);
?>
