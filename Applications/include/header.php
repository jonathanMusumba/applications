<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application form_Biodata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        body {
            background-color: #e0f7fa; /* Light cyan background for the body */
            color: #000; /* Default text color */
        }
        .header {
            background-color: #4caf50; /* Green background for header */
            color: #fff; /* White text color for header */
            padding: 10px 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .navbar {
            width: 100%;
        }
        .navbar-nav {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .nav-item {
            margin: 0 10px;
        }
        .nav-link {
            color: #fff; /* White text for navigation links */
        }
        .nav-link:hover {
            color: #ffeb3b; /* Yellow text on hover */
        }
        .apply-now {
            font-weight: bold;
            color: #ffeb3b; /* Yellow for Apply Now link */
        }
        .logout-btn, .login-btn {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #fff; /* White text for buttons */
        }
        .tooltip {
            margin-left: 5px;
        }
        #current-date {
            margin-top: 10px;
            color: #fff; /* White text for date */
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
        }
        input:checked + .slider {
            background-color: #2196f3;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info span {
            margin-right: 10px;
            color: #fff; /* White text for user info */
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">LUBEGA INSTITUTE ONLINE APPLICATION</div>
        <nav class="navbar navbar-expand-md navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link apply-now">Apply Now</a></li>
                    <li class="nav-item"><a href="../applicationHistory.php" class="nav-link applications">My Applications</a></li>
                    <li class="nav-item"><a href="../admissionHistory.php" class="nav-link admissions">My Admissions</a></li>
                </ul>
            </div>
        </nav>
        <div class="user-info">
            <?php
            if ($loggedIn) {
                echo '<span>Welcome ' . $userData['surname'] . '</span>';
                echo '<a href="../../applicants/logout.php" class="logout-btn">';
                echo '<i class="fas fa-sign-out-alt" aria-hidden="true"></i>';
                echo '<span class="tooltip">Logout</span>';
                echo '</a>';
            } else {
                echo '<a href="#" class="login-btn">';
                echo '<i class="fas fa-sign-in-alt" aria-hidden="true"></i>';
                echo '<span class="tooltip">Login</span>';
                echo '</a>';
            }
            ?>
        </div>
        <div>
            <span id="current-date"><?php echo date("l, F jS Y"); ?></span>
        </div>
        <div>
            <label class="switch">
                <input type="checkbox" id="dark-mode-toggle">
                <span class="slider round"></span>
            </label>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
