<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
                .completed .card-header {
            background-color: #d4edda; /* Light green for completed */
        }
        .incomplete .card-header {
            background-color: #f8d7da; /* Light red for incomplete */
        }

    </style>
</head>

<body>
<div class="container mt-3">
        <div class="alert alert-info">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <h3 id="course-count" style="margin: 0;">Available Courses [0]</h3>
                <button class="btn btn-danger btn-custom" onclick="fetchCourseData()">Refresh Page</button>
            </div>
            <p class="mt-2 mb-0" style="color: red;">Note: To avoid any inconvenience, PLEASE Apply to the Right Scheme. If you are not sure, seek guidance from the Academic Registrar's Office (Admissions Department).</p>
        </div>
    <div class="container mt-5">
        <h2 class="mb-4">ONLINE APPLICATION FORM</h2>
        <div class="accordion" id="applicationFormAccordion">
            <!-- Bio Information Section -->
            <div class="card">
        <div class="card-header" id="bioInfoHeading">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bioInfoCollapse" aria-expanded="true" aria-controls="bioInfoCollapse">
                    <i class="fas fa-user"></i> Bio Information Section
                </button>
                <button class="btn btn-sm btn-outline-primary float-right" onclick="toggleCollapse('#bioInfoCollapse')">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
                <div id="bioInfoCollapse" class="collapse show" aria-labelledby="bioInfoHeading" data-parent="#applicationFormAccordion">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="salutation">Salutation</label>
                                <select id="salutation" class="form-control" required>
                                    <option selected>Choose...</option>
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="surname">Surname</label>
                                <input type="text" class="form-control" id="surname" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="otherNames">Other Names</label>
                                <input type="text" class="form-control" id="otherNames" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="sex">Sex</label>
                                <select id="sex" class="form-control" required>
                                    <option selected>Choose...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="religion">Religion</label>
                                <select id="religion" class="form-control" required>
                                    <option selected>Choose...</option>
                                    <option>Christian</option>
                                    <option>Muslim</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="maritalStatus">Marital Status</label>
                                <select id="maritalStatus" class="form-control" required>
                                    <option selected>Choose...</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="telephone">Telephone</label>
                                <input type="text" class="form-control" id="telephone" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required autocomplete="email" placeholder="Enter your email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="districtOfBirth">District of Birth</label>
                                <select id="districtOfBirth" class="form-control" required>
                                    <option selected>Choose...</option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="districtOfOrigin">District of Origin</label>
                                <select id="districtOfOrigin" class="form-control" required>
                                    <option selected>Choose...</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ninNumber">NIN Number</label>
                                <input type="text" class="form-control" id="ninNumber">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="linNumber">LIN Number</label>
                                <input type="text" class="form-control" id="linNumber">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permanent Address -->
            <div class="card">
        <div class="card-header" id="permanentAddressHeading">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#permanentAddressCollapse" aria-expanded="false" aria-controls="permanentAddressCollapse">
                    <i class="fas fa-home"></i> Permanent Address
                </button>
                <button class="btn btn-sm btn-outline-primary float-right" onclick="toggleCollapse('#permanentAddressCollapse')">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
                <div id="permanentAddressCollapse" class="collapse" aria-labelledby="permanentAddressHeading" data-parent="#applicationFormAccordion">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="addressDistrict">District</label>
                                <select id="addressDistrict" class="form-control" required>
                                    <option selected>Choose...</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="subCounty">Sub County</label>
                                <input type="text" class="form-control" id="subCounty" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="village">Village</label>
                                <input type="text" class="form-control" id="village" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next of Kin -->
            <div class="card">
        <div class="card-header" id="nextOfKinHeading">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#nextOfKinCollapse" aria-expanded="false" aria-controls="nextOfKinCollapse">
                    <i class="fas fa-users"></i> Next of Kin
                </button>
                <button class="btn btn-sm btn-outline-primary float-right" onclick="toggleCollapse('#nextOfKinCollapse')">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
                <div id="nextOfKinCollapse" class="collapse" aria-labelledby="nextOfKinHeading" data-parent="#applicationFormAccordion">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nextOfKinName">Full Name</label>
                                <input type="text" class="form-control" id="nextOfKinName" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nextOfKinPhone">Telephone</label>
                                <input type="text" class="form-control" id="nextOfKinPhone" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nextOfKinDistrict">District</label>
                                <select id="nextOfKinDistrict" class="form-control" required>
                                    <option selected>Choose...</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="relationship">Relationship</label>
                                <input type="text" class="form-control" id="relationship" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Select Course Section -->
                <div class="card">
                    <div class="card-header" id="selectCourseHeading">
                        <h5 class="mb-0 d-flex justify-content-between align-items-center">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#selectCourseCollapse" aria-expanded="false" aria-controls="selectCourseCollapse">
                                <i class="fas fa-book-open"></i> Select Course
                            </button>
                            <button class="btn btn-sm btn-outline-primary" onclick="toggleCollapse('#selectCourseCollapse')">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="selectCourseCollapse" class="collapse" aria-labelledby="selectCourseHeading" data-parent="#applicationFormAccordion">
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <p class="mb-0">Note: To avoid any inconvenience, PLEASE Apply to the Right Scheme. If you are not sure, seek guidance from the Academic Registrar's Office (Admissions Department).</p>
                                <p class="mb-0">For assistance, please call: <strong>(123) 456-7890</strong> or WhatsApp: <strong>(123) 456-7890</strong>. You can also create a ticket <a href="https://support.example.com" target="_blank">here</a>.</p>
                            </div>

                            <!-- Hidden course selection table -->
                            <div id="courseSelection" style="display:none;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Course Name</th>
                                            <th>Duration</th>
                                            <th>Tuition</th>
                                        </tr>
                                    </thead>
                                    <tbody id="courseTableBody">
                                        <!-- Courses will be populated here dynamically -->
                                    </tbody>
                                </table>
                                <button id="confirmCourseBtn" class="btn btn-primary">Select</button>
                            </div>

                            <!-- Course details and Change Course button -->
                                          
                            <div class="form-group col-md-4">
                                <label for="courseDropdown">Select Your Preferred Course of Study</label>
                                <select id="courseDropdown" class="form-control">
                                    <option value="">Select Course</option>
                                </select>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="courseName">Course Name</label>
                                        <input type="text" id="courseName" class="form-control" readonly placeholder="Select a course to display details">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="scheme">Scheme</label>
                                        <input type="text" id="scheme" class="form-control" readonly placeholder="Select a course to display details">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="level">Level</label>
                                        <input type="text" id="level" class="form-control" readonly placeholder="Select a course to display details">
                                    </div>
                                </div>
                            <div id="courseDetails" style="display:none;">
                            <h5>Selected Course Details</h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>Course Name:</strong></td>
                                        <td id="selectedCourseName"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Scheme:</strong></td>
                                        <td id="selectedScheme"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Requirements:</strong></td>
                                        <td id="selectedRequirements"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button id="changeCourseBtn" class="btn btn-primary" style="display:none;" onclick="resetCourseSelection()">Change Course</button>
                        </div>
                        </div>
                    </div>
                </div>
          <!-- O Level Information -->
          <div class="card">
        <div class="card-header" id="oLevelInfoHeading">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#oLevelInfoCollapse" aria-expanded="false" aria-controls="oLevelInfoCollapse">
                    <i class="fas fa-school"></i> O Level Information
                </button>
                <button class="btn btn-sm btn-outline-primary float-right" onclick="toggleCollapse('#oLevelInfoCollapse')">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
            <div id="oLevelInfoCollapse" class="collapse" aria-labelledby="oLevelInfoHeading" data-parent="#applicationFormAccordion">
                <div class="card-body">
                <div class="alert alert-warning">
                                <p class="mb-0">Dear Applicant, please indicate the subjects and grades as they appear on the result slips and Certificate to avoid disqualifications.</p>
                            </div>
                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="schoolNameOLevel">School Name<span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="schoolNameOLevel" name="schoolName" placeholder="Start typing to search and select a school" required>
                            <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
                        </div>
                        <div class="form-group col-md-4">
                        <label for="indexNumberOLevel">Index Number:</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="centerNumberOLevel" readonly placeholder="Center No.">
                            <div class="input-group-append">
                                <select class="custom-select" id="personalNumberOLevel" name="personalNumberOLevel" autocomplete="off">
                                    <option value="">Select candidate number</option>
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>
                        </div>
                        <small id="indexNumberOLevelHelpBlock" class="form-text text-muted">Format: U0000/001</small>
                    </div>
                        <div class="form-group col-md-4">
                            <label for="yearOLevel">Year</label>
                            <select id="yearOLevel" class="form-control" required>
                                <option selected>Choose...</option>
                               
                            </select>
                        </div>
                    </div>
                    <h5>Subject Scores</h5>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="englishGrade">English</label>
                            <select id="englishGrade" class="form-control" required>
                                <option selected>Choose...</option>
                                <option>D1</option>
                                <option>D2</option>
                                <option>C3</option>
                                <option>C4</option>
                                <option>C5</option>
                                <option>C6</option>
                                <option>P7</option>
                                <option>P8</option>
                                <option>F9</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="mathGrade">Mathematics</label>
                            <select id="mathGrade" class="form-control" required>
                                <option selected>Choose...</option>
                                <option>D1</option>
                                <option>D2</option>
                                <option>C3</option>
                                <option>C4</option>
                                <option>C5</option>
                                <option>C6</option>
                                <option>P7</option>
                                <option>P8</option>
                                <option>F9</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="physicsGrade">Physics</label>
                            <select id="physicsGrade" class="form-control" required>
                                <option selected>Choose...</option>
                                <option>D1</option>
                                <option>D2</option>
                                <option>C3</option>
                                <option>C4</option>
                                <option>C5</option>
                                <option>C6</option>
                                <option>P7</option>
                                <option>P8</option>
                                <option>F9</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="chemistryGrade">Chemistry</label>
                            <select id="chemistryGrade" class="form-control" required>
                                <option selected>Choose...</option>
                                <option>D1</option>
                                <option>D2</option>
                                <option>C3</option>
                                <option>C4</option>
                                <option>C5</option>
                                <option>C6</option>
                                <option>P7</option>
                                <option>P8</option>
                                <option>F9</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="biologyGrade">Biology</label>
                            <select id="biologyGrade" class="form-control" required>
                                <option selected>Choose...</option>
                                <option>D1</option>
                                <option>D2</option>
                                <option>C3</option>
                                <option>C4</option>
                                <option>C5</option>
                                <option>C6</option>
                                <option>P7</option>
                                <option>P8</option>
                                <option>F9</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- A Level Information -->
        <div class="card">
        <div class="card-header" id="aLevelInfoHeading">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#aLevelInfoCollapse" aria-expanded="false" aria-controls="aLevelInfoCollapse">
                    <i class="fas fa-graduation-cap"></i> A Level Information (Optional)
                </button>
                <button class="btn btn-sm btn-outline-primary float-right" onclick="toggleCollapse('#aLevelInfoCollapse')">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
        <div id="aLevelInfoCollapse" class="collapse" aria-labelledby="aLevelInfoHeading" data-parent="#applicationFormAccordion">
                <div class="card-body">
                <div class="alert alert-warning">
                                <p class="mb-0">Dear Applicant, please indicate the subjects and grades as they appear on the result slips and Certificate to avoid disqualifications.</p>
                            </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="schoolNameALevel">School Name:</label>
                        <input type="text" class="form-control" id="schoolNameALevel" name="schoolName" placeholder="Start typing to search and select a school">
                        <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
                        </div>
                         <div class="form-group col-md-4">
                        <label for="indexNumberALevel">Index Number:</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="centerNumberALevel" readonly placeholder="Center No.">
                            <div class="input-group-append">
                                <select class="custom-select" id="personalNumberALevel" name="personalNumberALevel" autocomplete="off">
                                    <option value="">Select candidate number</option>
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>
                        </div>
                        <small id="indexNumberALevelHelpBlock" class="form-text text-muted">Format: U0000/501</small>
                    </div>
                        <div class="form-group col-md-4">
                            <label for="yearALevel">Year</label>
                            <select id="yearALevel" class="form-control">
                                <option selected>Choose...</option>
                            
                            </select>
                        </div>
                    </div>
                    <h5>Subject Scores</h5>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="mathGradeALevel">Mathematics</label>
                            <select id="mathGradeALevel" class="form-control">
                                <option selected>Choose...</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                                <option>O</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="biologyGradeALevel">Biology</label>
                            <select id="biologyGradeALevel" class="form-control">
                                <option selected>Choose...</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                                <option>O</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="chemistryGradeALevel">Chemistry</label>
                            <select id="chemistryGradeALevel" class="form-control">
                                <option selected>Choose...</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                                <option>O</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="physicsGradeALevel">Physics</label>
                            <select id="physicsGradeALevel" class="form-control">
                                <option selected>Choose...</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                                <option>O</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="geographyGradeALevel">Geography</label>
                            <select id="geographyGradeALevel" class="form-control">
                                <option selected>Choose...</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                                <option>O</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="agricultureGradeALevel">Agriculture</label>
                            <select id="agricultureGradeALevel" class="form-control">
                                <option selected>Choose...</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                                <option>O</option>
                                <option>F</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Other Qualifications -->
        <div class="card">
        <div class="card-header" id="otherQualificationsHeading">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#otherQualificationsCollapse" aria-expanded="false" aria-controls="otherQualificationsCollapse">
                    <i class="fas fa-certificate"></i> Other Qualifications
                </button>
                <button class="btn btn-sm btn-outline-primary float-right" onclick="toggleCollapse('#otherQualificationsCollapse')">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
        <div id="otherQualificationsCollapse" class="collapse" aria-labelledby="otherQualificationsHeading" data-parent="#applicationFormAccordion">
                <div class="card-body">
                    <h3>Details about Institute</h3>
                    <div class="form-row">
                             <div class="form-group col-md-4">
                            <label for="institutionName">Institution Name</label>
                            <input type="text" class="form-control" id="institutionName">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="courseStudied">Course Studied</label>
                            <input type="text" class="form-control" id="courseStudied">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="startYear">Start Year</label>
                            <select id="startYear" class="form-control">
                                <option selected>Choose...</option>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="completionYear">Completion Year</label>
                            <select id="completionYear" class="form-control">
                                <option selected>Choose...</option>
                                
                            </select>
                        </div>
                    </div>
                    <h3>Additional Details</h3>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="registered">Registered</label>
                            <select id="registered" class="form-control">
                                <option selected>Choose...</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="registrationNumber">Registration Number</label>
                            <input type="text" class="form-control" id="registrationNumber">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="yearOfRegistration">Year of Registration</label>
                            <select id="yearOfRegistration" class="form-control">
                                <option selected>Choose...</option>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="yearsInService">Years Worked</label>
                            <select id="yearsInService" class="form-control">
                                <option selected>Choose...</option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Declaration -->
            <div class="card">
        <div class="card-header" id="declarationHeading">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#declarationCollapse" aria-expanded="false" aria-controls="declarationCollapse">
                    <i class="fas fa-file-signature"></i> Declaration
                </button>
                <button class="btn btn-sm btn-outline-primary float-right" onclick="toggleCollapse('#declarationCollapse')">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
                <div id="declarationCollapse" class="collapse" aria-labelledby="declarationHeading" data-parent="#applicationFormAccordion">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="declarationCheck" required>
                                <label class="form-check-label" for="declarationCheck">
                                    I declare that the information provided is accurate and complete.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="card">
        <div class="card-header" id="submitHeading">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#submitCollapse" aria-expanded="false" aria-controls="submitCollapse">
                    <i class="fas fa-paper-plane"></i> Submit
                </button>
                <button class="btn btn-sm btn-outline-primary float-right" onclick="toggleCollapse('#submitCollapse')">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </h5>
        </div>
                <div id="submitCollapse" class="collapse" aria-labelledby="submitHeading" data-parent="#applicationFormAccordion">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.js"></script>
    <script>
    function initializeAutocomplete(schoolInputId, centerNumberId) {
    $('#' + schoolInputId).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'fetch_schools.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.Center_Name,
                            value: item.CenterNo + ' ' + item.Center_Name
                        };
                    }));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            const centerNo = ui.item.value.split(' ')[0]; // Extract CenterNo from selected item
            $('#' + centerNumberId).val(centerNo + '/');
        }
    }).data('ui-autocomplete')._renderItem = function(ul, item) {
        return $('<li>')
            .append('<div>' + item.label + '</div>')
            .appendTo(ul);
    };
}

