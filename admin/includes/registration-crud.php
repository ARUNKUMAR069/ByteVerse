<?php
require_once 'crud-base.php';

/**
 * Registration CRUD Operations
 */
class RegistrationCrud extends CrudBase {
    /**
     * Constructor
     * @param mysqli $conn - Database connection
     */
    public function __construct($conn) {
        parent::__construct($conn, 'registrations', 'id');
        
        $this->allowedFields = [
            'team_name', 'team_size', 'institution', 'challenge_track',
            'name', 'email', 'phone', 'role', 'project_title',
            'project_description', 'technologies', 'payment_status',
            'payment_id', 'status'
        ];
        
        $this->requiredFields = [
            'team_name', 'team_size', 'name', 'email', 'phone'
        ];
        
        $this->activityType = 'registration';
    }
    
    /**
     * Get registrations with filters
     * @param string $status - Filter by status
     * @param string $search - Search term
     * @param int $limit - Results limit
     * @param int $offset - Pagination offset
     * @return array - Filtered registrations
     */
    public function getFiltered($status = '', $search = '', $limit = 10, $offset = 0) {
        $where = '';
        $params = [];
        
        // Status filter
        if (!empty($status) && $status !== 'all') {
            $where = "status = ?";
            $params[] = $status;
        }
        
        // Search filter
        if (!empty($search)) {
            $searchWhere = "(name LIKE ? OR email LIKE ? OR team_name LIKE ?)";
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
     * @param string $status - Filter by status
     * @param string $search - Search term
     * @return int - Total count
     */
    public function getFilteredCount($status = '', $search = '') {
        $where = '';
        $params = [];
        
        // Status filter
        if (!empty($status) && $status !== 'all') {
            $where = "status = ?";
            $params[] = $status;
        }
        
        // Search filter
        if (!empty($search)) {
            $searchWhere = "(name LIKE ? OR email LIKE ? OR team_name LIKE ?)";
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
     * Change registration status
     * @param int $id - Registration ID
     * @param string $status - New status: 'pending', 'active', 'rejected'
     * @return bool - Success or failure
     */
    public function changeStatus($id, $status) {
        if (!in_array($status, ['pending', 'active', 'rejected'])) {
            return false;
        }
        
        $sql = "UPDATE registrations SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $status, $id);
        $result = $stmt->execute();
        
        if ($result) {
            $statusAction = ($status === 'active') ? 'approve' : 'reject';
            $this->logActivity($statusAction, "Changed registration ID: {$id} status to {$status}");
            return true;
        }
        
        return false;
    }
    
    /**
     * Bulk change status
     * @param array $ids - Registration IDs
     * @param string $status - New status
     * @return bool - Success or failure
     */
    public function bulkChangeStatus($ids, $status) {
        if (empty($ids) || !in_array($status, ['pending', 'active', 'rejected'])) {
            return false;
        }
        
        $placeholders = array_fill(0, count($ids), '?');
        $sql = "UPDATE registrations SET status = ? WHERE id IN (" . implode(", ", $placeholders) . ")";
        
        $stmt = $this->conn->prepare($sql);
        
        $types = 's' . str_repeat('i', count($ids));
        $params = array_merge([$status], $ids);
        
        $stmt->bind_param($types, ...$params);
        $result = $stmt->execute();
        
        if ($result) {
            $statusAction = ($status === 'active') ? 'bulk_approve' : 'bulk_reject';
            $this->logActivity($statusAction, "Bulk changed status to {$status} for registrations: " . implode(', ', $ids));
            return true;
        }
        
        return false;
    }
    
    /**
     * Get registration statistics
     * @return array - Statistics array
     */
    public function getStats() {
        $stats = [];
        
        // Total registrations
        $stats['total'] = $this->getCount();
        
        // Status counts
        $sql = "SELECT status, COUNT(*) as count FROM registrations GROUP BY status";
        $result = $this->conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $stats[$row['status']] = $row['count'];
        }
        
        // Track distribution
        $sql = "SELECT challenge_track, COUNT(*) as count FROM registrations GROUP BY challenge_track";
        $result = $this->conn->query($sql);
        
        $stats['tracks'] = [];
        while ($row = $result->fetch_assoc()) {
            $stats['tracks'][$row['challenge_track']] = $row['count'];
        }
        
        return $stats;
    }
}
