<?php
// filepath: c:\xampp\htdocs\new2\admin\components\admin-header.php

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base URL for assets and links
$base_url = '/new2/admin/';

// Set default page title if not set
if (!isset($page_title)) {
    $page_title = 'Admin Panel';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - ByteVerse Admin</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/admin-styles.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="admin-body">
    <!-- Mobile Header -->
    <header class="admin-header">
        <button class="admin-mobile-toggle" id="adminMobileToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="admin-logo">
            <a href="<?php echo $base_url; ?>admin-dashboard.php">
                <span class="admin-logo-text">Byte<span class="admin-highlight">Verse</span></span>
            </a>
        </div>
        
        <div class="admin-header-actions">
            <div class="admin-notification-bell">
                <?php
                // Get unread notifications count
                $unread_count = 0;
                if (isset($conn)) {
                    $notif_query = "SELECT COUNT(*) FROM admin_notifications WHERE is_read = 0";
                    try {
                        $unread_count = $conn->query($notif_query)->fetchColumn();
                    } catch (PDOException $e) {
                        // Silently fail if table doesn't exist yet
                    }
                }
                ?>
                <i class="fas fa-bell"></i>
                <?php if ($unread_count > 0): ?>
                <span class="admin-badge admin-badge-notification"><?php echo $unread_count; ?></span>
                <?php endif; ?>
                
                <!-- Notification Dropdown -->
                <div class="admin-notification-dropdown">
                    <div class="admin-notification-header">
                        <h3>Notifications</h3>
                        <a href="#" class="admin-notification-mark-all">Mark all as read</a>
                    </div>
                    <div class="admin-notification-body">
                        <?php
                        $has_notifications = false;
                        if (isset($conn)) {
                            $notif_list_query = "SELECT * FROM admin_notifications ORDER BY created_at DESC LIMIT 5";
                            try {
                                $notif_stmt = $conn->query($notif_list_query);
                                $notifications = $notif_stmt->fetchAll(PDO::FETCH_ASSOC);
                                $has_notifications = count($notifications) > 0;
                                
                                if ($has_notifications) {
                                    foreach ($notifications as $notif) {
                                        echo '<div class="admin-notification-item ' . ($notif['is_read'] ? 'read' : '') . '">';
                                        echo '<div class="admin-notification-icon"><i class="fas fa-' . htmlspecialchars($notif['icon'] ?: 'bell') . '"></i></div>';
                                        echo '<div class="admin-notification-content">';
                                        echo '<div class="admin-notification-message">' . htmlspecialchars($notif['message']) . '</div>';
                                        echo '<div class="admin-notification-time">' . date('M d, h:i A', strtotime($notif['created_at'])) . '</div>';
                                        echo '</div>';
                                        echo '<button class="admin-notification-mark-read" data-id="' . $notif['id'] . '"><i class="fas fa-check"></i></button>';
                                        echo '</div>';
                                    }
                                }
                            } catch (PDOException $e) {
                                // Silently fail if table doesn't exist yet
                            }
                        }
                        
                        if (!$has_notifications) {
                            echo '<div class="admin-notification-empty">';
                            echo '<i class="fas fa-bell-slash"></i>';
                            echo '<p>No notifications</p>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="admin-notification-footer">
                        <a href="<?php echo $base_url; ?>pages/admin-notifications.php">View All Notifications</a>
                    </div>
                </div>
            </div>
            
            <div class="admin-user-info">
                <div class="admin-user-avatar">
                    <?php if (isset($_SESSION['admin_avatar']) && !empty($_SESSION['admin_avatar'])): ?>
                    <img src="<?php echo $base_url; ?>uploads/avatars/<?php echo $_SESSION['admin_avatar']; ?>" alt="User Avatar">
                    <?php else: ?>
                    <i class="fas fa-user-circle"></i>
                    <?php endif; ?>
                </div>
                <div class="admin-user-name"><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></div>
                <i class="fas fa-chevron-down"></i>
                
                <!-- User Dropdown -->
                <div class="admin-dropdown-menu">
                    <a href="<?php echo $base_url; ?>pages/admin-profile.php" class="admin-dropdown-item">
                        <i class="fas fa-user"></i> My Profile
                    </a>
                    <a href="<?php echo $base_url; ?>pages/admin-settings.php" class="admin-dropdown-item">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <div class="admin-dropdown-divider"></div>
                    <a href="<?php echo $base_url; ?>admin-logout.php" class="admin-dropdown-item">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Include Sidebar -->
    <?php include 'admin-sidebar.php'; ?>
    
    <!-- Main Content -->
    <main class="admin-main"></main>