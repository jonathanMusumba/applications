<?php
$mediaDir = 'Carousels/'; // Directory where your media files are stored

// Check if the directory exists
if (!is_dir($mediaDir)) {
    die("Directory does not exist.");
}

// Get all files from the directory
$files = array_diff(scandir($mediaDir), array('.', '..'));

if (count($files) > 0) {
    $first = true; // Flag for the first item to set as 'active'
    foreach ($files as $file) {
        $filePath = $mediaDir . $file;
        $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $activeClass = $first ? 'active' : '';
        
        // Check if the file is an image or video
        if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Display image
            echo '<div class="carousel-item ' . $activeClass . '">';
            echo '<img src="' . htmlspecialchars($filePath) . '" class="d-block w-100" alt="' . htmlspecialchars($file) . '">';
            echo '</div>';
        } elseif (in_array($fileExt, ['mp4', 'avi', 'mov'])) {
            // Display video
            echo '<div class="carousel-item ' . $activeClass . '">';
            echo '<video controls class="d-block w-100">
                    <source src="' . htmlspecialchars($filePath) . '" type="video/' . ($fileExt === 'mp4' ? 'mp4' : 'x-m4v') . '">
                    Your browser does not support the video tag.
                  </video>';
            echo '</div>';
        }
        
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
?>
