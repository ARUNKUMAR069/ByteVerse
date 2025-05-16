<?php
// filepath: c:\xampp\htdocs\new2\admin\components\admin-sidebar.php

// Determine current page and directory depth
$current_page = basename($_SERVER['PHP_SELF'], '.php');
$is_root = !strpos($_SERVER['PHP_SELF'], '/pages/');
$path_prefix = $is_root ? 'pages/' : '';
$back_prefix = $is_root ? '' : '../';
?>

<aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-sidebar-header">
        <div class="admin-logo">
            <a href="<?php echo $back_prefix; ?>admin-dashboard.php">
                <span class="admin-logo-text">Byte<span class="admin-highlight">Verse</span></span>
            </a>
        </div>
        <button class="admin-sidebar-close" id="adminSidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="admin-sidebar-content">
        <nav class="admin-nav">
            <ul class="admin-nav-list">
                <li class="admin-nav-item <?php echo $current_page == 'admin-dashboard' ? 'active' : ''; ?>">
                    <a href="<?php echo $back_prefix; ?>admin-dashboard.php" class="admin-nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="admin-nav-item <?php echo $current_page == 'admin-registrations' ? 'active' : ''; ?>">
                    <a href="<?php echo $path_prefix; ?>admin-registrations.php" class="admin-nav-link">
                        <i class="fas fa-users"></i>
                        <span>Registrations</span>
                        <?php if (isset($reg_stats) && $reg_stats['pending'] > 0): ?>
                        <span class="admin-badge admin-badge-primary"><?php echo $reg_stats['pending']; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                
                <li class="admin-nav-item <?php echo $current_page == 'admin-sponsors' ? 'active' : ''; ?>">
                    <a href="<?php echo $path_prefix; ?>admin-sponsors.php" class="admin-nav-link">
                        <i class="fas fa-handshake"></i>
                        <span>Sponsors</span>
                        <?php if (isset($sponsor_stats) && $sponsor_stats['pending'] > 0): ?>
                        <span class="admin-badge admin-badge-primary"><?php echo $sponsor_stats['pending']; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                
                <li class="admin-nav-divider"></li>
                
                <?php if (isset($_SESSION['admin_role']) && ($_SESSION['admin_role'] === 'super_admin' || $_SESSION['admin_role'] === 'admin')): ?>
                <li class="admin-nav-item <?php echo $current_page == 'admin-users' ? 'active' : ''; ?>">
                    <a href="<?php echo $path_prefix; ?>admin-users.php" class="admin-nav-link">
                        <i class="fas fa-user-shield"></i>
                        <span>Admin Users</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <li class="admin-nav-item has-submenu <?php echo in_array($current_page, ['admin-settings', 'admin-logs']) ? 'active' : ''; ?>">
                    <a href="#" class="admin-nav-link admin-nav-dropdown-toggle">
                        <i class="fas fa-cog"></i>
                        <span>System</span>
                        <i class="fas fa-chevron-down admin-dropdown-icon"></i>
                    </a>
                    <ul class="admin-nav-dropdown">
                        <li class="admin-nav-dropdown-item <?php echo $current_page == 'admin-settings' ? 'active' : ''; ?>">
                            <a href="<?php echo $path_prefix; ?>admin-settings.php" class="admin-nav-link">
                                <i class="fas fa-sliders-h"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['admin_role']) && ($_SESSION['admin_role'] === 'super_admin' || $_SESSION['admin_role'] === 'admin')): ?>
                        <li class="admin-nav-dropdown-item <?php echo $current_page == 'admin-logs' ? 'active' : ''; ?>">
                            <a href="<?php echo $path_prefix; ?>admin-logs.php" class="admin-nav-link">
                                <i class="fas fa-history"></i>
                                <span>Activity Logs</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    
    <div class="admin-sidebar-footer">
        <div class="admin-user-info">
            <div class="admin-user-avatar">
                <?php if (isset($_SESSION['admin_avatar']) && !empty($_SESSION['admin_avatar'])): ?>
                <img src="<?php echo $back_prefix; ?>uploads/avatars/<?php echo $_SESSION['admin_avatar']; ?>" alt="User Avatar">
                <?php else: ?>
                <i class="fas fa-user-circle"></i>
                <?php endif; ?>
            </div>
            <div class="admin-user-details">
                <div class="admin-user-name"><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></div>
                <div class="admin-user-role"><?php echo adminGetRoleName($_SESSION['admin_role'] ?? 'viewer'); ?></div>
            </div>
            <div class="admin-logout">
                <a href="<?php echo $back_prefix; ?>admin-logout.php" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>
</aside>

<div class="admin-overlay" id="adminOverlay"></div>