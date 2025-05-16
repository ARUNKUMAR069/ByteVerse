// filepath: byteverse-admin/admin/assets/js/admin-script.js

document.addEventListener("DOMContentLoaded", function() {
    // Initialize tooltips
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(tooltip => {
        tooltip.addEventListener('mouseenter', function() {
            const tooltipText = this.getAttribute('data-tooltip');
            const tooltipElement = document.createElement('div');
            tooltipElement.className = 'tooltip';
            tooltipElement.innerText = tooltipText;
            document.body.appendChild(tooltipElement);
            const rect = this.getBoundingClientRect();
            tooltipElement.style.left = `${rect.left + window.scrollX}px`;
            tooltipElement.style.top = `${rect.bottom + window.scrollY}px`;
        });

        tooltip.addEventListener('mouseleave', function() {
            const tooltipElement = document.querySelector('.tooltip');
            if (tooltipElement) {
                tooltipElement.remove();
            }
        });
    });

    // Handle sidebar toggle
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('admin-sidebar');
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    // Initialize data tables
    if (typeof $.fn.DataTable !== 'undefined') {
        $('.admin-table').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: false,
            pageLength: 10
        });
    }

    // Chart initialization
    const ctx = document.getElementById('adminChart').getContext('2d');
    const adminChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Registrations',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});