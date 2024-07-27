<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Add your custom CSS here */
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header">
                <h3>Admin Dashboard</h3>
            </div>
            <ul class="list-unstyled components">
                <li><a href="#posts">Manage Posts</a></li>
                <li><a href="#comments">Manage Comments</a></li>
                <li><a href="#advertisements">Manage Advertisements</a></li>
                <li><a href="#messages">Manage Messages</a></li>
                <li><a href="#notices">Manage Notices</a></li>
                <li><a href="#super-admin">Super Admin</a></li>
            </ul>
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="toggle-dark-mode">Toggle Dark Mode</a>
                </li>
                <li>
                    <a href="logout.php" class="logout">Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                </div>
            </nav>
            <div class="container">
                <!-- Include the content sections here -->
                <div id="posts"> <!-- Manage Posts Section --></div>
                <div id="comments"> <!-- Manage Comments Section --></div>
                <div id="advertisements"> <!-- Manage Advertisements Section --></div>
                <div id="messages"> <!-- Manage Messages Section --></div>
                <div id="notices"> <!-- Manage Notices Section --></div>
                <div id="super-admin"> <!-- Super Admin Section --></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

            $('.toggle-dark-mode').on('click', function () {
                $('body').toggleClass('dark-mode');
            });
        });
    </script>
    <style>
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
    </style>
</body>
</html>
