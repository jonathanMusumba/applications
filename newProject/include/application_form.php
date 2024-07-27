<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <style>
        /* Add the necessary styles for light and dark mode, sidebar, top nav, content area, and the toast notifications */
body.light-mode {
/* Add the necessary styles for light and dark mode, sidebar, top nav, content area, and the toast notifications */
body.light-mode {
    background-color: #ffffff;
    color: #000000;
}

body.dark-mode {
    background-color: #000000;
    color: #ffffff;
}

.navbar, .sidebar {
    transition: background-color 0.3s, color 0.3s;
}

.dark-mode .navbar, .dark-mode .sidebar {
    background-color: #333333;
    color: #ffffff;
}

.nav-link.active, .dropdown-item.active {
    background-color: rgba(0, 0, 0, 0.1);
}

.toast {
    background-color: #ffffff;
    color: #000000;
}

.toast-header {
    background-color: #000000;
    color: #ffffff;
}

/* Custom styles for the sidebar and top bar */
.sidebar {
    height: 100%;
    width: 220px;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1;
    overflow-x: hidden;
    padding-top: 20px;
}

.sidebar .nav-link {
    padding: 15px 20px;
    font-size: 16px;
}

.navbar .navbar-brand, .navbar .nav-link, .navbar .form-check-label {
    font-weight: bold;
}

/* Ensure content fits within the main content area */
#content-area {
    margin-left: 240px; /* Adjust this if necessary to fit your layout */
    padding: 20px;
}


    </style>
