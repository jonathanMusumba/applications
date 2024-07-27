<?php
include("../scripts/uce.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['olevel_data'] = json_encode($_POST);
    header("Location: success_page.php");
    exit();
}
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
            <form id="olevelSection" class="form-section" method="POST" action="">
                <div class="form-group">
                    <input type="checkbox" id="didNotSit" name="didNotSit">
                    <label for="didNotSit">I DID NOT SIT FOR UGANDA CERTIFICATE OF EDUCATION EXAMINATIONS</label>
                </div>
                <div class="alert alert-warning warning-message" id="didNotSitWarning">
                    YOU SELECTED YOU DID NOT SIT FOR UGANDA CERTIFICATE OF EDUCATION (UCE) EXAMINATIONS.
                    If you continue to save this result, you will not be able to edit this option.
                    <button type="button" id="saveEmptyResults" class="btn btn-danger mt-2">Save Results</button>
                </div>
                <div class="form-row section-to-validate">
                <!-- School Name -->
                <div class="form-group col-md-4">
                    <label for="schoolUCE">School Name<span class="text-danger">*</span>:</label>
                    <input type="text" class="form-control" id="schoolUCE" name="schoolUCE" placeholder="Start typing to search and select a school" required>
                    <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
                </div>

                <!-- Index Number -->
                <div class="form-group col-md-4">
                    <label for="indexNumberUCE" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="centerNumberUCE" name="centerNumberUCE" placeholder="Center No." value="U0000" readonly>
                        <input type="hidden" id="indexNumberField" name="indexNumberUCE" value="">
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
                    </select>
                </div>
            </div>
                        <div id="subjectSelectionSection" style="display: none;">
                        <div class="form-group row">
                            <label for="subject" class="col-sm-3 col-form-label">Select Subject:</label>
                            <input type="hidden" id="subjectsField" name="SubjectsUCE" value="">
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
                                            <label for="aggregates" class="mr-2">AGGREGATE<span class="text-danger">*</span>:</label>
                                            <input type="number" class="form-control" id="aggregates" name="aggregates" required min="8" max="68">
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
                                            <button type="submit" id="saveResults" class="btn btn-success">Save Results</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function () {
            // Initialize the autocomplete for schoolUCE input
            $("#schoolUCE").autocomplete({
                source: 'school_search.php',
                minLength: 2, // Minimum number of characters to trigger autocomplete
                select: function (event, ui) {
                    // Handle the selection event here if needed
                }
            });

            // Populate the year select dropdown dynamically
            var currentYear = new Date().getFullYear();
            for (var year = currentYear; year >= 1980; year--) {
                $('#yearUCE').append($('<option>', {
                    value: year,
                    text: year
                }));
            }

            // Show/hide sections based on "didNotSit" checkbox
            $("#didNotSit").change(function () {
                if (this.checked) {
                    $("#didNotSitWarning").show();
                    $(".section-to-validate").hide();
                    $("#subjectSelectionSection").hide();
                    $("#saveEmptyResults").show();
                } else {
                    $("#didNotSitWarning").hide();
                    $(".section-to-validate").show();
                    $("#subjectSelectionSection").show();
                    $("#saveEmptyResults").hide();
                }
            });

            // Save empty results when the "Save Results" button is clicked
            $("#saveEmptyResults").click(function () {
                var emptyData = {
                    didNotSit: true,
                    schoolUCE: "",
                    centerNumberUCE: "",
                    candidateNumberUCE: "",
                    indexNumberUCE: "",
                    yearUCE: "",
                    SubjectsUCE: [],
                    division: "",
                    aggregates: ""
                };
                $.post("", emptyData, function () {
                    alert("Data saved successfully!");
                    location.reload();
                });
            });

            // Add subject and grade to the table
            $("#addSubject").click(function () {
                var subject = $("#subject").val();
                var grade = $("#grade").val();
                var subjectName = $("#subject option:selected").text();

                if (subject && grade) {
                    var row = "<tr>";
                    row += "<td>" + subject + "</td>";
                    row += "<td>" + subjectName + "</td>";
                    row += "<td>" + grade + "</td>";
                    row += "<td><button type='button' class='btn btn-danger btn-sm remove-subject'>Remove</button></td>";
                    row += "</tr>";

                    $("#subjectsTable").append(row);

                    // Reset the dropdowns after adding
                    $("#subject").val("");
                    $("#grade").val("");

                    // Update the summary counts
                    updateSummary();
                }
            });

            // Remove subject from the table
            $(document).on("click", ".remove-subject", function () {
                $(this).closest("tr").remove();
                updateSummary();
            });

            // Update the summary counts
            function updateSummary() {
                var distinctions = 0;
                var credits = 0;
                var passes = 0;
                var failures = 0;

                $("#subjectsTable tr").each(function () {
                    var grade = $(this).find("td:eq(2)").text();

                    if (grade.startsWith("D")) {
                        distinctions++;
                    } else if (grade.startsWith("C")) {
                        credits++;
                    } else if (grade.startsWith("P")) {
                        passes++;
                    } else if (grade.startsWith("F")) {
                        failures++;
                    }
                });

                $("#distinctions").text(distinctions);
                $("#credits").text(credits);
                $("#passes").text(passes);
                $("#failures").text(failures);
            }

            // Save the form data as JSON on submit
            $("#olevelSection").submit(function (e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                var jsonData = {};

                // Convert form data to JSON object
                $.each(formData, function () {
                    jsonData[this.name] = this.value;
                });

                // Collect subjects from the table
                var subjects = [];
                $("#subjectsTable tr").each(function () {
                    var subject = {};
                    subject.code = $(this).find("td:eq(0)").text();
                    subject.name = $(this).find("td:eq(1)").text();
                    subject.grade = $(this).find("td:eq(2)").text();
                    subjects.push(subject);
                });
                jsonData.SubjectsUCE = subjects;

                // Save JSON data in a hidden input field
                $("#subjectsField").val(JSON.stringify(subjects));

                // Post the form data to the server
                $.post("", jsonData, function () {
                    alert("Data saved successfully!");
                    location.reload();
                });
            });
        });
    </script>
</body>

</html>
