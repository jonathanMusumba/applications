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

    // Retrieve form data
    $EntryType = $_POST['entryType'];
    $Level = $_POST['level'];
    $Course = $_POST['course'];
    $ACADEMIC_SESSION = $_POST['academicSession'];
    $SURNAME = $_POST['surname'];
    $OTHER_NAMES = $_POST['otherNames'];
    $DOB = $_POST['dob'];
    $SEX = $_POST['sex'];
    $MARITAL_STATUS = $_POST['maritalStatus'];
    $RELIGION = $_POST['religion'];
    $TELEPHONE = $_POST['telephone'];
    $EMAIL= $_POST['email'];
    $COUNTRY= $_POST['country'];
    $DISTRICT = $_POST['district'];
    $COUNTY = $_POST['county'];
    $SUBCOUNTY = $_POST['subCounty'];
    $PARISH = $_POST['parish'];
    $VILLAGE = $_POST['village'];
    $KIN_NAME = $_POST['kinName'];
    $KIN_OCCUPATION = $_POST['kinOccupation'];
    $KIN_TELEPHONE = $_POST['kinTelephone'];
    $KIN_EMAIL = $_POST['kinEmail'];
    $KIN_DISTRICT = $_POST['kinDistrict'];
    $KIN_PARISH = $_POST['kinParish'];
    $KIN_VILLAGE = $_POST['kinVillage'];
    $RELATIONSHIP= $_POST['kinRelationship'];
    $Salutation = $_POST['salutation'];
    $SourceOfInformation = $_POST['sourceOfInformation'];
    $RadioStation = isset($_POST['radioStation']) ? $_POST['radioStation'] : null; // Radio station if Radio is selected
    $ApplicantNumber = isset($_POST['applicantNumber']) ? $_POST['applicantNumber'] : null;

    $sqlInsert = "INSERT INTO biodata (
        salutation, sourceOfInformation, radioStation, entryType, level, course, academicSession, surname, otherNames, dob, sex,
        maritalStatus, religion, telephone, email, country, district, county, subcounty,
        parish, village, kinName, kinOccupation, kinTelephone, kinEmail, kinDistrict, 
        kinParish, kinVillage, kinRelation, applicantNumber, formID) 
    VALUES (
        '$Salutation', '$SourceOfInformation', '$RadioStation', '$EntryType', '$Level', '$Course', '$ACADEMIC_SESSION', '$SURNAME', '$OTHER_NAMES', 
        '$DOB', '$SEX', '$MARITAL_STATUS', '$RELIGION', '$TELEPHONE', '$EMAIL', 
        '$COUNTRY', '$DISTRICT', '$COUNTY', '$SUBCOUNTY', '$PARISH', '$VILLAGE', '$KIN_NAME', 
        '$KIN_OCCUPATION', '$KIN_TELEPHONE', '$KIN_EMAIL', '$KIN_DISTRICT', '$KIN_PARISH', 
        '$KIN_VILLAGE', '$RELATIONSHIP', '$ApplicantNumber', '$formID')";
        
    if ($conn->query($sqlInsert) === TRUE) {
        // Display success message with Form ID and continue button
        echo "Biodata data submitted successfully. Your Form ID is: $formID <br>";
        echo '<button onclick="redirectToAcademics()">Continue to Academics</button>';
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
}
?>

<script>
function redirectToAcademics() {
    // Redirect to academics.html
    window.location.href = 'academics.html';
}
</script>
