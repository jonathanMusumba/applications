<?php
session_start();

$error = '';

// Database connection
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

// Query to fetch registered users data
$sql = "SELECT surname, otherNames, dob, sex, email, phone, nationality, creation_date, applicantNumber, last_login FROM users";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Registered Users</h1>
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Surname</th>
                            <th scope="col">Other Names</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Nationality</th>
                            <th scope="col">Created On</th>
                            <th scope="col">Applicant Number</th>
                            <th scope="col">Last Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['surname']); ?></td>
                                <td><?php echo htmlspecialchars($row['otherNames']); ?></td>
                                <td><?php echo htmlspecialchars($row['dob']); ?></td>
                                <td><?php echo htmlspecialchars($row['sex']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['nationality']); ?></td>
                                <td><?php echo htmlspecialchars($row['creation_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['applicantNumber']); ?></td>
                                <td><?php echo isset($_SESSION['last_login']) ? htmlspecialchars($_SESSION['last_login']) : 'N/A'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No registered users found.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>

    <!-- Bootstrap JS and dependencies (for optional features like tooltips, popovers, etc.) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>