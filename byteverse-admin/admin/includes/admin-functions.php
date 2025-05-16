<?php
// filepath: c:\xampp\htdocs\new2\admin\includes\admin-functions.php

function redirectTo($location) {
    header("Location: " . $location);
    exit;
}

function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

function checkUserRole($role) {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
}

function logActivity($action, $entity, $entityId) {
    global $conn; // Assuming $conn is the database connection
    $stmt = $conn->prepare("INSERT INTO admin_logs (admin_id, log_action, log_entity, entity_id, log_time) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$_SESSION['admin_id'], $action, $entity, $entityId]);
}

function getAdminSettings() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM admin_settings");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateAdminSettings($settings) {
    global $conn;
    foreach ($settings as $key => $value) {
        $stmt = $conn->prepare("UPDATE admin_settings SET setting_value = ? WHERE setting_key = ?");
        $stmt->execute([$value, $key]);
    }
}
?>