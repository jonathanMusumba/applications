<?php
include("scripts/uce.php");
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Level Information Section</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/uce.css">
    <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
    <style>
       
    </style>
</head>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header section-header">
            <span><i class="fas fa-graduation-cap"></i> O LEVEL INFORMATION</span>
            <div class="status">
                <i class="fas fa-circle-stop"></i>
                <span class="badge badge-danger">NOT FILLED</span>
                <i class="fas fa-chevron-right ml-2"></i>
            </div>
        </div>
        <div class="card-body">
            <form id="olevelSection" class="form-section" method="POST" action="save_data.php">
                <div class="form-row section-to-validate">
                    <!-- School Name -->
                    <div class="form-group col-md-4">
                        <label for="schoolName">School Name<span class="text-danger">*</span>:</label>
                        <input type="text" class="form-control" id="schoolName" name="schoolName" placeholder="Start typing to search and select a school" required>
                        <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
                    </div>

                    <!-- Index Number -->
                    <div class="form-group col-md-4">
                        <label for="indexNumber" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="centerNumber" name="centerNumber" placeholder="Center No." value="U0000" readonly>
                            <input type="hidden" id="indexNumberField" name="indexNumber" value="">
                            <div class="input-group-append">
                                <select class="custom-select" id="candidateNumber" name="candidateNumber" required>
                                    <option value="">Select candidate number</option>
                                    <?php
                                    // Generate options for candidate number from 001 to 499
                                    for ($i = 1; $i <= 499; $i++) {
                                        printf('<option value="%03d">%03d</option>', $i, $i);
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <small id="indexNumberHelpBlock" class="form-text text-muted">Format: U1234/123</small>
                    </div>


                <!-- Year of Sitting -->
                <div class="form-group col-md-4">
                    <label for="yearOfSitting" class="required-field">Year of Sitting<span class="text-danger">*</span>:</label>
                    <select class="form-control" id="yearOfSitting" name="yearOfSitting" required>
                        <option value="" disabled selected>Select an Option</option>
                    </select>
                </div>
            </div>
                        <div id="subjectSelectionSection" style="display: none;">
                        <div class="form-group row">
                            <label for="subject" class="col-sm-3 col-form-label">Select Subject:</label>
                            <input type="hidden" id="subjectsField" name="subjects" value="">
                            <div class="col-sm-3">
                                <select class="form-control" id="subject">
                                <option value="" disabled selected>Select an Option</option>
                                    <option value="112">ENGLISH LANGUAGE</option>
                                    <option value="223">CRE: CHRISTIAN LIVING TODAY</option>
                                    <option value="241">HISTORY</option>
                                    <option value="273">GEOGRAPHY</option>
                                    <option value="456">MATHEMATICS</option>
                                    <option value="527">AGRIC PRINCIPLES AND PRACTICES</option>
                                    <option value="535">PHYSICS</option>
                                    <option value="545">CHEMISTRY</option>
                                    <option value="553">BIOLOGY</option>
                                    <option value="800">COMMERCE</option>
                                    <option value="355">LUSOGA</option>
                                    <option value="612">IPS (ART)</option>
                                    <option value="336">KISWAHILI</option>
                                    <option value="335">LUGANDA</option>
                                    <option value="840">ICT</option>
                                    <option value="845">ENTREPRENEURSHIP</option>
                                </select>
                            </div>
                            <label for="grade" class="col-sm-2 col-form-label">Grade:</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="grade">
                                <option value="" disabled selected>Select an Option</option>
                                    <option value="D1">D1</option>
                                    <option value="D2">D2</option>
                                    <option value="C3">C3</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="P7">P7</option>
                                    <option value="P8">P8</option>
                                    <option value="F9">F9</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="addSubject" class="btn btn-primary">Add Subject</button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>CODE</th>
                                        <th>SUBJECT</th>
                                        <th>GRADE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="subjectsTable">
                                    <!-- Subjects will be added here dynamically -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>SUMMARY</strong></td>
                                    </tr>
                                    <tr>
                                    <td colspan="4" class="form-inline">
                                        <div class="form-group mr-3">
                                            <label for="aggregate" class="mr-2">AGGREGATE<span class="text-danger">*</span>:</label>
                                            <input type="number" class="form-control" id="aggregate" name="aggregate" required min="8" max="68">
                                        </div>
                                        <div class="form-group">
                                            <label for="division" class="mr-2">DIVISION<span class="text-danger">*</span>:</label>
                                            <input type="number" class="form-control" id="division" name="division" required min="1" max="4">
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="inline-form">
                                                <div>
                                                    <label>Distinctions:</label>
                                                    <span id="distinctions">0</span>
                                                </div>
                                                <div>
                                                    <label>Credits:</label>
                                                    <span id="credits">0</span>
                                                </div>
                                                <div>
                                                    <label>Passes:</label>
                                                    <span id="passes">0</span>
                                                </div>
                                                <div>
                                                    <label>Failures:</label>
                                                    <span id="failures">0</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right">
                                            <button type="submit" id="saveResults" class="btn btn-success" disabled>Save Results</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </form>
                <div id="validationMessage" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/olevel.js"></script>
<script>
     function checkFormCompletion() {
    const schoolName = document.getElementById('schoolName').value;
    const centerNumber = document.getElementById('centerNumber').value;
    const candidateNumber = document.getElementById('candidateNumber').value;
    const yearOfSitting = document.getElementById('yearOfSitting').value;

    if (schoolName && centerNumber && candidateNumber && yearOfSitting) {
        document.getElementById('subjectSelectionSection').style.display = 'block';
    } else {
        document.getElementById('subjectSelectionSection').style.display = 'none';
    }
}

function enableFormElements() {
    document.getElementById('schoolName').disabled = false;
    document.getElementById('centerNumber').disabled = false;
    document.getElementById('candidateNumber').disabled = false;
    document.getElementById('yearOfSitting').disabled = false;
    document.getElementById('subjectSelectionSection').style.display = 'none';
    document.getElementById('didNotSitWarning').style.display = 'none';
}

function disableFormElements() {
    document.getElementById('schoolName').value = '';
    document.getElementById('centerNumber').value = '';
    document.getElementById('candidateNumber').value = '';
    document.getElementById('yearOfSitting').value = '';
    document.getElementById('schoolName').disabled = true;
    document.getElementById('centerNumber').disabled = true;
    document.getElementById('candidateNumber').disabled = true;
    document.getElementById('yearOfSitting').disabled = true;

    document.getElementById('subjectSelectionSection').style.display = 'none';
    document.getElementById('didNotSitWarning').style.display = 'block';

    // Clear the subjects table
    const subjectsTable = document.getElementById('subjectsTable');
    subjectsTable.innerHTML = ''; // Clear all rows

    // Update summary values
    document.getElementById('aggregate').value = '';
    document.getElementById('division').value = '';
    document.getElementById('distinctions').textContent = '0';
    document.getElementById('credits').textContent = '0';
    document.getElementById('passes').textContent = '0';
    document.getElementById('failures').textContent = '0';
    const subjectJsonInput = document.getElementById('subjectJson');
    subjectJsonInput.value = '';

    // Disable the save button until the warning save button is clicked
    document.getElementById('saveResults').disabled = true;
}

// Add event listeners to form fields
document.getElementById('schoolName').addEventListener('input', checkFormCompletion);
document.getElementById('centerNumber').addEventListener('input', checkFormCompletion);
document.getElementById('candidateNumber').addEventListener('input', checkFormCompletion);
document.getElementById('yearOfSitting').addEventListener('change', checkFormCompletion);
document.getElementById('didNotSit').addEventListener('change', function () {
    if (this.checked) {
        disableFormElements();
    } else {
        enableFormElements();
        checkFormCompletion(); // Check form completion to show/hide subject selection section
    }
});

// Handle save button inside warning message
document.getElementById('saveEmptyResults').addEventListener('click', function () {
    // Submit the form with empty or default values
    document.getElementById('olevelSection').submit();
});

// Handle the regular save button
document.getElementById('saveResults').addEventListener('click', function () {
    // Check if form is complete before submitting
    if (document.getElementById('schoolName').value &&
        document.getElementById('centerNumber').value &&
        document.getElementById('candidateNumber').value &&
        document.getElementById('yearOfSitting').value) {
        document.getElementById('olevelSection').submit();
    }
});

    
</script>

</body>

</html>
