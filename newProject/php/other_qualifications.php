<?php
// other_qualifications.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $formID = $_POST['formID'];
    // Process other qualifications
    $qualifications = [
        'institutionName' => $_POST['institutionName'],
        'courseStudied' => $_POST['courseStudied'],
        'registrationNumber' => $_POST['registrationNumber'],
        'yearOfRegistration' => $_POST['yearOfRegistration'],
        'activeYears' => $_POST['activeYears'],
        'placeOfWork' => $_POST['placeOfWork'],
        'designation' => $_POST['designation']
    ];
    // Save to database
    // Your database update code here
}
?>
<form id="otherQualificationsForm"class="border p-4 rounded shadow-sm">
    <!-- Other Qualifications fields here -->
    <input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
    <!-- Add fields and Save button -->
    <button type="submit" class="btn btn-primary">Save Other Qualifications</button>
</form>
