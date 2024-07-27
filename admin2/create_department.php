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

$sql = "SELECT course_id, course_name FROM courses";
$courses_result = $conn->query($sql);

if ($courses_result === false) {
    die("Error: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $department_name = $_POST['department_name'];
    $department_code = $_POST['department_code'];
    $description = $_POST['description'];
    $selected_courses = $_POST['courses'] ?? []; // Array of course IDs

    // Insert department
    $stmt = $conn->prepare("INSERT INTO departments (name, code, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $department_name, $department_code, $description);

    if ($stmt->execute()) {
        $department_id = $stmt->insert_id;

        // Insert department-course relations
        foreach ($selected_courses as $course_id) {
            $relation_stmt = $conn->prepare("INSERT INTO department_courses (department_id, course_id) VALUES (?, ?)");
            $relation_stmt->bind_param("ii", $department_id, $course_id);
            $relation_stmt->execute();
            $relation_stmt->close();
        }

        echo "<p>Department added successfully.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Add Department</h1>
        <form action="create_department.php" method="post">
            <div class="form-group">
                <label for="department_name">Department Name:</label>
                <input type="text" id="department_name" name="department_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="department_code">Department Code:</label>
                <input type="text" id="department_code" name="department_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="courses">Select Courses:</label>
                <select id="courses" name="courses[]" class="form-control" multiple>
                    <?php while ($course = $courses_result->fetch_assoc()): ?>
                        <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Department</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
