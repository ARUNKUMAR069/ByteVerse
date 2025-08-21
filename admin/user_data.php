<?php
$current_page = 'user_data';
require_once 'includes/header.php';
require_once(__DIR__ . '/../backend/includes/db.php');

$conn = getDbConnection();
if (!$conn) {
    die("Database connection failed.");
}

$stmt = $conn->prepare("SELECT * FROM registrations ORDER BY created_at DESC");
$stmt->execute();
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="content">
    <h1>All User Registrations</h1>
    <div class="table-responsive">
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Team Name</th>
                    <th>Team Size</th>
                    <th>Institution</th>
                    <th>Challenge Track</th>
                    <th>Leader Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Project Title</th>
                    <th>Project Description</th>
                    <th>Technologies</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['team_name']) ?></td>
                    <td><?= htmlspecialchars($row['team_size']) ?></td>
                    <td><?= htmlspecialchars($row['institution']) ?></td>
                    <td><?= htmlspecialchars($row['challenge_track']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['role']) ?></td>
                    <td><?= htmlspecialchars($row['project_title']) ?></td>
                    <td><?= htmlspecialchars($row['project_description']) ?></td>
                    <td><?= htmlspecialchars($row['technologies']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['payment_status']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>