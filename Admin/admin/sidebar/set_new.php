To create the `manage_applications.php` page with the functionalities you described, follow these steps:

### 1. **Database and HTML Structure**

Start by setting up the page with the necessary HTML and PHP code to handle database interactions, search functionalities, and display the application details.

### 2. **Database Schema**

Ensure you have the following tables and fields:

- **`applications`** table:
  - `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
  - `salutation` (VARCHAR)
  - `surname` (VARCHAR)
  - `otherNames` (VARCHAR)
  - `level` (VARCHAR)
  - `course` (VARCHAR)
  - `dob` (DATE)
  - `sex` (VARCHAR)
  - `maritalStatus` (VARCHAR)
  - `religion` (VARCHAR)
  - `telephone` (VARCHAR)
  - `email` (VARCHAR)
  - `district` (VARCHAR)
  - `FormID` (VARCHAR)
  - `createDate` (DATE)
  - `Status` (VARCHAR)
  - `submitDate` (DATE)
  - `Olevel` (JSON)
  - `Alevel` (JSON)
  - `OtherQualifications` (JSON)
  - `nextOfKin` (JSON)
  - `permanentAddress` (JSON)

### 3. **PHP and HTML Code**

Here’s how you can set up `manage_applications.php`:

**`manage_applications.php`**:
```php
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';
$year = isset($_POST['year']) ? $_POST['year'] : date('Y');
$searchTerm = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

// Fetch applications based on year and search term
$query = "SELECT * FROM applications WHERE YEAR(createDate) = ? AND (surname LIKE ? OR otherNames LIKE ?) AND Status = 'submitted'";
$stmt = $conn->prepare($query);
$searchTerm = "%$searchTerm%";
$stmt->bind_param("sss", $year, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Manage Applications</h1>
        <form method="post" class="form-inline mb-4">
            <div class="form-group mx-sm-3 mb-2">
                <label for="year" class="sr-only">Year</label>
                <select id="year" name="year" class="form-control">
                    <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($i == $year) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="search" class="sr-only">Search</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Search by Name" value="<?php echo htmlspecialchars($searchTerm); ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Salutation</th>
                    <th>Applicant Name</th>
                    <th>Level</th>
                    <th>Course</th>
                    <th>Dob</th>
                    <th>Sex</th>
                    <th>Marital Status</th>
                    <th>Religion</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>District</th>
                    <th>Form ID</th>
                    <th>Create Date</th>
                    <th>Submit Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['salutation']); ?></td>
                        <td><?php echo htmlspecialchars($row['surname'] . ' ' . $row['otherNames']); ?></td>
                        <td><?php echo htmlspecialchars($row['level']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['dob']); ?></td>
                        <td><?php echo htmlspecialchars($row['sex']); ?></td>
                        <td><?php echo htmlspecialchars($row['maritalStatus']); ?></td>
                        <td><?php echo htmlspecialchars($row['religion']); ?></td>
                        <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['district']); ?></td>
                        <td><?php echo htmlspecialchars($row['FormID']); ?></td>
                        <td><?php echo htmlspecialchars($row['createDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['submitDate']); ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row['id']; ?>">View</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Applicant Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="applicant-details"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="admitButton">Admit Student</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#viewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var applicantId = button.data('id');
            var modal = $(this);

            $.ajax({
                url: 'fetch_applicant.php',
                type: 'POST',
                data: { id: applicantId },
                success: function(response) {
                    modal.find('#applicant-details').html(response);
                }
            });
        });

        $('#admitButton').click(function() {
            // Handle admit student functionality here
        });
    </script>
</body>
</html>
```

### 4. **Fetching Applicant Details**

**`fetch_applicant.php`**:
```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$query = "SELECT * FROM applications WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$applicant = $stmt->get_result()->fetch_assoc();

