<?php
// API endpoint to fetch dynamic dashboard data
require_once '../includes/db-config.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

// Get request type
$type = isset($_GET['type']) ? $_GET['type'] : '';
$response = [];

if ($type === 'registrations') {
    // Get monthly registration data for trend chart
    $monthly_data = [];
    $month_labels = [];
    $current_year = date('Y');

    // Get registration data for the past 7 months
    for ($i = 6; $i >= 0; $i--) {
        $month = date('m', strtotime("-$i months"));
        $month_name = date('M', strtotime("-$i months"));
        $year = date('Y', strtotime("-$i months"));
        
        $start_date = "$year-$month-01";
        $end_date = date('Y-m-t', strtotime($start_date));
        
        $sql = "SELECT COUNT(*) as count FROM registrations 
                WHERE created_at BETWEEN '$start_date' AND '$end_date 23:59:59'";
        $result = $conn->query($sql);
        $count = 0;
        
        if ($result && $result->num_rows > 0) {
            $count = $result->fetch_assoc()['count'];
        }
        
        $monthly_data[] = $count;
        $month_labels[] = $month_name;
    }
    
    $response = [
        'labels' => $month_labels,
        'values' => $monthly_data
    ];
} elseif ($type === 'teams') {
    // Get team distribution by challenge track
    $track_data = [];
    $track_labels = [];
    
    $track_sql = "SELECT challenge_track, COUNT(*) as count FROM registrations GROUP BY challenge_track";
    $track_result = $conn->query($track_sql);

    if ($track_result && $track_result->num_rows > 0) {
        while ($row = $track_result->fetch_assoc()) {
            $track = $row['challenge_track'];
            $count = $row['count'];
            
            // Map database values to display labels
            $track_display = [
                'ai_ml' => 'AI/ML',
                'blockchain' => 'Blockchain',
                'ar_vr' => 'AR/VR',
                'iot' => 'IoT',
                'open_innovation' => 'Open Innovation'
            ];
            
            $track_labels[] = $track_display[$track] ?? ucfirst($track);
            $track_data[] = $count;
        }
    }
    
    $response = [
        'labels' => $track_labels,
        'values' => $track_data
    ];
} elseif ($type === 'stats') {
    // Get current stats
    $stats = [];
    
    // Total users
    $sql_users = "SELECT COUNT(*) as total FROM registrations";
    $result_users = $conn->query($sql_users);
    $stats['users'] = ($result_users && $result_users->num_rows > 0) ? $result_users->fetch_assoc()['total'] : 0;

    // Total teams
    $sql_teams = "SELECT COUNT(DISTINCT team_name) as total FROM registrations";
    $result_teams = $conn->query($sql_teams);
    $stats['teams'] = ($result_teams && $result_teams->num_rows > 0) ? $result_teams->fetch_assoc()['total'] : 0;

    // Total sponsors
    $sql_sponsors = "SELECT COUNT(*) as total FROM sponsors";
    $result_sponsors = $conn->query($sql_sponsors);
    $stats['sponsors'] = ($result_sponsors && $result_sponsors->num_rows > 0) ? $result_sponsors->fetch_assoc()['total'] : 0;

    // Unread messages
    $sql_messages = "SELECT COUNT(*) as total FROM contact_messages WHERE is_read = 0";
    $result_messages = $conn->query($sql_messages);
    $stats['messages'] = ($result_messages && $result_messages->num_rows > 0) ? $result_messages->fetch_assoc()['total'] : 0;
    
    $response = $stats;
} else {
    $response = ['error' => 'Invalid data type requested'];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
