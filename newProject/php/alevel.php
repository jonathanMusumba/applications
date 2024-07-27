<?php
session_start();
include_once("db_connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $formID = $_POST['formID'];
    $alevel = [
        'schoolAlevel' => $_POST['schoolAlevel'],
        'indexNumberAlevel' => $_POST['indexNumberAlevel'],
        'yearAlevel' => $_POST['yearAlevel'],
        'subjectsAlevel' => json_encode($_POST['subjectsAlevel']), // Assuming subjects are passed as an array
    ];
    // Save to database
    // Your database update code here
}
?>

<form id="alevelForm">
    <div class="form-group">
        <label for="schoolAlevel">School</label>
        <input type="text" id="schoolAlevel" name="schoolAlevel" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="indexNumberAlevel">Index Number</label>
        <input type="text" id="indexNumberAlevel" name="indexNumberAlevel" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="yearAlevel">Year</label>
        <select id="yearAlevel" name="yearAlevel" class="form-control" required>
            <!-- Populate years dynamically -->
        </select>
    </div>
    <div class="form-group">
        <label for="subjectsAlevel">Subjects</label>
        <input type="text" id="subjectsAlevel" name="subjectsAlevel[]" class="form-control">
        <button type="button" id="addSubjectAlevel" class="btn btn-secondary">Add Subject</button>
        <table id="subjectsTableAlevel" class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Code</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
    <button type="submit" class="btn btn-primary">Save A Level</button>
</form>
