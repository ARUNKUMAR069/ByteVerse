<?php
// filepath: c:\xampp\htdocs\byteverse-admin\admin\includes\admin-database.php

class AdminDatabase {
    private $host = 'localhost';
    private $db_name = 'byteverse_db';
    private $username = 'root';
    private $password = '';
    public $conn;

    // Database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>