<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to custom external CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> <!-- jQuery UI CSS -->

    <!-- jQuery and jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!-- jQuery UI -->

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
</head>
<body class="light-mode">
<!-- Top Navigation -->
<nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: green; color: white;">
    <a class="navbar-brand" href="#" style="color: white; margin-right: 30px;">Online Applications</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="messages">MESSAGES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="applications">APPLICATIONS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="admissions">ADMISSIONS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="apply_now">APPLY NOW</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> Profile
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" data-target="profile">MY PROFILE</a>
                    <a class="dropdown-item" href="#" data-target="password_change">CHANGE PASSWORD</a>
                    <a class="dropdown-item" href="logout.php" data-target="logout">LOGOUT</a>
                </div>
            </li>
        </ul>
        <div class="form-check ml-3 mode-toggle">
            <div class="switch tooltip">
                <input class="form-check-input" type="checkbox" id="modeToggle">
                <span class="slider round" style="width: 40px; height: 20px;"></span>
                <span class="tooltiptext" id="modeTooltip" style="color: white;">Dark Mode</span>
            </div>
            <label class="form-check-label" for="modeToggle" style="color: white;">Dark Mode</label>
        </div>
    </div>
</nav>

<!-- Side Navigation -->
<div class="sidebar d-none d-md-block" style="background-color: #f8f9fa; border-right: 1px solid black;">
    <div class="nav-item" style="border-bottom: 1px solid black; display: flex; align-items: center; justify-content: center; padding: 10px;">
        <img src="logo.png" alt="Logo" style="max-height: 100%; max-width: 100%; object-fit: contain;">
    </div>
    <div class="nav-item" style="border-bottom: 1px solid black;">
        <a class="nav-link sidebar-nav-link" href="#" data-target="apply_now"><i class="fas fa-clipboard-list"></i> APPLY NOW</a>
    </div>
    <div class="nav-item" style="border-bottom: 1px solid black;">
        <a class="nav-link sidebar-nav-link" href="#" data-target="messages"><i class="fas fa-envelope"></i> MESSAGES</a>
    </div>
    <div class="nav-item" style="border-bottom: 1px solid black;">
        <a class="nav-link sidebar-nav-link" href="#" data-target="admissions"><i class="fas fa-graduation-cap"></i> ADMISSIONS</a>
    </div>
    <div class="nav-item" style="border-bottom: 1px solid black;">
        <a class="nav-link sidebar-nav-link" href="#" data-target="applications"><i class="fas fa-archive"></i> APPLICATIONS</a>
    </div>
    <div class="nav-item" style="border-bottom: 1px solid black;">
        <a class="nav-link sidebar-nav-link" href="#" data-target="profile"><i class="fas fa-user"></i> MY PROFILE</a>
    </div>
    <div class="nav-item" style="border-bottom: 1px solid black;">
        <a class="nav-link sidebar-nav-link" href="#" data-target="password_change"><i class="fas fa-key"></i> CHANGE PASSWORD</a>
    </div>
    <div class="nav-item" style="border-bottom: 1px solid black;">
        <a class="nav-link sidebar-nav-link" href="logout.php" data-target="logout"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
    </div>
</div>

<!-- Main Content Area -->
<div id="content-area" class="container mt-5 pt-4">
    <!-- Content will be loaded here -->
    <div class="alert alert-info mt-3">
        <span class="circle-exclamation">
            <i class="fas fa-exclamation"></i>
        </span>
        <strong>APPLY FOR CERTIFICATE, DIPLOMA DIRECT AND FOR EXTENSIONS!</strong>
    </div>
</div>

<!-- Toasts -->
<div class="toast-container position-fixed bottom-0 right-0 p-3" style="z-index: 1050;">
    <!-- Toasts will be dynamically added here -->
</div>

<script>
$(document).ready(function () {
    // Function to load content
    function loadContent(target) {
        $('#content-area').load(target + '.php', function (response, status, xhr) {
            if (status == "error") {
                $('#content-area').html('<p>Error loading content: ' + xhr.status + ' ' + xhr.statusText + '</p>');
            }
        });
    }

    function setActiveState(target) {
        // Remove active class from all nav links
        $('.nav-link').removeClass('active');
        $('.sidebar-nav-link').removeClass('active');

        // Add active class to the clicked nav link
        $('.nav-link[data-target="' + target + '"]').addClass('active');
        $('.sidebar-nav-link[data-target="' + target + '"]').addClass('active');
    }

    // Load initial dashboard content
    loadContent('dashboard');

    // Set up click event handlers for top navigation
    $('.nav-link').on('click', function (e) {
        e.preventDefault();
        var target = $(this).data('target');

        // Set active state and load content
        setActiveState(target);
        loadContent(target);
    });

    // Handle sidebar link clicks
    $('.sidebar-nav-link').on('click', function (e) {
        e.preventDefault();
        var target = $(this).data('target');

        // Set active state and load content
        setActiveState(target);
        loadContent(target);
    });

    // Function to show toasts
    function showToast(message) {
        var toastHTML = '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">' +
                            '<div class="toast-body">' + message + '</div>' +
                        '</div>';
        $('.toast-container').append(toastHTML);
        $('.toast').toast({ delay: 5000 });
        $('.toast').toast('show');
    }

    // Example toast for login
    showToast('You are logged in');
});
</script>
</body>
</html>
