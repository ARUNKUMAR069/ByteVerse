<?php
// filepath: c:\xampp\htdocs\new2\admin\includes\admin-functions.php

// Utility functions for the admin panel

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security functions
function adminSanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function adminGenerateCSRFToken() {
    if (!isset($_SESSION['admin_csrf_token'])) {
        $_SESSION['admin_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['admin_csrf_token'];
}

function adminVerifyCSRFToken($token) {
    return isset($_SESSION['admin_csrf_token']) && hash_equals($_SESSION['admin_csrf_token'], $token);
}

// Activity logging
function logAdminActivity($userId, $action, $entity, $entityId = null, $details = null) {
    require_once 'admin-database.php';
    
    $db = new AdminDatabase();
    $conn = $db->getConnection();
    
    $query = "INSERT INTO admin_logs (admin_id, log_action, log_entity, entity_id, log_details, ip_address)
             VALUES (:admin_id, :action, :entity, :entity_id, :details, :ip)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':admin_id', $userId);
    $stmt->bindParam(':action', $action);
    $stmt->bindParam(':entity', $entity);
    $stmt->bindParam(':entity_id', $entityId);
    $stmt->bindParam(':details', $details);
    
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt->bindParam(':ip', $ip);
    
    return $stmt->execute();
}

// Format functions
function adminFormatDate($date) {
    return date('M d, Y', strtotime($date));
}

function adminFormatDateTime($date) {
    return date('M d, Y h:i A', strtotime($date));
}

function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}

// Status badge helpers
function adminGetStatusBadge($status) {
    $class = '';
    switch (strtolower($status)) {
        case 'active':
        case 'approved':
        case 'completed':
            $class = 'admin-status active';
            break;
        case 'inactive':
        case 'rejected':
        case 'failed':
            $class = 'admin-status inactive';
            break;
        case 'pending':
            $class = 'admin-status pending';
            break;
        default:
            $class = 'admin-status';
    }
    
    return '<span class="' . $class . '">' . ucfirst($status) . '</span>';
}

function adminGetRoleName($role) {
    switch ($role) {
        case 'super_admin':
            return 'Super Admin';
        case 'admin':
            return 'Administrator';
        case 'manager':
            return 'Manager';
        case 'editor':
            return 'Editor';
        case 'viewer':
            return 'Viewer';
        default:
            return ucfirst($role);
    }
}

// Notification functions
function createAdminNotification($userId, $message, $type = 'info', $icon = null, $link = null) {
    require_once 'admin-database.php';
    
    $db = new AdminDatabase();
    $conn = $db->getConnection();
    
    // Default icons based on type
    if (!$icon) {
        switch ($type) {
            case 'success': $icon = 'check-circle'; break;
            case 'warning': $icon = 'exclamation-triangle'; break;
            case 'danger': $icon = 'exclamation-circle'; break;
            default: $icon = 'bell';
        }
    }
    
    $query = "INSERT INTO admin_notifications (admin_id, message, type, icon, link, created_at)
              VALUES (:admin_id, :message, :type, :icon, :link, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':admin_id', $userId);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':icon', $icon);
    $stmt->bindParam(':link', $link);
    
    return $stmt->execute();
}

// Get admin settings
function getAdminSetting($key, $default = null) {
    require_once 'admin-database.php';
    
    $db = new AdminDatabase();
    $conn = $db->getConnection();
    
    $query = "SELECT setting_value FROM admin_settings WHERE setting_key = :key";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':key', $key);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['setting_value'] : $default;
}

// Update admin settings
function updateAdminSetting($key, $value) {
    require_once 'admin-database.php';
    
    $db = new AdminDatabase();
    $conn = $db->getConnection();
    
    $query = "INSERT INTO admin_settings (setting_key, setting_value) 
              VALUES (:key, :value)
              ON DUPLICATE KEY UPDATE setting_value = :value";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':key', $key);
    $stmt->bindParam(':value', $value);
    
    return $stmt->execute();
}