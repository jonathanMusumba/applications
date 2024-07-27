<!-- A Level Form -->
<form id="alevelForm" method="POST" action="submit_alevel.php" class="border p-4 rounded shadow-sm">
    <!-- Academic Details -->
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
                                <input type="text" class="form-control" id="schoolUACE" name="schoolName" placeholder="Start typing to search and select a school" required>
                                <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
                            
                            </div>

                                                        <!-- Index Number -->
                                <div class="form-group col-md-4">
                                <label for="indexNumber" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="centerNumberUACE" name="centerNumber" placeholder="Center No." value="U0000" readonly>
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
</form>
