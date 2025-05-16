<?php
// Database configuration

// Database credentials
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'byteverse';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if admin_users table exists, if not, suggest setup
function check_table_exists($conn, $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    return ($result && $result->num_rows > 0);
}

// Function to check if user is logged in
function check_admin_login() {
    if (!isset($_SESSION['admin_id'])) {
        // Only redirect if the script is not setup-database.php
        $current_script = basename($_SERVER['SCRIPT_NAME']);
        if ($current_script !== 'setup-database.php' && $current_script !== 'login.php') {
            header("Location: login.php");
            exit;
        }
    }
}

// Safely redirect to another page
function safe_redirect($url) {
    // Check if headers have already been sent
    if (!headers_sent()) {
        // If headers haven't been sent, use regular redirect
        header("Location: $url");
        exit;
    } else {
        // If headers have been sent, use JavaScript redirect
        echo "<script>window.location.href='$url';</script>";
        // Provide a fallback link in case JavaScript is disabled
        echo "<noscript><meta http-equiv='refresh' content='0;url=$url'></noscript>";
        echo "<p>If you are not redirected automatically, please <a href='$url'>click here</a>.</p>";
        exit;
    }
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
