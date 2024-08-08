<form id="alevel-form">
<div class="form-row">
            <div class="form-group col-md-4">
                <label for="schoolUACE">School Name<span class="text-danger">*</span>:</label>
                <input type="text" class="form-control" id="schoolUACE" name="schoolName" placeholder="Start typing to search and select a school" required>
                <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
            </div>

            <div class="form-group col-md-4">
                <label for="centerNumberUACE" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="centerNumberUACE" name="centerNumber" placeholder="Center No." value="U0000" readonly>
                    <div class="input-group-append">
                        <select class="custom-select" id="candidateNumberUACE" name="candidateNumber" required>
                            <option value="">Select candidate number</option>
                            <?php
                            for ($i = 501; $i <= 999; $i++) {
                                printf('<option value="%03d">%03d</option>', $i, $i);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <small id="indexNumberHelpBlock" class="form-text text-muted">Format: U1234/123</small>
            </div>

            <div class="form-group col-md-4">
                <label for="yearUACE" class="required-field">Year of Sitting<span class="text-danger">*</span>:</label>
                <select class="form-control" id="yearUACE" name="yearOfSitting" required>
                    <option value="" disabled selected>Select a year</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>A Level Subjects and Grades</label>
            <div class="form-row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select class="form-control form-control-sm" id="subjectSelect">
                            <option value="">Select Subject</option>
                            <option value="MATHEMATICS">MATHEMATICS</option>
                            <option value="BIOLOGY">BIOLOGY</option>
                            <option value="CHEMISTRY">CHEMISTRY</option>
                            <option value="PHYSICS">PHYSICS</option>
                            <option value="AGRICULTURE">AGRICULTURE</option>
                            <option value="GEOGRAPHY">GEOGRAPHY</option>
                            <option value="LUSOGA">LUSOGA</option>
                            <option value="DIVINITY">DIVINITY</option>
                            <option value="LITERATURE">LITERATURE</option>
                            <option value="ECONOMICS">ECONOMICS</option>
                            <option value="ENTREPRENUERSHIP">ENTREPRENUERSHIP</option>
                            <option value="LUGANDA">LUGANDA</option>
                            <!-- Add more subjects as needed -->
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <select class="form-control form-control-sm" id="gradeSelect">
                            <option value="">Select Grade</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="O">O</option>
                            <option value="F">F</option>
                            <!-- Add more grades as needed -->
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary mt-4" id="addSubject">Add Subject</button>
                </div>
            </div>
            <table class="table table-bordered" id="aLevelSubjectsTable">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <button type="button" class="btn btn-success" id="saveALevel">Save A Level Information</button>

</form>
