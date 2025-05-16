<?php
require_once 'crud-base.php';

/**
 * Sponsor CRUD Operations
 */
class SponsorCrud extends CrudBase {
    /**
     * Constructor
     * @param mysqli $conn - Database connection
     */
    public function __construct($conn) {
        parent::__construct($conn, 'sponsors', 'sponsor_id');
        
        $this->allowedFields = [
            'name', 'company', 'logo', 'website', 'tier',
            'contribution', 'email', 'phone', 'description', 'status'
        ];
        
        $this->requiredFields = [
            'name', 'company', 'email', 'tier', 'contribution'
        ];
        
        $this->activityType = 'sponsor';
    }
    
    /**
     * Get sponsors with filters
     * @param string $status - Filter by status
     * @param string $search - Search term
     * @param int $limit - Results limit
     * @param int $offset - Pagination offset
     * @return array - Filtered sponsors
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
            $searchWhere = "(name LIKE ? OR company LIKE ? OR email LIKE ?)";
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
            $searchWhere = "(name LIKE ? OR company LIKE ? OR email LIKE ?)";
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
     * Change sponsor status
     * @param int $id - Sponsor ID
     * @param string $status - New status: 'pending', 'active', 'inactive'
     * @return bool - Success or failure
     */
    public function changeStatus($id, $status) {
        if (!in_array($status, ['pending', 'active', 'inactive'])) {
            return false;
        }
        
        $sql = "UPDATE sponsors SET status = ? WHERE sponsor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $status, $id);
        $result = $stmt->execute();
        
        if ($result) {
            $action = ($status === 'active') ? 'approve' : 'reject';
            $this->logActivity($action, "Changed sponsor ID: {$id} status to {$status}");
            return true;
        }
        
        return false;
    }
    
    /**
     * Bulk change status
     * @param array $ids - Sponsor IDs
     * @param string $status - New status
     * @return bool - Success or failure
     */
    public function bulkChangeStatus($ids, $status) {
        if (empty($ids) || !in_array($status, ['pending', 'active', 'inactive'])) {
            return false;
        }
        
        $placeholders = array_fill(0, count($ids), '?');
        $sql = "UPDATE sponsors SET status = ? WHERE sponsor_id IN (" . implode(", ", $placeholders) . ")";
        
        $stmt = $this->conn->prepare($sql);
        
        $types = 's' . str_repeat('i', count($ids));
        $params = array_merge([$status], $ids);
        
        $stmt->bind_param($types, ...$params);
        $result = $stmt->execute();
        
        if ($result) {
            $action = ($status === 'active') ? 'bulk_approve' : 'bulk_reject';
            $this->logActivity($action, "Bulk changed status to {$status} for sponsors: " . implode(', ', $ids));
            return true;
        }
        
        return false;
    }
    
    /**
     * Upload sponsor logo
     * @param array $file - $_FILES array
     * @param string $sponsorName - Sponsor name for filename
     * @return string|false - Filename or false on failure
     */
    public function uploadLogo($file, $sponsorName) {
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }
        
        // Create upload directory if it doesn't exist
        $uploadDir = '../assets/images/sponsors/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Generate filename
        $safeFilename = preg_replace('/[^a-z0-9]/', '-', strtolower($sponsorName));
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $safeFilename . '-' . time() . '.' . $extension;
        $targetFile = $uploadDir . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $filename;
        }
        
        return false;
    }
    
    /**
     * Get sponsor statistics
     * @return array - Statistics array
     */
    public function getStats() {
        $stats = [];
        
        // Total sponsors
        $stats['total'] = $this->getCount();
        
        // Status counts
        $sql = "SELECT status, COUNT(*) as count FROM sponsors GROUP BY status";
        $result = $this->conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $stats[$row['status']] = $row['count'];
        }
        
        // Tier distribution
        $sql = "SELECT tier, COUNT(*) as count FROM sponsors GROUP BY tier";
        $result = $this->conn->query($sql);
        
        $stats['tiers'] = [];
        while ($row = $result->fetch_assoc()) {
            $stats['tiers'][$row['tier']] = $row['count'];
        }
        
        // Total contribution
        $sql = "SELECT SUM(contribution) as total FROM sponsors WHERE status = 'active'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $stats['total_contribution'] = $row['total'] ?? 0;
        
        return $stats;
    }
}
