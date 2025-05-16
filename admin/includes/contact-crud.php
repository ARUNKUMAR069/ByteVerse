<?php
require_once 'crud-base.php';

/**
 * Contact Messages CRUD Operations
 */
class ContactCrud extends CrudBase {
    /**
     * Constructor
     * @param mysqli $conn - Database connection
     */
    public function __construct($conn) {
        parent::__construct($conn, 'contact_messages', 'message_id');
        
        $this->allowedFields = [
            'name', 'email', 'phone', 'message', 'is_read'
        ];
        
        $this->requiredFields = [
            'name', 'email', 'message'
        ];
        
        $this->activityType = 'message';
    }
    
    /**
     * Get messages with filters
     * @param bool $readStatus - null for all, true for read, false for unread
     * @param string $search - Search term
     * @param int $limit - Results limit
     * @param int $offset - Pagination offset
     * @return array - Filtered messages
     */
    public function getFiltered($readStatus = null, $search = '', $limit = 10, $offset = 0) {
        $where = '';
        $params = [];
        
        // Read status filter
        if ($readStatus !== null) {
            $where = "is_read = ?";
            $params[] = $readStatus ? 1 : 0;
        }
        
        // Search filter
        if (!empty($search)) {
            $searchWhere = "(name LIKE ? OR email LIKE ? OR message LIKE ?)";
            $searchParam = "%{$search}%";
            
            if (empty($where)) {
                $where = $searchWhere;
            } else {
                $where .= " AND {$searchWhere}";
            }
            
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }
        
        return $this->getAll($where, $params, $limit, $offset);
    }
    
    /**
     * Get total count with filters
     * @param bool $readStatus - null for all, true for read, false for unread
     * @param string $search - Search term
     * @return int - Total count
     */
    public function getFilteredCount($readStatus = null, $search = '') {
        $where = '';
        $params = [];
        
        // Read status filter
        if ($readStatus !== null) {
            $where = "is_read = ?";
            $params[] = $readStatus ? 1 : 0;
        }
        
        // Search filter
        if (!empty($search)) {
            $searchWhere = "(name LIKE ? OR email LIKE ? OR message LIKE ?)";
            $searchParam = "%{$search}%";
            
            if (empty($where)) {
                $where = $searchWhere;
            } else {
                $where .= " AND {$searchWhere}";
            }
            
            $params[] = $searchParam;
            $params[] = $searchParam;
            $params[] = $searchParam;
        }
        
        return $this->getCount($where, $params);
    }
    
    /**
     * Mark message as read
     * @param int $id - Message ID
     * @return bool - Success or failure
     */
    public function markAsRead($id) {
        $sql = "UPDATE contact_messages SET is_read = 1 WHERE message_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        
        if ($result) {
            $this->logActivity('read', "Marked message ID: {$id} as read");
            return true;
        }
        
        return false;
    }
    
    /**
     * Mark message as unread
     * @param int $id - Message ID
     * @return bool - Success or failure
     */
    public function markAsUnread($id) {
        $sql = "UPDATE contact_messages SET is_read = 0 WHERE message_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        
        if ($result) {
            $this->logActivity('unread', "Marked message ID: {$id} as unread");
            return true;
        }
        
        return false;
    }
    
    /**
     * Bulk mark messages as read
     * @param array $ids - Message IDs
     * @return bool - Success or failure
     */
    public function bulkMarkAsRead($ids) {
        if (empty($ids)) {
            return false;
        }
        
        $placeholders = array_fill(0, count($ids), '?');
        $sql = "UPDATE contact_messages SET is_read = 1 WHERE message_id IN (" . implode(", ", $placeholders) . ")";
        
        $stmt = $this->conn->prepare($sql);
        $types = str_repeat('i', count($ids));
        $stmt->bind_param($types, ...$ids);
        $result = $stmt->execute();
        
        if ($result) {
            $this->logActivity('bulk_mark_read', "Marked messages as read: " . implode(', ', $ids));
            return true;
        }
        
        return false;
    }
    
    /**
     * Get message statistics
     * @return array - Statistics array
     */
    public function getStats() {
        $stats = [];
        
        // Total messages
        $stats['total'] = $this->getCount();
        
        // Read/unread counts
        $sql = "SELECT is_read, COUNT(*) as count FROM contact_messages GROUP BY is_read";
        $result = $this->conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $key = $row['is_read'] ? 'read' : 'unread';
            $stats[$key] = $row['count'];
        }
        
        return $stats;
    }
}
