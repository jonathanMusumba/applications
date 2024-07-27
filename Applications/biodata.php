        <?php
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "LINMS";
       
        $conn = new mysqli($servername, $username, $password, $dbname);
        $districts = [];
        $userData = [];
        $loggedIn = false; // Initialize login status
       
        try {
            $stmt = $conn->query("SELECT id, district_name FROM districts");
            while ($row = $stmt->fetch_assoc()) {
                $districts[] = $row;
            }
        } catch (Exception $e) {
            echo "Error fetching districts: " . $e->getMessage();
            exit();
        }
        $userData = [];
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                try {
                    $stmt = $conn->prepare("SELECT id, surname, otherNames, dob, sex, email, phone, nationality, applicantNumber FROM users WHERE id = ?");
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $userData = $result->fetch_assoc();
                    $loggedIn = true;
                } catch (Exception $e) {
                    echo "Error fetching user data: " . $e->getMessage();
                    exit();
                }
            } else {
                echo "User not logged in.";
                exit();
            }
            if (!empty($userData['dob'])) {
                $dob = date('d/m/Y', strtotime($userData['dob'])); // Format the dob from database
            } else {
                $dob = ''; // Default value if dob is not available
            }
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application form_Biodata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet"href ="../css/biodata.css">
    <link rel="stylesheet"href ="../css/schemes.css">
    <link rel="stylesheet"href ="../css/apply-now.css">
    <style>#progress-bar {
            margin-bottom: 20px;
        }
        .table-dropdown {
            border: 1px solid #ccc;
            border-collapse: collapse;
            width: 100%;
        }
        .table-dropdown th, .table-dropdown td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .table-dropdown th {
            background-color: #f2f2f2;
        }
        .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #28a745; /* Green background color */
    padding: 10px 20px;
    color: #fff; /* White text color */
}

.logo {
    font-size: 24px;
    font-weight: bold;
}

.navigation {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap to the next line if needed */
    align-items: center;
}

.navigation li {
    margin-right: 10px; /* Adjust spacing between navigation items */
}

.navigation li a {
    color: #fff;
    text-decoration: none;
    padding: 10px;
    transition: background-color 0.3s;
    position: relative;
}

.navigation li a.active,
.navigation li a:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Light background color on hover/active */
    border-radius: 5px;
}

