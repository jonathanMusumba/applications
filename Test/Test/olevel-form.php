
<form id="olevelForm" method="POST" action="submit_olevel.php" class="border p-4 rounded shadow-sm">
<div class="form-row section-to-validate">
                    <!-- School Name -->
                    <div class="form-group col-md-4">
                        <label for="schoolName">School Name<span class="text-danger">*</span>:</label>
                        <input type="text" class="form-control" id="schoolUCE" name="schoolName" placeholder="Start typing to search and select a school" required>
                        <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
                    </div>

                    <!-- Index Number -->
                    <div class="form-group col-md-4">
                        <label for="indexNumber" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="centerNumberUCE" name="centerNumber" placeholder="Center No." value="U0000" readonly>
                            <input type="hidden" id="indexNumberField" name="indexNumberUCE" value="">
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
                    <select class="form-control" id="yearUCE" name="yearOfSitting" required>
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
                        <div id="subjectSelectionSectionUCE" style="display: none;">
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