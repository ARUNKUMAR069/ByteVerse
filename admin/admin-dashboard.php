
<?php
// Include required files
require_once 'includes/admin-database.php';
require_once 'includes/admin-auth.php';
require_once 'includes/admin-functions.php';

// Initialize database and auth
$database = new AdminDatabase();
$auth = new AdminAuth($database);

// Check if user is logged in
if (!$auth->isLoggedIn()) {
    header("Location: admin-index.php");
    exit;
}

// Database connection
$conn = $database->getConnection();

// Get dashboard stats
try {
    // Total registrations
    $reg_query = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN reg_status = 'pending' THEN 1 ELSE 0 END) as pending,
                    SUM(CASE WHEN reg_status = 'approved' THEN 1 ELSE 0 END) as approved,
                    SUM(CASE WHEN reg_status = 'rejected' THEN 1 ELSE 0 END) as rejected
                  FROM registrations";
    $reg_stmt = $conn->query($reg_query);
    $reg_stats = $reg_stmt->fetch(PDO::FETCH_ASSOC);
    
    // Total sponsors
    $sponsor_query = "SELECT 
                        COUNT(*) as total,
                        SUM(CASE WHEN sponsor_status = 'pending' THEN 1 ELSE 0 END) as pending,
                        SUM(CASE WHEN sponsor_status = 'approved' THEN 1 ELSE 0 END) as approved,
                        SUM(CASE WHEN sponsor_status = 'rejected' THEN 1 ELSE 0 END) as rejected
                      FROM sponsors";
    $sponsor_stmt = $conn->query($sponsor_query);
    $sponsor_stats = $sponsor_stmt->fetch(PDO::FETCH_ASSOC);
    
    // Total admin users
    $users_query = "SELECT COUNT(*) as total FROM admin_users";
    $users_stmt = $conn->query($users_query);
    $users_stats = $users_stmt->fetch(PDO::FETCH_ASSOC);
    
    // Recent registrations
    $recent_reg_query = "SELECT * FROM registrations ORDER BY reg_created DESC LIMIT 5";
    $recent_reg_stmt = $conn->query($recent_reg_query);
    $recent_registrations = $recent_reg_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Recent sponsors
    $recent_sponsor_query = "SELECT * FROM sponsors ORDER BY created_at DESC LIMIT 5";
    $recent_sponsor_stmt = $conn->query($recent_sponsor_query);
    $recent_sponsors = $recent_sponsor_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Recent activity logs
    $logs_query = "SELECT al.*, au.admin_username 
                   FROM admin_logs al
                   LEFT JOIN admin_users au ON al.admin_id = au.admin_id
                   ORDER BY al.log_time DESC LIMIT 10";
    $logs_stmt = $conn->query($logs_query);
    $recent_logs = $logs_stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Handle database error
    $error_message = "Database error: " . $e->getMessage();
}

// Include header
include_once 'components/admin-header.php';
?>

