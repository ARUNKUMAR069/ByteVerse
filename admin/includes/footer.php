</div><!-- End content-wrapper -->
        </div><!-- End main-content -->
    </div><!-- End admin-container -->
    
    <!-- Logout Modal -->
    <div class="modal" id="logout-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Logout Confirmation</h2>
                <button class="modal-close" id="close-logout-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-sign-out-alt text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="text-center">Are you sure you want to logout from the admin panel?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancel-logout">Cancel</button>
                <a href="logout.php" class="btn btn-danger">Yes, Logout</a>
            </div>
        </div>
    </div>
    
    <!-- Make sure Modal Backdrop exists for sidebar toggle -->
    <div class="modal-backdrop" id="modal-backdrop"></div>
    
    <!-- Admin scripts -->
    <script src="assets/js/admin-script.js"></script>
    <!-- Debug script for sidebar toggle -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Log sidebar elements to console for debugging
        console.log('Sidebar:', document.getElementById('sidebar'));
        console.log('Sidebar Toggle:', document.getElementById('sidebar-toggle'));
        console.log('Main Content:', document.querySelector('.main-content'));
        
        // Add manual sidebar toggle functionality if needed
        const debugToggle = function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle('show');
                document.getElementById('modal-backdrop').classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
            
            console.log('Manual toggle clicked');
        };
        
        // Add a global function for debugging from browser console if needed
        window.toggleSidebar = debugToggle;
    });
    </script>
</body>
</html>
<?php 
// Flush the output buffer
ob_end_flush();
?>
