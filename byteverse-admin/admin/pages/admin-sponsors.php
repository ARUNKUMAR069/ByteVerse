<?php
// filepath: c:\xampp\htdocs\byteverse-admin\admin\pages\admin-sponsors.php

// Include required files
require_once '../includes/auth-check.php';
require_once '../includes/admin-database.php';
require_once '../includes/admin-functions.php';

// Initialize database
$database = new AdminDatabase();
$conn = $database->getConnection();

// Get sponsors data
$sponsors_query = "SELECT * FROM sponsors ORDER BY created_at DESC";
$sponsors_stmt = $conn->query($sponsors_query);
$sponsors = $sponsors_stmt->fetchAll(PDO::FETCH_ASSOC);

// Set page title
$page_title = "Sponsors";
include '../components/admin-header.php';
?>

<div class="admin-content">
    <h1 class="admin-page-title">Sponsors</h1>
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">List of Sponsors</h2>
            <a href="admin-add-sponsor.php" class="admin-btn admin-btn-primary">Add New Sponsor</a>
        </div>
        <div class="admin-card-body">
            <?php if (!empty($sponsors)): ?>
            <div class="admin-table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($sponsors as $sponsor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($sponsor['company_name']); ?></td>
                            <td><?php echo htmlspecialchars($sponsor['contact_person']); ?></td>
                            <td><?php echo htmlspecialchars($sponsor['email']); ?></td>
                            <td>
                                <span class="admin-status <?php echo strtolower($sponsor['status']); ?>">
                                    <?php echo ucfirst($sponsor['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="admin-edit-sponsor.php?id=<?php echo $sponsor['id']; ?>" class="admin-btn admin-btn-sm admin-btn-outline">Edit</a>
                                <a href="admin-delete-sponsor.php?id=<?php echo $sponsor['id']; ?>" class="admin-btn admin-btn-sm admin-btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="admin-empty-state">
                <h3>No sponsors found</h3>
                <p>There are currently no sponsors registered. Please add some sponsors.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../components/admin-footer.php'; ?>