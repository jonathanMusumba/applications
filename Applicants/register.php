<?php
session_start();
include __DIR__ . '/../db_connection/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $surname = htmlspecialchars(trim($_POST['surname']));
    $otherNames = htmlspecialchars(trim($_POST['otherNames']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $nationality = htmlspecialchars(trim($_POST['nationality']));
    $dob = htmlspecialchars(trim($_POST['dob']));
    $sex = htmlspecialchars(trim($_POST['sex']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));
    $passwordHint = htmlspecialchars(trim($_POST['passwordHint']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: register.html");
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: register.html");
        exit();
    }

    // Normalize phone number
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phone) == 10 && substr($phone, 0, 1) == '0') {
        $phone = '256' . substr($phone, 1);
    }

    if (strlen($phone) > 12) {
        $_SESSION['error'] = "Invalid phone number format.";
        header("Location: register.html");
        exit();
    }

    // Convert DOB to yyyy-mm-dd
    $dobArray = explode("/", $dob);
    if (count($dobArray) == 3) {
        $dob = $dobArray[2] . '-' . $dobArray[1] . '-' . $dobArray[0];
    } else {
        $_SESSION['error'] = "Invalid date format. Please use dd/mm/yyyy.";
        header("Location: register.html");
        exit();
    }

    // Create mysqli connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "LINMS";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Generate Applicant Number
       // Generate Applicant Number
       function generateApplicantNumber($conn) {
        $currentYear = date('y'); // Last two digits of the current year
        $numberStart = 1000001; // Starting number if no records exist for the year
    
        // Check the last used number in the users table for the current year
        $query = "SELECT MAX(SUBSTRING(applicantNumber, 7, 7)) AS lastNumber FROM users WHERE applicantNumber LIKE ?";
        $stmt = $conn->prepare($query);
        $prefix = "LINMS{$currentYear}%";
        $stmt->bind_param('s', $prefix);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastNumber = $row['lastNumber'];
            if ($lastNumber !== null) {
                $newNumber = intval($lastNumber) + 1;
            } else {
                $newNumber = $numberStart;
            }
        } else {
            $newNumber = $numberStart;
        }
    
        // Generate random letter
        $randomLetter = chr(rand(65, 90)); // Generate a random uppercase letter
    
        // Construct applicant number
        $applicantNumber = "LINMS{$currentYear}{$newNumber}{$randomLetter}";
    
        return $applicantNumber;
    }
    // Generate applicant number
    $applicantNumber = generateApplicantNumber($conn);

    // Hash passwords
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_password_hint = password_hash($passwordHint, PASSWORD_DEFAULT);

    // Store applicant data in session for confirmation page
    $applicant_data = [
        'surname' => $surname,
        'otherNames' => $otherNames,
        'email' => $email,
        'phone' => $phone,
        'nationality' => $nationality,
        'dob' => $dob,
        'sex' => $sex,
        'applicantNumber' => $applicantNumber,
        'password' => $hashed_password,
        'password_hint' => $hashed_password_hint
    ];
    $_SESSION['applicant_data'] = $applicant_data;

    // Check if email or phone already exists
    $stmt_check = $conn->prepare("SELECT * FROM users WHERE email=? OR phone=?");
    $stmt_check->bind_param('ss', $email, $phone);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email or phone number already registered.";
        header("Location: register.html");
        exit();
    }

    // Insert applicant data into the database
    $stmt_insert = $conn->prepare("INSERT INTO users (surname, otherNames, email, phone, nationality, dob, sex, applicantNumber, password, password_hint, is_verified) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, TRUE)");
    $stmt_insert->bind_param('ssssssssss', $surname, $otherNames, $email, $phone, $nationality, $dob, $sex, $applicantNumber, $hashed_password, $hashed_password_hint);

    try {
        $conn->begin_transaction();

        // Insert into users table
        $stmt_insert->execute();

        // Commit transaction
        $conn->commit();

        // Redirect to confirmation page
        header("Location: confirmation.php");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: register.html");
        exit();
    } finally {
        // Close connection
        $conn->close();
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: register.html");
    exit();
}
?>
