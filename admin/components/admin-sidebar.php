
<aside class="admin-sidebar" id="adminSidebar">
    <nav class="admin-nav">
        <ul class="admin-nav-list">
            <li class="admin-nav-item <?php echo $current_page == 'admin-dashboard' ? 'active' : ''; ?>">
                <a href="admin-dashboard.php" class="admin-nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="admin-nav-item <?php echo $current_page == 'admin-pages/admin-registrations' ? 'active' : ''; ?>">
                <a href="admin-pages/admin-registrations.php" class="admin-nav-link">
                    <i class="fas fa-users"></i>
                    <span>Registrations</span>
                    <span class="admin-badge admin-badge-primary">New</span>
                </a>
            </li>
            
            <li class="admin-nav-item <?php echo $current_page == 'admin-pages/admin-sponsors' ? 'active' : ''; ?>">
                <a href="admin-pages/admin-sponsors.php" class="admin-nav-link">
                    <i class="fas fa-handshake"></i>
                    <span>Sponsors</span>
                </a>
            </li>
            
            <?php if ($_SESSION['admin_role'] === 'super_admin' || $_SESSION['admin_role'] === 'admin'): ?>
            <li class="admin-nav-item <?php echo $current_page == 'admin-pages/admin-users' ? 'active' : ''; ?>">
                <a href="admin-pages/admin-users.php" class="admin-nav-link">
                    <i class="fas fa-user-shield"></i>
                    <span>Admin Users</span>
                </a>
            </li>
            <?php endif; ?>
            
            <li class="admin-nav-item admin-nav-dropdown <?php echo (strpos($current_page, 'settings') !== false || strpos($current_page, 'logs') !== false) ? 'active' : ''; ?>">
                <a href="#" class="admin-nav-link admin-nav-dropdown-toggle">
                    <i class="fas fa-cog"></i>
                    <span>System</span>
                    <i class="fas fa-chevron-down admin-dropdown-icon"></i>
                </a>
                <ul class="admin-nav-dropdown-menu">
                    <li class="admin-nav-item <?php echo $current_page == 'admin-pages/admin-settings' ? 'active' : ''; ?>">
                        <a href="admin-pages/admin-settings.php" class="admin-nav-link">
                            <i class="fas fa-sliders-h"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <?php if ($_SESSION['admin_role'] === 'super_admin'): ?>
                    <li class="admin-nav-item <?php echo $current_page == 'admin-pages/admin-logs' ? 'active' : ''; ?>">
                        <a href="admin-pages/admin-logs.php" class="admin-nav-link">
                            <i class="fas fa-history"></i>
                            <span>Activity Logs</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </nav>
    
    <div class="admin-sidebar-footer">
        <div class="admin-version">
            ByteVerse Admin v1.0
        </div>
    </div>
</aside>