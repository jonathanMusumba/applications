<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info mt-3">
            <i class="fas fa-user"></i> <strong>My Profile Details</strong>
            <a href="#" class="btn btn-danger btn-sm float-right" onclick="window.location.reload();">Reload</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fetch and display user details here -->
                    <?php
                    // Assuming you have a database connection already established
                    include 'db_connection.php';  // Adjust the path as necessary

                    // Retrieve user details using session user ID
                    session_start();
                    $userId = $_SESSION['user_id'];

                    $query = "SELECT surname, other_names, gender, nationality, email, phone, date_of_birth, last_login FROM users WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $stmt->bind_result($surname, $other_names, $gender, $nationality, $email, $phone, $date_of_birth, $last_login);

                    if ($stmt->fetch()) {
                        echo "<tr><td>Surname</td><td>$surname</td></tr>";
                        echo "<tr><td>Other Names</td><td>$other_names</td></tr>";
                        echo "<tr><td>Gender</td><td>$gender</td></tr>";
                        echo "<tr><td>Nationality</td><td>$nationality</td></tr>";
                        echo "<tr><td>Email</td><td>$email</td></tr>";
                        echo "<tr><td>Phone</td><td>$phone</td></tr>";
                        echo "<tr><td>Date of Birth</td><td>$date_of_birth</td></tr>";
                        echo "<tr><td>Last Login</td><td>$last_login</td></tr>";
                    } else {
                        echo "<tr><td colspan='2'>No profile details found.</td></tr>";
                    }

                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
