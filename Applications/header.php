<?php
// Placeholder for login/logout functionality
$loggedIn = false; // Assuming the user is not logged in initially
$userSurname = ''; // Placeholder for the user's surname

// Check if user is logged in and retrieve surname from database
if ($loggedIn) {
    // Example database connection and query
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "LINMS";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Example query to fetch user's surname
    $userId = $_SESSION['user_id']; // Assuming you have the user ID stored in session
    $sql = "SELECT surname FROM users WHERE id = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the first row (assuming only one row expected)
        $row = $result->fetch_assoc();
        $userSurname = $row["surname"];
    } else {
        echo "0 results";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .header {
            background-color: #4a90e2;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navigation {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navigation li {
            margin-right: 20px;
        }

        .navigation li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .navigation li a:hover {
            color: #8bc34a;
        }

        .navigation li a:visited {
            color: white;
        }

        .active {
            color: #D2691E;
        }

        .login-btn, .logout-btn {
            color: white;
            text-decoration: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            position: relative;
        }

        .login-btn .fas, .logout-btn .fas {
            margin-right: 5px;
        }

        .tooltip {
            visibility: hidden;
            width: 120px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            top: -30px;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .login-btn:hover .tooltip, .logout-btn:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">Your Logo</div>
        <ul class="navigation">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">My Applications</a></li>
            <li><a href="#">Apply Now</a></li>
            <?php
            if ($loggedIn) {
                // If logged in, show logout link in navigation
                echo '<li>Welcome ' . $userSurname . '</li>';
                echo '<li><a href="#" class="logout-btn">';
                echo '<i class="fas fa-sign-out-alt" aria-hidden="true"></i>';
                echo '<span class="tooltip">Logout</span>';
                echo '</a></li>';
            } else {
                // If user is not logged in, display login button
                echo '<li><a href="#" class="login-btn">';
                echo '<i class="fas fa-sign-in-alt" aria-hidden="true"></i>';
                echo '<span class="tooltip">Login</span>';
                echo '</a></li>';
            }
            ?>
        </ul>
        <div>
            <span id="current-date"><?php echo date("l, F jS Y"); ?></span>
        </div>
    </div>

    <!-- Bootstrap JS (optional, if needed for other functionality) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome JS (optional, if needed for other functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>

</html>
