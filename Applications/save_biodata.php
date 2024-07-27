<?php
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

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sqlCreateDB) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db($dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables with default values or $_POST data
    // (Ensure all variables are initialized as per your form fields)

    // Generate Form ID: LINMS{y}1{random Character(A-Z, but not I and O}001(A-Z, but not I and O}
    $currentYear = date('y');

    // Function to generate a random character from A-Z excluding I and O
    function getRandomChar() {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ'; // Excluding I and O
        $randomChar = $characters[rand(0, strlen($characters) - 1)];
        return $randomChar;
    }
    
    // Generate random character (A-Z except I and O)
    $randomChar1 = getRandomChar();
    
    // Form ID in the format LINMS{y}1{RandomChar}001{RandomChar}
    $formID = "LINMS{$currentYear}1{$randomChar1}001{$randomChar1}";

    // Set createDate to current timestamp
    $createDate = date('Y-m-d H:i:s');
    
    // Set status to "Pending"
    $status = "Pending";

    // Assuming $_POST['applicantNumber'] contains the correct applicantNumber
    $applicantNumber = isset($_POST['applicantNumber']) ? $_POST['applicantNumber'] : '';

    // Check if applicantNumber exists in users table
    $checkUserQuery = "SELECT * FROM users WHERE applicantNumber = '$applicantNumber'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        // User with applicantNumber exists, fetch other data and proceed with insertion
        $userRow = $result->fetch_assoc();

        // Retrieve other form data from $_POST
        $Salutation = isset($_POST['salutation']) ? $_POST['salutation'] : '';
        $SourceOfInformation = isset($_POST['sourceOfInformation']) ? $_POST['sourceOfInformation'] : '';
        $RadioStation = isset($_POST['radioStation']) ? $_POST['radioStation'] : '';
        $EntryType = isset($_POST['entryType']) ? $_POST['entryType'] : '';
        $Level = isset($_POST['level']) ? $_POST['level'] : '';
        $Course = isset($_POST['course']) ? $_POST['course'] : '';
        $ACADEMIC_SESSION = isset($_POST['academicSession']) ? $_POST['academicSession'] : '';
        $SURNAME = isset($_POST['surname']) ? $_POST['surname'] : '';
        $OTHER_NAMES = isset($_POST['otherNames']) ? $_POST['otherNames'] : '';
        $DOB = isset($_POST['dob']) ? $_POST['dob'] : '';
        $SEX = isset($_POST['sex']) ? $_POST['sex'] : '';
        $MARITAL_STATUS = isset($_POST['maritalStatus']) ? $_POST['maritalStatus'] : '';
        $RELIGION = isset($_POST['religion']) ? $_POST['religion'] : '';
        $TELEPHONE = isset($_POST['telephone']) ? $_POST['telephone'] : '';
        $EMAIL= isset($_POST['email']) ? $_POST['email'] : '';
        $COUNTRY= isset($_POST['country']) ? $_POST['country'] : '';
        $DISTRICT = isset($_POST['district']) ? $_POST['district'] : '';
        $COUNTY = isset($_POST['county']) ? $_POST['county'] : '';
        $SUBCOUNTY = isset($_POST['subCounty']) ? $_POST['subCounty'] : '';
        $PARISH = isset($_POST['parish']) ? $_POST['parish'] : '';
        $VILLAGE = isset($_POST['village']) ? $_POST['village'] : '';
        $KIN_NAME = isset($_POST['kinName']) ? $_POST['kinName'] : '';
        $KIN_OCCUPATION = isset($_POST['kinOccupation']) ? $_POST['kinOccupation'] : '';
        $KIN_TELEPHONE = isset($_POST['kinTelephone']) ? $_POST['kinTelephone'] : '';
        $KIN_EMAIL = isset($_POST['kinEmail']) ? $_POST['kinEmail'] : '';
        $KIN_DISTRICT = isset($_POST['kinDistrict']) ? $_POST['kinDistrict'] : '';
        $KIN_PARISH = isset($_POST['kinParish']) ? $_POST['kinParish'] : '';
        $KIN_VILLAGE = isset($_POST['kinVillage']) ? $_POST['kinVillage'] : '';
        $RELATIONSHIP= isset($_POST['kinRelationship']) ? $_POST['kinRelationship'] : '';
        
        
        // Insert into applications table
        $sqlInsert = "INSERT INTO applications (
            formID, createDate, status, salutation, sourceOfInformation, radioStation, entryType, level, course, academicSession, surname, otherNames, dob, sex,
            maritalStatus, religion, telephone, email, country, district, county, subcounty,
            parish, village, kinName, kinOccupation, kinTelephone, kinEmail, kinDistrict, 
            kinParish, kinVillage, kinRelation, applicantNumber) 
        VALUES (
            '$formID', '$createDate', '$status', '$Salutation', '$SourceOfInformation', '$RadioStation', '$EntryType', '$Level', '$Course', '$ACADEMIC_SESSION', '$SURNAME', '$OTHER_NAMES', 
            '$DOB', '$SEX', '$MARITAL_STATUS', '$RELIGION', '$TELEPHONE', '$EMAIL', 
            '$COUNTRY', '$DISTRICT', '$COUNTY', '$SUBCOUNTY', '$PARISH', '$VILLAGE', '$KIN_NAME', 
            '$KIN_OCCUPATION', '$KIN_TELEPHONE', '$KIN_EMAIL', '$KIN_DISTRICT', '$KIN_PARISH', 
            '$KIN_VILLAGE', '$RELATIONSHIP', '$applicantNumber')";
            
        if ($conn->query($sqlInsert) === TRUE) {
            $_SESSION['FormID'] = $formID;

            // Display success message with Form ID and continue button
            echo '
        <div class="card border-success mb-3" style="max-width: 30rem;">
            <div class="card-header bg-success text-white">Form Submission Successful</div>
            <div class="card-body text-success">
                <h5 class="card-title">Biodata data submitted successfully.</h5>
                <p class="card-text">
                    Your Form ID is: ' . $formID . '<br>
                    Keep your Form ID safely as you in case you want to continue with your Application.<br>
                    Uncompleted forms shall not be considered.
                </p>
                <button class="btn btn-success" onclick="redirectToAcademics()">Continue to Academics Section</button>
            </div>
        </div>
    ';
        } else {
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }
    } else {
        // If applicantNumber doesn't exist in users table
        echo "Error: Applicant number does not exist.";
    }
}
?>

<script>
    function redirectToAcademics() {
        // Assuming you use jQuery for AJAX requests
        $.ajax({
            url: 'redirectToAcademics.php',
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = 'academics/academics.php?formID=' + response.formID + '&applicantNumber=' + response.applicantNumber;
                } else {
                    console.error('Failed to redirect:', response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }
</script>

