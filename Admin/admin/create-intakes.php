<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate and sanitize input (You should add more specific validation as per your requirements)
    $intake_year = $_POST['intake_year'];
    $intake_month = $_POST['intake_month'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    
    // Determine status based on end date
    $today = date('Y-m-d');
    $status = ($end_date >= $today) ? 'Running' : 'Expired';
    
    // You might want to add more robust validation here for dates, etc.
    
    // Database connection (Replace with your actual database credentials)
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
    
    // Prepare SQL statement to insert data into intakes table
    $sql = "INSERT INTO intakes (intake_year, intake_month, start_date, end_date, status, description, created_on)
            VALUES ('$intake_year', '$intake_month', '$start_date', '$end_date', '$status', '$description', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Intake</title>
</head>
<body>
    <h2>Create Intake</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Intake Year: <input type="text" name="intake_year"><br><br>
        Intake Month: <input type="text" name="intake_month"><br><br>
        Start Date: <input type="date" name="start_date"><br><br>
        End Date: <input type="date" name="end_date"><br><br>
        Description: <textarea name="description"></textarea><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
