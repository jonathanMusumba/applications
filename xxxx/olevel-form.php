<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Level Information Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <form id="olevelForm">
        <div class="form-row section-to-validate">
            <!-- School Name -->
            <div class="form-group col-md-4">
                <label for="schoolUCE">School Name<span class="text-danger">*</span>:</label>
                <input type="text" class="form-control" id="schoolUCE" name="schoolUCE" placeholder="Start typing to search and select a school" required>
                <input type="hidden" id="centerNumberUCE">
                <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
            </div>

            <!-- Index Number -->
            <div class="form-group col-md-4">
                <label for="indexNumberUCE" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="centerNumberUCE" name="centerNumberUCE" placeholder="Center No." readonly>
                    <input type="hidden" id="indexNumberField" name="indexNumber" value="">
                    <div class="input-group-append">
                        <select class="custom-select" id="candidateNumberUCE" name="candidateNumberUCE" required>
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
                <label for="yearUCE" class="required-field">Year of Sitting<span class="text-danger">*</span>:</label>
                <select class="form-control" id="yearUCE" name="yearUCE" required>
                <option value="" disabled selected>Select an Option</option>
                    <!-- Add options dynamically or statically as needed -->
                </select>
            </div>
        </div>

        <!-- Add Subjects Section -->
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
            <table class="table table-bordered" id="subjectsTable">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Subjects will be added here dynamically -->
                </tbody>
            </table>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        // Initialize autocomplete
        $("#schoolUCE").autocomplete({
            source: 'fetch_school.php',
            select: function (event, ui) {
                $('#centerNumberUCE').val(ui.item.centerNo);
            }
        });
        // Populate year selection
        var currentYear = new Date().getFullYear();

        // Define the start and end year for the range
        var startYear = currentYear - 1; // One year before the current year
        var endYear = currentYear - 20;  // Twenty years before the current year

        // Populate the select element with years
        var $yearSelect = $('#yearUCE');
        $yearSelect.empty(); // Clear existing options

        for (var year = startYear; year >= endYear; year--) {
            $yearSelect.append($('<option>', { value: year, text: year }));
        }

        // Enable subjects section once all fields are filled
        $('.section-to-validate input, .section-to-validate select').on('input change', function () {
            const allFilled = $('.section-to-validate input, .section-to-validate select').toArray().every(field => field.value.trim() !== '');
            if (allFilled) {
                $('#subjectSelectionSection').show();
            } else {
                $('#subjectSelectionSection').hide();
            }
        });

        // Add subject to table
        $('#addSubject').click(function () {
            const subject = $('#subject').val();
            const grade = $('#grade').val();
            const subjectText = $('#subject option:selected').text();

            if (subject && grade) {
                const row = `<tr>
                    <td>${subjectText}</td>
                    <td>${grade}</td>
                    <td><button type="button" class="btn btn-danger btn-sm removeSubjectBtn">Remove</button></td>
                </tr>`;
                $('#subjectsTable tbody').append(row);

                // Clear inputs
                $('#subject').val('');
                $('#grade').val('');
            }
        });

        // Remove subject from table
        $(document).on('click', '.removeSubjectBtn', function () {
            $(this).closest('tr').remove();
        });

        // Handle form submission
        $('#olevelForm').submit(function (e) {
            e.preventDefault();

            const formData = {
                school: $('#schoolUCE').val(),
                centerNumber: $('#centerNumberUCE').val(),
                indexNumber: $('#centerNumberUCE').val() + '/' + $('#candidateNumberUCE').val(),
                year: $('#yearUCE').val(),
                subjects: []
            };

            $('#subjectsTable tbody tr').each(function () {
                const subject = $(this).find('td').eq(0).text();
                const grade = $(this).find('td').eq(1).text();
                formData.subjects.push({ subject, grade });
            });

            console.log(JSON.stringify(formData));

            // Save formData as JSON to your desired location
        });
    });
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</body>
</html>