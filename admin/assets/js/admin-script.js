/**
 * ByteVerse Admin Panel Scripts
 * Handle sidebar toggling, dropdowns, notifications, and other UI interactions
 */

// Wait for DOM content to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initSidebar();
    initDropdowns();
    initLogoutModal();
});

/**
 * Initialize sidebar functionality
 */
function initSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const closeSidebar = document.getElementById('close-sidebar');
    const modalBackdrop = document.getElementById('modal-backdrop');
    
    if (!sidebar) return;
    
    // Load sidebar state from localStorage
    const isMobile = window.innerWidth <= 992;
    const storedState = localStorage.getItem('sidebarState');
    
    // Set initial state
    if (isMobile) {
        // Mobile devices always start with hidden sidebar
        sidebar.classList.remove('show');
        sidebar.classList.remove('collapsed');
    } else {
        // Desktop: check if it was collapsed previously
        if (storedState === 'collapsed') {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
        }
    }
    
    // Toggle sidebar when button is clicked
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (isMobile) {
                // Mobile: toggle show/hide
                sidebar.classList.toggle('show');
                if (modalBackdrop) {
                    modalBackdrop.classList.toggle('show');
                }
            } else {
                // Desktop: toggle collapsed state
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                
                // Save state to localStorage
                localStorage.setItem('sidebarState', 
                    sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
            }
        });
    }
    
    // Close sidebar when "X" is clicked (mobile only)
    if (closeSidebar) {
        closeSidebar.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.remove('show');
            if (modalBackdrop) {
                modalBackdrop.classList.remove('show');
            }
        });
    }
    
    // Close sidebar when backdrop is clicked (mobile only)
    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function() {
            sidebar.classList.remove('show');
            modalBackdrop.classList.remove('show');
        });
    }
    
    // Handle window resize events
    window.addEventListener('resize', function() {
        const currentIsMobile = window.innerWidth <= 992;
        
        if (currentIsMobile !== isMobile) {
            if (currentIsMobile) {
                // Switching to mobile
                sidebar.classList.remove('show');
                if (modalBackdrop) {
                    modalBackdrop.classList.remove('show');
                }
            } else {
                // Switching to desktop
                if (storedState === 'collapsed') {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                }
            }
        }
    });
    
    // Special handling for collapsed sidebar dropdowns on hover
    const dropdowns = document.querySelectorAll('.nav-dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('mouseenter', function() {
            if (sidebar.classList.contains('collapsed') && !isMobile) {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.style.top = `${this.offsetTop}px`;
                }
            }
        });
    });
}

/**
 * Initialize dropdown menus
 */
function initDropdowns() {
    // Sidebar nav dropdowns
    const navDropdowns = document.querySelectorAll('.nav-dropdown');
    
    navDropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        
        if (toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                dropdown.classList.toggle('active');
                
                // Close other dropdowns
                navDropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown && otherDropdown.classList.contains('active')) {
                        otherDropdown.classList.remove('active');
                    }
                });
                
                // Save dropdown state to localStorage
                const dropdownId = dropdown.classList[0];
                if (dropdownId) {
                    localStorage.setItem(dropdownId + '-open', dropdown.classList.contains('active'));
                }
            });
        }
        
        // Restore dropdown state from localStorage
        const dropdownId = dropdown.classList[0];
        if (dropdownId && localStorage.getItem(dropdownId + '-open') === 'true') {
            dropdown.classList.add('active');
        }
        
        // If this dropdown is marked as active from PHP (current page is in this section)
        // Make sure it's expanded
        if (dropdown.classList.contains('active') && !dropdown.classList.contains('open')) {
            dropdown.classList.add('active');
        }
    });
    
    // User dropdown in header
    const adminDropdown = document.getElementById('admin-dropdown-toggle');
    const adminMenu = document.getElementById('admin-dropdown-menu');
    
    if (adminDropdown && adminMenu) {
        adminDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            adminMenu.classList.toggle('show');
            
            // Close notification menu if open
            const notificationMenu = document.getElementById('notification-menu');
            if (notificationMenu && notificationMenu.classList.contains('show')) {
                notificationMenu.classList.remove('show');
            }
        });
        
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!adminDropdown.contains(e.target) && !adminMenu.contains(e.target)) {
                adminMenu.classList.remove('show');
            }
        });
    }
}

