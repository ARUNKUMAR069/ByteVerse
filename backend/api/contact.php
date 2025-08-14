<?php
define('SECURE_ACCESS', true);
require_once('index.php');

// Debug information - log the request details
error_log('Contact API accessed - Method: ' . $_SERVER['REQUEST_METHOD'] . ', Content-Type: ' . (isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : 'not set'));

// Allow only POST requests - with better detection
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // If the request was forwarded from another URL, check the original method
    $originalMethod = isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) ? $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : '';
    if ($originalMethod === 'POST') {
        error_log('Accepting forwarded POST request');
    } else {
        sendResponse(false, 'Invalid request method');
    }
}

// Get and sanitize form data - combining first + last name
$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$name = trim($firstName . ' ' . $lastName);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// Validate required fields
if (empty($firstName) || empty($lastName) || empty($email) || empty($message)) {
    sendResponse(false, 'Please fill in all required fields');
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendResponse(false, 'Please enter a valid email address');
}

try {
    $conn = getDbConnection();
    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    // Begin transaction
    $conn->beginTransaction();

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message, is_read, created_at) 
                           VALUES (:name, :email, :phone, :subject, :message, 0, NOW())");
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);
    
    $stmt->execute();
    
    // Log activity
    $messageId = $conn->lastInsertId();
    $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                    VALUES (:user_id, :activity_type, :description, :ip_address)";
    $activity_stmt = $conn->prepare($activity_sql);
    $user_id = 0; // System action
    $activity_type = 'new_message';
    $description = "New contact message from: $name ($email)";
    $ip_address = $_SERVER['REMOTE_ADDR'];
    
    $activity_stmt->bindParam(':user_id', $user_id);
    $activity_stmt->bindParam(':activity_type', $activity_type);
    $activity_stmt->bindParam(':description', $description);
    $activity_stmt->bindParam(':ip_address', $ip_address);
    $activity_stmt->execute();
    
    // Commit the transaction
    $conn->commit();
    
    sendResponse(true, 'Thank you for your message! We\'ll get back to you soon.');
    
} catch (Exception $e) {
    // Rollback the transaction if there's an error
    if ($conn) {
        $conn->rollBack();
    }
    error_log("Contact Form Error: " . $e->getMessage());
    sendResponse(false, 'Something went wrong. Please try again later.');
}
