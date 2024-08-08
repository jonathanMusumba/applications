<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ludeb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT board_name, logo FROM examination_board ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$board_name = "Your Examination Board";
$logo = "default-logo.png"; // Default logo in case the query fails

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $board_name = $row['board_name'];
    $logo = $row['logo'];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('background.jpg') no-repeat center center fixed; /* Replace 'background-image.jpg' with your image path */
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #fff;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
        .container {
            z-index: 2;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .logo-container {
            margin-bottom: 20px;
        }
        .logo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px solid #007bff;
            padding: 10px;
            background-color: #fff;
        }
        h1 {
            font-weight: bold;
            font-size: 2.5rem;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            z-index: 2;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="logo-container">
            <img src="<?php echo htmlspecialchars($logo); ?>" alt="Logo" class="logo">
        </div>
        <h1><br>Welcome to <br> <?php echo htmlspecialchars($board_name); ?></br> <br> Results Management System</br></h1>
        <a href="login.php" class="btn btn-primary mt-4">Login</a>
    </div>

    <footer>
        <p>Powered by ILABS UGANDA LIMITED (Jonathan Musumba)</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
