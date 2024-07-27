// admin/js/admin_scripts.js
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar for small screens
    const sidebarToggle = document.querySelector('.navbar-toggler');
    const sidebar = document.querySelector('.sidebar');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('open');
    });

    // Toggle dark mode
    const darkModeToggle = document.querySelector('#darkModeToggle');
    const body = document.body;

    darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
    });
});
// admin/js/admin_scripts.js
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar for small screens
    const sidebarToggle = document.querySelector('.navbar-toggler');
    const sidebar = document.querySelector('.sidebar');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('open');
    });

    // Toggle dark mode
    const darkModeToggle = document.querySelector('#darkModeToggle');
    const body = document.body;

    darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
    });
});