<div class="admin-dashboard">
    <!-- Stats Row -->
    <div class="admin-stats-row">
        <div class="admin-stat-card admin-stat-primary">
            <div class="admin-stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="admin-stat-info">
                <span class="admin-stat-title">Registrations</span>
                <span class="admin-stat-value"><?php echo $reg_stats['total'] ?? 0; ?></span>
                <div class="admin-stat-details">
                    <span class="admin-badge admin-badge-success"><?php echo $reg_stats['approved'] ?? 0; ?> Approved</span>
                    <span class="admin-badge admin-badge-warning"><?php echo $reg_stats['pending'] ?? 0; ?> Pending</span>
                </div>
            </div>
        </div>
        
        <div class="admin-stat-card admin-stat-info">
            <div class="admin-stat-icon">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="admin-stat-info">
                <span class="admin-stat-title">Sponsors</span>
                <span class="admin-stat-value"><?php echo $sponsor_stats['total'] ?? 0; ?></span>
                <div class="admin-stat-details">
                    <span class="admin-badge admin-badge-success"><?php echo $sponsor_stats['approved'] ?? 0; ?> Approved</span>
                    <span class="admin-badge admin-badge-warning"><?php echo $sponsor_stats['pending'] ?? 0; ?> Pending</span>
                </div>
            </div>
        </div>
        
        <div class="admin-stat-card admin-stat-success">
            <div class="admin-stat-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="admin-stat-info">
                <span class="admin-stat-title">Admin Users</span>
                <span class="admin-stat-value"><?php echo $users_stats['total'] ?? 0; ?></span>
                <div class="admin-stat-details">
                    <span class="admin-badge admin-badge-light"><?php echo adminGetRoleName($_SESSION['admin_role']); ?></span>
                </div>
            </div>
        </div>
        
        <div class="admin-stat-card admin-stat-warning">
            <div class="admin-stat-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="admin-stat-info">
                <span class="admin-stat-title">Event Countdown</span>
                <span class="admin-stat-value" id="eventCountdown">Loading...</span>
                <div class="admin-stat-details">
                    <span class="admin-badge admin-badge-light">August 22-23, 2025</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Content Row -->
    <div class="admin-grid-row">
        <!-- Recent registrations -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Recent Registrations</h2>
                <a href="admin-pages/admin-registrations.php" class="admin-button admin-button-sm admin-button-outline-primary">
                    View All
                </a>
            </div>
            <div class="admin-card-body">
                <div class="admin-table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Team</th>
                                <th>Leader</th>
                                <th>Domain</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recent_registrations)): ?>
                            <tr>
                                <td colspan="5" class="admin-text-center">No registrations found</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($recent_registrations as $reg): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reg['team_name']); ?></td>
                                    <td><?php echo htmlspecialchars($reg['team_leader']); ?></td>
                                    <td><?php echo htmlspecialchars($reg['project_domain']); ?></td>
                                    <td><?php echo adminGetStatusBadge($reg['reg_status']); ?></td>
                                    <td><?php echo adminFormatDate($reg['reg_created']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Recent sponsors -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Recent Sponsors</h2>
                <a href="admin-pages/admin-sponsors.php" class="admin-button admin-button-sm admin-button-outline-primary">
                    View All
                </a>
            </div>
            <div class="admin-card-body">
                <div class="admin-table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Contact</th>
                                <th>Tier</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recent_sponsors)): ?>
                            <tr>
                                <td colspan="5" class="admin-text-center">No sponsors found</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($recent_sponsors as $sponsor): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($sponsor['company_name']); ?></td>
                                    <td><?php echo htmlspecialchars($sponsor['contact_name']); ?></td>
                                    <td>
                                        <span class="admin-badge admin-badge-<?php echo $sponsor['sponsor_tier']; ?>">
                                            <?php echo ucfirst($sponsor['sponsor_tier']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo adminGetStatusBadge($sponsor['sponsor_status']); ?></td>
                                    <td><?php echo adminFormatDate($sponsor['created_at']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Activity Log -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Recent Activity</h2>
            <?php if ($auth->hasPermission('super_admin')): ?>
            <a href="admin-pages/admin-logs.php" class="admin-button admin-button-sm admin-button-outline-primary">
                View All Logs
            </a>
            <?php endif; ?>
        </div>
        <div class="admin-card-body">
            <div class="admin-activity-log">
                <?php if (empty($recent_logs)): ?>
                <div class="admin-empty-state">
                    <i class="fas fa-history admin-empty-icon"></i>
                    <p>No activity logs found</p>
                </div>
                <?php else: ?>
                    <?php foreach ($recent_logs as $log): ?>
                    <div class="admin-activity-item">
                        <div class="admin-activity-icon">
                            <?php
                            $icon = 'fas fa-info-circle';
                            switch ($log['log_action']) {
                                case 'login':
                                case 'logout':
                                    $icon = 'fas fa-sign-in-alt';
                                    break;
                                case 'create':
                                    $icon = 'fas fa-plus-circle';
                                    break;
                                case 'update':
                                    $icon = 'fas fa-edit';
                                    break;
                                case 'delete':
                                    $icon = 'fas fa-trash-alt';
                                    break;
                                case 'approve':
                                    $icon = 'fas fa-check-circle';
                                    break;
                                case 'reject':
                                    $icon = 'fas fa-times-circle';
                                    break;
                            }
                            ?>
                            <i class="<?php echo $icon; ?>"></i>
                        </div>
                        <div class="admin-activity-details">
                            <div class="admin-activity-text">
                                <strong><?php echo htmlspecialchars($log['admin_username']); ?></strong>
                                <?php echo htmlspecialchars($log['log_details']); ?>
                                <?php if ($log['entity_id']): ?>
                                <span class="admin-activity-entity">(<?php echo htmlspecialchars($log['log_entity']); ?> #<?php echo $log['entity_id']; ?>)</span>
                                <?php endif; ?>
                            </div>
                            <div class="admin-activity-time">
                                <?php echo adminFormatDate($log['log_time']); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Event countdown
    function updateCountdown() {
        const eventDate = new Date('August 22, 2025 00:00:00').getTime();
        const now = new Date().getTime();
        const distance = eventDate - now;
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        
        if (distance < 0) {
            document.getElementById('eventCountdown').innerHTML = 'Event has started!';
        } else {
            document.getElementById('eventCountdown').innerHTML = `${days}d ${hours}h`;
        }
    }
    
    // Update countdown immediately and then every minute
    updateCountdown();
    setInterval(updateCountdown, 60000);
</script>

<?php
// Include footer
include_once 'components/admin-footer.php';
?>