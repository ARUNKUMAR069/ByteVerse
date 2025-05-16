/**
 * ByteVerse Admin Panel Helper Functions
 * Handles sidebar toggling, modals, and other UI interactions
 */

// Run when DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initSidebar();
    setupModals();
    initCharts();
    setupTableFilters();
    handleFormValidation();
    initNotifications();
});

/**
 * Initialize sidebar functionality
 */
function initSidebar() {
    const mobileToggle = document.getElementById('mobile-toggle');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('close-sidebar');
    const modalBackdrop = document.getElementById('modal-backdrop');
    
    if (!sidebar) return;
    
    // Show sidebar on mobile toggle click
    if (mobileToggle) {
        mobileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.add('show');
            if (modalBackdrop) modalBackdrop.classList.add('show');
        });
    }
    
    // Hide sidebar when close button is clicked
    if (closeSidebar) {
        closeSidebar.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.remove('show');
            if (modalBackdrop) modalBackdrop.classList.remove('show');
        });
    }
    
    // Hide sidebar when clicking outside (on backdrop)
    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function(e) {
            if (sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                modalBackdrop.classList.remove('show');
            }
        });
    }
    
    // Close sidebar when window resizes to desktop size
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
            if (modalBackdrop) modalBackdrop.classList.remove('show');
        }
    });
}

/**
 * Setup modals functionality
 */
function setupModals() {
    const modalTriggers = document.querySelectorAll('[data-modal-target]');
    const modalCloseButtons = document.querySelectorAll('.modal-close, .cancel-modal');
    const modalBackdrop = document.getElementById('modal-backdrop');
    
    // Open modals when triggers are clicked
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            const modalId = this.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            
            if (modal) {
                modal.classList.add('show');
                if (modalBackdrop) modalBackdrop.classList.add('show');
            }
        });
    });
    
    // Close modals when close buttons are clicked
    modalCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                modal.classList.remove('show');
                if (modalBackdrop) modalBackdrop.classList.remove('show');
            }
        });
    });
    
    // Close modals when backdrop is clicked
    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', function() {
            document.querySelectorAll('.modal.show').forEach(modal => {
                modal.classList.remove('show');
            });
            this.classList.remove('show');
        });
    }
    
    // Handle logout modal specifically
    const logoutBtn = document.getElementById('logout-btn');
    const headerLogoutBtn = document.getElementById('header-logout-btn');
    const logoutModal = document.getElementById('logout-modal');
    
    if (logoutBtn && logoutModal) {
        logoutBtn.addEventListener('click', function() {
            logoutModal.classList.add('show');
            if (modalBackdrop) modalBackdrop.classList.add('show');
        });
    }
    
    if (headerLogoutBtn && logoutModal) {
        headerLogoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            logoutModal.classList.add('show');
            if (modalBackdrop) modalBackdrop.classList.add('show');
        });
    }
}

/**
 * Initialize charts if they exist on the page
 */
function initCharts() {
    // Only proceed if Chart.js is available
    if (typeof Chart === 'undefined') return;
    
    // Registration chart
    const registrationsChart = document.getElementById('registrationsChart');
    if (registrationsChart) {
        new Chart(registrationsChart.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Registrations',
                    data: [5, 15, 25, 30, 45, 80, 120],
                    backgroundColor: 'rgba(0, 215, 254, 0.2)',
                    borderColor: 'rgba(0, 215, 254, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(0, 215, 254, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.7)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
    
    // Teams distribution chart
    const teamsChart = document.getElementById('teamsChart');
    if (teamsChart) {
        new Chart(teamsChart.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['AI/ML', 'Blockchain', 'AR/VR', 'IoT', 'Open Innovation'],
                datasets: [{
                    data: [25, 20, 15, 15, 25],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'rgba(255, 255, 255, 0.7)',
                            font: {
                                size: 12
                            },
                            padding: 15
                        }
                    }
                },
                cutout: '70%'
            }
        });
    }
}

/**
 * Setup table filters and checkbox functionality
 */
function setupTableFilters() {
    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('select-all');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.table-responsive input[type="checkbox"]:not(#select-all)');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    }
    
    // Handle checkbox toggles affecting bulk action buttons
    const bulkActionSelects = document.querySelectorAll('select[name="bulk_action"]');
    bulkActionSelects.forEach(select => {
        const form = select.closest('form');
        if (form) {
            const checkboxes = form.querySelectorAll('input[type="checkbox"]:not(#select-all)');
            const submitButton = form.querySelector('button[type="submit"]');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Check if any checkbox is checked
                    const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                    
                    // Enable or disable submit button based on selections
                    if (submitButton) {
                        submitButton.disabled = !anyChecked;
                    }
                });
            });
        }
    });
    
    // Export to CSV functionality
    const exportButton = document.getElementById('export-csv-btn');
    if (exportButton) {
        exportButton.addEventListener('click', function() {
            const currentPath = window.location.pathname;
            const currentPage = currentPath.substring(currentPath.lastIndexOf('/') + 1);
            const exportPage = currentPage.replace('.php', '-export.php');
            
            // Get current search params
            const urlParams = new URLSearchParams(window.location.search);
            
            // Redirect to export page with current filters
            window.location.href = `${exportPage}?${urlParams.toString()}`;
        });
    }
}

/**
 * Handle form validation
 */
function handleFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        if (form.classList.contains('no-validation')) return;
        
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    highlightInvalidField(field);
                } else {
                    removeInvalidHighlight(field);
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showNotification('Please fill in all required fields', 'error');
            }
        });
    });
    
    function highlightInvalidField(field) {
        field.classList.add('invalid');
        
        const errorMessage = field.nextElementSibling?.classList.contains('error-message') 
            ? field.nextElementSibling 
            : null;
            
        if (!errorMessage) {
            const message = document.createElement('div');
            message.className = 'error-message';
            message.textContent = 'This field is required';
            field.insertAdjacentElement('afterend', message);
        }
        
        field.addEventListener('input', function onInput() {
            if (field.value.trim()) {
                removeInvalidHighlight(field);
                field.removeEventListener('input', onInput);
            }
        });
    }
    
    function removeInvalidHighlight(field) {
        field.classList.remove('invalid');
        
        const errorMessage = field.nextElementSibling?.classList.contains('error-message') 
            ? field.nextElementSibling 
            : null;
            
        if (errorMessage) {
            errorMessage.remove();
        }
    }
}

/**
 * Initialize notification system
 */
function initNotifications() {
    window.showNotification = function(message, type = 'info') {
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
    };
    
    function closeNotification(notification) {
        notification.style.transform = 'translateX(100%)';
        notification.style.opacity = '0';
        
        setTimeout(() => {
            notification.remove();
        }, 300);
    }
}

/**
 * Toggle the Admin dropdown menu
 */
function toggleAdminMenu() {
    const adminDropdownMenu = document.querySelector('.admin-dropdown-menu');
    if (adminDropdownMenu) {
        adminDropdownMenu.classList.toggle('show');
    }
}
