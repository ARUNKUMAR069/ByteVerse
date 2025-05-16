<?php
// filepath: c:\xampp\htdocs\new2\admin\includes\admin-auth.php

class AdminAuth {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function login($username, $password) {
        $conn = $this->db->getConnection();
        
        // Find user by username
        $query = "SELECT * FROM admin_users WHERE admin_username = :username AND admin_status = 'active'";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verify password if user exists
        if ($user && password_verify($password, $user['admin_password'])) {
            // Start session if not started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            // Set session variables
            $_SESSION['admin_user_id'] = $user['admin_id'];
            $_SESSION['admin_username'] = $user['admin_username'];
            $_SESSION['admin_email'] = $user['admin_email'];
            $_SESSION['admin_fullname'] = $user['admin_fullname'];
            $_SESSION['admin_role'] = $user['admin_role'];
            $_SESSION['admin_status'] = $user['admin_status'];
            $_SESSION['admin_avatar'] = $user['admin_avatar'];
            
            // Update last login time
            $update_query = "UPDATE admin_users SET admin_last_login = NOW() WHERE admin_id = :id";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bindParam(':id', $user['admin_id']);
            $update_stmt->execute();
            
            // Log login activity
            $this->logActivity($user['admin_id'], 'login', 'system', null, 'User logged in');
            
            return true;
        }
        
        return false;
    }
    
    public function logout() {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Log logout activity if user is logged in
        if (isset($_SESSION['admin_user_id'])) {
            $this->logActivity($_SESSION['admin_user_id'], 'logout', 'system', null, 'User logged out');
        }
        
        // Destroy session
        session_unset();
        session_destroy();
        
        return true;
    }
    
    public function isLoggedIn() {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['admin_user_id']);
    }
    
    public function hasPermission($requiredRole) {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['admin_role'])) {
            return false;
        }
        
        $userRole = $_SESSION['admin_role'];
        
        // Role hierarchy
        $roles = [
            'super_admin' => 5,
            'admin' => 4,
            'manager' => 3,
            'editor' => 2,
            'viewer' => 1
        ];
        
        // Get role levels
        $userRoleLevel = isset($roles[$userRole]) ? $roles[$userRole] : 0;
        
        if (is_array($requiredRole)) {
            // If required role is an array, check if user's role is in the array
            return in_array($userRole, $requiredRole);
        } else {
            // If required role is a string, check if user's role level is sufficient
            $requiredRoleLevel = isset($roles[$requiredRole]) ? $roles[$requiredRole] : 0;
            return $userRoleLevel >= $requiredRoleLevel;
        }
    }
    
    public function changePassword($userId, $currentPassword, $newPassword) {
        $conn = $this->db->getConnection();
        
        // Get user's current password
        $query = "SELECT admin_password FROM admin_users WHERE admin_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verify current password
        if ($user && password_verify($currentPassword, $user['admin_password'])) {
            // Hash new password
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update password
            $update_query = "UPDATE admin_users SET admin_password = :password WHERE admin_id = :id";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bindParam(':password', $passwordHash);
            $update_stmt->bindParam(':id', $userId);
            
            if ($update_stmt->execute()) {
                // Log password change
                $this->logActivity($userId, 'update', 'users', $userId, 'Password changed');
                return true;
            }
        }
        
        return false;
    }
    
    public function requestPasswordReset($email) {
        $conn = $this->db->getConnection();
        
        // Find user by email
        $query = "SELECT * FROM admin_users WHERE admin_email = :email AND admin_status = 'active'";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            return false;
        }
        
        // Generate token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', time() + 3600); // 1 hour expiry
        
        // Store token
        $query = "INSERT INTO admin_reset_tokens (admin_id, token, expires_at) 
                  VALUES (:admin_id, :token, :expires)
                  ON DUPLICATE KEY UPDATE token = :token, expires_at = :expires";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':admin_id', $user['admin_id']);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expires', $expires);
        
        if ($stmt->execute()) {
            // Send email with reset link
            $resetLink = "http://localhost/new2/admin/reset-password.php?token=" . $token;
            $to = $user['admin_email'];
            $subject = "ByteVerse Admin - Password Reset";
            $message = "Hello " . $user['admin_fullname'] . ",\n\n";
            $message .= "You have requested to reset your password. Please click the link below to reset it:\n\n";
            $message .= $resetLink . "\n\n";
            $message .= "This link will expire in 1 hour.\n\n";
            $message .= "If you did not request this, please ignore this email.\n\n";
            $message .= "Regards,\nByteVerse Admin Team";
            
            return mail($to, $subject, $message);
        }
        
        return false;
    }
    
    private function logActivity($userId, $action, $entity, $entityId = null, $details = null) {
        $conn = $this->db->getConnection();
        
        $query = "INSERT INTO admin_logs (admin_id, log_action, log_entity, entity_id, log_details, ip_address)
                 VALUES (:admin_id, :action, :entity, :entity_id, :details, :ip)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':admin_id', $userId);
        $stmt->bindParam(':action', $action);
        $stmt->bindParam(':entity', $entity);
        $stmt->bindParam(':entity_id', $entityId);
        $stmt->bindParam(':details', $details);
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $stmt->bindParam(':ip', $ip);
        
        return $stmt->execute();
    }
}