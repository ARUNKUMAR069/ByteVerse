<?php
// Database connection parameters
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "byteverse";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($db_name);

// Read SQL file
$sql_file = file_get_contents('essential-tables.sql');

// Execute multi query
if ($conn->multi_query($sql_file)) {
    echo "Tables created successfully<br>";
    
    // Process all result sets
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    
} else {
    echo "Error executing SQL: " . $conn->error . "<br>";
}

$conn->close();
echo "Setup complete!";
?>
