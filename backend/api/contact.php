
<?php
define('SECURE_ACCESS', true);
require_once('index.php');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

// Get and sanitize form data
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// Validate required fields
if (empty($name) || empty($email) || empty($message)) {
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

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, message, is_read, created_at) 
                           VALUES (:name, :email, :phone, :message, 0, NOW())");
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':message', $message);
    
    $stmt->execute();
    
    sendResponse(true, 'Thank you for your message! We\'ll get back to you soon.');
    
} catch (Exception $e) {
    error_log("Contact Form Error: " . $e->getMessage());
    sendResponse(false, 'Something went wrong. Please try again later.');
}
460ab1b