if ($applicant) {
    $details = '
    <h4>Bio Data</h4>
    <p>Salutation: ' . htmlspecialchars($applicant['salutation']) . '</p>
    <p>Surname: ' . htmlspecialchars($applicant['surname']) . '</p>
    <p>Other Names: ' . htmlspecialchars($applicant['otherNames']) . '</p>
    <p>Sex: ' . htmlspecialchars($applicant['sex']) . '</p>
    <p>Date of Birth: ' . htmlspecialchars($applicant['dob']) . '</p>
    <p>Marital Status: ' . htmlspecialchars($applicant['maritalStatus']) . '</

p>
    <p>Religion: ' . htmlspecialchars($applicant['religion']) . '</p>
    <p>Telephone: ' . htmlspecialchars($applicant['telephone']) . '</p>
    <p>Email: ' . htmlspecialchars($applicant['email']) . '</p>
    
    <h4>Next of Kin</h4>';
    
    $nextOfKin = json_decode($applicant['nextOfKin'], true);
    $details .= '
    <p>Name: ' . htmlspecialchars($nextOfKin['name']) . '</p>
    <p>Email: ' . htmlspecialchars($nextOfKin['email']) . '</p>
    <p>Phone: ' . htmlspecialchars($nextOfKin['phone']) . '</p>
    <p>Address: ' . htmlspecialchars($nextOfKin['kinDistrict']) . '</p>
    
    <h4>Permanent Address</h4>';
    
    $permanentAddress = json_decode($applicant['permanentAddress'], true);
    $details .= '
    <p>District: ' . htmlspecialchars($permanentAddress['district']) . '</p>
    <p>Sub County: ' . htmlspecialchars($permanentAddress['subCounty']) . '</p>
    <p>Village: ' . htmlspecialchars($permanentAddress['village']) . '</p>
    
    <h4>O Level Information</h4>
    <table class="table">
        <thead>
            <tr>
                <th>School</th>
                <th>Index Number</th>
                <th>Year</th>
                <th>Subjects</th>
            </tr>
        </thead>
        <tbody>';

    $olevel = json_decode($applicant['Olevel'], true);
    foreach ($olevel['subjects'] as $index => $subject) {
        $details .= '
        <tr>
            <td>' . htmlspecialchars($olevel['school']) . '</td>
            <td>' . htmlspecialchars($olevel['indexNumber']) . '</td>
            <td>' . htmlspecialchars($olevel['year']) . '</td>
            <td>' . htmlspecialchars($subject['name']) . ' (' . htmlspecialchars($subject['code']) . ') - ' . htmlspecialchars($subject['grade']) . '</td>
        </tr>';
    }
    
    $details .= '</tbody>
    </table>';

    if (!empty($applicant['Alevel'])) {
        $details .= '
        <h4>A Level Information</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>School</th>
                    <th>Index Number</th>
                    <th>Year</th>
                    <th>Subjects</th>
                </tr>
            </thead>
            <tbody>';

        $alevel = json_decode($applicant['Alevel'], true);
        foreach ($alevel['subjects'] as $index => $subject) {
            $details .= '
            <tr>
                <td>' . htmlspecialchars($alevel['school']) . '</td>
                <td>' . htmlspecialchars($alevel['indexNumber']) . '</td>
                <td>' . htmlspecialchars($alevel['year']) . '</td>
                <td>' . htmlspecialchars($subject['name']) . ' (' . htmlspecialchars($subject['code']) . ') - ' . htmlspecialchars($subject['grade']) . '</td>
            </tr>';
        }

        $details .= '</tbody>
        </table>';
    }

    if (!empty($applicant['OtherQualifications'])) {
        $details .= '
        <h4>Other Qualifications</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Institution Name</th>
                    <th>Award Obtained</th>
                    <th>Start Year</th>
                    <th>End Year</th>
                </tr>
            </thead>
            <tbody>';

        $otherQualifications = json_decode($applicant['OtherQualifications'], true);
        foreach ($otherQualifications as $qualification) {
            $details .= '
            <tr>
                <td>' . htmlspecialchars($qualification['institutionName']) . '</td>
                <td>' . htmlspecialchars($qualification['awardObtained']) . '</td>
                <td>' . htmlspecialchars($qualification['startYear']) . '</td>
                <td>' . htmlspecialchars($qualification['endYear']) . '</td>
            </tr>';
        }

        $details .= '</tbody>
        </table>';
    }

    echo $details;
} else {
    echo 'No details found.';
}
?>
```

### 5. **Admit Student Button Functionality**

You can implement the "Admit Student" functionality by adding a button in the `fetch_applicant.php` response and creating an `admit_student.php` script to handle the admission process.

**`admit_student.php`**:
```php
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
try {
    $stmt = $conn->prepare('UPDATE applications SET Status = "admitted" WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    echo 'Student admitted successfully.';
} catch (Exception $e) {
    echo 'Error admitting student: ' . $e->getMessage();
}
?>
```

### Summary

- **`manage_applications.php`**: Handles the display of applications, search functionality, and year filter.
- **`fetch_applicant.php`**: Retrieves detailed information about an applicant and returns it for display in a modal.
- **`admit_student.php`**: Handles the logic to admit a student when the "Admit Student" button is clicked.

These scripts and HTML setup will help you manage applications efficiently, allowing you to view, search, and admit students as needed. Adjust the paths and variable names as required to fit your specific project structure.