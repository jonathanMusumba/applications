<?php

session_start();
if(isset($_POST['formID']) && !empty($_POST['formID'])) {
    $formID = $_POST['formID'];

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
    
    // SQL query to check if the formID exists in your database
    $sql = "SELECT * FROM applications WHERE FormID = '$formID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Form ID exists, redirect to academics.php or further processing page
        header("Location: academics.php?formID=$formID");
        exit();
    } else {
        // Form ID does not exist, redirect back to the form with an error message
        header("Location: biodata.php?error=invalid_form_id");
        exit();
    }

    $conn->close();
} else {
    // Form ID not submitted, redirect back to the form with an error message
    header("Location: biodata.php?error=missing_form_id");
    exit();
}

