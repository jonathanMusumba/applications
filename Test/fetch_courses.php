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

// Check if there is a running intake
$intake_query = "SELECT COUNT(*) as count FROM intakes WHERE intake_status = 'Running' AND end_date >= CURDATE()";
$intake_result = $conn->query($intake_query);
$running_intake = $intake_result->fetch_assoc()['count'] > 0;

// Fetch courses
$courses_query = "SELECT course_name, duration, entry_level, tuition FROM courses";
$courses_result = $conn->query($courses_query);

$index = 0;
$active_set = false;

if ($courses_result->num_rows > 0) {
    while ($course = $courses_result->fetch_assoc()) {
        if ($index % 3 == 0) {
            echo '<div class="carousel-item' . (!$active_set ? ' active' : '') . '">';
            echo '<div class="row">';
            $active_set = true;
        }

        $course_name = htmlspecialchars($course['course_name']);
        $duration = htmlspecialchars($course['duration']);
        $entry_level = htmlspecialchars($course['entry_level']);
        $tuition = htmlspecialchars($course['tuition']);

        echo '<div class="col-md-4">';
        echo '  <div class="card mt-2">';
        echo '    <div class="card-body">';
        echo '      <h5 class="card-title">' . $course_name . '</h5>';
        echo '      <p class="card-text">Duration: ' . $duration . '</p>';
        echo '      <p class="card-text">Entry Level: ' . $entry_level . '</p>';
        echo '      <p class="card-text">Tuition: ' . $tuition . '</p>';
        
        if ($running_intake) {
            echo '      <a href="applicants/register.html" class="btn btn-danger">Apply Now</a>';
        } else {
            echo '      <button class="btn btn-secondary" disabled>Apply Now</button>';
        }

        echo '    </div>';
        echo '  </div>';
        echo '</div>';

        $index++;

        if ($index % 3 == 0 || $index == $courses_result->num_rows) {
            echo '</div>';
            echo '</div>';
        }
    }
} else {
    echo '<div class="carousel-item active">';
    echo '<div class="row">';
    echo '<div class="col-12">';
    echo '<p>No courses available.</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

$conn->close();
?>
