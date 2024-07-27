<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Initialize database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$districts = [];
$userData = [];
$applications = [];
$intakes=[];
$loggedIn = false; // Initialize login status

// Fetch districts
try {
    $stmt = $conn->query("SELECT id, district_name FROM districts");
    while ($row = $stmt->fetch_assoc()) {
        $districts[] = $row;
    }
} catch (Exception $e) {
    echo "Error fetching districts: " . $e->getMessage();
    exit();
}

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['applicant_number'])) {
    $userId = $_SESSION['user_id'];
    $applicantNumber = $_SESSION['applicant_number']; // Retrieve applicant number from session

    // Fetch user data
    try {
        $stmt = $conn->prepare("SELECT id, surname, otherNames, dob, sex, email, phone, nationality, applicantNumber FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();

        if ($userData) {
            $loggedIn = true;
            $dob = !empty($userData['dob']) ? date('d/m/Y', strtotime($userData['dob'])) : ''; // Format date of birth
        } else {
            echo "User not found.";
            exit();
        }
    } catch (Exception $e) {
        echo "Error fetching user data: " . $e->getMessage();
        exit();
    }

    // Fetch applications for the logged-in user using a join with the intakes table
    try {
        $query = "SELECT applications.*, intakes.intake_year, intakes.start_date, intakes.end_date, intakes.intake_status AS intake_status
                  FROM applications
                  JOIN intakes ON applications.academicSession = intakes.intake_year
                  WHERE applications.applicantNumber = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $applicantNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $applications = $result->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        echo "Error fetching applications: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

// Function to determine intake status based on the current date
function getIntakeStatus($start_date, $end_date) {
    $currentDate = new DateTime();
    $startDate = new DateTime($start_date);
    $endDate = new DateTime($end_date);

    if ($currentDate >= $startDate && $currentDate <= $endDate) {
        return 'Running';
    } else {
        return 'Expired';
    }
}

// Close the database connection
$conn->close();
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
    <style>
        /* Styles for the header and navigation */
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
        }

        .form-section {
            margin-bottom: 20px; /* Bottom margin for each form section */
        }

        /* Progress bar styles */
        .switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 20px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 14px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:checked + .slider:before {
    transform: translateX(20px);
}

        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .header.dark-mode {
            background-color: #333;
        }

        .navigation li a.dark-mode {
            color: #ffffff;
        }

        .navigation li a.dark-mode:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .tooltip.dark-mode {
            background-color: #444;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">Your Logo</div>
        <ul class="navigation">
            <li><a href="Dashboard.php" class="apply-now">Apply Now</a></li>
            <li><a href="#" class="applications active">My Applications</a></li>
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

    <div class="container mt-4">
        <div id="content">
            <!-- My Applications content -->
            <h2>My Application Forms</h2>
            <?php if (!empty($applications)) : ?>
                <?php foreach ($applications as $application) : ?>
                    <div class="application-grid">
                        <div class="grid-item">
                            <strong>Entry Type:</strong> <?php echo htmlspecialchars($application['entryType']); ?>
                        </div>
                        <div class="grid-item">
                            <strong>Intake Status:</strong> 
                            <?php 
                            $intakeStatus = getIntakeStatus($application['start_date'], $application['end_date']);
                            echo htmlspecialchars($intakeStatus);
                            ?>
                        </div>
                        <div class="grid-item">
                            <strong>Intake Year:</strong> <?php echo htmlspecialchars($application['academicSession']); ?>
                        </div>
                        <div class="grid-item">
                            <strong>Form ID:</strong> <?php echo htmlspecialchars($application['FormID']); ?>
                        </div>
                        <div class="grid-item">
                            <strong>Application Status:</strong> <?php echo htmlspecialchars($application['Status']); ?>
                        </div>
                        <div class="grid-item">
                            <strong>Start Date:</strong> <?php echo htmlspecialchars($application['createDate']); ?>
                        </div>
                        <div class="grid-item">
                            <strong>Date of Submission:</strong> <?php echo htmlspecialchars($application['submitDate']); ?>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-primary preview-print-btn" data-id="<?php echo $application['FormID']; ?>">Preview & Print</button>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No applications found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Preview & Print Modal -->
    <div class="modal fade" id="previewPrintModal" tabindex="-1" aria-labelledby="previewPrintModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewPrintModalLabel">Application Form Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="previewPrintContent">
                    <!-- Preview content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printContent('previewPrintContent')">Print</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function loadContent(page) {
            const content = document.getElementById('content');
            switch (page) {
                case 'apply-now':
                    content.innerHTML = '<h2>Apply Now</h2><p>Welcome to the application portal. Click on "My Applications" to view your submitted and pending application forms.</p>';
                    break;
                case 'applications':
                    content.innerHTML = '<h2>My Applications</h2><p>Here you can view your submitted and pending application forms.</p>';
                    break;
                case 'admissions':
                    content.innerHTML = '<h2>My Admissions</h2><p>Here you can view your admission information and download your admission letter.</p><div class="alert alert-success">New admission available!</div>';
                    break;
                default:
                    content.innerHTML = '<h2>Apply Now</h2><p>Welcome to the application portal. Click on "My Applications" to view your submitted and pending application forms.</p>';
                    break;
            }
        }

        document.querySelector('.logout-btn').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'logout.php'; // Redirect to the logout page
        });

        document.querySelector('.login-btn').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'login.php'; // Redirect to the login page
        });

        document.querySelectorAll('.preview-print-btn').forEach(button => {
            button.addEventListener('click', function() {
                const formId = this.dataset.id;
                // Fetch form data via AJAX or similar method (for simplicity, using static data here)
                const formData = {
                    logo: 'Your Logo',
                    instituteName: 'Your Institute Name',
                    academicYear: '2024/2025',
                    intake: 'January',
                    formId: formId,
                    startDate: '2024-01-10',
                    biodata: {
                        name: 'John Doe',
                        salutation: 'Mr.',
                        gender: 'Male',
                        email: 'johndoe@example.com',
                        mobile: '123456789',
                        maritalStatus: 'Single',
                        religion: 'None',
                        dob: '1990-01-01'
                    },
                    nextOfKin: {
                        name: 'Jane Doe',
                        relationship: 'Sister',
                        email: 'janedoe@example.com',
                        phone: '987654321',
                        district: 'District A'
                    },
                    permanentAddress: {
                        district: 'District A',
                        subcounty: 'Subcounty A',
                        village: 'Village A'
                    },
                    olevel: {
                        schoolName: 'O-Level School',
                        indexNumber: 'O12345',
                        year: '2005',
                        subjects: [
                            { sn: 1, subjectCode: 'ENG', result: 'A', score: 85 },
                            { sn: 2, subjectCode: 'MATH', result: 'B', score: 75 },
                            // Add more subjects as needed
                        ]
                    },
                    alevel: {
                        schoolName: 'A-Level School',
                        indexNumber: 'A12345',
                        year: '2007',
                        subjects: [
                            { sn: 1, subjectCode: 'BIO', result: 'B', score: 75 },
                            { sn: 2, subjectCode: 'CHE', result: 'A', score: 85 },
                            // Add more subjects as needed
                        ]
                    },
                    otherQualifications: [
                        {
                            institutionName: 'Other Institution',
                            award: 'Certificate',
                            startYear: '2008',
                            endYear: '2009',
                            placeOfWork: 'Company A',
                            designation: 'Position A'
                        }
                        // Add more qualifications as needed
                    ],
                    courseInformation: [
                        { sn: 1, courseName: 'Course 1' },
                        { sn: 2, courseName: 'Course 2' }
                        // Add more courses as needed
                    ]
                };

                // Format form data into HTML for preview
                let previewContent = `
                    <div style="text-align: center;">
                        <img src="logo.png" alt="Logo" style="width: 100px;">
                        <h1>${formData.instituteName}</h1>
                        <h2>Online Application Form</h2>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Academic Year</th>
                            <td>${formData.academicYear}</td>
                        </tr>
                        <tr>
                            <th>Intake</th>
                            <td>${formData.intake}</td>
                        </tr>
                        <tr>
                            <th>Form ID</th>
                            <td>${formData.formId}</td>
                        </tr>
                        <tr>
                            <th>Application Start Date</th>
                            <td>${formData.startDate}</td>
                        </tr>
                    </table>
                    <h3>Application Details</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>${formData.biodata.name}</td>
                        </tr>
                        <tr>
                            <th>Salutation</th>
                            <td>${formData.biodata.salutation}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>${formData.biodata.gender}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>${formData.biodata.email}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>${formData.biodata.mobile}</td>
                        </tr>
                        <tr>
                            <th>Marital Status</th>
                            <td>${formData.biodata.maritalStatus}</td>
                        </tr>
                        <tr>
                            <th>Religion</th>
                            <td>${formData.biodata.religion}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>${formData.biodata.dob}</td>
                        </tr>
                    </table>
                    <h3>Next of Kin Information</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Full Name</th>
                            <td>${formData.nextOfKin.name}</td>
                        </tr>
                        <tr>
                            <th>Relationship</th>
                            <td>${formData.nextOfKin.relationship}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>${formData.nextOfKin.email}</td>
                        </tr>
                        <tr>
                            <th>Telephone</th>
                            <td>${formData.nextOfKin.phone}</td>
                        </tr>
                        <tr>
                            <th>District</th>
                            <td>${formData.nextOfKin.district}</td>
                        </tr>
                    </table>
                    <h3>Permanent Address</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>District</th>
                            <td>${formData.permanentAddress.district}</td>
                        </tr>
                        <tr>
                            <th>Subcounty</th>
                            <td>${formData.permanentAddress.subcounty}</td>
                        </tr>
                        <tr>
                            <th>Village</th>
                            <td>${formData.permanentAddress.village}</td>
                        </tr>
                    </table>
                    <h3>O-Level Information</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>School Name</th>
                            <td>${formData.olevel.schoolName}</td>
                        </tr>
                        <tr>
                            <th>Index Number</th>
                            <td>${formData.olevel.indexNumber}</td>
                        </tr>
                        <tr>
                            <th>Year of Sitting</th>
                            <td>${formData.olevel.year}</td>
                        </tr>
                    </table>
                    <h4>Subjects</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>SN</th>
                            <th>Subject Code</th>
                            <th>Result</th>
                            <th>Score</th>
                        </tr>
                        ${formData.olevel.subjects.map(subject => `
                            <tr>
                                <td>${subject.sn}</td>
                                <td>${subject.subjectCode}</td>
                                <td>${subject.result}</td>
                                <td>${subject.score}</td>
                            </tr>
                        `).join('')}
                    </table>
                `;

                if (formData.alevel) {
                    previewContent += `
                        <h3>A-Level Information</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>School Name</th>
                                <td>${formData.alevel.schoolName}</td>
                            </tr>
                            <tr>
                                <th>Index Number</th>
                                <td>${formData.alevel.indexNumber}</td>
                            </tr>
                            <tr>
                                <th>Year of Sitting</th>
                                <td>${formData.alevel.year}</td>
                            </tr>
                        </table>
                        <h4>Subjects</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>SN</th>
                                <th>Subject Code</th>
                                <th>Result</th>
                                <th>Score</th>
                            </tr>
                            ${formData.alevel.subjects.map(subject => `
                                <tr>
                                    <td>${subject.sn}</td>
                                    <td>${subject.subjectCode}</td>
                                    <td>${subject.result}</td>
                                    <td>${subject.score}</td>
                                </tr>
                            `).join('')}
                        </table>
                    `;
                }

                if (formData.otherQualifications.length > 0) {
                    previewContent += `
                        <h3>Other Qualifications</h3>
                        <table class="table table-bordered">
                            ${formData.otherQualifications.map(qualification => `
                                <tr>
                                    <th>Institution Name</th>
                                    <td>${qualification.institutionName}</td>
                                </tr>
                                <tr>
                                    <th>Award Obtained</th>
                                    <td>${qualification.award}</td>
                                </tr>
                                <tr>
                                    <th>Start Year</th>
                                    <td>${qualification.startYear}</td>
                                </tr>
                                <tr>
                                    <th>End Year</th>
                                    <td>${qualification.endYear}</td>
                                </tr>
                                <tr>
                                    <th>Place of Work</th>
                                    <td>${qualification.placeOfWork}</td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>${qualification.designation}</td>
                                </tr>
                            `).join('')}
                        </table>
                    `;
                }

                if (formData.courseInformation.length > 0) {
                    previewContent += `
                        <h3>Course Information</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>SN</th>
                                <th>Course Name</th>
                            </tr>
                            ${formData.courseInformation.map(course => `
                                <tr>
                                    <td>${course.sn}</td>
                                    <td>${course.courseName}</td>
                                </tr>
                            `).join('')}
                        </table>
                    `;
                }

                document.getElementById('previewPrintContent').innerHTML = previewContent;
                $('#previewPrintModal').modal('show');
            });
        });

        function printContent(el) {
            const restorePage = document.body.innerHTML;
            const printContent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = restorePage;
        }
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
    </script>
</body>
</html>
