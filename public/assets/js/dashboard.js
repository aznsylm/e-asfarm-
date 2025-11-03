// Sidebar Toggle for Mobile
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        }
    });

    // Active menu highlight
    const currentPath = window.location.pathname;
    const menuItems = document.querySelectorAll('.sidebar-menu .menu-item a');
    
    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentPath) {
            item.closest('.menu-item').classList.add('active');
        }
    });
});