</head>
< class="light-mode">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: green; color: white;">
        <a class="navbar-brand" href="#" style="color: white; margin-right: 30px;">Online Applications</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="messages.php" data-target="messages" style="font-weight: bold; color: white;">MESSAGES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="applications.php" data-target="applications" style="font-weight: bold; color: white;">APPLICATIONS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admissions.php" data-target="admissions" style="font-weight: bold; color: white;">ADMISSIONS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="apply_now.php" data-target="apply" style="font-weight: bold; color: white;">APPLY NOW</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profile.php" data-target="profile">MY PROFILE</a>
                        <a class="dropdown-item" href="change_password.php" data-target="change-password">CHANGE PASSWORD</a>
                        <a class="dropdown-item" href="logout.php" data-target="logout">LOGOUT</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="form-check ml-3 mode-toggle">
                        <div class="switch tooltip">
                            <input class="form-check-input" type="checkbox" id="modeToggle">
                            <span class="slider round" style="width: 40px; height: 20px;"></span>
                            <span class="tooltiptext" id="modeTooltip" style="color: white;">Dark Mode</span>
                        </div>
                        <label class="form-check-label" for="modeToggle" style="color: white;">Dark Mode</label>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Side Navigation -->
    <div class="sidebar d-none d-md-block" style="background-color: #f8f9fa; border-right: 1px solid black;">
        <div class="nav-item" style="border-bottom: 1px solid black; display: flex; align-items: center; justify-content: center; padding: 10px;">
            <img src="logo.png" alt="Logo" style="max-height: 100%; max-width: 100%; object-fit: contain;">
        </div>
        <div class="nav-item" style="border-bottom: 1px solid black;">
            <a class="nav-link sidebar-nav-link" href="apply_now.php" data-target="apply"><i class="fas fa-clipboard-list"></i>APPLY NOW</a>
        </div>
        <div class="nav-item" style="border-bottom: 1px solid black;">
            <a class="nav-link sidebar-nav-link" href="messages.php" data-target="messages"><i class="fas fa-envelope"></i>MESSAGES</a>
        </div>
        <div class="nav-item" style="border-bottom: 1px solid black;">
            <a class="nav-link sidebar-nav-link" href="admissions.php" data-target="admissions"><i class="fas fa-graduation-cap"></i>ADMISSIONS</a>
        </div>
        <div class="nav-item" style="border-bottom: 1px solid black;">
            <a class="nav-link sidebar-nav-link" href="applications.php" data-target="applications"><i class="fas fa-archive"></i>APPLICATIONS</a>
        </div>
        <div class="nav-item">
            <a class="nav-link sidebar-nav-link" href="profile.php" data-target="profile"><i class="fas fa-user"></i> MY PROFILE</a>
        </div>
        <div class="nav-item" style="border-bottom: 1px solid black;">
            <a class="nav-link sidebar-nav-link" href="change_password.php" data-target="change-password"><i class="fas fa-key"></i> CHANGE PASSWORD</a>
        </div>
        <div class="nav-item" style="border-bottom: 1px solid black;">
            <a class="nav-link sidebar-nav-link" href="logout.php" data-target="logout"><i class="fas fa-sign-out-alt"></i>LOGOUT</a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div id="content-area" class="container mt-3">
        <!-- Content will be loaded here -->
        <div class="alert alert-info mt-3">
            <span class="circle-exclamation">
                <i class="fas fa-exclamation"></i>
            </span>
            <strong>APPLY FOR CERTIFICATE, DIPLOMA DIRECT AND FOR EXTENSIONS!</strong>
        </div>
        <div class="container mt-4">
            <div class="row">
                <!-- Intake Information Section (Sample) -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">ACADEMIC YEAR: 2024</h5>
                            <p class="card-text">INTAKE: January</p>
                            <p class="card-text">RUNNING FROM: 01/01/2024 TO 31/12/2024</p>
                            <p class="card-text">REMAINING TIME: <!-- Calculation for remaining time here --></p>
                            <p class="card-text">NUMBER OF COURSES YOU CAN APPLY FOR: 1</p>
                            <p class="card-text">NUMBER OF FORMS YOU CAN FILL: 1</p>
                            <p class="card-text">APPLICATION STATUS: Running</p>
                            <p class="card-text">DESCRIPTION: Sample intake description.</p>
                            <p class="card-text">ADMISSION FEES: For Ugandans: UGX. 50,000, For NON-UGANDANS: UGX. 50,000</p>
                            <button class="btn btn-success btn-apply-now">APPLY NOW</button>
                        </div>
                    </div>
                </div>
                <!-- Repeat for other intakes -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> <!-- Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
  <!--<script src="main.js"></script> -->
    <script>
        $(document).ready(function() {
    // Default content on page load
    $('#content-area').html(`
        <div class="alert alert-info mt-3">
            <span class="circle-exclamation">
                <i class="fas fa-exclamation"></i>
            </span>
            <strong>APPLY FOR CERTIFICATE, DIPLOMA DIRECT AND FOR EXTENSIONS!</strong>
        </div>
        <div class="container mt-4">
            <div class="row">
                <?php foreach ($activeIntakes as $index => $intake): ?>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">ACADEMIC YEAR: <?php echo htmlspecialchars($intake['intake_year']); ?></h5>
                                <p class="card-text">INTAKE: <?php echo htmlspecialchars($intake['intake_month']); ?></p>
                                <p class="card-text">RUNNING FROM: <?php echo htmlspecialchars($intake['start_date']); ?> TO <?php echo htmlspecialchars($intake['end_date']); ?></p>
                                <p class="card-text">REMAINING TIME: <!-- Calculation for remaining time here --></p>
                                <p class="card-text">NUMBER OF COURSES YOU CAN APPLY FOR: 1</p>
                                <p class="card-text">NUMBER OF FORMS YOU CAN FILL: 1</p>
                                <p class="card-text">APPLICATION STATUS: <?php echo htmlspecialchars($intake['intake_status']); ?></p>
                                <p class="card-text">DESCRIPTION: <?php echo htmlspecialchars($intake['description']); ?></p>
                                <p class="card-text">ADMISSION FEES: For Ugandans: UGX. 50,000, For NON-UGANDANS: UGX. 50,000</p>
                                <?php if (strtolower($intake['intake_status']) == 'running'): ?>
                                    <button class="btn btn-success btn-apply-now" data-intake-year="<?php echo htmlspecialchars($intake['intake_year']); ?>" data-intake-month="<?php echo htmlspecialchars($intake['intake_month']); ?>">APPLY NOW</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    `);

    // Function to load content dynamically and activate corresponding menu items
    function loadContent(url, callback) {
        $('#content-area').load(url, function() {
            if (callback) callback();
        });
    }

    function setActiveState(target) {
        $('.nav-link, .dropdown-item').removeClass('active');
        $(`.nav-link[data-target="${target}"], .dropdown-item[data-target="${target}"]`).addClass('active');
    }

    $('.nav-link, .dropdown-item').on('click', function(event) {
        event.preventDefault();
        var targetUrl = $(this).attr('href');
        var targetData = $(this).data('target');

        // Load content dynamically
        loadContent(targetUrl, function() {
            setActiveState(targetData);
        });

        // Display toast notification for login and logout
        if (targetData === 'logout') {
            showToast('Logout successful!');
        } else if (targetData === 'profile') {
            showToast('Login successful!');
        }
    });

    // Function to show toast notification
    function showToast(message) {
        var toastHtml = `
            <div class="toast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                <div class="toast-header">
                    <strong class="mr-auto">Notification</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;

        $('body').append(toastHtml);
        $('.toast').toast({ delay: 3000 });
        $('.toast').toast('show');

        setTimeout(function() {
            $('.toast').remove();
        }, 3500);
    }

    // Toggle dark mode
    $('#modeToggle').on('change', function() {
        $('body').toggleClass('dark-mode light-mode');
        $('#modeTooltip').text($(this).is(':checked') ? 'Light Mode' : 'Dark Mode');
    });
});

    </script> 
</body>
</html>
