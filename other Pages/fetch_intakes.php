<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Initialize database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current date
$current_date = new DateTime();

// Fetch running intakes
$intakes_query = "SELECT intake_year, intake_month, end_date FROM intakes WHERE intake_status = 'Running' AND end_date >= CURDATE()";
$intakes_result = $conn->query($intakes_query);

// Check if there are any running intakes
if ($intakes_result->num_rows > 0) {
    while ($intake = $intakes_result->fetch_assoc()) {
        $intake_year = htmlspecialchars($intake['intake_year']);
        $intake_month = htmlspecialchars($intake['intake_month']);
        $end_date = new DateTime($intake['end_date']);
        $countdown = $end_date->diff($current_date);
        $countdown_str = $countdown->format('%a days');
        
        echo '<div class="card mt-2">';
        echo '  <div class="card-body">';
        echo '    <h5 class="card-title">Intake Year: ' . $intake_year . '</h5>';
        echo '    <p class="card-text">Intake Month: ' . $intake_month . '</p>';
        echo '    <p class="card-text">Running up to: ' . $end_date->format('Y-m-d') . '</p>';
        echo '    <p class="card-text" style="color: red;">Closes in: ' . $countdown_str . '</p>';
        echo '    <a href="applicants/register.html" class="btn btn-danger">Apply Now</a>';
        echo '  </div>';
        echo '</div>';
    }
} else {
    // Calculate next March
    $next_year = $current_date->format('Y') + 1;
    $next_march = new DateTime("$next_year-03-01");
    $countdown = $next_march->diff($current_date);
    $countdown_str = $countdown->format('%a days left');

    echo '<div class="card mt-2">';
    echo '  <div class="card-body">';
    echo '    <h5 class="card-title">Our Intakes</h5>';
    echo '    <p class="card-text">Will Open in March ' . $next_year . '</p>';
    echo '    <p class="card-text" style="color: red;">Opens in: ' . $countdown_str . '</p>';
    echo '    <button class="btn btn-secondary" disabled>Apply Now</button>';
    echo '  </div>';
    echo '</div>';
}

$conn->close();
?>
