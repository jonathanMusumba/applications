<?php
// next_of_kin.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $formID = $_POST['formID'];
    // Process the next of kin
    $nextOfKin = [
        'fullName' => $_POST['fullName'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'districtOfResidence' => $_POST['districtOfResidence']
    ];
    // Save to database
    // Your database update code here
}
?>
<form id="nextOfKinForm"class="border p-4 rounded shadow-sm">
    <!-- Next of Kin fields here -->
    <input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
    <div class="form-group">
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="districtOfResidence">District of Residence</label>
        <input type="text" id="districtOfResidence" name="districtOfResidence" class="form-control" required>
    </div>
    <input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
    <button type="submit" class="btn btn-primary">Save Next of Kin</button>
</form>
