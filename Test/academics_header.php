<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application form_Biodata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    
</head>

<body>
    <div class="header">
    
        <div class="logo">LUBEGA INSTITUTE ONLINE APPLICATION</div>
        <nav class="navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item"><a href="#" class="apply-now">Apply Now</a></li>
            <li class="nav-item"><a href="../applicationHistory.php" class="applications">My Applications</a></li>
            <li class="nav-item"><a href="../admissionHistory.php" class="admissions">My Admissions</a></li>
            </ul>
            </nav>
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
    </div>
    
