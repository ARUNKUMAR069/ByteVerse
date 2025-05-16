<?php
// Start output buffering at the very beginning of the file
ob_start();

// Include database connection
require_once 'db-config.php';

// Check login status before starting session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check login status
if (!isset($_SESSION['admin_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    // Redirect to login page
    header('Location: login.php');
    exit;
}

// Get current page for active menu highlighting
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Get admin user info if logged in
$admin_user = null;
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE admin_id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $admin_user = $result->fetch_assoc();
    }
}

// Get notifications
$notifications = [];
$unread_count = 0;

// Get unread messages count
$unread_messages_sql = "SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0";
$unread_messages_result = $conn->query($unread_messages_sql);
if ($unread_messages_result && $unread_messages_result->num_rows > 0) {
    $unread_messages = $unread_messages_result->fetch_assoc()['count'];
    if ($unread_messages > 0) {
        $notifications[] = [
            'type' => 'message',
            'count' => $unread_messages,
            'text' => "$unread_messages unread " . ($unread_messages == 1 ? "message" : "messages")
        ];
        $unread_count += $unread_messages;
    }
}

// Get pending registrations
$pending_reg_sql = "SELECT COUNT(*) as count FROM registrations WHERE status = 'pending'";
$pending_reg_result = $conn->query($pending_reg_sql);
if ($pending_reg_result && $pending_reg_result->num_rows > 0) {
    $pending_reg = $pending_reg_result->fetch_assoc()['count'];
    if ($pending_reg > 0) {
        $notifications[] = [
            'type' => 'registration',
            'count' => $pending_reg,
            'text' => "$pending_reg pending " . ($pending_reg == 1 ? "registration" : "registrations")
        ];
        $unread_count += $pending_reg;
    }
}

