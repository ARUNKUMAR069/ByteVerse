<?php
// filepath: c:\xampp\htdocs\new2\admin\admin-dashboard.php

// Include required files
require_once 'includes/auth-check.php';
require_once 'includes/admin-database.php';
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
    
    // Recent activity
    $activity_query = "SELECT a.*, u.admin_username 
                      FROM admin_logs a 
                      LEFT JOIN admin_users u ON a.admin_id = u.admin_id
                      ORDER BY a.log_time DESC LIMIT 10";
    $activity_stmt = $conn->query($activity_query);
    $activities = $activity_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Recent registrations
    $recent_reg_query = "SELECT * FROM registrations ORDER BY reg_created DESC LIMIT 5";
    $recent_reg_stmt = $conn->query($recent_reg_query);
    $recent_registrations = $recent_reg_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Recent sponsors
    $recent_sponsor_query = "SELECT * FROM sponsors ORDER BY created_at DESC LIMIT 5";
    $recent_sponsor_stmt = $conn->query($recent_sponsor_query);
    $recent_sponsors = $recent_sponsor_stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}

// Set page title
$page_title = "Admin Dashboard";
include 'components/admin-header.php';
?>

<div class="admin-content">
    <!-- Welcome message -->
    <div class="admin-welcome">
        <div class="admin-welcome-content">
            <h1 class="admin-welcome-title">Welcome, <?php echo htmlspecialchars($_SESSION['admin_fullname'] ?? $_SESSION['admin_username']); ?>!</h1>
            <p class="admin-welcome-text">Here's what's happening with ByteVerse Hackathon today.</p>
        </div>
        <div class="admin-welcome-actions">
            <a href="pages/admin-settings.php" class="admin-btn admin-btn-outline">
                <i class="fas fa-cog"></i> Settings
            </a>
        </div>
    </div>
    
    <!-- Stats Row -->
    <div class="admin-stats-row">
        <!-- Registrations Stats -->
        <div class="admin-stats-card">
            <div class="admin-stats-icon registration-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="admin-stats-content">
                <div class="admin-stats-title">Total Registrations</div>
                <div class="admin-stats-value"><?php echo number_format($reg_stats['total'] ?? 0); ?></div>
                <div class="admin-stats-info">
                    <span class="admin-status pending"><?php echo $reg_stats['pending'] ?? 0; ?> pending</span>
                    <span class="admin-status active"><?php echo $reg_stats['approved'] ?? 0; ?> approved</span>
                </div>
            </div>
        </div>
        
        <!-- Sponsors Stats -->
        <div class="admin-stats-card">
            <div class="admin-stats-icon sponsor-icon">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="admin-stats-content">
                <div class="admin-stats-title">Total Sponsors</div>
                <div class="admin-stats-value"><?php echo number_format($sponsor_stats['total'] ?? 0); ?></div>
                <div class="admin-stats-info">
                    <span class="admin-status pending"><?php echo $sponsor_stats['pending'] ?? 0; ?> pending</span>
                    <span class="admin-status active"><?php echo $sponsor_stats['approved'] ?? 0; ?> approved</span>
                </div>
            </div>
        </div>
        
        <!-- Users Online Stats -->
        <div class="admin-stats-card">
            <div class="admin-stats-icon users-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="admin-stats-content">
                <div class="admin-stats-title">Admin Users</div>
                <div class="admin-stats-value">
                    <?php 
                    $admin_count_query = "SELECT COUNT(*) FROM admin_users WHERE admin_status = 'active'";
                    $admin_count = $conn->query($admin_count_query)->fetchColumn();
                    echo number_format($admin_count);
                    ?>
                </div>
                <div class="admin-stats-info">
                    <span class="admin-status active">Active System</span>
                </div>
            </div>
        </div>
        
        <!-- System Status -->
        <div class="admin-stats-card">
            <div class="admin-stats-icon system-icon">
                <i class="fas fa-server"></i>
            </div>
            <div class="admin-stats-content">
                <div class="admin-stats-title">System Status</div>
                <div class="admin-stats-value">
                    <?php
                    $reg_open_query = "SELECT setting_value FROM admin_settings WHERE setting_key = 'registration_open'";
                    $reg_open = $conn->query($reg_open_query)->fetchColumn() ?: 'yes';
                    echo $reg_open === 'yes' ? 'Open' : 'Closed';
                    ?>
                </div>
                <div class="admin-stats-info">
                    <span class="admin-status <?php echo $reg_open === 'yes' ? 'active' : 'inactive'; ?>">
                        Registrations <?php echo $reg_open === 'yes' ? 'Open' : 'Closed'; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content Grid -->
    <div class="admin-grid-row">
        <!-- Recent Registrations -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Recent Registrations</h2>
                <a href="pages/admin-registrations.php" class="admin-btn admin-btn-sm admin-btn-outline-primary">
                    View All
                </a>
            </div>
            <div class="admin-card-body">
                <?php if (!empty($recent_registrations)): ?>
                <div class="admin-table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Team</th>
                                <th>Leader</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recent_registrations as $reg): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($reg['team_name']); ?></td>
                                <td>
                                    <?php echo htmlspecialchars($reg['team_leader']); ?>
                                    <div class="admin-table-meta"><?php echo htmlspecialchars($reg['leader_email']); ?></div>
                                </td>
                                <td>
                                    <span class="admin-status <?php echo strtolower($reg['reg_status']); ?>">
                                        <?php echo ucfirst($reg['reg_status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($reg['reg_created'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="admin-empty-state">
                    <div class="admin-empty-state-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>No registrations yet</h3>
                    <p>Teams will appear here once they register for the hackathon.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Recent Sponsors -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Recent Sponsors</h2>
                <a href="pages/admin-sponsors.php" class="admin-btn admin-btn-sm admin-btn-outline-primary">
                    View All
                </a>
            </div>
            <div class="admin-card-body">
                <?php if (!empty($recent_sponsors)): ?>
                <div class="admin-table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recent_sponsors as $sponsor): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($sponsor['company_name']); ?></td>
                                <td>
                                    <?php echo htmlspecialchars($sponsor['contact_name']); ?>
                                    <div class="admin-table-meta"><?php echo htmlspecialchars($sponsor['contact_email']); ?></div>
                                </td>
                                <td>
                                    <span class="admin-status <?php echo strtolower($sponsor['sponsor_status']); ?>">
                                        <?php echo ucfirst($sponsor['sponsor_status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($sponsor['created_at'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="admin-empty-state">
                    <div class="admin-empty-state-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>No sponsors yet</h3>
                    <p>Sponsor inquiries will appear here when companies reach out to support the event.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Recent Activity</h2>
            <a href="pages/admin-logs.php" class="admin-btn admin-btn-sm admin-btn-outline-primary">
                View All Logs
            </a>
        </div>
        <div class="admin-card-body">
            <?php if (!empty($activities)): ?>
            <div class="admin-activity-log">
                <?php foreach($activities as $activity): ?>
                <div class="admin-activity-item">
                    <div class="admin-activity-icon">
                        <?php
                        $icon = 'info-circle';
                        switch($activity['log_action']) {
                            case 'create': $icon = 'plus-circle'; break;
                            case 'update': $icon = 'edit'; break;
                            case 'delete': $icon = 'trash-alt'; break;
                            case 'login': $icon = 'sign-in-alt'; break;
                            case 'logout': $icon = 'sign-out-alt'; break;
                            case 'approve': $icon = 'check-circle'; break;
                            case 'reject': $icon = 'times-circle'; break;
                        }
                        ?>
                        <i class="fas fa-<?php echo $icon; ?>"></i>
                    </div>
                    <div class="admin-activity-details">
                        <div class="admin-activity-text">
                            <strong><?php echo htmlspecialchars($activity['admin_username']); ?></strong>
                            <?php echo $activity['log_action']; ?>d 
                            <?php echo $activity['log_entity']; ?>
                            <?php if ($activity['entity_id']): ?>
                            <span class="admin-activity-entity">#<?php echo $activity['entity_id']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="admin-activity-time">
                            <?php echo date('M d, Y h:i A', strtotime($activity['log_time'])); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="admin-empty-state">
                <div class="admin-empty-state-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3>No activity yet</h3>
                <p>Admin activities will be logged and displayed here.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'components/admin-footer.php'; ?>