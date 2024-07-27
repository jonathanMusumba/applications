<?php

include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if $conn is initialized
    if (!isset($conn)) {
        die("Database connection not established.");
    }

    // Retrieve form data
    $formID = $conn->real_escape_string($_POST['formID']);
    $district = $conn->real_escape_string($_POST['district']);
    $subCountry = $conn->real_escape_string($_POST['subCountry']);
    $village = $conn->real_escape_string($_POST['village']);

    // Prepare address array and convert to JSON
    $address = [
        'district' => $district,
        'subCountry' => $subCountry,
        'village' => $village
    ];
    $addressJson = json_encode($address);

    // Prepare SQL statement to update the permanent address
    $sql = "UPDATE apply SET Permanent_address_information = ? WHERE formID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param('ss', $addressJson, $formID);
        if ($stmt->execute()) {
            echo "Permanent address saved successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<form id="permanentAddressForm" class="border p-4 rounded shadow-sm" method="POST" action="">
    <!-- Permanent Address fields here -->
    <input type="hidden" name="formID" value="<?php echo htmlspecialchars($formID); ?>">
    
    <div class="form-group row">
        <label for="district" class="col-sm-3 col-form-label">District</label>
        <div class="col-sm-9">
            <input type="text" id="district" name="district" class="form-control" required>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="subCountry" class="col-sm-3 col-form-label">Sub-Country</label>
        <div class="col-sm-9">
            <input type="text" id="subCountry" name="subCountry" class="form-control" required>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="village" class="col-sm-3 col-form-label">Village</label>
        <div class="col-sm-9">
            <input type="text" id="village" name="village" class="form-control" required>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Save Permanent Address</button>
</form>
