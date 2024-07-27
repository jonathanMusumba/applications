<?php
// submit_form.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $formID = $_POST['formID'];
    // Process final submission
    $sourceOfInformation = $_POST['sourceOfInformation'];
    $declaration = $_POST['declaration'];
    $consent = $_POST['consent'];
    // Update database
    // Your database update code here
}
?>
<div class="container mt-5">
        <form id="submitForm" class="border p-4 rounded shadow-sm" method="POST" action="submit_form.php">
            <div id="submitApplicationSection" class="form-section">
                <h2 class="text-center">SUBMIT YOUR APPLICATION FORM</h2>                
                <input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">               
                <!-- Display Applicant's Name -->
                <div class="form-group">
                    <label for="applicantName">Applicant's Name</label>
                    <input type="text" class="form-control" id="applicantName" name="applicantName" value="<?php echo htmlspecialchars($applicantName); ?>" readonly>
                </div>                
                <!-- Source of Information -->
                <div class="form-group">
                    <label for="sourceOfInformation">Where did you know us from?</label>
                    <select class="form-control" id="sourceOfInformation" name="sourceOfInformation" required>
                        <option value="">Select Source</option>
                        <option value="Radio Station">Radio Station</option>
                        <option value="Word of Mouth">Word of Mouth</option>
                        <option value="Google">Google</option>
                        <option value="Social Media">Social Media</option>
                        <option value="Television">Television</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <!-- Conditional Radio Options -->
                <div class="form-group radio-group" id="radioOptions">
                    <label for="radioStation">Which Radio Station?</label>
                    <select class="form-control" id="radioStation" name="radioStation">
                        <option value="">Select Radio Station</option>
                        <option value="Baaba FM">Baaba FM</option>
                        <option value="Busoga One">Busoga One</option>
                        <option value="NBS">NBS</option>
                        <option value="Apex FM">Apex FM</option>
                        <option value="Sebbo FM">Sebbo FM</option>
                        <option value="Eye FM">Eye FM</option>
                        <option value="Others">Others</option>
                    </select>
                </div>

                <div class="text-center my-3">
                    <button type="button" class="btn btn-light" id="consentButton" disabled>CLICK ON THE TEXT BELOW TO CONSENT AND SUBMIT YOUR FORM</button>
                </div>
                
                <div class="declaration my-3">
                    <input type="checkbox" class="declaration-checkbox" id="declarationCheckbox">
                    <label for="declarationCheckbox" class="text-danger">
                        I SANDRA BABISE, DECLARE THAT TO THE BEST OF MY KNOWLEDGE THE INFORMATION I HAVE PROVIDED HERE IS TRUE AND I AGREE TO THE ONLINE APPLICATION TERMS AND CONDITIONS OF USE.
                    </label>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-3" id="submitApplicationButton" disabled>SUBMIT FORM</button>
                </div>
                
                <div id="submitApplicationValidationMessage" class="mt-3"></div>
            </div>
        </form>
    </div>
