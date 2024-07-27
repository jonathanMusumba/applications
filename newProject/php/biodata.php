<?php

include_once("db_connection.php");

// Function to get the last form ID
function getLastFormID($conn) {
    $sql = "SELECT form_id FROM form_id_sequence ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        return $row['form_id'];
    }
    return null; // Default if no form ID is found
}

// Function to save a new form ID into the database
function saveFormID($conn, $formID) {
    $stmt = $conn->prepare("INSERT INTO form_id_sequence (form_id) VALUES (?)");
    $stmt->bind_param("s", $formID);
    $stmt->execute();
    $stmt->close();
}

// Function to generate a new sequential form ID
function generateFormID($conn) {
    $lastFormID = getLastFormID($conn);
    $year = date('y');
    $prefix = $year . 'LNMS';

    if ($lastFormID) {
        $lastNumber = intval(substr($lastFormID, 6, 6));
        $nextNumber = $lastNumber + 1;
        $formattedNumber = str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    } else {
        $formattedNumber = '000001'; // Starting number
    }

    $newFormID = $prefix . $formattedNumber;
    saveFormID($conn, $newFormID);

    return $newFormID;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize database connection
    $conn = new mysqli("localhost", "root", "", "LINMS");
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Generate and use the new form ID
    $formID = generateFormID($conn);

    // Process the biodata
    $biodata = [
        'salutation' => $_POST['salutation'],
        'surname' => $_POST['surname'],
        'otherNames' => $_POST['otherNames'],
        'sex' => $_POST['sex'],
        'dateOfBirth' => $_POST['dateOfBirth'],
        'nationality' => $_POST['nationality'],
        'districtOfResidence' => $_POST['districtOfResidence'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'nationalIdNumber' => $_POST['nationalIdNumber'],
        'maritalStatus' => $_POST['maritalStatus'],
        'religion' => $_POST['religion'],
        'linNumber' => $_POST['linNumber']
    ];

    // Encode biodata as JSON
    $biodata_json = json_encode($biodata);

    // Prepare SQL statement to insert biodata
    $stmt = $conn->prepare("
        INSERT INTO apply (
            formID, Biodata_information, Form_status, Create_date
        ) VALUES (?, ?, 'Incomplete', CURDATE())
    ");
    $stmt->bind_param(
        "ss", 
        $formID, $biodata_json
    );

    // Execute statement
    if ($stmt->execute()) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

// Check if user is logged in
$districts = [];
$userData = [];
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Initialize a new connection
    $conn = new mysqli("localhost", "root", "", "LINMS");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
    $stmt->close();
    $conn->close();
} else {
    echo "User not logged in.";
    exit();
}

// Initialize a new connection to fetch districts
$conn = new mysqli("localhost", "root", "", "LINMS");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    $stmt = $conn->query("SELECT id, district_name FROM districts");
    while ($row = $stmt->fetch_assoc()) {
        $districts[] = $row;
    }
} catch (Exception $e) {
    echo "Error fetching districts: " . $e->getMessage();
    exit();
}
$stmt->close();
$conn->close();
?>


<div class="container mt-4">
<div class="container mt-4">
<div class="container mt-4">
        <form id="biodataForm" class="border p-4 rounded shadow-sm" method="POST" action="">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="salutation" class="form-label">Salutation</label>
                    <select id="salutation" name="salutation" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Mr">Mr</option>
                        <option value="Ms">Ms</option>
                        <option value="Mrs">Mrs</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="surname" class="form-label">Surname</label>
                    <input type="text" id="surname" name="surname" class="form-control" readonly value="<?php echo htmlspecialchars($userData['surname'] ?? ''); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="otherNames" class="form-label">Other Names</label>
                    <input type="text" id="otherNames" name="otherNames" class="form-control" readonly value="<?php echo htmlspecialchars($userData['otherNames'] ?? ''); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="sex" class="form-label">Sex</label>
                    <input type="text" id="sex" name="sex" class="form-control" readonly value="<?php echo htmlspecialchars($userData['sex'] ?? ''); ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                    <input type="date" id="dateOfBirth" name="dateOfBirth" class="form-control" readonly value="<?php echo htmlspecialchars($userData['dob'] ?? ''); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="nationality" class="form-label">Nationality</label>
                    <input type="text" id="nationality" name="nationality" class="form-control" readonly value="<?php echo htmlspecialchars($userData['nationality'] ?? ''); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="districtOfResidence" class="form-label">District of Residence</label>
                    <select id="districtOfResidence" name="districtOfResidence" class="form-control" required>
                        <option value="">Select</option>
                        <?php foreach ($districts as $district): ?>
                            <option value="<?php echo htmlspecialchars($district['district_name']); ?>">
                                <?php echo htmlspecialchars($district['district_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" readonly value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" readonly value="<?php echo htmlspecialchars($userData['phone'] ?? ''); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="nationalIdNumber" class="form-label">National ID Number</label>
                    <input type="text" id="nationalIdNumber" name="nationalIdNumber" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="maritalStatus" class="form-label">Marital Status</label>
                    <select id="maritalStatus" name="maritalStatus" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="religion" class="form-label">Religion</label>
                    <input type="text" id="religion" name="religion" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="linNumber" class="form-label">LIN Number</label>
                    <input type="text" id="linNumber" name="linNumber" class="form-control">
                </div>
            </div>
            <input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
            <button type="submit" class="btn btn-primary">Save Biodata</button>
        </form>
    </div>