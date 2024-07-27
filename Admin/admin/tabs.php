
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <link rel="stylesheet"href ="../css/biodata.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <style>
        /* Custom styles for tabs */
        .tab-content {
            padding-top: 20px;
        }
        .progress {
            height: 20px;
            margin-bottom: 30px;
            overflow: visible;
        }
        .progress-bar {
            border-radius: 10px;
            height: 20px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            line-height: 20px;
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
        <div class="logo">LUBEGA INSTITUTE ONLINE APPLICATION</div>
        <ul class="navigation">
            <li><a href="#" class="apply-now">Apply Now</a></li>
            <li><a href="dash2.php" class="applications">My Applications</a></li>
            <li><a href="#" class="admissions">My Admissions</a></li>
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
        <div>
            <label class="switch">
                <input type="checkbox" id="dark-mode-toggle">
                <span class="slider round"></span>
            </label>
        </div>
    </div>

<section class="container mt-5">
        <!-- Title and form status -->
        <h2 class="text-center mb-4">Academic Details Section</h2>
        <div class="text-center mb-3">
            <strong>FORM STATUS:</strong> <?php echo $formStatus; ?>
        </div>

        <!-- Progress bar -->
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;"
                aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                <?php echo round($progress); ?>%
            </div>
        </div>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="Olevel-tab" data-bs-toggle="tab" data-bs-target="#Olevel-tab-pane" type="button" role="tab" aria-controls="Olevel-tab-pane" aria-selected="true">O Level Infomation</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="Alevel-tab" data-bs-toggle="tab" data-bs-target="#Alevel-tab-pane" type="button" role="tab" aria-controls="Alevel-tab-pane" aria-selected="false">A level Information</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="qualifications-tab" data-bs-toggle="tab" data-bs-target="#qualifications-tab-pane" type="button" role="tab" aria-controls="qualifications-tab-pane" aria-selected="false">Other Qualifations</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="submit-tab" data-bs-toggle="tab" data-bs-target="#submit-tab-pane" type="button" role="tab" aria-controls="submit-tab-pane" aria-selected="false">Review & Submit</button>
  </li>
  
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="Olevel-tab-pane" role="tabpanel" aria-labelledby="Olevel-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="Alevel-tab-pane" role="tabpanel" aria-labelledby="Alevel-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="qualifications-tab-pane" role="tabpanel" aria-labelledby="qualifications-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="submit-tab-pane" role="tabpanel" aria-labelledby="submit-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
</div>