.navigation li a .tooltip {
    visibility: hidden;
    width: 120px;
    background-color: #000;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}

.navigation li a:hover .tooltip {
    visibility: visible;
    opacity: 1;
}

@media (max-width: 767.98px) {
    .navigation {
        justify-content: center; /* Center align navigation items on small screens */
    }

    .navigation li {
        margin: 5px; /* Adjust margin for smaller spacing between items */
    }

    .navigation li a {
        padding: 8px; /* Reduce padding for smaller touch targets */
    }
}; /* Padding for top and bottom */
        
        .form-section {
            margin-bottom: 20px; /* Bottom margin for each form section */
        }
        .progress {
            width: 50%;
            background-color: #ddd;
        }

    .progress-bar {
        background-color: #007bff;
        height: 30px;
        width: 250px;
        text-align: center;
        line-height: 30px;
        color: white;
    }
        </style>
</head>

<body>
<div class="header">
        <div class="logo">Your Logo</div>
        <ul class="navigation">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">My Applications</a></li>
            <li><a href="#">Apply Now</a></li>
            <?php
            if ($loggedIn) {
                // If logged in, show user information and logout button
                echo '<li>Welcome ' . $userData['surname'] . '</li>';
                echo '<li><a href="#" class="logout-btn">';
                echo '<i class="fas fa-sign-out-alt" aria-hidden="true"></i>';
                echo '<span class="tooltip">Logout</span>';
                echo '</a></li>';
            } else {
                // If not logged in, show login button
                echo '<li><a href="#" class="login-btn">';
                echo '<i class="fas fa-sign-in-alt" aria-hidden="true"></i>';
                echo '<span class="tooltip">Login</span>';
                echo '</a></li>';
            }
            ?>
        </ul>
        <div>
            <span id="current-date"><?php echo date("l, F jS Y"); ?></span>
        </div>
    </div>

<section class="container mt-5">
        <div id="progress-bar" class="progress">
            <div id="progress" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
<section class="container mt-5">
    
        <form action="save_biodata.php" method="post">
        <div class="container">
        <div class="container">
        <div class="form-group mt-4">
        <div class="form-group mt-4">
            <button type="button" class="btn btn-secondary" id="continueButton">
                Continue Application
            </button>
        </div>
    </form>

    <!-- Section for Continuing Applicants -->
    <div id="continueSection" style="display: none;">
        <hr class="my-4">
        <h3 class="bg-info text-white p-2 mb-4">Continuing Applicants</h3>
        <form action="check_form_id.php" method="post">
            <div class="form-group">
                <label for="formID">Enter Form ID:</label>
                <input type="text" class="form-control" id="formID" name="formID" required>
            </div>
            <button type="submit" class="btn btn-primary">Continue</button>
        </form>
    </div>
    <section class="container mt-5 progress-section">
    <div class="card mb-4">
    <h3 class="card-header bg-info text-white p-2">Online Application Form</h3>
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="applicantNumber" class="col-sm-4 col-form-label text-left">Applicant Number:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="applicantNumber" name="applicantNumber" value="<?php echo htmlspecialchars($userData['applicantNumber']); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="sourceOfInformation" class="col-sm-4 col-form-label">Source of Information:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="sourceOfInformation" name="sourceOfInformation" onchange="toggleRadioStationInput(this.value)" required>
                                <option value="">Select Source</option>
                                <option value="Social media">Social media</option>
                                <option value="Google">Google</option>
                                <option value="Word of mouth">Word of mouth</option>
                                <option value="Radio">Radio</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" id="radioStationInput" style="display: none;">
                    <div class="form-group row">
                        <label for="radioStation" class="col-sm-4 col-form-label">Radio Station:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="radioStation" name="radioStation">
                                <option value="">Select Radio Station</option>
                                <option value="NBS fm">NBS fm</option>
                                <option value="Baaba fm">Baaba fm</option>
                                <option value="Busoga One fm">Busoga One fm</option>
                                <option value="others">Others</option>
                                <!-- Add more stations as needed -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="container mt-5 progress-section">
<div class="card mb-4">
<h3 class="bg-info text-white p-2 mb-4">SECTION A:ENTRY INFORMATION</h3>
<div class="card-body">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="entryType">Entry Type:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="entryType" id="directEntry" value="direct" required>
                        <label class="form-check-label" for="directEntry">Direct Entry</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="entryType" id="indirectEntry" value="indirect" required>
                        <label class="form-check-label" for="indirectEntry">Indirect Entry</label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="level">Level:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" id="certificateLevel" value="certificate" required>
                        <label class="form-check-label" for="certificateLevel">Certificate</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" id="diplomaLevel" value="diploma" required>
                        <label class="form-check-label" for="diplomaLevel">Diploma</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="course">Course:</label>
                    <select class="form-control" id="course" name="course" required>
                    <option value="">Select Course</option>
                    <?php
                    // Assuming $conn is your database connection
                    $sql = "SELECT course_name, duration, tuition, entry_level FROM courses";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $courseName = $row['course_name'];
                            $duration = $row['duration'];
                            $tuition = $row['tuition'];
                            $entryLevel = $row['entry_level'];

                            // Display each course in a table-like format within the dropdown
                            echo "<option value='$courseName' data-duration='$duration' data-tuition='$tuition' data-entry-level='$entryLevel'>";
                            echo "$courseName</option>";
                        }
                    } else {
                        echo "<option disabled>No courses available</option>";
                    }
                    ?>
                </select>
                </div>
                <div class="form-group col-md-6">
                <label for="academicSession">Academic Session:</label>
                <select class="form-control" id="academicSession" name="academicSession" required>
                    <option value="">Select Academic Session</option>
                    <?php
                    // Get the current year
                    $currentYear = date('Y');

                    // Calculate the academic sessions
                    $startYear = $currentYear;
                    $endYear = $currentYear + 1;
                    $academicSession = "{$startYear}/{$endYear}";

                    // Display options for the next 5 years
                    for ($i = 0; $i < 5; $i++) {
                        echo "<option value=\"$academicSession\">$academicSession</option>";
                        // Increment the start and end years for the next academic session
                        $startYear++;
                        $endYear++;
                        $academicSession = "{$startYear}/{$endYear}";
                    }
                    ?>
                </select>
            </div>
            </div>
    </div>
 </div>
 </section>
 <section class="container mt-5 progress-section">
            <hr class="my-4">
            <div class="card mb-4">
                <h3 class="bg-info text-white p-2 mb-4">SECTION B: BIO-DATA INFORMATION</h3>
            <div class="card-body">
                <div class="row">
                <div class="col-md-4">
                        <div class="form-group">
                        <label for="salutation">Salutation:</label>
                        <select class="form-control" id="salutation" name="salutation" required>
                    <option value="">Select Salutation</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Dr.">Dr.</option>
                    </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="surname">Surname:</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="<?php echo htmlspecialchars($userData['surname']); ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="otherNames">Other Names:</label>
                        <input type="text" class="form-control" id="otherNames" name="otherNames" value="<?php echo htmlspecialchars($userData['otherNames']); ?>">
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">
                    <div class="form-group">
                        <label for="dob">Date of Birth (DD/MM/YYYY):</label>
                        <input type="text" class="form-control" id="dob" name="dob" placeholder="31/01/1990" value="<?php echo htmlspecialchars($userData['dob']); ?>" onchange="updateAge(this.value)" required>
                    </div>
                    </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="text" class="form-control" id="age" name="age" style="width: 60px;" readonly>
                    </div> -->
                    <div id="dobError" class="text-danger"></div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Sex:</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="male" name="sex" value="male" <?php echo ($userData['sex'] == 'male') ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="female" name="sex" value="female" <?php echo ($userData['sex'] == 'female') ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="maritalStatus">Marital Status:</label>
                            <select class="form-control" id="maritalStatus" name="maritalStatus" required>
                                <option value="">Select Marital Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="religion">Religion:</label>
                            <select class="form-control" id="religion" name="religion">
                                <option value="">Select Religion</option>
                                <option value="moslem">Moslem</option>
                                <option value="anglican">Anglican</option>
                                <option value="bornAgain">Born-Again</option>
                                <option value="catholic">Catholic</option>
                                <option value="seventhAdventist">Seventh Adventist</option>
                                <option value="traditionist">Traditionist</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
