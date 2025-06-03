<?php
define('SECURE_ACCESS', true);
require_once('index.php');

// Payment verification after Razorpay callback
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

// Get payment details
$razorpay_payment_id = filter_input(INPUT_POST, 'razorpay_payment_id', FILTER_SANITIZE_STRING);
$razorpay_order_id = filter_input(INPUT_POST, 'razorpay_order_id', FILTER_SANITIZE_STRING);
$razorpay_signature = filter_input(INPUT_POST, 'razorpay_signature', FILTER_SANITIZE_STRING);

// Your Razorpay Key Secret
$key_secret = '6qvb9LZmjob6evhouICZSpEj';

// Verify payment signature
$generated_signature = hash_hmac('sha256', $razorpay_payment_id . '|' . $razorpay_order_id, $key_secret);

if ($generated_signature == $razorpay_signature) {
    // Payment is verified, update database
    try {
        $conn = getDbConnection();
        if (!$conn) {
            throw new Exception("Database connection failed");
        }
        
        // Update payment status
        $stmt = $conn->prepare("UPDATE payments SET payment_status = 'completed' WHERE payment_id = :payment_id");
        $stmt->bindParam(':payment_id', $razorpay_payment_id);
        $stmt->execute();
        
        sendResponse(true, 'Payment verified successfully');
    } catch (Exception $e) {
        sendResponse(false, 'Failed to verify payment');
    }
} else {
    // Invalid signature
    sendResponse(false, 'Payment verification failed');
}