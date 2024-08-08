<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information & Course of Study</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        .invalid-feedback {
            display: none;
        }
        .is-invalid ~ .invalid-feedback {
            display: block;
        }
        .required-field::after {
            content: '*';
            color: red;
            margin-left: 5px;
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
            <i class="fas fa-info-circle"></i> Please fill all the required fields marked with <span style="color: red;">*</span>.
        </div>

        <form id="admission-form-part1">
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
                     <div class="invalid-feedback">Applicant should be 18 years and above.</div>
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
                    <label for="course" class="required-field">Course</label>
                    <input type="text" class="form-control" id="course" name="course" required>
                    <div class="invalid-feedback">Course is required.</div>
                </div>
                <div class="form-group">
                    <label for="studyMode" class="required-field">Mode of Study</label>
                    <select class="form-control" id="studyMode" name="studyMode" required>
                        <option value="">Select Mode</option>
                        <option value="Full-Time">Full-Time</option>
                        <option value="Part-Time">Part-Time</option>
                    </select>
                    <div class="invalid-feedback">Mode of Study is required.</div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="form-section">
                <button type="button" id="next-section" class="btn btn-primary">Next Section</button>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="personal-info-course.js"></script>
</body>
</html>
