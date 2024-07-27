<?php
function getSubmitDate() {
    return date("dd-mm-yyyy H:i"); 
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sqlCreateDB) === FALSE) {
    die("Error creating database: " . $conn->error);
}

mysqli_select_db($conn, "LINMS");



$sqlCreateTable = "CREATE TABLE IF NOT EXISTS academics (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    indexNumberUCE VARCHAR(255) NOT NULL,
    yearUCE INT(4) NOT NULL,
    eng INT(1) NOT NULL,
    mtc INT(1) NOT NULL,
    bio INT(1) NOT NULL,
    chem INT(1) NOT NULL,
    phy INT(1) NOT NULL,
    geog INT(1) NOT NULL,
    his INT(1) NOT NULL,
    agric INT(1),
    cre INT(1),
    com INT(1),
    ent INT(1),
    art INT(1),
    comp INT(1),
    lit INT(1),
    lus_lug INT(1),
    aggregates INT(2) NOT NULL CHECK (aggregates BETWEEN 8 AND 64),
    division INT(1) NOT NULL CHECK (division BETWEEN 1 AND 4),
    indexNumberUACE VARCHAR(255) UNIQUE,
    yearUACE INT(4),
    biology INT(1),
    chemistry INT(1),
    mathematics INT(1),
    agriculture INT(1),
    geography INT(1),
    physics INT(1),
    general_paper INT(1),
    ict_sub_math INT(1),
    uce_certificate VARCHAR(255),
    uace_certificate VARCHAR(255), 
    workPlace VARCHAR(255),  
    Designation VARCHAR (255),       
    supportDocuments VARCHAR(255),
    applicantCode VARCHAR(4) NOT NULL UNIQUE,
    SubmitDate DATE,
    UNIQUE INDEX indexNumberUCE_yearUCE_unique (indexNumberUCE, yearUCE)

)";

if ($conn->query($sqlCreateTable) === TRUE) {
    //echo "Table academics successfully created";
 
} else {
    echo "Error creating table academics: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $indexNumberUCE = isset($_POST["indexNumberUCE"]) ? $_POST["indexNumberUCE"] : null;
    $yearUCE = isset($_POST["yearUCE"]) ? $_POST["yearUCE"] : null;
    $eng = isset($_POST["eng"]) ? $_POST["eng"] : null;
    $mtc = isset($_POST["mtc"]) ? $_POST["mtc"] : null;
    $bio = isset($_POST["bio"]) ? $_POST["bio"] : null;
    $chem = isset($_POST["chem"]) ? $_POST["chem"] : null;
    $phy = isset($_POST["phy"]) ? $_POST["phy"] : null;
    $geog = isset($_POST["geog"]) ? $_POST["geog"] : null;
    $his = isset($_POST["his"]) ? $_POST["his"] : null;
    $agric = isset($_POST["agric"]) ? $_POST["agric"] : null;
    $cre = isset($_POST["cre"]) ? $_POST["cre"] : null;
    $com = isset($_POST["com"]) ? $_POST["com"] : null;
    $ent = isset($_POST["ent"]) ? $_POST["ent"] : null;
    $art = isset($_POST["art"]) ? $_POST["art"] : null;
    $comp = isset($_POST["comp"]) ? $_POST["comp"] : null;
    $lit = isset($_POST["lit"]) ? $_POST["lit"] : null;
    $lus_lug = isset($_POST["lus_lug"]) ? $_POST["lus_lug"] : null;
    $aggregates = isset($_POST["aggregates"]) ? $_POST["aggregates"] : null;
    $division = isset($_POST["division"]) ? $_POST["division"] : null;
    $indexNumberUACE = isset($_POST["indexNumberUACE"]) ? $_POST["indexNumberUACE"] : null;
    $yearUACE = isset($_POST["yearUACE"]) ? $_POST["yearUACE"] : null;
    $biology = isset($_POST["biology"]) ? $_POST["biology"] : null;
    $chemistry = isset($_POST["chemistry"]) ? $_POST["chemistry"] : null;
    $mathematics = isset($_POST["mathematics"]) ? $_POST["mathematics"] : null;
    $agriculture = isset($_POST["agriculture"]) ? $_POST["agriculture"] : null;
    $geography = isset($_POST["geography"]) ? $_POST["geography"] : null;
    $physics = isset($_POST["physics"]) ? $_POST["physics"] : null;
    $general_paper = isset($_POST["general_paper"]) ? $_POST["general_paper"] : null;
    $ict_sub_math = isset($_POST["ict_sub_math"]) ? $_POST["ict_sub_math"] : null;
    $workPlace = isset($_POST["workPlace"]) ? $_POST["workPlace"] : null;
    $Designation= isset($_POST["designation"]) ? $_POST["designation"] : null;
    $applicantCode = isset($_POST["applicantCode"]) ? $_POST["applicantCode"] : null;
    $uce_certificate = isset($_FILES['uce_certificate']) ? $_FILES['uce_certificate'] : NULL;
    $uace_certificate = isset($_FILES['uace_certificate']) ? $_FILES['uace_certificate'] : NULL;
    $supportDocuments = isset($_FILES['supportDocuments']) ? $_FILES['supportDocuments'] : NULL;
   
    $indexNumberUCE = isset($_POST["indexNumberUCE"]) ? $_POST["indexNumberUCE"] : null;
    $yearUCE = isset($_POST["yearUCE"]) ? $_POST["yearUCE"] : null;
    
    // Check if the combination of indexNumberUCE and yearUCE already exists
    $sqlCheckDuplicate = "SELECT * FROM academics WHERE indexNumberUCE = '$indexNumberUCE' AND yearUCE = '$yearUCE'";
    $result = $conn->query($sqlCheckDuplicate);
    
    if ($result->num_rows > 0) {
        // Display error message if the combination already exists
        echo "The same index number has been used for the same year. Please provide a different index number for this year.";
        exit(); 
    }
    $applicantCode = isset($_POST["applicantCode"]) ? $_POST["applicantCode"] : null;
    
    $sqlCheckApplicantCode = "SELECT id FROM biodata WHERE applicantCode = '$applicantCode'";
    $result = $conn->query($sqlCheckApplicantCode);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $biodataId = $row['id'];

    $sqlInsert = "INSERT INTO academics (indexNumberUCE, yearUCE, eng, mtc, bio, chem,
    phy, geog, his, agric, cre, com, ent, art, comp, lit, lus_lug, aggregates, division,
     yearUACE, biology, chemistry, mathematics, agriculture, geography,
      physics, general_paper, ict_sub_math, uce_certificate, uace_certificate, workPlace,
       designation, supportDocuments,applicantCode,SubmitDate) 
   VALUES ('$indexNumberUCE', '$yearUCE', '$eng', '$mtc', '$bio', '$chem', '$phy', '$geog',
    '$his', '$agric', '$cre', '$com', '$ent', '$art', '$comp', '$lit', '$lus_lug', '$aggregates',
     '$division', '$yearUACE', '$biology', '$chemistry', '$mathematics', 
     '$agriculture', '$geography', '$physics', '$general_paper', '$ict_sub_math', '$uce_certificate',
      '$uace_certificate', '$workPlace','$Designation', '$supportDocuments','$applicantCode',NOW())";
   
   if (!empty($indexNumberUACE)) {
       $sqlInsert = str_replace("yearUACE", "indexNumberUACE, yearUACE", $sqlInsert);
   }
        
       
        if ($conn->query($sqlInsert) === TRUE) {
            echo"You have successfully applied to Lubega Institute of Nursing and Health Professionals";
            exit(); 
        } else {
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }
    }
}
        
        $conn->close();