// Initialize autocomplete for O Level
initializeAutocomplete('schoolNameOLevel', 'centerNumberOLevel');

// Initialize autocomplete for A Level
initializeAutocomplete('schoolNameALevel', 'centerNumberALevel');

            function populateYears() {
            const currentYear = new Date().getFullYear();
            const startYear = currentYear - 1; // Starting year (one year before current year)
            const endYear = currentYear - 20; // Ending year (20 years before current year)
            const ids = ["completionYear", "startYear", "yearALevel", "yearOLevel","yearOfRegistration"];
    
            ids.forEach(id => {
                const selectElement = document.getElementById(id);
                if (selectElement) {
                    selectElement.innerHTML = ''; // Clear existing options
                    
                    // Add default option
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Choose...';
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    selectElement.appendChild(defaultOption);

                    // Add year options
                    for (let year = startYear; year >= endYear; year--) {
                        const option = document.createElement('option');
                        option.value = year;
                        option.textContent = year;
                        selectElement.appendChild(option);
                    }
                }
            });
        }

        // Ensure the function is called when the page loads
        window.addEventListener('load', populateYears);

        function populateDistricts() {
    console.log('Fetching districts...');
    fetch('fetch_districts.php')
        .then(response => response.json())
        .then(data => {
            console.log('Districts fetched:', data);
            if (Array.isArray(data)) {
                const ids = ["nextOfKinDistrict", "addressDistrict", "districtOfOrigin", "districtOfBirth"];
                ids.forEach(id => {
                    const selectElement = document.getElementById(id);
                    if (selectElement) {
                        // Clear existing options
                        selectElement.innerHTML = '';
                        // Add default option
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = 'Select District';
                        selectElement.appendChild(defaultOption);
                        // Add options from data
                        data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.district_id;
                            option.textContent = district.district_name;
                            selectElement.appendChild(option);
                        });
                        console.log(`Populated districts for ${id}`);
                    }
                });
            } else {
                console.error('Failed to load districts:', data.error || 'Unknown error');
            }
        })
        .catch(error => console.error('Error fetching districts:', error));
}

