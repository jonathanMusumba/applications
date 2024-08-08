<form id="olevel-form">
<div class="row">
<div class="form-group col-md-4">
                <label for="schoolUCE">School Name<span class="text-danger">*</span>:</label>
                <input type="text" class="form-control" id="schoolUCE" name="schoolName" placeholder="Start typing to search and select a school" required>
                <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
            </div>

                    <!-- Index Number -->
                    <div class="form-group col-md-4">
                    <label for="centerNumberUCE" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="centerNumberUCE" name="centerNumber" placeholder="Center No." value="U0000" readonly>
                    <input type="hidden" id="indexNumberField" name="indexNumberUCE" value="">
                    <div class="input-group-append">
                        <select class="custom-select" id="candidateNumber" name="candidateNumber" required>
                            <option value="">Select candidate number</option>
                            <?php
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
                <select class="form-control" id="yearUCE" name="yearOfSitting" required>
                    <option value="" disabled selected>Select a year</option>
                </select>
                </div>
            </div>
        <div class="form-group">
            <label for="oLevelSubjects" class="required">O Level Subjects</label>
            <div id="oLevelSubjects">
                <div class="form-row">
                    <div class="col-md-5">
                        <select class="form-control form-control-sm" id="subject" required>
                        <option value="" disabled selected>Select O level subjetcs</option>
                                    <option value="ENG">ENGLISH LANGUAGE</option>
                                    <option value="CRE">CRE: CHRISTIAN LIVING TODAY</option>
                                    <option value="HIS">HISTORY</option>
                                    <option value="GEO">GEOGRAPHY</option>
                                    <option value="MTC">MATHEMATICS</option>
                                    <option value="AGR">AGRIC PRINCIPLES AND PRACTICES</option>
                                    <option value="PHY">PHYSICS</option>
                                    <option value="CHE">CHEMISTRY</option>
                                    <option value="BIO">BIOLOGY</option>
                                    <option value="COM">COMMERCE</option>
                                    <option value="LUS">LUSOGA</option>
                                    <option value="IPS">IPS (ART)</option>
                                    <option value="KIS">KISWAHILI</option>
                                    <option value="LUG">LUGANDA</option>
                                    <option value="ICT">ICT</option>
                                    <option value="ENT">ENTREPRENEURSHIP</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control form-control-sm" id="grade" required>
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
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-secondary" id="addOLevelSubject">Add Subject</button>
                    </div>
                </div>
                <table class="table table-bordered mt-2" id="oLevelSubjectsTable">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Subjects will be appended here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="oLevelAggregates">Aggregates</label>
                    <input type="number" class="form-control form-control-sm" id="oLevelAggregates" min="8" max="64" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="oLevelDivision">Division</label>
                    <input type="number" class="form-control form-control-sm" id="oLevelDivision" min="1" max="4" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="saveOLevel">Save O Level Information</button>
    </form>
</form>
