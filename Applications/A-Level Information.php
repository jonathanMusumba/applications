<?php
include("scripts/uace.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Level Information Section</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        #validationMessage {
            color: red;
        }

        .inline-form {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .inline-form div {
            display: flex;
            align-items: center;
        }

        .inline-form label {
            margin-right: 5px;
        }
        .form-group input,
        .form-group select {
            font-size: 0.875rem;s
        }
    </style>
</head>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header section-header">
            <span><i class="fas fa-graduation-cap"></i> A LEVEL INFORMATION</span>
            <div class="status">
                <i class="fas fa-circle-stop"></i>
                <span class="badge badge-danger">NOT FILLED</span>
                <i class="fas fa-chevron-right ml-2"></i>
            </div>
        </div>
        <div class="card-body">
            <div class="form-section">
                <form id="alevelSection" method="POST" action="scripts/saveUACE.php">
                    <div class="form-group">
                        <input type="checkbox" id="didNotSit" name="didNotSit">
                        <label for="didNotSit">I DID NOT SIT FOR UGANDA CERTIFICATE OF EDUCATION EXAMINATIONS</label>
                    </div>
                    <div class="alert alert-warning warning-message" id="didNotSitWarning" style="display: none;">
                        YOU SELECTED YOU DID NOT SIT FOR UGANDA CERTIFICATE OF EDUCATION (UCE) EXAMINATIONS.
                        If you continue to save this result, you will not be able to edit this option.
                        <button type="button" id="saveEmptyResults" class="btn btn-danger mt-2">Save Results</button>
                    </div>

                    <!-- Additional form fields for A Level information can be added here -->
                    
                    <div class="form-row">
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
                                    <div class="input-group-append">
                                        <select class="custom-select" id="candidateNumber" name="candidateNumber" required>
                                            <option value="">Select candidate number</option>
                                            <?php
                                            // Generate options for candidate number from 001 to 499
                                            for ($i = 501; $i <= 999; $i++) {
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
                            <div class="col-sm-3">
                                <select class="form-control" id="subject">
                                <option value="" disabled selected>Select an Option</option>
                                    <option value="P530">Biology</option>
                                    <option value="P525">Chemistry</option>
                                    <option value="P425">Mathematics</option>
                                    <option value="P515">Agriculture</option>
                                    <option value="P250">Geography</option>
                                    <option value="P510">Physics</option>
                                    <option value="S101">General Paper</option>
                                    <option value="S850/S475">SUBSIDIARY ICT</option>
                                    <option value="S475">SUBSIDIARY MATH</option>
                                </select>
                            </div>
                            <label for="grade" class="col-sm-2 col-form-label">Grade:</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="grade">
                                <option value="" disabled selected>Select an Option</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="O">O</option>
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
                                </table>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="pointsObtained">Points Obtained</label>
                                <input type="number" class="form-control form-control-sm" id="pointsObtained" name="pointsObtained" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="resultCode">Result Code</label>
                                <input type="number" class="form-control form-control-sm" id="resultCode" name="resultCode" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Principle Passes:</label>
                                <span id="principlePasses">0</span>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Subsidiary Passes:</label>
                                <span id="subsidiaryPasses">0</span>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Failures:</label>
                                <span id="failures">0</span>
                            </div>
                        </div>

                            <button type="submit" id="saveResults" class="btn btn-success">Save Results</button>
                        </div>
                    </form>
                    <div id="validationMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/uace.js"></script>
    <script>


$(document).ready(function() {

    const currentYear = new Date().getFullYear();

        // Calculate the range of years
        const startYear = currentYear - 15;
        const endYear = currentYear - 1;

        // Get the select element
        const yearSelect = document.getElementById('yearOfSitting');

        // Generate options dynamically
        for (let year = endYear; year >= startYear; year--) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
// Show warning when checkbox is checked

var principlePasses = 0;
    var subsidiaryPasses = 0;
    var failures = 0;
    var totalPoints = 0;

    // Handle checkbox change
    $('#didNotSit').change(function() {
        if ($(this).is(':checked')) {
            $('#didNotSitWarning').show();
            $('#formContent').hide();
        } else {
            $('#didNotSitWarning').hide();
            $('#formContent').show();
        }
    });

    // Save empty results if checkbox is checked
    $('#saveEmptyResults').click(function() {
        // Simulate sending empty data to the server
        $.ajax({
            url: 'submit_alevel.php',
            type: 'POST',
            data: { didNotSit: true },
            success: function(response) {
                $('#validationMessage').text('Results saved successfully.');
                $('#saveResults').text('Update Results').removeClass('btn-success').addClass('btn-warning');
                $('#didNotSitWarning').hide();
                $('#formContent').show();
                $('#didNotSit').prop('checked', false);
            },
            error: function(error) {
                $('#validationMessage').text('Error saving results. Please try again.');
            }
        });
    });

    // Add subject
    $('#addSubject').click(function() {
        var subjectCode = $('#subject').val();
        var subjectText = $('#subject option:selected').text();
        var grade = $('#grade').val();

        // Ensure subject is not added twice
        var exists = false;
        $('#subjectsTable tr').each(function() {
            if ($(this).find('td').eq(0).text() === subjectCode) {
                exists = true;
                return false;
            }
        });
        if (exists) {
            alert('Subject already added.');
            return;
        }

        // Add subject to the table
        var row = '<tr>' +
            '<td>' + subjectCode + '</td>' +
            '<td>' + subjectText + '</td>' +
            '<td>' + grade + '</td>' +
            '<td><button type="button" class="btn btn-danger removeSubject">Remove</button></td>' +
            '</tr>';
        $('#subjectsTable').append(row);

        // Update counters and points
        updateCountersAndPoints(grade);

        // Check if minimum subjects are met
        var subjectsCount = $('#subjectsTable tr').length - 1; // subtract 1 for the header row
        $('#saveResults').prop('disabled', subjectsCount < 3); // Adjust based on your requirements
    });

    // Remove subject
    $('#subjectsTable').on('click', '.removeSubject', function() {
        var grade = $(this).closest('tr').find('td').eq(2).text();
        $(this).closest('tr').remove();
        updateCountersAndPoints(grade, true);

        // Check if minimum subjects are met
        var subjectsCount = $('#subjectsTable tr').length - 1; // subtract 1 for the header row
        $('#saveResults').prop('disabled', subjectsCount < 3); // Adjust based on your requirements
    });

    // Update counters and points
    function updateCountersAndPoints(grade, isRemoval = false) {
        var points = 0;
        switch (grade) {
            case 'A': points = 6; break;
            case 'B': points = 5; break;
            case 'C': points = 4; break;
            case 'D': points = 3; break;
            case 'E': points = 2; break;
            case 'O': points = 1; break;
            case 'D1': case 'D2': case 'C3': case 'C4': case 'C5': case 'C6':
                points = 1; break;
            case 'P7': case 'P8': case 'F9':
                points = 0; break;
        }

        if (isRemoval) {
            if (points > 0) principlePasses--;
            else if (grade === 'O' || grade === 'P7' || grade === 'P8') subsidiaryPasses--;
            else if (grade === 'F9') failures--;

            totalPoints -= points;
        } else {
            if (points > 0) principlePasses++;
            else if (grade === 'O' || grade === 'P7' || grade === 'P8') subsidiaryPasses++;
            else if (grade === 'F9') failures++;

            totalPoints += points;
        }

        $('#principlePasses').text(principlePasses);
        $('#subsidiaryPasses').text(subsidiaryPasses);
        $('#failures').text(failures);
        $('#pointsObtained').val(totalPoints);
    }

    // Save results
    $('#saveResults').click(function() {
        var subjectsData = [];
        $('#subjectsTable tr').each(function() {
            var code = $(this).find('td').eq(0).text().trim();
            var grade = $(this).find('td').eq(2).text().trim();
            subjectsData.push({ code, grade });
        });

        var formData = {
            schoolName: $('#schoolUACE').val().trim(),
            indexNumber: $('#centerNumberUACE').val().trim() + '/' + $('#candidateNumber').val().trim(),
            yearOfSitting: $('#yearUACE').val(),
            subjects: subjectsData,
            pointsObtained: $('#pointsObtained').val(),
            resultCode: $('#resultCode').val(),
            principlePasses: $('#principlePasses').text(),
            subsidiaryPasses: $('#subsidiaryPasses').text(),
            failures: $('#failures').text()
        };

        // Encode data as JSON
        $('#subjectsFieldAlevel').val(JSON.stringify(formData));

        // Submit the form
        $('#alevelForm').submit();
    });
});


    $('#schoolName').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'fetch_schools.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.Center_Name,
                            value: item.CenterNo + ' ' + item.Center_Name
                        };
                    }));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            const centerNo = ui.item.value.split(' ')[0]; // Extract CenterNo from selected item
            $('#centerNumber').val(centerNo + '/');
        }
    }).data('ui-autocomplete')._renderItem = function(ul, item) {
        return $('<li>')
            .append('<div>' + item.label + '</div>')
            .appendTo(ul);
    };

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
const currentYear = new Date().getFullYear();

        // Calculate the range of years
        const startYear = currentYear - 22;
        const endYear = currentYear - 1;

        // Get the select element
        const yearSelect = document.getElementById('yearOfSitting');

        // Generate options dynamically
        for (let year = endYear; year >= startYear; year--) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
