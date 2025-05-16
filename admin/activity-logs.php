<?php
require_once 'includes/header.php';

// Pagination setup
$limit = 20;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Filter setup
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$where_clause = '';

if ($filter === 'login') {
    $where_clause = "WHERE a.activity_type = 'login'";
} elseif ($filter === 'admin') {
    $where_clause = "WHERE a.activity_type LIKE '%admin%'";
} elseif ($filter === 'registration') {
    $where_clause = "WHERE a.activity_type LIKE '%registration%'";
} elseif ($filter === 'message') {
    $where_clause = "WHERE a.activity_type LIKE '%message%'";
}

// Search functionality
$search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
if (!empty($search_term)) {
    $search_clause = "WHERE (u.admin_username LIKE '%".mysqli_real_escape_string($conn, $search_term)."%' 
                     OR a.description LIKE '%".mysqli_real_escape_string($conn, $search_term)."%'
                     OR a.activity_type LIKE '%".mysqli_real_escape_string($conn, $search_term)."%')";
    $where_clause = empty($where_clause) ? $search_clause : $where_clause . " AND " . substr($search_clause, 6);
}

// Count total logs
$count_sql = "SELECT COUNT(*) as total FROM activity_logs a 
              LEFT JOIN admin_users u ON a.user_id = u.admin_id $where_clause";
$count_result = $conn->query($count_sql);
$total_logs = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_logs / $limit);

// Get logs for current page
$sql = "SELECT a.*, u.admin_username 
        FROM activity_logs a
        LEFT JOIN admin_users u ON a.user_id = u.admin_id
        $where_clause
        ORDER BY a.created_at DESC LIMIT $offset, $limit";
$logs_result = $conn->query($sql);
?>

<div class="content">
    <div class="card-header with-actions">
        <h2><i class="fas fa-history"></i> Activity Logs</h2>
        
        <div class="filter-actions">
            <form action="" method="GET" class="search-form">
                <div class="search-group">
                    <input type="text" name="search" placeholder="Search logs..." value="<?php echo htmlspecialchars($search_term); ?>">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            
            <div class="btn-group">
                <a href="activity-logs.php?filter=all" class="btn <?php echo $filter === 'all' ? 'btn-primary' : 'btn-light'; ?>">All</a>
                <a href="activity-logs.php?filter=login" class="btn <?php echo $filter === 'login' ? 'btn-primary' : 'btn-light'; ?>">Login</a>
                <a href="activity-logs.php?filter=admin" class="btn <?php echo $filter === 'admin' ? 'btn-primary' : 'btn-light'; ?>">Admin</a>
                <a href="activity-logs.php?filter=registration" class="btn <?php echo $filter === 'registration' ? 'btn-primary' : 'btn-light'; ?>">Registration</a>
                <a href="activity-logs.php?filter=message" class="btn <?php echo $filter === 'message' ? 'btn-primary' : 'btn-light'; ?>">Messages</a>
            </div>
        </div>
    </div>
    
    <div class="content-card">
        <div class="logs-stats">
            <div class="stat-group">
                <div class="stat-item">
                    <div class="stat-value"><?php echo number_format($total_logs); ?></div>
                    <div class="stat-label">Total Activities</div>
                </div>
            </div>
            
            <div class="export-section">
                <button type="button" id="export-csv-btn" class="btn btn-secondary">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th width="150px">Timestamp</th>
                        <th width="120px">User</th>
                        <th width="120px">Activity Type</th>
                        <th>Description</th>
                        <th width="150px">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($logs_result && $logs_result->num_rows > 0): ?>
                        <?php while($row = $logs_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['log_id']; ?></td>
                                <td><?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?></td>
                                <td><?php echo htmlspecialchars($row['admin_username'] ?? 'Unknown'); ?></td>
                                <td>
                                    <span class="badge activity-type-<?php echo strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $row['activity_type'])); ?>">
                                        <?php echo htmlspecialchars($row['activity_type']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No activity logs found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if ($total_pages > 1): ?>
        <div class="pagination-container">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                <li>
                    <a href="activity-logs.php?page=<?php echo $page - 1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php 
                // Show a limited number of page links
                $start_page = max(1, min($page - 2, $total_pages - 4));
                $end_page = min($total_pages, max($page + 2, 5));
                
                if ($start_page > 1): ?>
                <li>
                    <a href="activity-logs.php?page=1&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">1</a>
                </li>
                <?php 
                    if ($start_page > 2): 
                        echo '<li><span class="pagination-ellipsis">...</span></li>';
                    endif;
                endif;
                
                for ($i = $start_page; $i <= $end_page; $i++): ?>
                <li>
                    <a href="activity-logs.php?page=<?php echo $i; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" 
                       class="pagination-link <?php echo $i === $page ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
                <?php endfor; 
                
                if ($end_page < $total_pages): 
                    if ($end_page < $total_pages - 1): 
                        echo '<li><span class="pagination-ellipsis">...</span></li>';
                    endif;
                ?>
                <li>
                    <a href="activity-logs.php?page=<?php echo $total_pages; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link"><?php echo $total_pages; ?></a>
                </li>
                <?php endif; ?>
                
                <?php if ($page < $total_pages): ?>
                <li>
                    <a href="activity-logs.php?page=<?php echo $page + 1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search_term); ?>" class="pagination-link">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Export to CSV functionality
    const exportCsvBtn = document.getElementById('export-csv-btn');
    if (exportCsvBtn) {
        exportCsvBtn.addEventListener('click', function() {
            // Get current filter and search parameters
            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter') || 'all';
            const search = urlParams.get('search') || '';
            
            // Redirect to export endpoint with current filters
            window.location.href = `export-logs.php?filter=${filter}&search=${encodeURIComponent(search)}`;
        });
    }
});
</script>

<?php require_once 'includes/footer.php'; ?>
