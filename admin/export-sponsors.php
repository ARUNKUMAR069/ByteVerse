<?php
// Start output buffering
ob_start();
require_once 'includes/header.php';

// Check if user has permission
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Process export request
if (isset($_POST['export'])) {
    $format = $_POST['format'] ?? 'csv';
    $status = $_POST['status'] ?? 'all';
    
    // Build query based on filters
    $sql = "SELECT * FROM sponsors";
    $params = [];
    $types = "";
    
    if ($status !== 'all') {
        $sql .= " WHERE status = ?";
        $params[] = $status;
        $types .= "s";
    }
    
    $sql .= " ORDER BY created_at DESC";
    
    // Prepare and execute query
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $sponsors = [];
        while ($row = $result->fetch_assoc()) {
            $sponsors[] = $row;
        }
        
        // Generate export file
        if ($format === 'csv') {
            // Set headers for CSV download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="sponsors_export_' . date('Y-m-d') . '.csv"');
            
            // Create output stream
            $output = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($output, ['ID', 'Company Name', 'Contact Name', 'Email', 'Phone', 'Tier', 'Website', 'Status', 'Created At']);
            
            // Add data
            foreach ($sponsors as $sponsor) {
                fputcsv($output, [
                    $sponsor['sponsor_id'],
                    $sponsor['company_name'],
                    $sponsor['contact_name'],
                    $sponsor['contact_email'],
                    $sponsor['contact_phone'],
                    $sponsor['tier'],
                    $sponsor['website'],
                    $sponsor['status'],
                    $sponsor['created_at']
                ]);
            }
            
            fclose($output);
            exit;
        } elseif ($format === 'json') {
            // Set headers for JSON download
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="sponsors_export_' . date('Y-m-d') . '.json"');
            
            echo json_encode($sponsors, JSON_PRETTY_PRINT);
            exit;
        } elseif ($format === 'excel') {
            // For Excel format, you would typically use a library like PhpSpreadsheet
            // This is a simplified version that outputs an HTML table that Excel can open
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="sponsors_export_' . date('Y-m-d') . '.xls"');
            
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>Company Name</th><th>Contact Name</th><th>Email</th><th>Phone</th><th>Tier</th><th>Website</th><th>Status</th><th>Created At</th></tr>';
            
            foreach ($sponsors as $sponsor) {
                echo '<tr>';
                echo '<td>' . $sponsor['sponsor_id'] . '</td>';
                echo '<td>' . htmlspecialchars($sponsor['company_name']) . '</td>';
                echo '<td>' . htmlspecialchars($sponsor['contact_name']) . '</td>';
                echo '<td>' . htmlspecialchars($sponsor['contact_email']) . '</td>';
                echo '<td>' . htmlspecialchars($sponsor['contact_phone']) . '</td>';
                echo '<td>' . htmlspecialchars($sponsor['tier']) . '</td>';
                echo '<td>' . htmlspecialchars($sponsor['website']) . '</td>';
                echo '<td>' . htmlspecialchars($sponsor['status']) . '</td>';
                echo '<td>' . $sponsor['created_at'] . '</td>';
                echo '</tr>';
            }
            
            echo '</table>';
            exit;
        }
    } else {
        $export_error = "No sponsors found matching your criteria.";
    }
}

// Log the activity
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $activity_description = "Accessed sponsors export page";
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
                    VALUES (?, 'export', ?, ?)";
    $activity_stmt = $conn->prepare($activity_sql);
    $activity_stmt->bind_param("iss", $admin_id, $activity_description, $ip);
    $activity_stmt->execute();
}
?>

<div class="content">
    <div class="card-header">
        <h2><i class="fas fa-file-export"></i> Export Sponsors Data</h2>
    </div>
    
    <div class="content-card">
        <?php if (isset($export_error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <p><?php echo htmlspecialchars($export_error); ?></p>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="card-description">
            <p>Use the form below to export sponsor data in your preferred format. You can filter the data by status.</p>
        </div>
        
        <form method="post" class="form-card">
            <div class="form-section">
                <h3 class="section-title">Export Options</h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="format" class="input-label">Export Format</label>
                        <select class="cyber-input" id="format" name="format">
                            <option value="csv">CSV (Comma Separated Values)</option>
                            <option value="excel">Excel (.xls)</option>
                            <option value="json">JSON</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="status" class="input-label">Filter by Status</label>
                        <select class="cyber-input" id="status" name="status">
                            <option value="all">All Sponsors</option>
                            <option value="active">Active Only</option>
                            <option value="pending">Pending Only</option>
                            <option value="inactive">Inactive Only</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <a href="sponsors.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Sponsors
                </a>
                <button type="submit" name="export" class="btn btn-primary">
                    <i class="fas fa-download"></i> Export Data
                </button>
            </div>
        </form>
        
        <div class="form-help-card mt-6">
            <h4><i class="fas fa-info-circle"></i> About Data Export</h4>
            <ul class="help-list">
                <li>CSV files can be opened in Excel, Google Sheets, or any text editor.</li>
                <li>Excel format provides a simple spreadsheet that opens directly in Microsoft Excel.</li>
                <li>JSON format is useful for developers or for importing to other systems.</li>
                <li>Exports will include all sponsor data fields except for sensitive information.</li>
                <li>For large data sets, the export may take a few moments to generate.</li>
            </ul>
        </div>
    </div>
</div>

<?php 
require_once 'includes/footer.php';
ob_end_flush();
?>
