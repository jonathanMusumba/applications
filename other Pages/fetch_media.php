<?php
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

// Fetch media items
$sql = "SELECT * FROM media ORDER BY date_uploaded DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $first = true; // Flag for the first item to set as 'active'
    while ($row = $result->fetch_assoc()) {
        $activeClass = $first ? 'active' : '';
        echo '<div class="carousel-item ' . $activeClass . '">';
        
        // Determine if the media is an image or video
        $mediaPath = htmlspecialchars($row['media_url']);
        $mediaDescription = htmlspecialchars($row['description']);
        
        if (strpos($mediaPath, '.mp4') !== false || strpos($mediaPath, '.avi') !== false || strpos($mediaPath, '.mov') !== false) {
            // If media is a video
            echo '<video controls class="d-block w-100">
                    <source src="' . $mediaPath . '" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>';
        } else {
            // If media is an image
            echo '<img src="' . $mediaPath . '" class="d-block w-100" alt="' . $mediaDescription . '">';
        }
        
        echo '<div class="carousel-caption d-none d-md-block">
                <h5>' . htmlspecialchars($row['title']) . '</h5>
                <p>' . htmlspecialchars($mediaDescription) . '</p>
              </div>';
        echo '</div>';
        
        $first = false; // Set the first item as not active after the first iteration
    }
} else {
    // No media items found
    echo '<div class="carousel-item active">
            <img src="placeholder.jpg" class="d-block w-100" alt="No media available">
            <div class="carousel-caption d-none d-md-block">
                <h5>No Media</h5>
                <p>No media items available at the moment.</p>
            </div>
          </div>';
}

$conn->close();
?>
