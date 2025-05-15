
<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AdminAuth {
    private $db;
    private $conn;
    
    public function __construct($database) {
        $this->db = $database;
        $this->conn = $this->db->getConnection();
    }
    
    // Check if admin is logged in
    public function isLoggedIn() {
        return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
    }
    
    // Login admin user
    public function login($username, $password) {
        // Validate input
        if (empty($username) || empty($password)) {
            return [
                'success' => false,
                'message' => 'Username and password are required'
            ];
        }
        
        try {
            // Check if user exists
            $query = "SELECT * FROM admin_users WHERE admin_username = :username AND admin_status = 'active' LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verify password
                if (password_verify($password, $user['admin_password'])) {
                    // Update last login
                    $update_query = "UPDATE admin_users SET admin_last_login = NOW() WHERE admin_id = :id";
                    $update_stmt = $this->conn->prepare($update_query);
                    $update_stmt->bindParam(":id", $user['admin_id']);
                    $update_stmt->execute();
                    
                    // Set session variables
                    $_SESSION['admin_id'] = $user['admin_id'];
                    $_SESSION['admin_username'] = $user['admin_username'];
                    $_SESSION['admin_role'] = $user['admin_role'];
                    $_SESSION['admin_email'] = $user['admin_email'];
                    $_SESSION['admin_fullname'] = $user['admin_fullname'];
                    $_SESSION['admin_avatar'] = $user['admin_avatar'];
                    
                    // Log this activity
                    $this->logActivity($user['admin_id'], 'login', 'auth', null, 'Admin logged in', $this->getIPAddress());
                    
                    return [
                        'success' => true,
                        'message' => 'Login successful',
                        'user' => $user
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Invalid credentials'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'User not found or inactive'
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }
    }
    
    // Logout admin user
    public function logout() {
        if ($this->isLoggedIn()) {
            $user_id = $_SESSION['admin_id'];
            // Log this activity
            $this->logActivity($user_id, 'logout', 'auth', null, 'Admin logged out', $this->getIPAddress());
            
            // Unset all session variables
            $_SESSION = array();
            
            // If it's desired to kill the session, also delete the session cookie
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            
            // Finally, destroy the session
            session_destroy();
            
            return [
                'success' => true,
                'message' => 'Logout successful'
            ];
        }
        
        return [
            'success' => false,
            'message' => 'No active session to logout'
        ];
    }
    
    // Check permission by role
    public function hasPermission($requiredRole) {
        if (!$this->isLoggedIn()) {
            return false;
        }
        
        $roles = [
            'viewer' => 1,
            'manager' => 2,
            'admin' => 3,
            'super_admin' => 4
        ];
        
        $userRole = $_SESSION['admin_role'];
        
        return $roles[$userRole] >= $roles[$requiredRole];
    }
    
    // Log admin activity
    public function logActivity($adminId, $action, $entity, $entityId = null, $details = null, $ipAddress = null) {
        try {
            $query = "INSERT INTO admin_logs (admin_id, log_action, log_entity, entity_id, log_details, ip_address)
                      VALUES (:admin_id, :action, :entity, :entity_id, :details, :ip_address)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':admin_id', $adminId);
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':entity', $entity);
            $stmt->bindParam(':entity_id', $entityId);
            $stmt->bindParam(':details', $details);
            $stmt->bindParam(':ip_address', $ipAddress);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Just log silently - don't disrupt main operations
            error_log('Failed to log activity: ' . $e->getMessage());
            return false;
        }
    }
    
    // Get IP address
    private function getIPAddress() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}