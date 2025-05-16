<?php
// filepath: c:\xampp\htdocs\byteverse-admin\admin\pages\admin-registrations.php

// Include required files
require_once '../includes/auth-check.php';
require_once '../includes/admin-database.php';
require_once '../includes/admin-functions.php';

// Initialize database connection
$database = new AdminDatabase();
$conn = $database->getConnection();

// Fetch registrations
$reg_query = "SELECT * FROM registrations ORDER BY reg_created DESC";
$reg_stmt = $conn->query($reg_query);
$registrations = $reg_stmt->fetchAll(PDO::FETCH_ASSOC);

// Set page title
$page_title = "Admin Registrations";
include '../components/admin-header.php';
?>

<div class="admin-content">
    <h1 class="admin-page-title">Registered Teams</h1>
    
    <div class="admin-table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Team Leader</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($registrations)): ?>
                    <?php foreach ($registrations as $reg): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reg['team_name']); ?></td>
                            <td><?php echo htmlspecialchars($reg['team_leader']); ?></td>
                            <td><?php echo htmlspecialchars($reg['leader_email']); ?></td>
                            <td>
                                <span class="admin-status <?php echo strtolower($reg['reg_status']); ?>">
                                    <?php echo ucfirst($reg['reg_status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M d, Y', strtotime($reg['reg_created'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No registrations found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../components/admin-footer.php'; ?>