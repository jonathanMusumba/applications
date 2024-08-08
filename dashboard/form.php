<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .required:after {
            content: " *";
            color: red;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control-sm {
            font-size: 14px;
        }
        .row {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Application Form</h2>
        <ul class="nav nav-tabs" id="formTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#bio-data">Bio Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#permanent-address">Permanent Address</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#next-of-kin">Next of Kin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#o-level">O Level Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#a-level">A Level Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#other-qualifications">Other Qualifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#submit-form">Submit Form</a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Bio Data -->
            <div class="tab-pane fade show active" id="bio-data">
                <form id="bioDataForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salutation" class="required">Salutation</label>
                                <select class="form-control form-control-sm" id="salutation" required>
                                    <option value="">Select</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Dr">Dr</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surname" class="required">Surname</label>
                                <input type="text" class="form-control form-control-sm" id="surname" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="otherNames" class="required">Other Names</label>
                                <input type="text" class="form-control form-control-sm" id="otherNames" required pattern="[A-Za-z\s]+" title="Only alphabets are allowed">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sex" class="required">Sex</label>
                                <select class="form-control form-control-sm" id="sex" required>
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob" class="required">Date of Birth</label>
                                <input type="date" class="form-control form-control-sm" id="dob" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="maritalStatus" class="required">Marital Status</label>
                                <select class="form-control form-control-sm" id="maritalStatus" required>
                                    <option value="">Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="religion" class="required">Religion</label>
                                <select class="form-control form-control-sm" id="religion" required>
                                    <option value="">Select</option>
                                    <option value="Christianity">Christianity</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Hinduism">Hinduism</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="required">Email</label>
                                <input type="email" class="form-control form-control-sm" id="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="required">Phone</label>
                                <input type="tel" class="form-control form-control-sm" id="phone" required pattern="^\+[0-9]{1,3}-[0-9]{9,10}$" title="Phone number with country code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality" class="required">Nationality</label>
                                <input type="text" class="form-control form-control-sm" id="nationality" required pattern="[A-Za-z\s]+" title="Only valid country names">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="districtOfBirth" class="required">District of Birth</label>
                                <input type="text" class="form-control form-control-sm" id="districtOfBirth" required pattern="[A-Za-z\s]{1,30}" title="Only alphabets, max 30 characters">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ninNumber">NIN Number</label>
                                <input type="text" class="form-control form-control-sm" id="ninNumber" pattern="^[CFM]{1}[0-9A-Za-z]{13}$" title="Starts with C, F, or M, max 14 characters">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="linNumber">LIN Number</label>
                                <input type="text" class="form-control form-control-sm" id="linNumber" pattern="^[A-Za-z0-9]+$" title="No special characters">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="disability">Any Physical Disability</label>
                                <textarea class="form-control form-control-sm" id="disability" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="saveBioData">Save Bio Information</button>
                </form>
            </div>

            <!-- Permanent Address -->
            <div class="tab-pane fade" id="permanent-address">
                <form id="permanentAddressForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district" class="required">District</label>
                                <input type="text" class="form-control form-control-sm" id="district" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subcounty" class="required">Subcounty</label>
                                <input type="text" class="form-control form-control-sm" id="subcounty" required>
                            </div>
                            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="village" class="required">Village</label>
                        <input type="text" class="form-control form-control-sm" id="village" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="savePermanentAddress">Save Permanent Address</button>
        </form>
    </div>

    <!-- Next of Kin -->
    <div class="tab-pane fade" id="next-of-kin">
        <form id="nextOfKinForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fullName" class="required">Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="fullName" required pattern="[A-Za-z\s]+" title="Only alphabets are allowed">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telephone" class="required">Telephone</label>
                        <input type="tel" class="form-control form-control-sm" id="telephone" required pattern="^\+[0-9]{1,3}-[0-9]{9,10}$" title="Phone number with country code">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Valid email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="relationship" class="required">Relationship</label>
                        <input type="text" class="form-control form-control-sm" id="relationship" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="districtOfResidence" class="required">District of Residence</label>
                        <input type="text" class="form-control form-control-sm" id="districtOfResidence" required pattern="[A-Za-z\s]+" title="Only alphabets are allowed">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="saveNextOfKin">Save Next of Kin</button>
        </form>
    </div>

    <!-- O Level Information -->
    <div class="tab-pane fade" id="o-level">
        <form id="oLevelForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oLevelSchool" class="required">O Level School</label>
                        <input type="text" class="form-control form-control-sm" id="oLevelSchool" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oLevelIndexNumber" class="required">O Level Index Number</label>
                        <input type="text" class="form-control form-control-sm" id="oLevelCenterNumber" placeholder="Center Number" required pattern="[0-9]+" title="Numbers only">
                        <input type="text" class="form-control form-control-sm" id="oLevelCandidateNumber" placeholder="Candidate Number" required pattern="[0-9]+" title="Numbers only">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oLevelYear" class="required">O Level Year</label>
                        <input type="number" class="form-control form-control-sm" id="oLevelYear" required min="1900" max="2099">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="oLevelSubjects" class="required">O Level Subjects</label>
                <div id="oLevelSubjects">
                    <div class="form-row">
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" id="subject" required>
                                <option value="">Select Subject</option>
                                <option value="Math">Math</option>
                                <option value="English">English</option>
                                <option value="Science">Science</option>
                                <!-- Add more subjects as needed -->
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" id="grade" required>
                                <option value="">Select Grade</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <!-- Add more grades as needed -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-secondary" id="addSubject">Add Subject</button>
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
    </div>

    <!-- A Level Information -->
    <div class="tab-pane fade" id="a-level">
        <form id="aLevelForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aLevelSchool" class="required">A Level School</label>
                        <input type="text" class="form-control form-control-sm" id="aLevelSchool" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aLevelIndexNumber" class="required">A Level Index Number</label>
                        <input type="text" class="form-control form-control-sm" id="aLevelCenterNumber" placeholder="Center Number" required pattern="[0-9]+" title="Numbers only">
                        <input type="text" class="form-control form-control-sm" id="aLevelCandidateNumber" placeholder="Candidate Number" required pattern="[0-9]+" title="Numbers only">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aLevelYear" class="required">A Level Year</label>
                        <input type="number" class="form-control form-control-sm" id="aLevelYear" required min="1900" max="2099">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="aLevelSubjects" class="required">A Level Subjects</label>
                <div id="aLevelSubjects">
                    <div class="form-row">
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" id="subject" required>
                                <option value="">Select Subject</option>
                                <option value="Math">Math</option>
                                <option value="English">English</option>
                                <option value="Biology">Biology</option>
                                <!-- Add more subjects as needed -->
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" id="grade" required>
                                <option value="">Select Grade</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <!-- Add more grades as needed -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-secondary" id="addSubject">Add Subject</button>
                        </div>
                    </div>
                    <table class="table table-bordered mt-2" id="aLevelSubjectsTable">
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
            <button type="button" class="btn btn-primary" id="saveALevel">Save A Level Information</button>
        </form>
    </div>

    <!-- Other Qualifications -->
    <div class="tab-pane fade" id="other-qualifications">
        <form id="otherQualificationsForm">
            <div class="form-group">
                <label for="otherQualifications">Other Qualifications</label>
                <textarea class="form-control form-control-sm" id="otherQualifications" rows="5" placeholder="Describe your other qualifications here..."></textarea>
            </div>
            <button type="button" class="btn btn-primary" id="saveOtherQualifications">Save Other Qualifications</button>
        </form>
    </div>
</div>

<!-- Review & Submit -->
<div id="review-submit" class="mt-4">
    <form id="reviewSubmitForm">
        <div class="form-group">
            <label for="declaration" class="required">Declaration</label>
            <textarea class="form-control form-control-sm" id="declaration" rows="4" readonly>Your declaration text here. By submitting, you agree to our terms and conditions.</textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="consentCheckbox" required>
            <label class="form-check-label" for="consentCheckbox">I agree to the declaration above</label>
        </div>
        <button type="submit" class="btn btn-primary" id="submitForm" disabled>Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    // JavaScript to handle dynamic form elements and submit button enabling/disabling
    document.getElementById('consentCheckbox').addEventListener('change', function() {
        document.getElementById('submitForm').disabled = !this.checked;
    });

    document.getElementById('addSubject').addEventListener('click', function() {
        let subject = document.getElementById('subject').value;
        let grade = document.getElementById('grade').value;

        if (subject && grade) {
            let table = document.getElementById('oLevelSubjectsTable').getElementsByTagName('tbody')[0];
            let newRow = table.insertRow();
            newRow.innerHTML = `<tr>
                <td>${subject}</td>
                <td>${grade}</td>
                <td><button type="button" class="btn btn-danger btn-sm removeSubject">Remove</button></td>
            </tr>`;

            // Remove subject row
            newRow.querySelector('.removeSubject').addEventListener('click', function() {
                table.removeChild(newRow);
            });
        } else {
            alert('Please select a subject and a grade.');
        }
    });

    // Similar JavaScript functions for other form interactions
</script>