// Get pending sponsors
$pending_sponsor_sql = "SELECT COUNT(*) as count FROM sponsors WHERE status = 'pending'";
$pending_sponsor_result = $conn->query($pending_sponsor_sql);
if ($pending_sponsor_result && $pending_sponsor_result->num_rows > 0) {
    $pending_sponsor = $pending_sponsor_result->fetch_assoc()['count'];
    if ($pending_sponsor > 0) {
        $notifications[] = [
            'type' => 'sponsor',
            'count' => $pending_sponsor,
            'text' => "$pending_sponsor pending " . ($pending_sponsor == 1 ? "sponsor" : "sponsors")
        ];
        $unread_count += $pending_sponsor;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteVerse Admin</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Orbitron:wght@400;500;600;700;800&family=Chakra+Petch:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/admin-style.css">
    
    <!-- Alert Styles -->
    <link rel="stylesheet" href="assets/css/alert-styles.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Add dedicated sidebar styles -->
    <link rel="stylesheet" href="assets/css/sidebar-styles.css">
    
    <style>
    /* Inline styles for quick fixes */
    .logo-text {
        font-size: 1.2rem !important; /* Smaller ByteVerse text */
    }
    
    /* Fix notification icon responsiveness */
    .notification-dropdown {
        position: relative;
    }
    
    .notification-bell {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        padding: 8px;
        color: var(--text-default);
        cursor: pointer;
    }
    
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 18px;
        height: 18px;
        background-color: var(--danger);
        color: white;
        border-radius: 50%;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2px;
    }
    
    /* Toggle button for sidebar */
    .sidebar-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: var(--text-default);
        font-size: 1.2rem;
        margin-right: 8px;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 0.05);
        color: var(--primary-accent);
    }
    
    /* Hide mobile menu toggle button as we don't need it */
    .mobile-menu-toggle {
        display: none !important; 
    }
    
    .sidebar {
        transform: translateX(0); /* Default state */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }
        
        .sidebar.show {
            transform: translateX(0);
        }
    }
    
    /* Make dropdown menu work */
    .nav-dropdown > .dropdown-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    
    .nav-dropdown.active > .dropdown-menu {
        max-height: 200px;
    }
    
    .nav-dropdown > a .dropdown-icon {
        transition: transform 0.3s ease;
    }
    
    .nav-dropdown.active > a .dropdown-icon {
        transform: rotate(180deg);
    }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <div class="logo-text">Byte<span>Verse</span></div>
                    <div class="admin-label">Admin Panel</div>
                </div>
                <!-- Clear, simple toggle button with appropriate tooltip -->
                <button id="sidebar-toggle" class="sidebar-toggle" title="Toggle Sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <button id="close-sidebar" class="close-sidebar d-md-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <?php if ($admin_user): ?>
            <div class="admin-profile">
                <div class="profile-image">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="profile-info">
                    <h3><?php echo htmlspecialchars($admin_user['admin_fullname']); ?></h3>
                    <p><?php echo ucfirst($admin_user['admin_role']); ?></p>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="sidebar-nav">
                <ul>
                    <li class="<?php echo $current_page === 'dashboard' ? 'active' : ''; ?>">
                        <a href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-dropdown <?php echo in_array($current_page, ['registrations', 'registration-view', 'edit-registration', 'add-registration']) ? 'active' : ''; ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="fas fa-user-plus"></i>
                            <span>Registrations</span>
                            <?php if (isset($pending_reg) && $pending_reg > 0): ?>
                            <span class="nav-badge"><?php echo $pending_reg; ?></span>
                            <?php endif; ?>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="registrations.php"><i class="fas fa-list"></i> All Registrations</a></li>
                            <li><a href="add-registration.php"><i class="fas fa-plus"></i> Add New</a></li>
                            <li><a href="registrations.php?filter=pending"><i class="fas fa-clock"></i> Pending</a></li>
                            <li><a href="registrations.php?filter=active"><i class="fas fa-check"></i> Approved</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-dropdown <?php echo in_array($current_page, ['sponsors', 'add-sponsor', 'edit-sponsor']) ? 'active' : ''; ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="fas fa-handshake"></i>
                            <span>Sponsors</span>
                            <?php if (isset($pending_sponsor) && $pending_sponsor > 0): ?>
                            <span class="nav-badge"><?php echo $pending_sponsor; ?></span>
                            <?php endif; ?>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="sponsors.php"><i class="fas fa-list"></i> All Sponsors</a></li>
                            <li><a href="add-sponsor.php"><i class="fas fa-plus"></i> Add Sponsor</a></li>
                            <li><a href="sponsors.php?filter=pending"><i class="fas fa-clock"></i> Pending</a></li>
                            <li><a href="sponsors.php?filter=active"><i class="fas fa-check"></i> Active</a></li>
                            <li><a href="export-sponsors.php"><i class="fas fa-file-export"></i> Export Data</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-dropdown <?php echo in_array($current_page, ['contact', 'reply-message']) ? 'active' : ''; ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="fas fa-envelope"></i>
                            <span>Messages</span>
                            <?php if (isset($unread_messages) && $unread_messages > 0): ?>
                            <span class="nav-badge"><?php echo $unread_messages; ?></span>
                            <?php endif; ?>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="contact.php"><i class="fas fa-list"></i> All Messages</a></li>
                            <li><a href="contact.php?filter=unread"><i class="fas fa-envelope"></i> Unread</a></li>
                            <li><a href="contact.php?filter=read"><i class="fas fa-envelope-open"></i> Read</a></li>
                        </ul>
                    </li>
                    
                    <li class="<?php echo $current_page === 'activity-logs' ? 'active' : ''; ?>">
                        <a href="activity-logs.php">
                            <i class="fas fa-history"></i>
                            <span>Activity Logs</span>
                        </a>
                    </li>
                    
                    <?php if ($admin_user && $admin_user['admin_role'] === 'admin'): ?>
                    <li class="<?php echo $current_page === 'settings' ? 'active' : ''; ?>">
                        <a href="settings.php">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="sidebar-footer">
                <button id="logout-btn" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="admin-header">
                <div class="header-left">
                    <!-- Remove mobile toggle button from here -->
                    <h1 class="page-title">
                        <?php 
                        $title_map = [
                            'dashboard' => '<i class="fas fa-tachometer-alt"></i> Dashboard',
                            'registrations' => '<i class="fas fa-user-plus"></i> Registrations',
                            'add-registration' => '<i class="fas fa-plus-circle"></i> Add Registration',
                            'edit-registration' => '<i class="fas fa-edit"></i> Edit Registration',
                            'sponsors' => '<i class="fas fa-handshake"></i> Sponsors',
                            'add-sponsor' => '<i class="fas fa-plus-circle"></i> Add Sponsor',
                            'edit-sponsor' => '<i class="fas fa-edit"></i> Edit Sponsor',
                            'contact' => '<i class="fas fa-envelope"></i> Messages',
                            'reply-message' => '<i class="fas fa-reply"></i> Reply to Message',
                            'activity-logs' => '<i class="fas fa-history"></i> Activity Logs',
                            'settings' => '<i class="fas fa-cog"></i> Settings',
                        ];
                        echo $title_map[$current_page] ?? 'ByteVerse Admin';
                        ?>
                    </h1>
                </div>
                
                <div class="header-right">
                    <!-- Remove notification dropdown section -->
                    <div class="admin-dropdown">
                        <div class="admin-dropdown-toggle" id="admin-dropdown-toggle">
                            <i class="fas fa-user-circle"></i>
                            <span><?php echo $admin_user ? htmlspecialchars($admin_user['admin_username']) : 'Admin'; ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        
                        <div class="admin-dropdown-menu" id="admin-dropdown-menu">
                            <a href="profile.php" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="settings.php" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" id="header-logout-btn" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <!-- Content will be inserted here -->
