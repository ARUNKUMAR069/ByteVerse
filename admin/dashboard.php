<?php
require_once 'includes/header.php';

// Get stats for dashboard
$stats = [];

// Total users
$sql_users = "SELECT COUNT(*) as total FROM registrations";
$result_users = $conn->query($sql_users);
$stats['users'] = ($result_users && $result_users->num_rows > 0) ? $result_users->fetch_assoc()['total'] : 0;

// Total teams - Modified query to count distinct team names instead of team_id
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

// Check if admin_users table exists
$admin_table_exists = false;
$check_table = $conn->query("SHOW TABLES LIKE 'admin_users'");
if ($check_table && $check_table->num_rows > 0) {
    $admin_table_exists = true;
}

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

// Get team distribution by challenge track
$track_data = [];
$track_labels = [];
$track_colors = [
    'ai_ml' => 'rgba(255, 99, 132, 0.8)',
    'blockchain' => 'rgba(54, 162, 235, 0.8)',
    'ar_vr' => 'rgba(255, 206, 86, 0.8)',
    'iot' => 'rgba(75, 192, 192, 0.8)',
    'open_innovation' => 'rgba(153, 102, 255, 0.8)'
];

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

// Recent registrations
$sql_recent = "SELECT * FROM registrations ORDER BY created_at DESC LIMIT 5";
$recent_registrations = $conn->query($sql_recent);

// Recent messages
$sql_recent_messages = "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5";
$recent_messages = $conn->query($sql_recent_messages);

// Recent activities - Modified to work whether admin_users table exists or not
if ($admin_table_exists) {
    $sql_activities = "SELECT a.*, u.admin_username 
                      FROM activity_logs a
                      LEFT JOIN admin_users u ON a.user_id = u.admin_id
                      ORDER BY a.created_at DESC LIMIT 10";
} else {
    $sql_activities = "SELECT a.* FROM activity_logs a ORDER BY a.created_at DESC LIMIT 10";
}

$recent_activities = $conn->query($sql_activities);

// Calculate percentage change for stats
function calculatePercentChange($current, $previous) {
    if ($previous == 0) {
        return $current > 0 ? 100 : 0;
    }
    return round((($current - $previous) / $previous) * 100);
}

// Get data for previous period to calculate trends
$prev_month = date('m', strtotime('-1 month'));
$prev_year = date('Y', strtotime('-1 month'));
$start_date = "$prev_year-$prev_month-01";
$end_date = date('Y-m-t', strtotime($start_date));

// Previous period registrations
$sql_prev_users = "SELECT COUNT(*) as total FROM registrations WHERE created_at < '$start_date'";
$result_prev_users = $conn->query($sql_prev_users);
$prev_users = ($result_prev_users && $result_prev_users->num_rows > 0) ? $result_prev_users->fetch_assoc()['total'] : 0;

// Previous period teams
$sql_prev_teams = "SELECT COUNT(DISTINCT team_name) as total FROM registrations WHERE created_at < '$start_date'";
$result_prev_teams = $conn->query($sql_prev_teams);
$prev_teams = ($result_prev_teams && $result_prev_teams->num_rows > 0) ? $result_prev_teams->fetch_assoc()['total'] : 0;

// Previous period sponsors
$sql_prev_sponsors = "SELECT COUNT(*) as total FROM sponsors WHERE created_at < '$start_date'";
$result_prev_sponsors = $conn->query($sql_prev_sponsors);
$prev_sponsors = ($result_prev_sponsors && $result_prev_sponsors->num_rows > 0) ? $result_prev_sponsors->fetch_assoc()['total'] : 0;

// Calculate percentage changes
$user_change = calculatePercentChange($stats['users'], $prev_users);
$team_change = calculatePercentChange($stats['teams'], $prev_teams);
$sponsor_change = calculatePercentChange($stats['sponsors'], $prev_sponsors);
?>

