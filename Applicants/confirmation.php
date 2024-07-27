<?php
session_start();

if (!isset($_SESSION['applicant_data'])) {
    header("Location: register.php");
    exit();
}

$applicant_data = $_SESSION['applicant_data'];
$applicantNumber = $applicant_data['applicantNumber']; // Get the Applicant Number

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lubega Institute Online Application Portal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        
        .content h1 {
            color: #007bff;
        }
        
        .btn-primary {
            background-color: #007bff;
            border: none;
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
        }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Lubega Institute Online Application Portal</h2>
        </div>
        <div class="content">
            <h1>Dear <?php echo htmlspecialchars($applicant_data['surname']); ?>!</h1>
            <p>Your account has been successfully created on <strong>Lubega Institute Online Application Portal</strong>. Use the Applicant Number below to login to your account.</p>
            <a href="index.php" class="btn-primary">LOGIN TO MY ACCOUNT</a>
            <p>For reference, here's your account detail:</p>
            <p>
                <strong>Full Name:</strong> <?php echo htmlspecialchars($applicant_data['surname'] . " " . $applicant_data['otherNames']); ?><br>
                <strong>Email:</strong> <?php echo htmlspecialchars($applicant_data['email']); ?><br>
                <strong>Phone:</strong> <?php echo htmlspecialchars($applicant_data['phone']); ?><br>
                <strong>Gender:</strong> <?php echo htmlspecialchars($applicant_data['sex']); ?><br>
                <strong>Applicant Number:</strong> <?php echo htmlspecialchars($applicantNumber); ?>
            </p>
            <p><strong>Keep your PASSWORD & APPLICANT NUMBER very safe</strong>
                 Please DO NOT expose your login credentials and in case of any suspicions, change your login password.</p>
            <p>Thanks,<br>LINMS Support Team</p>
        </div>
        <div class="footer">
            <p>&copy; <?php echo date("Y"); ?> Lubega Institute of Nursing & Health Professionals. All Rights Reserved.</p>
        </div>
    </div>
</body>

</html>
