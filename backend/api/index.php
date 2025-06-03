
<?php
// API entry point with security headers
header("Content-Type: application/json");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");

// Prevent direct access
if (!defined('SECURE_ACCESS')) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Direct access not allowed']);
    exit;
}

// Database connection
require_once('../includes/db.php');

// Response function
function sendResponse($success, $message, $data = null) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}