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
    
    <!-- Global Sidebar Toggle Script -->
    <script src="assets/js/sidebar-toggle.js"></script>
    
    <!-- Admin scripts -->
    <script src="assets/js/admin-script.js"></script>
</body>
</html>
<?php 
// Flush the output buffer
ob_end_flush();
?>