// Call the function to populate the districts on page load
window.addEventListener('load', populateDistricts);

            function populatePersonalNumbers() {
            const oLevelPersonalNumbers = document.getElementById('personalNumberOLevel');
            const aLevelPersonalNumbers = document.getElementById('personalNumberALevel');

            function populateNumbers(selectElement, start, end) {
                selectElement.innerHTML = ''; // Clear existing options

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select candidate number';
                defaultOption.disabled = true;
                defaultOption.selected = true;
                selectElement.appendChild(defaultOption);

                for (let i = start; i <= end; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i.toString().padStart(3, '0');
                    selectElement.appendChild(option);
                }
            }

            populateNumbers(oLevelPersonalNumbers, 1, 499);
            populateNumbers(aLevelPersonalNumbers, 501, 999);
        }

        window.onload = populatePersonalNumbers;

        document.addEventListener('DOMContentLoaded', function() {
    const courseDropdown = document.getElementById('courseDropdown');
    const courseSelection = document.getElementById('courseSelection');
    const courseTableBody = document.getElementById('courseTableBody');
    const courseNameField = document.getElementById('courseName');
    const schemeField = document.getElementById('scheme');
    const levelField = document.getElementById('level');
    const changeCourseBtn = document.getElementById('changeCourseBtn');
    const courseDetails = document.getElementById('courseDetails');
    const selectedCourseName = document.getElementById('selectedCourseName');
    const selectedScheme = document.getElementById('selectedScheme');
    const selectedRequirements = document.getElementById('selectedRequirements');
    // Initialize fields
    courseNameField.value = '';
    schemeField.value = '';
    levelField.value = '';

    // Fetch and populate courses
    function loadCourses() {
        fetch('fetch_courses.php')
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data); // Debugging statement

                if (Array.isArray(data.courses)) {
                    courseDropdown.innerHTML = '<option value="">Select Course</option>'; // Reset dropdown
                    courseTableBody.innerHTML = ''; // Reset table

                    data.courses.forEach(course => {
                        console.log('Course data:', course); // Debugging statement

                        // Populate dropdown
                        const option = document.createElement('option');
                        option.value = course.course_id;
                        option.textContent = course.course_name;
                        option.dataset.duration = course.Duration || 'N/A';
                        option.dataset.entryLevel = course.Entry_level || 'N/A';
                        option.dataset.scheme = course.Scheme || 'N/A';
                        option.dataset.tuition = course.Tuition || 'N/A';
                        option.dataset.requirements = course.Requirements || 'N/A'; // Added Requirements
                        courseDropdown.appendChild(option);

                        // Populate table with "Select" buttons
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td><button class="btn btn-primary select-course-btn" data-id="${course.course_id}">Select</button></td>
                            <td>${course.course_name}</td>
                            <td>${course.Duration}</td>
                            <td>${course.Tuition}</td>
                        `;
                        courseTableBody.appendChild(row);
                    });

                    // Show the table when the dropdown is clicked
                    courseDropdown.addEventListener('click', function() {
                        courseSelection.style.display = 'block';
                    });
                } else {
                    console.error('Failed to load courses:', data.error || 'Unknown error');
                }
            })
            .catch(error => console.error('Error fetching courses:', error));
    }

    // Handle course selection
    courseTableBody.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('select-course-btn')) {
            const selectedCourseId = event.target.getAttribute('data-id');
            const selectedOption = Array.from(courseDropdown.options).find(option => option.value === selectedCourseId);
            if (selectedOption) {
                courseNameField.value = selectedOption.textContent;
                schemeField.value = selectedOption.dataset.scheme;
                levelField.value = selectedOption.dataset.entryLevel;
                selectedCourseName.textContent = selectedOption.textContent;
                selectedScheme.textContent = selectedOption.dataset.scheme;

                // Set up default requirements
                const requirements = [];
                requirements.push('Must be 18 years and above');
                
                // Specific scheme requirements
                if (selectedOption.dataset.scheme === 'Direct Entry') {
                    requirements.push('Must have at least 5 passes in subjects (English, Mathematics, Physics, Biology, Chemistry)');
                } else if (selectedOption.dataset.scheme === 'Indirect Entry') {
                    requirements.push('Must attach documents, referees');
                    requirements.push('If extension, must be registered and must have worked for not less than 2 years');
                }

                // Update the requirements list as a pipe-separated string
                selectedRequirements.textContent = requirements.join(' | ');
                
                courseSelection.style.display = 'none';
                courseDetails.style.display = 'block';
                changeCourseBtn.style.display = 'inline-block';
            }
        }
    });

    // Reset course selection
    window.resetCourseSelection = function() {
        courseDropdown.value = '';
        courseNameField.value = '';
        schemeField.value = '';
        levelField.value = '';
        selectedCourseName.textContent = '';
        selectedScheme.textContent = '';
        selectedRequirements.textContent = '';
        changeCourseBtn.style.display = 'none';
        courseSelection.style.display = 'none';
        courseDetails.style.display = 'none';
    };

    // Load courses on page load
    loadCourses();
});

function toggleCollapse(target) {
        var element = document.querySelector(target);
        if (element.classList.contains('show')) {
            element.classList.remove('show');
            element.classList.add('collapse');
            document.querySelector('[data-target="'+target+'"] .fas').classList.remove('fa-chevron-up');
            document.querySelector('[data-target="'+target+'"] .fas').classList.add('fa-chevron-down');
        } else {
            element.classList.remove('collapse');
            element.classList.add('show');
            document.querySelector('[data-target="'+target+'"] .fas').classList.remove('fa-chevron-down');
            document.querySelector('[data-target="'+target+'"] .fas').classList.add('fa-chevron-up');
        }
    }
    </script>
</body>

</html>
