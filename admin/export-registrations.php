<?php
// Start session and include database connection
session_start();
require_once 'includes/db-config.php';

// Check if user is logged in
check_admin_login();

// Get filter parameters
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$search_term = isset($_GET['search']) ? trim($_GET['search']) : '';

// Build query based on filters
$where_clause = '';

if ($filter === 'pending') {
    $where_clause = "WHERE status = 'pending'";
} elseif ($filter === 'active') {
    $where_clause = "WHERE status = 'active'";
} elseif ($filter === 'rejected') {
    $where_clause = "WHERE status = 'rejected'";
}

// Add search term to query if provided
if (!empty($search_term)) {
    $search_clause = "WHERE (name LIKE '%".mysqli_real_escape_string($conn, $search_term)."%' 
                     OR email LIKE '%".mysqli_real_escape_string($conn, $search_term)."%'
                     OR team_name LIKE '%".mysqli_real_escape_string($conn, $search_term)."%')";
    $where_clause = empty($where_clause) ? $search_clause : $where_clause . " AND " . substr($search_clause, 6);
}

// Query to get registrations
$sql = "SELECT id, team_name, name, email, phone, team_size, challenge_track, 
        project_title, institution, payment_status, status, created_at 
        FROM registrations $where_clause ORDER BY created_at DESC";

$result = $conn->query($sql);

// Set headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=byteverse_registrations_'.date('Y-m-d').'.csv');

// Create output stream
$output = fopen('php://output', 'w');

// Add UTF-8 BOM to fix special characters in Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Add header row
fputcsv($output, [
    'ID', 
    'Team Name', 
    'Team Lead', 
    'Email', 
    'Phone', 
    'Team Size', 
    'Challenge Track', 
    'Project Title', 
    'Institution',
    'Payment Status',
    'Registration Status',
    'Registered On'
]);

// Add data rows
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Format challenge track for readability
        $track = $row['challenge_track'];
        $track_names = [
            'ai_ml' => 'AI/ML Solutions',
            'blockchain' => 'Blockchain Innovation',
            'ar_vr' => 'AR/VR Experiences',
            'iot' => 'IoT & Hardware',
            'open_innovation' => 'Open Innovation'
        ];
        $formatted_track = isset($track_names[$track]) ? $track_names[$track] : ucfirst(str_replace('_', ' ', $track));
        
        // Format date
        $registration_date = date('Y-m-d H:i:s', strtotime($row['created_at']));
        
        // Write row to CSV
        fputcsv($output, [
            $row['id'],
            $row['team_name'],
            $row['name'],
            $row['email'],
            $row['phone'],
            $row['team_size'],
            $formatted_track,
            $row['project_title'],
            $row['institution'],
            ucfirst($row['payment_status']),
            ucfirst($row['status']),
            $registration_date
        ]);
    }
}

// Log activity
$activity_sql = "INSERT INTO activity_logs (user_id, activity_type, description, ip_address) 
               VALUES (?, 'export', 'Exported registrations to CSV', ?)";
$activity_stmt = $conn->prepare($activity_sql);
$ip = $_SERVER['REMOTE_ADDR'];
$activity_stmt->bind_param("is", $_SESSION['admin_id'], $ip);
$activity_stmt->execute();

// Close the connection
$conn->close();
?>
