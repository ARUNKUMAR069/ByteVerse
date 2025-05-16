<?php
/**
 * Base CRUD Operations Class
 * Provides common functionality for admin CRUD operations
 */
class CrudBase {
    protected $conn;
    protected $table;
    protected $primaryKey;
    protected $allowedFields = [];
    protected $requiredFields = [];
    protected $adminId;
    protected $activityType;
    
    /**
     * Constructor
     * @param mysqli $conn - Database connection
     * @param string $table - Table name
     * @param string $primaryKey - Primary key column name
     */
    public function __construct($conn, $table, $primaryKey = 'id') {
        $this->conn = $conn;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->adminId = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : 0;
    }
    
    /**
     * Get all records with optional filtering and pagination
     * @param string $where - WHERE clause
     * @param array $params - Parameters for prepared statement
     * @param int $limit - Limit results
     * @param int $offset - Offset for pagination
     * @return array - Result array
     */
    public function getAll($where = '', $params = [], $limit = 0, $offset = 0) {
        $sql = "SELECT * FROM {$this->table}";
        
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        if ($limit > 0) {
            $sql .= " LIMIT ?";
            $params[] = $limit;
            
            if ($offset > 0) {
                $sql .= " OFFSET ?";
                $params[] = $offset;
            }
        }
        
        $stmt = $this->conn->prepare($sql);
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        
        return $items;
    }
    
    /**
     * Get record count
     * @param string $where - WHERE clause
     * @param array $params - Parameters for prepared statement
     * @return int - Count
     */
    public function getCount($where = '', $params = []) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        
        $stmt = $this->conn->prepare($sql);
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['count'];
    }
    
    /**
     * Get a single record by ID
     * @param int $id - Record ID
     * @return array|null - Record or null if not found
     */
    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
    
    /**
     * Create a new record
     * @param array $data - Record data
     * @return int|bool - New ID or false on failure
     */
    public function create($data) {
        // Filter only allowed fields
        $filteredData = [];
        foreach ($this->allowedFields as $field) {
            if (isset($data[$field])) {
                $filteredData[$field] = $data[$field];
            }
        }
        
        // Check required fields
        foreach ($this->requiredFields as $field) {
            if (!isset($filteredData[$field]) || empty($filteredData[$field])) {
                return false; // Required field missing
            }
        }
        
        if (empty($filteredData)) {
            return false;
        }
        
        $fields = array_keys($filteredData);
        $placeholders = array_fill(0, count($fields), '?');
        
        $sql = "INSERT INTO {$this->table} (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $placeholders) . ")";
        $stmt = $this->conn->prepare($sql);
        
        $types = '';
        $values = [];
        
        foreach ($filteredData as $value) {
            $types .= $this->getBindType($value);
            $values[] = $value;
        }
        
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        
        if ($result) {
            $newId = $stmt->insert_id;
            $this->logActivity('create', "Created new {$this->activityType} with ID: {$newId}");
            return $newId;
        }
        
        return false;
    }
    
    /**
     * Update an existing record
     * @param int $id - Record ID
     * @param array $data - Record data
     * @return bool - Success or failure
     */
    public function update($id, $data) {
        // Filter only allowed fields
        $filteredData = [];
        foreach ($this->allowedFields as $field) {
            if (isset($data[$field])) {
                $filteredData[$field] = $data[$field];
            }
        }
        
        if (empty($filteredData)) {
            return false;
        }
        
        $setClause = [];
        foreach ($filteredData as $key => $value) {
            $setClause[] = "$key = ?";
        }
        
        $sql = "UPDATE {$this->table} SET " . implode(", ", $setClause) . " WHERE {$this->primaryKey} = ?";
        $stmt = $this->conn->prepare($sql);
        
        $types = '';
        $values = [];
        
        foreach ($filteredData as $value) {
            $types .= $this->getBindType($value);
            $values[] = $value;
        }
        
        // Add ID to values
        $types .= 'i';
        $values[] = $id;
        
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        
        if ($result) {
            $this->logActivity('update', "Updated {$this->activityType} with ID: {$id}");
            return true;
        }
        
        return false;
    }
    
    /**
     * Delete a record
     * @param int $id - Record ID
     * @return bool - Success or failure
     */
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        
        if ($result) {
            $this->logActivity('delete', "Deleted {$this->activityType} with ID: {$id}");
            return true;
        }
        
        return false;
    }
    
    /**
     * Bulk delete records
     * @param array $ids - Array of record IDs
     * @return bool - Success or failure
     */
    public function bulkDelete($ids) {
        if (empty($ids)) {
            return false;
        }
        
        $placeholders = array_fill(0, count($ids), '?');
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} IN (" . implode(", ", $placeholders) . ")";
        $stmt = $this->conn->prepare($sql);
        
        $types = str_repeat('i', count($ids));
        $stmt->bind_param($types, ...$ids);
        $result = $stmt->execute();
        
        if ($result) {
            $this->logActivity('bulk_delete', "Bulk deleted {$this->activityType}s: " . implode(', ', $ids));
            return true;
        }
        
        return false;
    }
    
    /**
     * Log admin activity
     * @param string $action - Type of action
     * @param string $description - Activity description
     */
    protected function logActivity($action, $description) {
        $activityType = empty($this->activityType) ? $action : "{$action}_{$this->activityType}";
        $sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                VALUES (?, ?, ?, ?)";
                
        $stmt = $this->conn->prepare($sql);
        $ip = $_SERVER['REMOTE_ADDR'];
        $stmt->bind_param("isss", $this->adminId, $activityType, $description, $ip);
        $stmt->execute();
    }
    
    /**
     * Get bind type for prepared statement
     * @param mixed $value - Value
     * @return string - Bind type (i, d, s, b)
     */
    private function getBindType($value) {
        if (is_int($value)) {
            return 'i';
        } elseif (is_float($value)) {
            return 'd';
        } elseif (is_string($value)) {
            return 's';
        } else {
            return 's'; // Default to string
        }
    }
}
