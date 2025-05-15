
<?php
class AdminDatabase {
    private $host = 'localhost';
    private $db_name = 'byteverse';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Get database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
    
    // Initialize database tables
    public function initializeTables() {
        $conn = $this->getConnection();
        
        // Create admin users table
        $users_table = "CREATE TABLE IF NOT EXISTS `admin_users` (
            `admin_id` INT AUTO_INCREMENT PRIMARY KEY,
            `admin_username` VARCHAR(50) NOT NULL UNIQUE,
            `admin_password` VARCHAR(255) NOT NULL,
            `admin_email` VARCHAR(100) NOT NULL UNIQUE,
            `admin_fullname` VARCHAR(100) NOT NULL,
            `admin_role` ENUM('super_admin', 'admin', 'manager', 'viewer') NOT NULL DEFAULT 'viewer',
            `admin_status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
            `admin_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `admin_last_login` TIMESTAMP NULL,
            `admin_avatar` VARCHAR(255) DEFAULT NULL
        )";
        $conn->exec($users_table);
        
        // Create sponsors table with admin tracking fields
        $sponsors_table = "CREATE TABLE IF NOT EXISTS `sponsors` (
            `sponsor_id` INT AUTO_INCREMENT PRIMARY KEY,
            `company_name` VARCHAR(100) NOT NULL,
            `contact_name` VARCHAR(100) NOT NULL,
            `contact_email` VARCHAR(100) NOT NULL,
            `contact_phone` VARCHAR(20) NOT NULL,
            `company_website` VARCHAR(255) DEFAULT NULL,
            `sponsor_tier` ENUM('platinum', 'gold', 'silver', 'bronze') NOT NULL,
            `sponsor_logo` VARCHAR(255) DEFAULT NULL,
            `sponsor_message` TEXT,
            `sponsor_status` ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `approved_by` INT DEFAULT NULL,
            `approved_at` TIMESTAMP NULL
        )";
        $conn->exec($sponsors_table);
        
        // Create registrations table with admin tracking fields
        $registrations_table = "CREATE TABLE IF NOT EXISTS `registrations` (
            `reg_id` INT AUTO_INCREMENT PRIMARY KEY,
            `team_name` VARCHAR(100) NOT NULL,
            `team_leader` VARCHAR(100) NOT NULL,
            `leader_email` VARCHAR(100) NOT NULL,
            `leader_phone` VARCHAR(20) NOT NULL,
            `college_name` VARCHAR(100) DEFAULT NULL,
            `member_count` INT NOT NULL,
            `member_details` TEXT NOT NULL,
            `project_domain` VARCHAR(50) NOT NULL,
            `project_idea` TEXT,
            `reg_status` ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
            `payment_status` ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
            `reg_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `approved_by` INT DEFAULT NULL,
            `approved_at` TIMESTAMP NULL
        )";
        $conn->exec($registrations_table);
        
        // Create admin activity log
        $activity_log_table = "CREATE TABLE IF NOT EXISTS `admin_logs` (
            `log_id` INT AUTO_INCREMENT PRIMARY KEY,
            `admin_id` INT NOT NULL,
            `log_action` VARCHAR(255) NOT NULL,
            `log_entity` VARCHAR(50) NOT NULL,
            `entity_id` INT DEFAULT NULL,
            `log_details` TEXT DEFAULT NULL,
            `ip_address` VARCHAR(45) DEFAULT NULL,
            `log_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn->exec($activity_log_table);
        
        // Create default admin user if it doesn't exist
        $query = "SELECT COUNT(*) FROM `admin_users` WHERE `admin_role` = 'super_admin'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        if ($stmt->fetchColumn() == 0) {
            // Create default admin user (username: admin, password: ByteVerse@2025)
            $default_password = password_hash('ByteVerse@2025', PASSWORD_DEFAULT);
            $admin_query = "INSERT INTO `admin_users` 
                            (`admin_username`, `admin_password`, `admin_email`, `admin_fullname`, `admin_role`) 
                            VALUES 
                            ('admin', :password, 'admin@byteverse.com', 'System Administrator', 'super_admin')";
            $stmt = $conn->prepare($admin_query);
            $stmt->bindParam(':password', $default_password);
            $stmt->execute();
        }
    }
}