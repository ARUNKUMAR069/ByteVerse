
<?php
// Database connection
function getDbConnection() {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'byteverse';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        error_log("Database Connection Error: " . $e->getMessage());
        return null;
    }
}