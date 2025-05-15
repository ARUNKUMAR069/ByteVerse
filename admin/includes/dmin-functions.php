

<?php
// Utility functions for the admin panel

// Sanitize input
function adminSanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Generate secure CSRF token
function adminGenerateCSRFToken() {
    if (!isset($_SESSION['admin_csrf_token'])) {
        $_SESSION['admin_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['admin_csrf_token'];
}

// Verify CSRF token
function adminVerifyCSRFToken($token) {
    if (!isset($_SESSION['admin_csrf_token']) || $token !== $_SESSION['admin_csrf_token']) {
        return false;
    }
    return true;
}

// Format date for display
function adminFormatDate($date, $format = 'M d, Y h:i A') {
    $datetime = new DateTime($date);
    return $datetime->format($format);
}

// Get role name for display
function adminGetRoleName($role) {
    $roles = [
        'super_admin' => 'Super Administrator',
        'admin' => 'Administrator',
        'manager' => 'Manager',
        'viewer' => 'Viewer'
    ];
    
    return isset($roles[$role]) ? $roles[$role] : 'Unknown';
}

// Check if user has access to a specific page
function adminCheckAccess($auth, $requiredRole) {
    if (!$auth->isLoggedIn()) {
        header("Location: admin-index.php");
        exit;
    }
    
    if (!$auth->hasPermission($requiredRole)) {
        header("Location: admin-dashboard.php?error=permission");
        exit;
    }
}

// Generate a random password
function adminGeneratePassword($length = 12) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    $password = '';
    $max = strlen($chars) - 1;
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, $max)];
    }
    
    return $password;
}

// Get status badge HTML based on status value
function adminGetStatusBadge($status, $type = 'generic') {
    $badges = [
        'generic' => [
            'pending' => '<span class="admin-badge admin-badge-warning">Pending</span>',
            'approved' => '<span class="admin-badge admin-badge-success">Approved</span>',
            'rejected' => '<span class="admin-badge admin-badge-danger">Rejected</span>',
            'active' => '<span class="admin-badge admin-badge-success">Active</span>',
            'inactive' => '<span class="admin-badge admin-badge-danger">Inactive</span>',
            'completed' => '<span class="admin-badge admin-badge-success">Completed</span>',
            'failed' => '<span class="admin-badge admin-badge-danger">Failed</span>'
        ],
        'payment' => [
            'pending' => '<span class="admin-badge admin-badge-warning">Pending</span>',
            'completed' => '<span class="admin-badge admin-badge-success">Completed</span>',
            'failed' => '<span class="admin-badge admin-badge-danger">Failed</span>'
        ]
    ];
    
    if (isset($badges[$type][$status])) {
        return $badges[$type][$status];
    }
    
    return '<span class="admin-badge admin-badge-secondary">' . ucfirst($status) . '</span>';
}

// Get pagination HTML
function adminGetPagination($currentPage, $totalPages, $baseUrl) {
    $html = '<div class="admin-pagination">';
    
    // Previous button
    if ($currentPage > 1) {
        $html .= '<a href="' . $baseUrl . '?page=' . ($currentPage - 1) . '" class="admin-pagination-item">&laquo;</a>';
    } else {
        $html .= '<span class="admin-pagination-item disabled">&laquo;</span>';
    }
    
    // Page numbers
    $startPage = max(1, $currentPage - 2);
    $endPage = min($totalPages, $currentPage + 2);
    
    if ($startPage > 1) {
        $html .= '<a href="' . $baseUrl . '?page=1" class="admin-pagination-item">1</a>';
        if ($startPage > 2) {
            $html .= '<span class="admin-pagination-item disabled">...</span>';
        }
    }
    
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            $html .= '<span class="admin-pagination-item active">' . $i . '</span>';
        } else {
            $html .= '<a href="' . $baseUrl . '?page=' . $i . '" class="admin-pagination-item">' . $i . '</a>';
        }
    }
    
    if ($endPage < $totalPages) {
        if ($endPage < $totalPages - 1) {
            $html .= '<span class="admin-pagination-item disabled">...</span>';
        }
        $html .= '<a href="' . $baseUrl . '?page=' . $totalPages . '" class="admin-pagination-item">' . $totalPages . '</a>';
    }
    
    // Next button
    if ($currentPage < $totalPages) {
        $html .= '<a href="' . $baseUrl . '?page=' . ($currentPage + 1) . '" class="admin-pagination-item">&raquo;</a>';
    } else {
        $html .= '<span class="admin-pagination-item disabled">&raquo;</span>';
    }
    
    $html .= '</div>';
    
    return $html;
}