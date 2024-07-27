<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "card_management";

// Initialize database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch user data, card details, and template
$id = $_GET['id'];
$card_type_id = $_GET['card_type_id'];

$sql = "SELECT u.*, c.id_number, c.expiry_date, c.additional_info, 
               ct.type_name, ct.template_image, ct.thumbprint_image, ct.background_color, ct.size
        FROM users u
        JOIN cards c ON u.id = c.user_id
        JOIN card_types ct ON c.card_type_id = ct.id
        WHERE u.id = $id AND ct.id = $card_type_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $surname = $row['surname'];
    $given_name = $row['given_name'];
    $dob = $row['date_of_birth'];
    $photo = $row['photo'];
    $signature = $row['signature'];
    $id_number = $row['id_number'];
    $expiry_date = $row['expiry_date'];
    $additional_info = json_decode($row['additional_info'], true);
    $template_image = $row['template_image'];
    $thumbprint_image = $row['thumbprint_image'];
    $background_color = $row['background_color'];
    $size = $row['size'];
} else {
    die("No record found.");
}

// Fetch custom fields for the card type
$fields_sql = "SELECT field_name, field_value 
               FROM card_fields 
               WHERE card_type_id = $card_type_id";
$fields_result = $conn->query($fields_sql);
$fields = [];

if ($fields_result->num_rows > 0) {
    while($field_row = $fields_result->fetch_assoc()) {
        $fields[$field_row['field_name']] = $field_row['field_value'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: <?php echo $background_color; ?>;
        }
        .id-card {
            width: <?php echo explode('x', $size)[0]; ?>px;
            height: <?php echo explode('x', $size)[1]; ?>px;
            background: url('<?php echo $template_image; ?>') no-repeat center center;
            background-size: cover;
            position: relative;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .photo {
            position: absolute;
            top: 120px;
            left: 60px;
            width: 150px;
            height: 200px;
            border: 2px solid #fff;
        }
        .photo img {
            width: 100%;
            height: 100%;
        }
        .details {
            position: absolute;
            top: 30px;
            left: 250px;
            right: 60px;
            color: #000;
        }
        .details .field {
            margin: 15px 0;
            font-size: 18px;
        }
        .details .field span {
            font-weight: bold;
        }
        .signature {
            position: absolute;
            bottom: 30px;
            left: 250px;
            font-family: 'Cursive', serif;
            font-size: 18px;
        }
        .thumbprint {
            position: absolute;
            bottom: 30px;
            right: 60px;
            width: 100px;
            height: 100px;
            background-color: #fff;
        }
        .thumbprint img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

<div class="id-card">
    <div class="photo">
        <img src="<?php echo $photo; ?>" alt="Photo">
    </div>
    <div class="details">
        <?php foreach ($fields as $field_name => $field_value): ?>
            <div class="field"><span><?php echo $field_name; ?>:</span> <?php echo $field_value; ?></div>
        <?php endforeach; ?>
        <div class="field"><span>ID No:</span> <?php echo $id_number; ?></div>
        <div class="field"><span>Date of Expiry:</span> <?php echo $expiry_date; ?></div>
        <?php if ($card_type_id == 1 && isset($additional_info['place_of_birth'])): // Example for National ID ?>
            <div class="field"><span>Place of Birth:</span> <?php echo $additional_info['place_of_birth']; ?></div>
        <?php endif; ?>
    </div>
    <div class="signature">
        <?php echo $signature; ?>
    </div>
    <div class="thumbprint">
        <img src="<?php echo $thumbprint_image; ?>" alt="Thumbprint">
    </div>
</div>

</body>
</html>
