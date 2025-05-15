
<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['admin_id']) && basename($_SERVER['PHP_SELF']) !== 'admin-index.php') {
    header("Location: admin-index.php");
    exit;
}

// Get current page for menu highlighting
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteVerse Admin - <?php echo ucfirst(str_replace('admin-', '', $current_page)); ?></title>
    
    <!-- Admin styles -->
    <link rel="stylesheet" href="assets/css/admin-styles.css">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Orbitron for headings, Chakra Petch for content -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&family=Chakra+Petch:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="admin-body">
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="admin-logo">
            <a href="admin-dashboard.php">
                <span class="admin-logo-text">Byte<span class="admin-highlight">Verse</span> Admin</span>
            </a>
        </div>
        
        <div class="admin-header-right">
            <?php if (isset($_SESSION['admin_id'])): ?>
                <div class="admin-notifications">
                    <a href="#" class="admin-icon-btn">
                        <i class="fas fa-bell"></i>
                        <span class="admin-badge admin-badge-notification">3</span>
                    </a>
                </div>
                
                <div class="admin-user-menu">
                    <div class="admin-user-info" id="userDropdownToggle">
                        <div class="admin-avatar">
                            <?php if (!empty($_SESSION['admin_avatar'])): ?>
                                <img src="<?php echo $_SESSION['admin_avatar']; ?>" alt="Avatar">
                            <?php else: ?>
                                <div class="admin-avatar-placeholder">
                                    <?php echo strtoupper(substr($_SESSION['admin_fullname'], 0, 1)); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="admin-user-name">
                            <?php echo $_SESSION['admin_fullname']; ?>
                            <span class="admin-role"><?php echo adminGetRoleName($_SESSION['admin_role']); ?></span>
                        </div>
                        <i class="fas fa-chevron-down admin-dropdown-icon"></i>
                    </div>
                    
                    <div class="admin-dropdown-menu" id="userDropdown">
                        <a href="admin-pages/admin-profile.php" class="admin-dropdown-item">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <a href="admin-pages/admin-settings.php" class="admin-dropdown-item">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <div class="admin-dropdown-divider"></div>
                        <a href="admin-logout.php" class="admin-dropdown-item admin-text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Mobile menu toggle -->
            <button class="admin-mobile-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
    
    <div class="admin-container">
        <!-- Sidebar will be included here -->
        <?php include_once('admin-sidebar.php'); ?>
        
        <!-- Main content container -->
        <main class="admin-content">
            <!-- Page header with title and breadcrumbs -->
            <div class="admin-page-header">
                <h1 class="admin-page-title">
                    <?php echo ucfirst(str_replace('admin-', '', $current_page)); ?>
                </h1>
                <div class="admin-breadcrumb">
                    <a href="admin-dashboard.php">Dashboard</a>
                    <?php if ($current_page != 'admin-dashboard'): ?>
                    <span class="admin-breadcrumb-separator">/</span>
                    <span><?php echo ucfirst(str_replace('admin-', '', $current_page)); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Alert messages -->
            <?php if (isset($_GET['success'])): ?>
            <div class="admin-alert admin-alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?php echo htmlspecialchars($_GET['success']); ?></span>
                <button class="admin-alert-close">&times;</button>
            </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error'])): ?>
            <div class="admin-alert admin-alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo htmlspecialchars($_GET['error']); ?></span>
                <button class="admin-alert-close">&times;</button>
            </div>
            <?php endif; ?>
            
            <!-- Main content starts here -->
            <div class="admin-content-inner"></div></div>