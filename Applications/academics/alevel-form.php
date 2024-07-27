<!-- A Level Form -->
<form id="alevelForm" method="POST" action="submit_alevel.php" class="border p-4 rounded shadow-sm">
<input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
<input type="hidden" name="applicantNumber" value="<?php echo htmlspecialchars($applicantNumber); ?>">
<input type="hidden" name="completionStatus" id="completionStatus" value="incomplete">
<form id="uaceForm">
<div class="form-group">
        <button type="button" id="skipSection" class="btn btn-secondary">Skip This Section</button>
    </div>

    <!-- Additional form fields for A Level information -->
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="schoolName">School Name:</label>
            <input type="text" class="form-control" id="schoolUACE" name="schoolName" placeholder="Start typing to search and select a school">
            <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
        </div>

        <!-- Index Number -->
        <div class="form-group col-md-4">
            <label for="indexNumber">Index Number:</label>
            <div class="input-group">
                <input type="text" class="form-control" id="centerNumberUACE" name="centerNumber" placeholder="Center No." value="U0000" readonly>
                <div class="input-group-append">
                    <select class="custom-select" id="candidateNumber" name="candidateNumber">
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
            <label for="yearOfSitting">Year of Sitting:</label>
            <select class="form-control" id="yearUACE" name="yearOfSitting">
                <option value="" disabled selected>Select an Option</option>
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear; $year >= 1990; $year--) {
                    echo "<option value=\"$year\">$year</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div id="subjectSelectionSection">
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
                                    <option value="S475">SUBSIDIARY MATH</option><!-- Subject options will be here -->
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
                </select>
            </div>
            <div class="col-sm-2">
                <button type="button" id="addSubjectUACE" class="btn btn-primary">Add Subject</button>
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
    </div>

    <button type="submit" id="saveResults" class="btn btn-success" disabled>Save Results</button>
</form>

<div id="validationMessage" class="mt-3"></div>