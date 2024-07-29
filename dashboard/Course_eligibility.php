<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Fetch courses from the database
$courses_query = "SELECT course_id, course_name FROM courses";
$courses_result = mysqli_query($conn, $courses_query);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $eligibility_criteria = $_POST['eligibility_criteria'];
    $targetDir = "uploads/courses/";

    // Ensure the directory exists
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Handle file upload
    $fileName = basename($_FILES["course_photo"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($_FILES["course_photo"]["name"])) {
        // Allow certain file formats
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif','JPG');
        if (in_array($fileType, $allowedTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["course_photo"]["tmp_name"], $targetFilePath)) {
                $insert_query = "INSERT INTO course_eligibility (course_id, eligibility_criteria, photo_path, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
                $stmt = mysqli_prepare($conn, $insert_query);
                mysqli_stmt_bind_param($stmt, 'iss', $course_id, $eligibility_criteria, $targetFilePath);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Eligibility criteria and photo uploaded successfully.";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error uploading the photo.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    } else {
        echo "Please select a photo to upload.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Course Eligibility</title>
</head>
<body>

<div class="container mt-5">
    <h2>Add Course Eligibility</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_id">Select Course</label>
            <select name="course_id" id="course_id" class="form-control" required>
                <option value="" disabled selected>Select a course</option>
                <?php while ($course = mysqli_fetch_assoc($courses_result)): ?>
                    <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="eligibility_criteria">Eligibility Criteria</label>
            <textarea name="eligibility_criteria" id="eligibility_criteria" rows="5" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="course_photo">Upload Course Photo</label>
            <input type="file" name="course_photo" id="course_photo" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Eligibility</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
