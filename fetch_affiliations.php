<?php
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

$sql = "SELECT * FROM affiliations WHERE status = 'active' ORDER BY affiliation_name ASC";
$result = $conn->query($sql);

$affiliations = array();
$isFirst = true;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $activeClass = $isFirst ? 'active' : '';
        echo '
        <div class="carousel-item ' . $activeClass . '">
            <div class="text-center">
                <a href="' . $row['url'] . '" target="_blank">
                    <img class="d-block w-50 mx-auto affiliation-logo" src="uploads/' . $row['affiliation_logo'] . '" alt="' . $row['affiliation_name'] . '">
                </a>
                <h5 class="mt-3 affiliation-name">' . $row['affiliation_name'] . '</h5>
                <p class="affiliation-caption">' . $row['description'] . '</p>
            </div>
        </div>';
        $isFirst = false;
    }
} else {
    echo '<div class="carousel-item active">
            <div class="text-center">
                <h5>No Affiliations Found</h5>
            </div>
          </div>';
}

$conn->close();
?>
