<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize districts and user data arrays
$districts = [];
$userData = [];
$loggedIn = false; // Initialize login status

try {
    // Fetch districts from database
    $stmt = $conn->query("SELECT id, district_name FROM districts");
    while ($row = $stmt->fetch_assoc()) {
        $districts[] = $row;
    }
} catch (Exception $e) {
    echo "Error fetching districts: " . $e->getMessage();
    exit();
}

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    try {
        // Fetch user data based on user ID
        $stmt = $conn->prepare("SELECT id, surname, otherNames, dob, sex, email, phone, nationality, applicantNumber FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();
        $loggedIn = true;
        
        // Set applicantNumber in session if found
        if (!empty($userData['applicantNumber'])) {
            $_SESSION['applicantNumber'] = $userData['applicantNumber'];
        } else {
            // Handle case where applicantNumber is empty
            echo "applicantNumber not found for user.";
            exit();
        }
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
    <link rel="stylesheet" href="../css/biodata.css">
    <link rel="stylesheet" href="../css/schemes.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="js/dashboard.js"></script>
    
</head>

<body>
    <div class="header">
        <div class="logo">LUBEGA INSTITUTE ONLINE APPLICATION</div>
        <ul class="navigation">
            <li><a href="#" class="apply-now active">Apply Now</a></li>
            <li><a href="applicationHistory.php" class="applications">My Applications</a></li>
            <li><a href="admissionHistory.php" class="admissions">My Admissions</a></li>
            <?php
            if ($loggedIn) {
                // If logged in, show user information and logout button
                echo '<li>Welcome ' . $userData['surname'] . '</li>';
                echo '<li><a href="../../applicants/logout.php" class="logout-btn">';
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
        <div>
            <label class="switch">
                <input type="checkbox" id="dark-mode-toggle">
                <span class="slider round"></span>
            </label>
        </div>
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
                   
                   $sql = "SELECT course_name, Duration, Tuition, scheme, Entry_Level FROM courses";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $courseName = $row['course_name'];
                            $duration = $row['Duration'];
                            $tuition = $row['Tuition'];
                            $entryType = $row['scheme']; // Corresponds to entryType in the form
                            $entryLevel = $row['Entry_Level']; // Corresponds to level in the form

                            echo "<option value='$courseName' data-entry-type='$entryType' data-entry-level='$entryLevel'>";
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
                    <option value="Parent">Parent</option>
                    <option value="Husband">Husband</option>
                    <option value="Wife">Wife</option>
                    <option value="Guardian">Guardian</option>                    
                    <option value="Sister">Sister</option>
                    <option value="Brother">Brother</option>
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
    
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    // Check if dark mode preference is saved in local storage
    const currentMode = localStorage.getItem('darkMode');
    if (currentMode === 'dark') {
        enableDarkMode();
        darkModeToggle.checked = true;
    } else {
        enableLightMode(); // Default to light mode
        darkModeToggle.checked = false;
    }

    // Listen for changes in the checkbox
    darkModeToggle.addEventListener('change', function() {
        if (darkModeToggle.checked) {
            enableDarkMode();
            localStorage.setItem('darkMode', 'dark'); // Save dark mode preference
        } else {
            enableLightMode();
            localStorage.setItem('darkMode', 'light'); // Save light mode preference
        }
    });

    // Function to enable dark mode
    function enableDarkMode() {
        document.body.classList.add('dark-mode');
        // Change text color to white when dark mode is enabled
        document.querySelectorAll('.header li a').forEach(function(link) {
            link.style.color = '#fff';
        });
    }s

    // Function to enable light mode
    function enableLightMode() {
        document.body.classList.remove('dark-mode');
        // Reset text color when light mode is enabled (assuming your default styles handle this)
        document.querySelectorAll('.header li a').forEach(function(link) {
            link.style.color = ''; // Reset to default or CSS defined color
        });
    }
});


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
document.addEventListener('DOMContentLoaded', function() {
    const entryTypeRadios = document.querySelectorAll('input[name="entryType"]');
    const levelRadios = document.querySelectorAll('input[name="level"]');
    const courseSelect = document.getElementById('course');

    function filterCourses() {
        const selectedEntryType = document.querySelector('input[name="entryType"]:checked')?.value;
        const selectedLevel = document.querySelector('input[name="level"]:checked')?.value;

        console.log('Selected Entry Type:', selectedEntryType);
        console.log('Selected Level:', selectedLevel);

        Array.from(courseSelect.options).forEach(option => {
            const courseEntryType = option.getAttribute('data-entry-type');
            const courseEntryLevel = option.getAttribute('data-entry-level');
            
            console.log('Course Entry Type:', courseEntryType);
            console.log('Course Entry Level:', courseEntryLevel);

            if ((selectedEntryType && selectedLevel) && (courseEntryType === selectedEntryType && courseEntryLevel === selectedLevel)) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });

        // Reset to the first visible option if any
        if (courseSelect.options[0].style.display === 'none') {
            courseSelect.value = '';
        }
    }

    entryTypeRadios.forEach(radio => radio.addEventListener('change', filterCourses));
    levelRadios.forEach(radio => radio.addEventListener('change', filterCourses));
});

    </script>
    
</body>

</html>
