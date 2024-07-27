<?php
// Include database connection and fetch existing courses
include 'fetch_courses.php';
include 'db_connection.php';

// Fetch intake years from the Intakes table
$intakeQuery = "SELECT intake_year FROM Intakes WHERE intake_status = 'running'";
$intakeResult = mysqli_query($conn, $intakeQuery);

// Prepare intake years for dropdown
$intakeOptions = '';
while ($row = mysqli_fetch_assoc($intakeResult)) {
    $intakeOptions .= '<option value="'.htmlspecialchars($row['intake_year']).'">'.htmlspecialchars($row['intake_year']).'</option>';
}

mysqli_close($conn);
?>

<form id="courseForm">
    <h2>Select a Course</h2>
    <div id="courseTableContainer">
        <?php echo $courseTableHtml; ?>
    </div>
    
    <h3>Add New Course</h3>
    <div class="form-group">
        <label for="courseName">Course Name</label>
        <input type="text" id="courseName" name="courseName" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="entryLevel">Entry Level</label>
        <input type="text" id="entryLevel" name="entryLevel" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="scheme">Scheme</label>
        <input type="text" id="scheme" name="scheme" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="intakeYear">Intake Year</label>
        <select id="intakeYear" name="intakeYear" class="form-control">
            <option value="" disabled selected>Select an Option</option>
            <?php echo $intakeOptions; ?>
        </select>
    </div>
    <button type="button" id="addCourseBtn" class="btn btn-secondary">Add Course</button>
    
    <h3>Selected Courses</h3>
    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Entry Level</th>
                    <th>Scheme</th>
                    <th>Intake Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="selectedCoursesTable">
                <!-- Selected courses will be appended here -->
            </tbody>
        </table>
    </div>
    
    <input type="hidden" id="formID" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
    <button type="submit" class="btn btn-primary">Save Course</button>
</form>

<script>
    // Handle adding a new course
    document.getElementById('addCourseBtn').addEventListener('click', function() {
        var courseName = document.getElementById('courseName').value;
        var entryLevel = document.getElementById('entryLevel').value;
        var scheme = document.getElementById('scheme').value;
        var intakeYear = document.getElementById('intakeYear').value;

        if (courseName && entryLevel && scheme && intakeYear) {
            var newRow = `<tr>
                <td>${courseName}</td>
                <td>${entryLevel}</td>
                <td>${scheme}</td>
                <td>${intakeYear}</td>
                <td><button type="button" class="btn btn-danger btn-sm removeCourse">Remove</button></td>
            </tr>`;

            document.querySelector('#selectedCoursesTable').insertAdjacentHTML('beforeend', newRow);
            document.getElementById('courseName').value = '';
            document.getElementById('entryLevel').value = '';
            document.getElementById('scheme').value = '';
            document.getElementById('intakeYear').value = '';
        } else {
            alert('Please fill out all fields.');
        }
    });

    // Handle removing a course from the selected list
    document.getElementById('selectedCoursesTable').addEventListener('click', function(event) {
        if (event.target.classList.contains('removeCourse')) {
            event.target.closest('tr').remove();
        }
    });

    // Handle form submission
    document.getElementById('courseForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var rows = document.querySelectorAll('#selectedCoursesTable tr');
        var courseData = [];

        rows.forEach(function(row) {
            var cells = row.querySelectorAll('td');
            courseData.push({
                courseName: cells[0].innerText,
                entryLevel: cells[1].innerText,
                scheme: cells[2].innerText,
                intakeYear: cells[3].innerText
            });
        });

        var formData = new FormData(this);
        formData.append('courseData', JSON.stringify(courseData));

        fetch('save_course.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
</script>