/**
 * Initialize logout modal
 */
function initLogoutModal() {
    const logoutBtn = document.getElementById('logout-btn');
    const headerLogoutBtn = document.getElementById('header-logout-btn');
    const logoutModal = document.getElementById('logout-modal');
    const modalBackdrop = document.getElementById('modal-backdrop');
    const cancelLogout = document.getElementById('cancel-logout');
    const closeLogoutModal = document.getElementById('close-logout-modal');
    
    if (!logoutModal) return;
    
    function showLogoutModal() {
        if (logoutModal && modalBackdrop) {
            logoutModal.classList.add('show');
            modalBackdrop.classList.add('show');
        }
    }
    
    function hideLogoutModal() {
        if (logoutModal && modalBackdrop) {
            logoutModal.classList.remove('show');
            
            // Only remove backdrop if sidebar is not shown
            if (!document.getElementById('sidebar').classList.contains('show')) {
                modalBackdrop.classList.remove('show');
            }
        }
    }
    
    // Show logout modal
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showLogoutModal();
        });
    }
    
    if (headerLogoutBtn) {
        headerLogoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Close admin dropdown
            const adminMenu = document.getElementById('admin-dropdown-menu');
            if (adminMenu) {
                adminMenu.classList.remove('show');
            }
            
            showLogoutModal();
        });
    }
    
    // Hide logout modal
    if (cancelLogout) {
        cancelLogout.addEventListener('click', hideLogoutModal);
    }
    
    if (closeLogoutModal) {
        closeLogoutModal.addEventListener('click', hideLogoutModal);
    }
    
    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function(e) {
            // If logout modal is visible, close it
            if (logoutModal.classList.contains('show')) {
                hideLogoutModal();
            }
            
            // Also close sidebar if it's open
            const sidebar = document.getElementById('sidebar');
            if (sidebar && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                localStorage.setItem('sidebarOpen', false);
            }
        });
    }
}

/**
 * Show notification toast
 * @param {string} message - Notification message
 * @param {string} type - Notification type: success, error, info, warning
 */
function showNotification(message, type = 'info') {
    // Create notification container if it doesn't exist
    let container = document.getElementById('notification-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'notification-container';
        container.style.position = 'fixed';
        container.style.top = '20px';
        container.style.right = '20px';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    
    // Set icon based on notification type
    let icon = 'info-circle';
    if (type === 'success') icon = 'check-circle';
    if (type === 'error') icon = 'exclamation-circle';
    if (type === 'warning') icon = 'exclamation-triangle';
    
    notification.innerHTML = `
        <div class="notification-icon">
            <i class="fas fa-${icon}"></i>
        </div>
        <div class="notification-content">${message}</div>
        <button class="notification-close">&times;</button>
    `;
    
    // Add to container
    container.appendChild(notification);
    
    // Style the notification
    Object.assign(notification.style, {
        display: 'flex',
        alignItems: 'center',
        margin: '0 0 10px 0',
        padding: '12px 15px',
        borderRadius: '5px',
        boxShadow: '0 3px 10px rgba(0, 0, 0, 0.2)',
        backgroundColor: type === 'success' ? 'rgba(39, 201, 63, 0.95)' :
                         type === 'error' ? 'rgba(255, 95, 86, 0.95)' :
                         type === 'warning' ? 'rgba(255, 204, 0, 0.95)' : 
                         'rgba(0, 215, 254, 0.95)',
        color: '#fff',
        transform: 'translateX(100%)',
        opacity: '0',
        transition: 'transform 0.3s ease, opacity 0.3s ease'
    });
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
        notification.style.opacity = '1';
    }, 50);
    
    // Close button functionality
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        closeNotification(notification);
    });
    
    // Auto close after 5 seconds
    setTimeout(() => {
        closeNotification(notification);
    }, 5000);
    
    function closeNotification(notification) {
        notification.style.transform = 'translateX(100%)';
        notification.style.opacity = '0';
        
        setTimeout(() => {
            notification.remove();
        }, 300);
    }
}

// Export functions for other scripts
window.showNotification = showNotification;
