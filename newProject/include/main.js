$(document).ready(function() {
    // Load the default content (Apply Now page) into the main content area
    $('#content-area').load('apply_now.php');

    // Attach click event to navigation links
    $('.nav-link, .sidebar-nav-link').on('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        var target = $(this).data('target'); // Get the target from the data attribute
        $('#content-area').load(target + '.php'); // Load the corresponding content
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.nav-link');
    const contentArea = document.getElementById('content-area');
    const modeToggle = document.getElementById('modeToggle');
    const tooltipText = document.getElementById('modeTooltip');

    // Function to load content via AJAX
    function loadContent(page) {
        $.ajax({
            url: page,
            type: 'GET',
            success: function(data) {
                contentArea.innerHTML = data;
            },
            error: function() {
                contentArea.innerHTML = '<div class="alert alert-danger">Error loading content.</div>';
            }
        });
    }

    // Handle navigation click
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const targetPage = this.getAttribute('href');
            
            // Prevent navigation for logout link
            if (targetPage === 'logout.php') {
                // Handle logout via AJAX or redirect
                handleLogout();
                return;
            }
            
            // Load the content
            loadContent(targetPage);
        });
    });

    // Function to handle logout
    function handleLogout() {
        $.ajax({
            url: 'logout.php',
            type: 'GET',
            success: function(data) {
                // Show logout success message
                contentArea.innerHTML = '<div class="container mt-5"><div class="alert alert-success" role="alert"><strong>Success!</strong> You have been logged out successfully.</div><a href="login.php" class="btn btn-primary">Login Again</a></div>';
            },
            error: function() {
                contentArea.innerHTML = '<div class="alert alert-danger">Error logging out.</div>';
            }
        });
    }

    // Load default content


    // Handle mode toggle
    function toggleMode() {
        document.body.classList.toggle('dark-mode', modeToggle.checked);
    }

    modeToggle.addEventListener('change', function() {
        toggleMode();
        updateTooltip();
    });

    // Update tooltip text based on mode
    function updateTooltip() {
        tooltipText.innerHTML = modeToggle.checked ? "Dark Mode" : "Light Mode";
    }

    // Initialize tooltip text
    updateTooltip();

    // Initialize mode based on checkbox state
    toggleMode();
});
