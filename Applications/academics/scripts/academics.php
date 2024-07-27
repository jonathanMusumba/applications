<?php
// Start session to access user data
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$districts = [];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: ../applicants/index.php");
    exit();
}

// Retrieve formID from query parameters
$formID = isset($_GET['formID']) ? $_GET['formID'] : null;
$progress = calculateProgress($formID);
 
$formStatus = 'Pending';// Replace with your logic to calculate progress

function calculateProgress($formID) {
    // Example logic to calculate progress based on form completion
    $totalSteps = 4; // Total number of steps (tabs)
    $completedSteps = 0; // Initialize completed steps

    // Logic to check completion of each section based on formID or other criteria
    // For demonstration, assume completedSteps based on form's progress
    switch ($formID) {
        case 'O-Level':
            $completedSteps = 1; // Example: O-Level Information completed
            break;
        case 'A-Level':
            $completedSteps = 2; // Example: A-Level Information completed
            break;
        case 'Other-Qualifications':
            $completedSteps = 3; // Example: Other Qualifications completed
            break;
        case 'Review-Submit':
            $completedSteps = 4; // Example: Review and Submit completed
            break;
        default:
            $completedSteps = 0;
            break;
    }
    if ($totalSteps > 0) {
        $progress = ($completedSteps / $totalSteps) * 100;
    } else {
        $progress = 0;
    }

    return $progress;
    
}
$userData = [];
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
if (!empty($userData['dob'])) {
    $dob = date('d/m/Y', strtotime($userData['dob'])); // Format the dob from database
} else {
    $dob = ''; // Default value if dob is not available
}
$fullName = $userData['surname'] . ' ' . $userData['otherNames'];
?>