// Add event listeners to form fields
document.getElementById('schoolName').addEventListener('input', checkFormCompletion);
document.getElementById('candidateNumber').addEventListener('change', checkFormCompletion);
document.getElementById('yearOfSitting').addEventListener('change', checkFormCompletion);
document.getElementById('didNotSit').addEventListener('change', function () {
    if (this.checked) {
        // Checkbox is checked, disable other form elements
        document.getElementById('subjectSelectionSection').style.display = 'none';
        document.getElementById('didNotSitWarning').style.display = 'block';

        // Clear values from other form fields
        document.getElementById('schoolName').value = '';
        document.getElementById('centerNumber').value = '';
        document.getElementById('candidateNumber').selectedIndex = 0;
        document.getElementById('yearOfSitting').selectedIndex = 0;
        const subjectsTable = document.getElementById('subjectsTable');
        subjectsTable.innerHTML = ''; // Clear all rows

        // Update summary values
        document.getElementById('pointsObtained').value = '';
        document.getElementById('resultCode').value = '';
        document.getElementById('principlePasses').textContent = '0';
        document.getElementById('subsidiaryPasses').textContent = '0';
        document.getElementById('failures').textContent = '0';
        const subjectJsonInput = document.getElementById('subjectJson');
        subjectJsonInput.value = '';

        // Disable the save button until the warning save button is clicked
        document.getElementById('saveResults').disabled = true;
    } else {
        // Checkbox is unchecked, enable form elements
        checkFormCompletion(); // Check form completion to show/hide subject selection section
        document.getElementById('didNotSitWarning').style.display = 'none';
    }
});

// Handle save button inside warning message
document.getElementById('saveEmptyResults').addEventListener('click', function () {
    // Submit the form with empty or default values
    document.getElementById('alevelSection').submit();
});
document.getElementById('saveResults').addEventListener('click', function () {
// Check if form is complete before submitting
if (document.getElementById('schoolName').value &&
    document.getElementById('centerNumber').value &&
    document.getElementById('candidateNumber').value &&
    document.getElementById('yearOfSitting').value) {
    document.getElementById('alevelSection').submit();
}
});
</script>

</body>
</html>
