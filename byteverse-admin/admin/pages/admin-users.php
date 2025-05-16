<?php
// filepath: c:\xampp\htdocs\byteverse-admin\admin\pages\admin-users.php

// Include required files
require_once '../includes/auth-check.php';
require_once '../includes/admin-database.php';
require_once '../includes/admin-functions.php';

// Initialize database connection
$database = new AdminDatabase();
$conn = $database->getConnection();

// Fetch users from the database
try {
    $query = "SELECT * FROM admin_users ORDER BY admin_id DESC";
    $stmt = $conn->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}

// Set page title
$page_title = "Admin Users";
include '../components/admin-header.php';
?>

<div class="admin-content">
    <h1 class="admin-page-title">Admin Users</h1>
    
    <?php if (isset($error)): ?>
        <div class="admin-error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="admin-table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['admin_id']); ?></td>
                            <td><?php echo htmlspecialchars($user['admin_username']); ?></td>
                            <td><?php echo htmlspecialchars($user['admin_email']); ?></td>
                            <td><?php echo htmlspecialchars($user['admin_status']); ?></td>
                            <td>
                                <a href="admin-edit-user.php?id=<?php echo $user['admin_id']; ?>" class="admin-btn admin-btn-sm">Edit</a>
                                <a href="admin-delete-user.php?id=<?php echo $user['admin_id']; ?>" class="admin-btn admin-btn-sm admin-btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../components/admin-footer.php'; ?>