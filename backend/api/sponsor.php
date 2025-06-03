<?php
define('SECURE_ACCESS', true);
require_once('index.php');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

// Get and sanitize form data
$company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$tier = filter_input(INPUT_POST, 'sponsorship_tier', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// Validate required fields
if (empty($company) || empty($name) || empty($email) || empty($phone) || empty($tier)) {
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

    // Default contribution amount based on tier
    $contribution = 0;
    switch ($tier) {
        case 'title_sponsor':
            $contribution = 50000;
            break;
        case 'gold_sponsor':
            $contribution = 25000;
            break;
        case 'silver_sponsor':
            $contribution = 10000;
            break;
        case 'supporter':
            $contribution = 5000;
            break;
        case 'green_soul':
        case 'custom':
            $contribution = 0;
            break;
    }

    $stmt = $conn->prepare("INSERT INTO sponsors (name, company, email, phone, tier, contribution, description, status, created_at) 
                           VALUES (:name, :company, :email, :phone, :tier, :contribution, :description, 'pending', NOW())");
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':company', $company);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':tier', $tier);
    $stmt->bindParam(':contribution', $contribution);
    $stmt->bindParam(':description', $message);
    
    $stmt->execute();
    
    sendResponse(true, 'Thank you for your interest! Our sponsorship team will contact you within 48 hours.');
    
} catch (Exception $e) {
    error_log("Sponsor Form Error: " . $e->getMessage());
    sendResponse(false, 'Something went wrong. Please try again later.');
}