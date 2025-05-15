
            </div> <!-- End of admin-content-inner -->
        </main> <!-- End of admin-content -->
    </div> <!-- End of admin-container -->

    <footer class="admin-footer">
        <div class="admin-footer-content">
            <p>&copy; <?php echo date('Y'); ?> ByteVerse Hackathon - Admin Dashboard</p>
        </div>
    </footer>

    <!-- Admin scripts -->
    <script src="assets/js/admin-scripts.js"></script>
    
    <!-- Additional page-specific scripts can be added here -->
    <?php if (isset($pageSpecificScripts) && !empty($pageSpecificScripts)): ?>
        <?php foreach ($pageSpecificScripts as $script): ?>
            <script src="<?php echo $script; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <script>
        // Close alert messages
        document.querySelectorAll('.admin-alert-close').forEach(function(button) {
            button.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });
        
        // User dropdown toggle
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        if (userDropdownToggle && userDropdown) {
            userDropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                userDropdown.classList.toggle('active');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!userDropdownToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('active');
                }
            });
        }
        
        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const adminSidebar = document.getElementById('adminSidebar');
        
        if (sidebarToggle && adminSidebar) {
            sidebarToggle.addEventListener('click', function() {
                adminSidebar.classList.toggle('active');
                document.body.classList.toggle('sidebar-open');
            });
        }
        
        // Dropdown menus in sidebar
        document.querySelectorAll('.admin-nav-dropdown-toggle').forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                this.parentElement.classList.toggle('open');
            });
        });
    </script>
</body>
</html>