<?php
// filepath: c:\xampp\htdocs\byteverse-admin\admin\pages\admin-logs.php

// Include required files
require_once '../includes/auth-check.php';
require_once '../includes/admin-database.php';
require_once '../includes/admin-functions.php';

// Initialize database
$database = new AdminDatabase();
$conn = $database->getConnection();

// Check if user is logged in
if (!$auth->isLoggedIn()) {
    header("Location: admin-index.php");
    exit;
}

// Fetch logs from the database
try {
    $log_query = "SELECT * FROM admin_logs ORDER BY log_time DESC";
    $log_stmt = $conn->query($log_query);
    $logs = $log_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}

// Set page title
$page_title = "Admin Logs";
include '../components/admin-header.php';
?>

<div class="admin-content">
    <h1 class="admin-title">Admin Activity Logs</h1>
    <div class="admin-card">
        <div class="admin-card-body">
            <?php if (!empty($logs)): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Entity</th>
                        <th>Admin</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($logs as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($log['log_action']); ?></td>
                        <td><?php echo htmlspecialchars($log['log_entity']); ?></td>
                        <td><?php echo htmlspecialchars($log['admin_username']); ?></td>
                        <td><?php echo date('M d, Y h:i A', strtotime($log['log_time'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="admin-empty-state">
                <h3>No logs available</h3>
                <p>Admin activities will appear here once logged.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../components/admin-footer.php'; ?>