<div class="dashboard">
    <!-- Stats Cards Row -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon users">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['users']); ?></h3>
                <p>Registered Users</p>
            </div>
            <div class="stat-chart">
                <?php if ($user_change > 0): ?>
                    <span class="trend-up">
                        <i class="fas fa-arrow-up"></i> <?php echo abs($user_change); ?>%
                    </span>
                <?php elseif ($user_change < 0): ?>
                    <span class="trend-down">
                        <i class="fas fa-arrow-down"></i> <?php echo abs($user_change); ?>%
                    </span>
                <?php else: ?>
                    <span class="trend-neutral">
                        <i class="fas fa-minus"></i> 0%
                    </span>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon teams">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['teams']); ?></h3>
                <p>Teams</p>
            </div>
            <div class="stat-chart">
                <?php if ($team_change > 0): ?>
                    <span class="trend-up">
                        <i class="fas fa-arrow-up"></i> <?php echo abs($team_change); ?>%
                    </span>
                <?php elseif ($team_change < 0): ?>
                    <span class="trend-down">
                        <i class="fas fa-arrow-down"></i> <?php echo abs($team_change); ?>%
                    </span>
                <?php else: ?>
                    <span class="trend-neutral">
                        <i class="fas fa-minus"></i> 0%
                    </span>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon sponsors">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['sponsors']); ?></h3>
                <p>Sponsors</p>
            </div>
            <div class="stat-chart">
                <?php if ($sponsor_change > 0): ?>
                    <span class="trend-up">
                        <i class="fas fa-arrow-up"></i> <?php echo abs($sponsor_change); ?>%
                    </span>
                <?php elseif ($sponsor_change < 0): ?>
                    <span class="trend-down">
                        <i class="fas fa-arrow-down"></i> <?php echo abs($sponsor_change); ?>%
                    </span>
                <?php else: ?>
                    <span class="trend-neutral">
                        <i class="fas fa-minus"></i> 0%
                    </span>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon messages">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo number_format($stats['messages']); ?></h3>
                <p>Unread Messages</p>
            </div>
            <div class="stat-chart">
                <span class="trend-neutral">
                    <i class="fas fa-bell"></i>
                </span>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="charts-row">
        <div class="chart-card">
            <div class="card-header">
                <h3>Registration Trends</h3>
                <div class="card-actions">
                    <button class="btn-icon" title="Refresh" id="refresh-reg-chart">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button class="btn-icon" title="More Options">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="registrationsChart"></canvas>
            </div>
        </div>
        
        <div class="chart-card">
            <div class="card-header">
                <h3>Team Distribution</h3>
                <div class="card-actions">
                    <button class="btn-icon" title="Refresh" id="refresh-team-chart">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button class="btn-icon" title="More Options">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="teamsChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Data Tables Row -->
    <div class="tables-row">
        <div class="table-card">
            <div class="card-header">
                <h3>Recent Registrations</h3>
                <a href="registrations.php" class="btn btn-link">View All</a>
            </div>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Team</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($recent_registrations && $recent_registrations->num_rows > 0): ?>
                            <?php while($row = $recent_registrations->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['team_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <span class="status-badge <?php echo $row['status'] === 'active' ? 'status-success' : 'status-pending'; ?>">
                                            <?php echo ucfirst($row['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="table-empty">No registration data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="table-card">
            <div class="card-header">
                <h3>Recent Activities</h3>
                <a href="activity-logs.php" class="btn btn-link">View All</a>
            </div>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Activity</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($recent_activities && $recent_activities->num_rows > 0): ?>
                            <?php while($row = $recent_activities->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <?php 
                                        if ($admin_table_exists && isset($row['admin_username'])) {
                                            echo htmlspecialchars($row['admin_username']);
                                        } else {
                                            echo "Admin #" . $row['user_id'];
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><?php echo date('M d, H:i', strtotime($row['created_at'])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="table-empty">No activity data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Messages Row -->
    <div class="messages-row">
        <div class="card-header">
            <h3>Recent Messages</h3>
            <a href="contact.php" class="btn btn-link">View All</a>
        </div>
        <div class="messages-container">
            <?php if ($recent_messages && $recent_messages->num_rows > 0): ?>
                <?php while($row = $recent_messages->fetch_assoc()): ?>
                    <div class="message-card <?php echo $row['is_read'] ? '' : 'unread'; ?>">
                        <div class="message-header">
                            <div class="sender-info">
                                <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                                <span class="message-date"><?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?></span>
                            </div>
                            <div class="message-status">
                                <?php if (!$row['is_read']): ?>
                                    <span class="status-badge status-new">New</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="message-content">
                            <p><?php echo nl2br(htmlspecialchars(substr($row['message'], 0, 150))); ?><?php echo strlen($row['message']) > 150 ? '...' : ''; ?></p>
                        </div>
                        <div class="message-footer">
                            <a href="contact.php?view=<?php echo $row['message_id']; ?>" class="btn btn-link">Read More</a>
                            <a href="mailto:<?php echo $row['email']; ?>" class="btn btn-link">Reply</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-messages">
                    <i class="fas fa-envelope-open"></i>
                    <p>No messages yet</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Registration chart with real data
const registrationsCtx = document.getElementById('registrationsChart').getContext('2d');
const registrationsChart = new Chart(registrationsCtx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($month_labels); ?>,
        datasets: [{
            label: 'Registrations',
            data: <?php echo json_encode($monthly_data); ?>,
            backgroundColor: 'rgba(0, 215, 254, 0.2)',
            borderColor: 'rgba(0, 215, 254, 1)',
            borderWidth: 2,
            tension: 0.4,
            pointBackgroundColor: 'rgba(0, 215, 254, 1)',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(255, 255, 255, 0.05)',
                },
                ticks: {
                    color: 'rgba(255, 255, 255, 0.7)'
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: 'rgba(255, 255, 255, 0.7)'
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Teams chart with real data
const teamsCtx = document.getElementById('teamsChart').getContext('2d');
const teamsChart = new Chart(teamsCtx, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($track_labels); ?>,
        datasets: [{
            data: <?php echo json_encode($track_data); ?>,
            backgroundColor: <?php echo json_encode(array_values($track_colors)); ?>,
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: 'rgba(255, 255, 255, 0.7)',
                    font: {
                        size: 12
                    },
                    padding: 15
                }
            }
        },
        cutout: '70%'
    }
});

// Refresh charts when button is clicked
document.getElementById('refresh-reg-chart').addEventListener('click', function() {
    this.querySelector('i').classList.add('fa-spin');
    fetch('api/dashboard-data.php?type=registrations')
        .then(response => response.json())
        .then(data => {
            registrationsChart.data.labels = data.labels;
            registrationsChart.data.datasets[0].data = data.values;
            registrationsChart.update();
            this.querySelector('i').classList.remove('fa-spin');
        })
        .catch(error => {
            console.error('Error fetching registration data:', error);
            this.querySelector('i').classList.remove('fa-spin');
        });
});

document.getElementById('refresh-team-chart').addEventListener('click', function() {
    this.querySelector('i').classList.add('fa-spin');
    fetch('api/dashboard-data.php?type=teams')
        .then(response => response.json())
        .then(data => {
            teamsChart.data.labels = data.labels;
            teamsChart.data.datasets[0].data = data.values;
            teamsChart.update();
            this.querySelector('i').classList.remove('fa-spin');
        })
        .catch(error => {
            console.error('Error fetching team data:', error);
            this.querySelector('i').classList.remove('fa-spin');
        });
});
</script>

<?php require_once 'includes/footer.php'; ?>
