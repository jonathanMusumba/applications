<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Dashboard</title>

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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 sidebar" style="background-color: #f8f9fa; border-right: 1px solid black; padding: 20px; height: 100vh;">
                <div class="nav-item" style="border-bottom: 1px solid black; display: flex; align-items: center; justify-content: center; padding: 10px;">
                    <img src="logo.png" alt="Logo" style="max-height: 60px; max-width: 100%; object-fit: contain;">
                </div>
                <div class="nav-item" style="border-bottom: 1px solid black;">
                    <a class="nav-link sidebar-nav-link" href="#" data-tab="dashboard">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </div>
                <div class="nav-item" style="border-bottom: 1px solid black;">
                    <a class="nav-link sidebar-nav-link" href="#" data-tab="apply-now">
                        <i class="fas fa-clipboard-list"></i> Apply Now
                    </a>
                </div>
                <div class="nav-item" style="border-bottom: 1px solid black;">
                    <a class="nav-link sidebar-nav-link" href="#" data-tab="application-history">
                        <i class="fas fa-history"></i> Application History
                    </a>
                </div>
                <div class="nav-item" style="border-bottom: 1px solid black;">
                    <a class="nav-link sidebar-nav-link" href="#" data-tab="admission-history">
                        <i class="fas fa-graduation-cap"></i> Admission History
                    </a>
                </div>
                <div class="nav-item" style="border-bottom: 1px solid black;">
                    <a class="nav-link sidebar-nav-link" href="#" data-tab="my-profile">
                        <i class="fas fa-user"></i> My Profile
                    </a>
                </div>
                <div class="nav-item" style="border-bottom: 1px solid black;">
                    <a class="nav-link sidebar-nav-link" href="#" data-tab="messages">
                        <i class="fas fa-envelope"></i> Messages
                    </a>
                </div>
                <div class="nav-item" style="border-bottom: 1px solid black;">
                    <a class="nav-link sidebar-nav-link" href="#" data-tab="change-password">
                        <i class="fas fa-key"></i> Change Password
                    </a>
                </div>
                <div class="nav-item" style="border-bottom: 1px solid black;">
                    <a class="nav-link sidebar-nav-link" href="logout.php" data-tab="logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 main-content" style="padding: 20px;">
                <nav class="top-nav" style="margin-bottom: 20px; background-color: #e9ecef; padding: 10px;">
                    <button data-tab="dashboard" class="btn btn-light">Dashboard</button>
                    <button data-tab="apply-now" class="btn btn-light">Apply Now</button>
                    <button data-tab="application-history" class="btn btn-light">Application History</button>
                    <button data-tab="admission-history" class="btn btn-light">Admission History</button>
                    <button data-tab="my-profile" class="btn btn-light">My Profile</button>
                    <button data-tab="messages" class="btn btn-light">Messages</button>
                    <button data-tab="change-password" class="btn btn-light">Change Password</button>
                    <button data-tab="logout" class="btn btn-light">Logout</button>
                </nav>
                <div class="content" id="content">
                    <!-- Dynamic content will be loaded here -->
                    <div class="alert alert-info mt-3">
                        <span class="circle-exclamation">
                            <i class="fas fa-exclamation"></i>
                        </span>
                        <strong>Welcome! Please select an option from the navigation.</strong>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        // Function to load content
        function loadContent(tab) {
            $('#content').load(tab + '.php', function (response, status, xhr) {
                if (status === "error") {
                    $('#content').html('<p>Error loading content: ' + xhr.status + ' ' + xhr.statusText + '</p>');
                }
            });
        }

        // Function to set active state
        function setActiveState(tab) {
            // Remove active class from all links and buttons
            $('.sidebar a').removeClass('active');
            $('.top-nav button').removeClass('active');

            // Add active class to the clicked link or button
            $('.sidebar a[data-tab="' + tab + '"]').addClass('active');
            $('.top-nav button[data-tab="' + tab + '"]').addClass('active');
        }

        // Load initial dashboard content
        loadContent('dashboard');

        // Click event handler for sidebar links
        $('.sidebar a').on('click', function (e) {
            e.preventDefault();
            var tab = $(this).data('tab');
            setActiveState(tab);
            loadContent(tab);
        });

        // Click event handler for top navigation buttons
        $('.top-nav button').on('click', function () {
            var tab = $(this).data('tab');
            setActiveState(tab);
            loadContent(tab);
        });
    });
    </script>
</body>
</html>
