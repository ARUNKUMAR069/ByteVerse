<?php
// filepath: c:\xampp\htdocs\new2\admin\includes\admin-database.php

class AdminDatabase {
    private $host = 'localhost';
    private $dbname = 'byteverse'; // Change this to your actual database name
    private $username = 'root';    // Change this to your actual database username
    private $password = '';        // Change this to your actual database password
    private $conn;
    
    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function initializeTables() {
        // Create admin_users table
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS admin_users (
                admin_id INT AUTO_INCREMENT PRIMARY KEY,
                admin_username VARCHAR(50) NOT NULL UNIQUE,
                admin_email VARCHAR(100) NOT NULL UNIQUE,
                admin_password VARCHAR(255) NOT NULL,
                admin_fullname VARCHAR(100) NOT NULL,
                admin_role ENUM('super_admin', 'admin', 'manager', 'editor', 'viewer') NOT NULL DEFAULT 'viewer',
                admin_status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
                admin_avatar VARCHAR(255) NULL,
                admin_last_login DATETIME NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");
        
        // Create admin_logs table
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS admin_logs (
                log_id INT AUTO_INCREMENT PRIMARY KEY,
                admin_id INT NULL,
                log_action VARCHAR(50) NOT NULL,
                log_entity VARCHAR(50) NOT NULL,
                entity_id INT NULL,
                log_details TEXT NULL,
                ip_address VARCHAR(45) NULL,
                log_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (admin_id) REFERENCES admin_users(admin_id) ON DELETE SET NULL
            )
        ");
        
        // Create admin_settings table
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS admin_settings (
                setting_id INT AUTO_INCREMENT PRIMARY KEY,
                setting_key VARCHAR(50) NOT NULL UNIQUE,
                setting_value TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");
        
        // Create admin_notifications table
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS admin_notifications (
                notification_id INT AUTO_INCREMENT PRIMARY KEY,
                admin_id INT NULL,
                message TEXT NOT NULL,
                type VARCHAR(20) DEFAULT 'info',
                icon VARCHAR(50) NULL,
                link VARCHAR(255) NULL,
                is_read TINYINT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (admin_id) REFERENCES admin_users(admin_id) ON DELETE SET NULL
            )
        ");
        
        // Create admin_reset_tokens table
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS admin_reset_tokens (
                token_id INT AUTO_INCREMENT PRIMARY KEY,
                admin_id INT NOT NULL,
                token VARCHAR(100) NOT NULL UNIQUE,
                expires_at DATETIME NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (admin_id) REFERENCES admin_users(admin_id) ON DELETE CASCADE
            )
        ");
        
        // Other tables can be created here (registrations, sponsors, etc.)
    }
}

// Include AdminAuth class
require_once 'admin-auth.php';