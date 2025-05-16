/**
 * Global Sidebar Toggle Functionality
 * This script handles the sidebar icon-only toggle functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const closeSidebar = document.getElementById('close-sidebar');
    const modalBackdrop = document.getElementById('modal-backdrop');
    
    if (!sidebar) return;
    
    // Get stored state
    const isMobile = window.innerWidth <= 992;
    const storedState = localStorage.getItem('sidebarState');
    
    // Set initial state based on screen size and stored preference
    if (isMobile) {
        // Mobile: always starts hidden
        sidebar.classList.remove('show');
        sidebar.classList.remove('icons-only');
    } else {
        // Desktop: check if it should be icons-only
        if (storedState === 'icons-only') {
            sidebar.classList.add('icons-only');
            mainContent.classList.add('expanded');
        } else {
            sidebar.classList.remove('icons-only');
            mainContent.classList.remove('expanded');
        }
    }
    
    // Toggle sidebar when button is clicked
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (isMobile) {
                // On mobile: toggle show/hide
                sidebar.classList.toggle('show');
                
                // Handle backdrop
                if (modalBackdrop) {
                    modalBackdrop.classList.toggle('show', sidebar.classList.contains('show'));
                }
            } else {
                // On desktop: toggle icons-only mode
                sidebar.classList.toggle('icons-only');
                mainContent.classList.toggle('expanded');
                
                // Save state
                localStorage.setItem('sidebarState', 
                    sidebar.classList.contains('icons-only') ? 'icons-only' : 'full');
            }
        });
    }
    
    // Close sidebar on close button click
    if (closeSidebar) {
        closeSidebar.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.remove('show');
            if (modalBackdrop) modalBackdrop.classList.remove('show');
        });
    }
    
    // Close sidebar on backdrop click
    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function() {
            sidebar.classList.remove('show');
            modalBackdrop.classList.remove('show');
        });
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        const currentIsMobile = window.innerWidth <= 992;
        
        if (currentIsMobile !== isMobile) {
            if (currentIsMobile) {
                // Switched to mobile
                sidebar.classList.remove('icons-only');
                sidebar.classList.remove('show');
                mainContent.classList.remove('expanded');
            } else {
                // Switched to desktop
                sidebar.classList.remove('show');
                
                // Restore desktop state
                if (storedState === 'icons-only') {
                    sidebar.classList.add('icons-only');
                    mainContent.classList.add('expanded');
                }
            }
        }
    });
});
