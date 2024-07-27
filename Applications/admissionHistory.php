<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Fetch admission history
$query = "SELECT * FROM admissions WHERE applicant_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$admissions = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    try {
        $stmt = $conn->prepare("SELECT id, surname, otherNames, dob, sex, email, phone, nationality, applicantNumber FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();
        $loggedIn = true;
    } catch (Exception $e) {
        echo "Error fetching user data: " . $e->getMessage();
        exit();
    }
} else {
    echo "User not logged in.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
 <?php include_once("include/academics_header.php"); ?>
    <div class="container mt-5">
        <h1>Admission History</h1>
        <button class="btn btn-primary btn-reload" onclick="window.location.reload();">Reload</button>
        
        <?php if (count($admissions) > 0) : ?>
            <?php foreach ($admissions as $admission) : ?>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Congratulations, you have been admitted to the Program:</h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($admission['program_name']); ?> for the Academic Year <?php echo htmlspecialchars($admission['academic_year']); ?></h6>
                        <table class="table table-bordered mt-3">
                            <tbody>
                                <tr>
                                    <td><strong>Program Name</strong></td>
                                    <td><?php echo htmlspecialchars($admission['program_name']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Department</strong></td>
                                    <td><?php echo htmlspecialchars($admission['department']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Academic Year</strong></td>
                                    <td><?php echo htmlspecialchars($admission['academic_year']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Entry Type</strong></td>
                                    <td><?php echo htmlspecialchars($admission['entry_type']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tuition</strong></td>
                                    <td><?php echo htmlspecialchars($admission['tuition']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="download_provisional_letter.php?admission_id=<?php echo $admission['id']; ?>" class="btn btn-success">Download Provisional Letter</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No admission history found.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    // Check if dark mode preference is saved in local storage
    const currentMode = localStorage.getItem('darkMode');
    if (currentMode === 'dark') {
        enableDarkMode();
        darkModeToggle.checked = true;
    } else {
        enableLightMode(); // Default to light mode
        darkModeToggle.checked = false;
    }

    // Listen for changes in the checkbox
    darkModeToggle.addEventListener('change', function() {
        if (darkModeToggle.checked) {
            enableDarkMode();
            localStorage.setItem('darkMode', 'dark'); // Save dark mode preference
        } else {
            enableLightMode();
            localStorage.setItem('darkMode', 'light'); // Save light mode preference
        }
    });

    // Function to enable dark mode
    function enableDarkMode() {
        document.body.classList.add('dark-mode');
        // Change text color to white when dark mode is enabled
        document.querySelectorAll('.header li a').forEach(function(link) {
            link.style.color = '#fff';
        });
    }s

    // Function to enable light mode
    function enableLightMode() {
        document.body.classList.remove('dark-mode');
        // Reset text color when light mode is enabled (assuming your default styles handle this)
        document.querySelectorAll('.header li a').forEach(function(link) {
            link.style.color = ''; // Reset to default or CSS defined color
        });
    }
});

    </script>
   
</body>
</html>
