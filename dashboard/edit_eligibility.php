<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$course_id = '';
$eligibility_criteria = '';
$photo_path = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['course_id'])) {
        $course_id = $_POST['course_id'];
        $eligibility_criteria = $_POST['eligibility_criteria'];
        $targetDir = "uploads/courses/";

        // Ensure the directory exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Handle file upload
        $photo_path = ''; // Default to empty if no new photo is uploaded
        if (!empty($_FILES["course_photo"]["name"])) {
            $fileName = basename($_FILES["course_photo"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["course_photo"]["tmp_name"], $targetFilePath)) {
                    $photo_path = $targetFilePath;
                } else {
                    echo "Error uploading the photo.";
                    exit;
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
                exit;
            }
        } else {
            // If no new photo, use the existing photo path
            $select_query = "SELECT photo_path FROM course_eligibility WHERE course_id = ?";
            $stmt = $conn->prepare($select_query);
            $stmt->bind_param('i', $course_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $existingData = $result->fetch_assoc();
            $photo_path = $existingData['photo_path'];
        }

        // Update course eligibility
        $update_query = "UPDATE course_eligibility SET eligibility_criteria = ?, photo_path = ?, updated_at = NOW() WHERE course_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('ssi', $eligibility_criteria, $photo_path, $course_id);

        if ($stmt->execute()) {
            echo "Eligibility criteria updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Fetch courses from the database
$courses_query = "SELECT course_id, course_name FROM courses";
$courses_result = mysqli_query($conn, $courses_query);

if (!$courses_result) {
    die("Error fetching courses: " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Course Eligibility</title>
</head>
<body>

<div class="container mt-5">
    <h2>Edit Course Eligibility</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Course Selection -->
        <div class="form-group">
            <label for="select_course">Select Course to Edit</label>
            <select name="course_id" id="select_course" class="form-control" onchange="this.form.submit()" required>
                <option value="" disabled selected>Select a course</option>
                <?php while ($course = mysqli_fetch_assoc($courses_result)): ?>
                    <option value="<?php echo $course['course_id']; ?>" <?php echo $course_id == $course['course_id'] ? 'selected' : ''; ?>>
                        <?php echo $course['course_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <?php if (isset($course_id) && !empty($course_id)): ?>
            <?php
            // Fetch existing data for the selected course
            $conn = new mysqli($servername, $username, $password, $dbname);
            $select_query = "SELECT * FROM course_eligibility WHERE course_id = ?";
            $stmt = $conn->prepare($select_query);
            $stmt->bind_param('i', $course_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $courseEligibility = $result->fetch_assoc();

            if ($courseEligibility) {
                $eligibility_criteria = htmlspecialchars($courseEligibility['eligibility_criteria']);
                $photo_path = htmlspecialchars($courseEligibility['photo_path']);
            } else {
                echo "<p>Course eligibility not found.</p>";
            }
            ?>
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <div class="form-group">
                <label for="eligibility_criteria">Eligibility Criteria</label>
                <textarea name="eligibility_criteria" id="eligibility_criteria" rows="5" class="form-control" required><?php echo $eligibility_criteria ?? ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="course_photo">Upload New Course Photo (Optional)</label>
                <input type="file" name="course_photo" id="course_photo" class="form-control" accept="image/*">
                <?php if (isset($photo_path) && !empty($photo_path)): ?>
                    <img src="<?php echo $photo_path; ?>" alt="Course Photo" class="img-thumbnail mt-2" style="max-width: 200px;">
                <?php endif; ?>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Eligibility</button>
        <?php endif; ?>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
