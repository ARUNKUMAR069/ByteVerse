document.addEventListener('DOMContentLoaded', function() {
    // Mobile navigation toggle
    const mobileToggle = document.getElementById('adminMobileToggle');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('adminOverlay');
    const closeBtn = document.getElementById('adminSidebarClose');
    
    if (mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Dropdown navigation
    const dropdownToggles = document.querySelectorAll('.admin-nav-dropdown-toggle');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.closest('.admin-nav-item');
            parent.classList.toggle('active');
        });
    });
    
    // User dropdown
    const userDropdown = document.querySelector('.admin-user-info');
    if (userDropdown) {
        userDropdown.addEventListener('click', function(e) {
            this.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
    }
    
    // Notification dropdown
    const notificationBell = document.querySelector('.admin-notification-bell');
    if (notificationBell) {
        notificationBell.addEventListener('click', function(e) {
            this.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationBell.contains(e.target)) {
                notificationBell.classList.remove('active');
            }
        });
    }
    
    // Alerts auto-hide
    const alerts = document.querySelectorAll('.admin-alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade-out');
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
    
    // Form validation
    const forms = document.querySelectorAll('.admin-form-validation');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('admin-input-error');
                    
                    // Add error message if not exists
                    let errorMsg = field.parentNode.querySelector('.admin-input-error-msg');
                    if (!errorMsg) {
                        errorMsg = document.createElement('div');
                        errorMsg.className = 'admin-input-error-msg';
                        errorMsg.innerText = 'This field is required';
                        field.parentNode.appendChild(errorMsg);
                    }
                } else {
                    field.classList.remove('admin-input-error');
                    const errorMsg = field.parentNode.querySelector('.admin-input-error-msg');
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
});

// Modal functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'block';
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('active');
    
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }, 300);
}

// Dark/Light mode toggle
function toggleDarkMode() {
    document.body.classList.toggle('admin-dark-mode');
    
    // Save preference
    const isDarkMode = document.body.classList.contains('admin-dark-mode');
    localStorage.setItem('admin_dark_mode', isDarkMode ? 'true' : 'false');
}

// Initialize dark mode based on saved preference
function initDarkMode() {
    const darkMode = localStorage.getItem('admin_dark_mode');
    if (darkMode === 'true') {
        document.body.classList.add('admin-dark-mode');
    }
}

// Call dark mode initialization
initDarkMode();