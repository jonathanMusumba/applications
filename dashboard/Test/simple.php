<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical School Admission Application</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .form-section {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-section h4 {
            margin-bottom: 15px;
        }
        .form-control-sm {
            height: calc(1.5em + .75rem + 2px);
        }
        .optional-section {
            display: none;
        }
        .invalid-feedback {
                display: none;
            }

            .is-invalid ~ .invalid-feedback {
                display: block;
            }
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
        .required-field::after {
            content: '*';
            color: red;
            margin-left: 5px;
        }
        .dynamic-fields .form-row {
            margin-bottom: 10px;
        }
        .dynamic-fields .remove-btn {
            cursor: pointer;
            color: #dc3545;
            margin-top: 10px;
        }
        .dynamic-fields .remove-btn:hover {
            color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
    <h2 class="mb-4 text-center">
            <i class="fas fa-clipboard-list"></i> APPLICATION FORM
        </h2>

        <!-- Notification Alert -->
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle"></i> Dear <span id="applicantSurname">Applicant</span>, please fill all the required fields marked with  <span style="color: red;">*</span>.
        </div>

        <form id="admission-form">
            <!-- Personal Information Section -->
            <div class="form-section" id="personal-info-section">
                <h4>Personal Information</h4>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="salutation">Salutation</label>
                        <select id="salutation" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Select Salutation</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Dr">Dr</option>
                        </select>
                        <div class="invalid-feedback">Salutation is required.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control form-control-sm" id="surname" required>
                        <div class="invalid-feedback">Surname is required.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="otherNames">Other Names</label>
                        <input type="text" class="form-control form-control-sm" id="otherNames" required>
                        <div class="invalid-feedback">Other Names are required.</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="sex">Sex</label>
                        <select id="sex" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback">Sex is required.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control form-control-sm" id="dob" required>
                        <div class="invalid-feedback">Date of Birth is required.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="religion">Religion</label>
                        <select id="religion" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Select Religion</option>
                            <option value="Protestant">Protestant</option>
                            <option value="Islam">Islam</option>
                            <option value="Born-Again">Born-again</option>
                            <option value="Adventist">Adventist</option>
                            <option value="Catholic">Catholic</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="invalid-feedback">Religion is required.</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="maritalStatus">Marital Status</label>
                        <select id="maritalStatus" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Select Marital Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                        <div class="invalid-feedback">Marital Status is required.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telephone">Telephone</label>
                        <input type="tel" class="form-control form-control-sm" id="telephone" required>
                        <div class="invalid-feedback">Telephone is required.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" required>
                        <div class="invalid-feedback">Email is required.</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nin">NIN Number</label>
                        <input type="text" class="form-control form-control-sm" id="nin">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lin">LIN Number</label>
                        <input type="text" class="form-control form-control-sm" id="lin">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="district">District of Residence</label>
                        <select id="district" class="form-control form-control-sm" required>
                        <option value="" disabled selected>Select District</option>
                        <!-- Options will be populated here -->
                    </select>
                        <div class="invalid-feedback">District is required.</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="physicalDisability">Any Physical Disability</label>
                    <textarea class="form-control form-control-sm" id="physicalDisability"></textarea>
                </div>
            </div>
            
            <!-- Permanent Address Section -->
            <div class="form-section" id="permanent-address-section">
                <h4>Permanent Address</h4>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="addressDistrict">District</label>
                        <select id="addressDistrict" class="form-control form-control-sm" required>
                            <option value="" disabled selected>Select District</option>
                            <!-- Options will be populated here -->
                        </select>
                        <div class="invalid-feedback">District is required.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="addressSubcounty">Subcounty</label>
                        <input type="text" class="form-control form-control-sm" id="addressSubcounty" required>
                        <div class="invalid-feedback">Subcounty is required.</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="addressVillage">Village</label>
                        <input type="text" class="form-control form-control-sm" id="addressVillage" required>
                        <div class="invalid-feedback">Village is required.</div>
                    </div>
                </div>
            </div>

            <!-- Next of Kin Section -->
            <div class="form-section" id="next-of-kin-section">
                <h4>Next of Kin</h4>
                <div class="form-group">
                    <label for="nextOfKinName">Name</label>
                    <input type="text" class="form-control form-control-sm" id="nextOfKinName" required>
                    <div class="invalid-feedback">Name is required.</div>
                </div>
                <div class="form-group">
                    <label for="nextOfKinTelephone">Telephone</label>
                    <input type="tel" class="form-control form-control-sm" id="nextOfKinTelephone" required>
                    <div class="invalid-feedback">Telephone is required.</div>
                </div>
                <div class="form-group">
                    <label for="nextOfKinEmail">Email (optional)</label>
                    <input type="email" class="form-control form-control-sm" id="nextOfKinEmail">
                </div>
                <div class="form-group">
                <label for="nextOfKinDistrict">District</label>
                <select id="nextOfKinDistrict" class="form-control form-control-sm" required>
                    <option value="" disabled selected>Select District</option>
                
                    <!-- Options will be populated here --
                    <!-- Add more districts as needed -->
                </select>
                <div class="invalid-feedback">District is required.</div>
            </div>

            </div>

            <!-- Course of Study Section -->
            <div class="form-section" id="course-of-study-section">
                <h4>Course of Study</h4>
                <div class="form-group">
                    <label for="course">Course</label>
                    <input type="text" class="form-control form-control-sm" id="course" required>
                </div>
                <div class="form-group">
                    <label for="scheme">Scheme</label>
                    <select id="scheme" class="form-control form-control-sm">
                        <option>Direct Entry</option>
                        <option>Indirect Entry</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="entryLevel">Entry Level</label>
                    <select id="entryLevel" class="form-control form-control-sm">
                        <option>CERTIFICATE</option>
                        <option>DIPLOMA</option>
                        <!-- Add other entry levels as needed -->
                    </select>
                </div>
            </div>

            <!-- Academic Background Section -->
            <div class="form-section" id="academic-background-section">
                <h4>Academic Background</h4>

                <!-- O Level Information -->
                <div class="form-group">
                    <label for="oLevelSchool">O Level - School Name</label>
                    <input type="text" class="form-control form-control-sm" id="oLevelSchool" required>
                    <div class="invalid-feedback">School Name is required.</div>
                </div>
                <div class="form-group">
                    <label for="oLevelIndex">O Level - Index Number</label>
                    <input type="text" class="form-control form-control-sm" id="oLevelIndex" required>
                    <div class="invalid-feedback">Index Number is required.</div>
                </div>
                <div class="form-group">
                    <label for="oLevelYear">O Level - Year</label>
                    <input type="number" class="form-control form-control-sm" id="oLevelYear" required>
                    <div class="invalid-feedback">Year is required.</div>
                </div>

                <!-- O Level Subjects -->
                <div class="form-section" id="o-level-subjects-section">
                <h4>O Level - Subjects and Grades</h4>
                <div id="oLevelSubjects" class="dynamic-fields">
                    <!-- Example Subject Entry -->
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <select class="form-control form-control-sm" name="oLevelSubject[]" required>
                                <option value="" disabled selected>Select Subject</option>
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
                        <div class="form-group col-md-6">
                            <select class="form-control form-control-sm" name="oLevelGrade[]" required>
                                <option value="" disabled selected>Select Grade</option>
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
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-danger remove-btn">Remove</button>
                        </div>
                    </div>
                    <!-- More subjects can be added dynamically -->
                </div>
                <button type="button" id="addOLevelSubject" class="btn btn-primary">Add Subject</button>
                <div class="invalid-feedback">At least 8 subjects including essential subjects are required.</div>
            </div>

                <!-- Optional A Level Information -->
                <div class="optional-section" id="aLevelSection">
                <h5>A Level (Optional)</h5>
                <div class="form-group">
                    <label for="aLevelSchool">A Level - School Name</label>
                    <input type="text" class="form-control form-control-sm" id="aLevelSchool">
                </div>
                <div class="form-group">
                    <label for="aLevelIndex">A Level - Index Number</label>
                    <input type="text" class="form-control form-control-sm" id="aLevelIndex">
                </div>
                <div class="form-group">
                    <label for="aLevelYear">A Level - Year</label>
                    <input type="number" class="form-control form-control-sm" id="aLevelYear">
                </div>
                <div class="form-group">
                    <label for="aLevelSubjects">A Level - Subjects and Scores</label>
                    <div id="aLevelSubjects">
                        <!-- Principal Subjects -->
                        <label>Principal Subjects (Min 3)</label>
                        <div id="aLevelPrincipalSubjects">
                            <!-- Example Principal Subject Entry -->
                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <select class="form-control form-control-sm" name="aLevelPrincipalSubject[]" required>
                                        <option value="" disabled selected>Select Principal Subject</option>
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
                                        <option value="ENTREPRENEURSHIP">ENTREPRENEURSHIP</option>
                                        <option value="LUGANDA">LUGANDA</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control form-control-sm" name="aLevelPrincipalGrade[]" required>
                                        <option value="" disabled selected>Select Grade</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="O">O</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" class="btn btn-danger remove-btn">Remove</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addPrincipalSubject" class="btn btn-primary">Add Principal Subject</button>
                        
                        <!-- Subsidiary Subjects -->
                        <label>Subsidiary Subjects (Max 2)</label>
                        <div id="aLevelSubsidiarySubjects">
                            <!-- Example Subsidiary Subject Entry -->
                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <select class="form-control form-control-sm" name="aLevelSubsidiarySubject[]">
                                        <option value="" disabled selected>Select Subsidiary Subject</option>
                                        <option value="GP">GENERAL PAPER (GP)</option>
                                        <option value="ICT">SUB ICT (ICT)</option>
                                        <option value="SUB_MTC">SUB MATH (SUB MTC)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control form-control-sm" name="aLevelSubsidiaryGrade[]">
                                        <option value="" disabled selected>Select Grade</option>
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
                                <div class="form-group col-md-12">
                                    <button type="button" class="btn btn-danger remove-btn">Remove</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addSubsidiarySubject" class="btn btn-primary">Add Subsidiary Subject</button>
                        <div class="invalid-feedback">At least 3 Principal subjects and up to 2 Subsidiary subjects are required.</div>
                    </div>
                </div>
            </div>
                <!-- Optional Other Qualifications -->
                <div class="optional-section" id="otherQualificationsSection">
                    <h5>Other Qualifications (Optional)</h5>
                    <div class="form-group">
                        <label for="institutionName">Institution Name</label>
                        <input type="text" class="form-control form-control-sm" id="institutionName">
                    </div>
                    <div class="form-group">
                        <label for="courseOfStudy">Course of Study</label>
                        <input type="text" class="form-control form-control-sm" id="courseOfStudy">
                    </div>
                    <div class="form-group">
                        <label for="qualificationGrade">Grade Obtained</label>
                        <input type="text" class="form-control form-control-sm" id="qualificationGrade">
                    </div>
                </div>
            </div>

            <!-- Declaration Section -->
            <div class="form-section" id="declaration-section">
                <h4>Declaration</h4>
                <div class="form-group">
                    <input type="checkbox" id="declaration" required>
                    <label for="declaration">I certify that the information provided is accurate and complete to the best of my knowledge.</label>
                    <div class="invalid-feedback">You must agree to the declaration.</div>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="consent" required>
                    <label for="consent">I consent to the use of my personal data in accordance with the institution’s privacy policy.</label>
                    <div class="invalid-feedback">You must consent to the privacy policy.</div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="form-section">
                <button type="button" id="prev-section" class="btn btn-secondary">Previous Section</button>
                <button type="button" id="next-section" class="btn btn-primary">Next Section</button>
                <button type="submit" class="btn btn-success">Submit Form</button>
            </div>
        </form>
    </div>

    <!-- Toast Notifications -->
    <div class="toast" id="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Form Status</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Data saved.
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="simple.js"></script>
</body>
</html>
