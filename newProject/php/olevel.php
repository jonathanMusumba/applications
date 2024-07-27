<?php
// olevel.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $formID = $_POST['formID'];
    $olevel = [
        'schoolUCE' => $_POST['schoolUCE'],
        'indexNumberUCE' => $_POST['indexNumberUCE'],
        'yearUCE' => $_POST['yearUCE'],
        'subjectsUCE' => json_encode($_POST['subjectsUCE']), // Assuming subjects are passed as an array
        'divisionUCE' => $_POST['divisionUCE'],
        'aggregatesUCE' => $_POST['aggregatesUCE'],
        'distinctionsUCE' => $_POST['distinctionsUCE'],
        'creditsUCE' => $_POST['creditsUCE'],
        'passesUCE' => $_POST['passesUCE'],
        'failuresUCE' => $_POST['failuresUCE']
    ];
    // Save to database
    // Your database update code here
}
?>

<form id="olevelForm">
    <div class="form-group">
        <label for="schoolUCE">School</label>
        <input type="text" id="schoolUCE" name="schoolUCE" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="indexNumberUCE">Index Number</label>
        <input type="text" id="indexNumberUCE" name="indexNumberUCE" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="yearUCE">Year</label>
        <select id="yearUCE" name="yearUCE" class="form-control" required>
            <!-- Populate years dynamically -->
        </select>
    </div>
    <div class="form-group">
        <label for="subjectsUCE">Subjects</label>
        <input type="text" id="subjectsUCE" name="subjectsUCE[]" class="form-control">
        <button type="button" id="addSubjectUCE" class="btn btn-secondary">Add Subject</button>
        <table id="subjectsTableUCE" class="table">
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
    <div class="form-group">
        <label for="divisionUCE">Division</label>
        <input type="text" id="divisionUCE" name="divisionUCE" class="form-control">
    </div>
    <div class="form-group">
        <label for="aggregatesUCE">Aggregates</label>
        <input type="text" id="aggregatesUCE" name="aggregatesUCE" class="form-control">
    </div>
    <div class="form-group">
        <label for="distinctionsUCE">Distinctions</label>
        <input type="text" id="distinctionsUCE" name="distinctionsUCE" class="form-control">
    </div>
    <div class="form-group">
        <label for="creditsUCE">Credits</label>
        <input type="text" id="creditsUCE" name="creditsUCE" class="form-control">
    </div>
    <div class="form-group">
        <label for="passesUCE">Passes</label>
        <input type="text" id="passesUCE" name="passesUCE" class="form-control">
    </div>
    <div class="form-group">
        <label for="failuresUCE">Failures</label>
        <input type="text" id="failuresUCE" name="failuresUCE" class="form-control">
    </div>
    <input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
    <button type="submit" class="btn btn-primary">Save O Level</button>
</form>
