<!-- /admin/manage_departments.php -->
<?php
include '../php/db_connection.php'; // Adjust the path as needed

// Fetch all departments
$departments_query = "SELECT * FROM departments";
$departments_result = $conn->query($departments_query);

// Fetch all courses
$courses_query = "SELECT * FROM courses";
$courses_result = $conn->query($courses_query);
$courses = [];
while ($course = $courses_result->fetch_assoc()) {
    $courses[] = $course;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Departments</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Manage Departments</h1>
        
        <form action="create_department.php" method="post" class="mb-4">
            <h3>Create New Department</h3>
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
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple courses.</small>
            </div>
            <button type="submit" class="btn btn-primary">Add Department</button>
        </form>

        <h3>Existing Departments</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Courses</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($department = $departments_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $department['id']; ?></td>
                        <td><?php echo $department['name']; ?></td>
                        <td><?php echo $department['code']; ?></td>
                        <td><?php echo $department['description']; ?></td>
                        <td>
                            <?php
                            // Fetch associated courses
                            $dept_courses_query = "SELECT * FROM department_courses WHERE department_id = " . $department['id'];
                            $dept_courses_result = $conn->query($dept_courses_query);
                            while ($dept_course = $dept_courses_result->fetch_assoc()) {
                                $course_query = "SELECT name FROM courses WHERE id = " . $dept_course['course_id'];
                                $course_result = $conn->query($course_query);
                                $course = $course_result->fetch_assoc();
                                echo $course['name'] . "<br>";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="edit_department.php?id=<?php echo $department['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_department.php?id=<?php echo $department['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