</div>
</section>
<section class="container mt-5 progress-section">
    <div class="card mb-4">
    <h3 class="card-header bg-info text-white p-2">SECTION C: CONTACT DETAILS</h3>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telephone">Telephone:</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Enter telephone number" value="<?php echo htmlspecialchars($userData['phone']); ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" value="<?php echo htmlspecialchars($userData['email']); ?>" required aria-describedby="emailHelp">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?php echo htmlspecialchars($userData['nationality']); ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="district">District:</label>
                    <select class="form-control" id="district" name="district" required>
                        <option value="" disabled selected>Select District</option>
                        <?php foreach ($districts as $district): ?>
                            <option value="<?php echo htmlspecialchars($district['district_name']); ?>">
                                <?php echo htmlspecialchars($district['district_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="county">County:</label>
                    <input type="text" class="form-control" id="county" name="county" placeholder="Enter county" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="subCounty">Sub County:</label>
                    <input type="text" class="form-control" id="subCounty" name="subCounty" placeholder="Enter sub county" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parish">Parish:</label>
                    <input type="text" class="form-control" id="parish" name="parish" placeholder="Enter parish" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="village">Village/Cell:</label>
                    <input type="text" class="form-control" id="village" name="village" placeholder="Enter village/cell" required>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="container mt-5 progress-section"> 
        <div class="card mb-4">
        <h3 class="card-header bg-info text-white p-2">SECTION D: NEXT OF KIN</h3>
        <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="kinName">Name:</label>
                <input type="text" class="form-control" id="kinName" name="kinName" required>
            </div>
            <div class="form-group col-md-6">
                <label for="kinOccupation">Occupation:</label>
                <input type="text" class="form-control" id="kinOccupation" name="kinOccupation" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="kinTelephone">Telephone:</label>
                <input type="text" class="form-control" id="kinTelephone" name="kinTelephone" required>
            </div>
            <div class="form-group col-md-6">
                <label for="kinEmail">Email:</label>
                <input type="text" class="form-control" id="kinEmail" name="kinEmail" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="kinDistrict">District:</label>
                <select class="form-control" id="kinDistrict" name="kinDistrict" required>
                    <option value="" disabled selected>Select District</option>
                    <?php foreach ($districts as $district): ?>
                        <option value="<?php echo htmlspecialchars($district['district_name']); ?>">
                            <?php echo htmlspecialchars($district['district_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="kinParish">Parish:</label>
                <input type="text" class="form-control" id="kinParish" name="kinParish" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="kinVillage">Village:</label>
                <input type="text" class="form-control" id="kinVillage" name="kinVillage" required>
            </div>
            <div class="form-group col-md-6">
                <label for="kinRelationship">Relationship:</label>
                <select class="form-control" id="kinRelationship" name="kinRelationship" required>
                    <option value="">Select Relationship</option>
                    <option value="Mother">Mother</option>
                    <option value="Father">Father</option>
                    <option value="Husband">Husband</option>
                    <option value="Wife">Wife</option>
                    <option value="Uncle">Uncle</option>
                    <option value="Auntie">Auntie</option>
                    <option value="Sponsor">Sponsor</option>
                    <option value="Grandparent">Grandparent</option>
                    <option value="Sister">Sister</option>
                    <option value="Brother">Brother</option>
                    <option value="Others">Others</option>
                </select>
            </div>
        </div>
    </div>
</div>
</section>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-arrow-right"></i> Next
                </button>
            </div>
        </form>
    </section>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        function validateForm() {
            var indexNumberUCE = document.getElementById("indexNumberUCE").value;
            var yearUCE = document.getElementById("yearUCE").value;
            var yearUACE = document.getElementById("yearUACE").value;

            // Validate index number format
            var indexNumberPattern = /^U\d{4}\/\d{3}$/;
            if (!indexNumberPattern.test(indexNumberUCE)) {
                alert("Invalid index number format. Please use format Uxxxx/xxx");
                return false;
            }

            // Validate UCE year
            var currentYear = new Date().getFullYear();
            if (parseInt(yearUCE) < (currentYear - 1)) {
                alert("UCE year should be at least 1 year before the current year.");
                return false;
            }

            // Validate UACE year
            if (parseInt(yearUACE) < (currentYear + 3)) {
                alert("UACE year should be at least 3 years from the current year.");
                return false;
            }

            return true;
        }
        function calculateAge(dobString) {
    // Split the date string into parts
    var parts = dobString.split('-');

    // Create a Date object from the parsed parts
    var dob = new Date(parts[0], parts[1] - 1, parts[2]);

    // Get today's date
    var today = new Date();

    // Calculate the age
    var age = today.getFullYear() - dob.getFullYear();
    var monthDiff = today.getMonth() - dob.getMonth();
    
    // If the birth month is greater than the current month or
    // if the birth month is equal to the current month but the birth day is greater than the current day
    // subtract one from the age
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
    }

    // Return the calculated age
    return age;
}

function toggleRadioStationInput(source) {
        var radioStationInput = document.getElementById("radioStationInput");
        if (source === "Radio") {
            radioStationInput.style.display = "block";
        } else {
            radioStationInput.style.display = "none";
        }
    }
    document.getElementById('course').addEventListener('change', function() {
            var selectedCourse = this.value;
            console.log('Selected Course:', selectedCourse);
            // You can do further processing or validation here if needed
        });
        document.getElementById('continueButton').addEventListener('click', function() {
        document.getElementById('continueSection').style.display = 'block';
    });
    $(document).ready(function() {
    var totalSections = $('.progress-section').length; // Total number of sections with class 'progress-section'
    
    // Function to calculate and update progress
    function updateProgress() {
        var completedSections = 0;
        
        // Check each section with class 'progress-section' for completion
        $('.progress-section').each(function() {
            var $section = $(this);
            
            // Count completed sections based on filled required fields (including readonly)
            if ($section.find('input[required], select[required]').filter(function() { 
                if ($(this).prop('readonly')) {
                    return true; // Consider readonly fields as filled
                } else {
                    return $(this).val(); // Check for non-readonly fields with a value
                }
            }).length > 0) {
                completedSections++;
            }
        });
        
        // Calculate progress percentage
        var progress = (completedSections / totalSections) * 100;
        
        // Update the progress bar
        $('#progress').css('width', progress + '%').attr('aria-valuenow', progress).text(progress.toFixed(2) + '%');
    }
    
    // Call updateProgress initially and whenever something changes in your form sections
    updateProgress();
    
    // Example event listeners (replace with actual form logic triggering progress update)
    $('input[required], select[required]').on('change keyup', function() {
        // Trigger updateProgress whenever a required field changes
        updateProgress();
    });
});
    </script>
</body>

</html>