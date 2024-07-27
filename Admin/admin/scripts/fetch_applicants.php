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
    <p>Marital Status: ' . htmlspecialchars($applicant['maritalStatus']) . '</p>
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
