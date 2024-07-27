<?php
// index.php

// Include database connection file
$include_path = __DIR__ . '/../db_connection/db_connection.php';
require_once($include_path);

// Fetch active intakes that are "Running"
$currentDate = date('Y-m-d');
$intakesQuery = "SELECT * FROM intakes WHERE end_date >= '$currentDate' AND status = 'Running'";
$result = $conn->query($intakesQuery);

$intakes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $intakes[] = $row;
    }
}

// Get the end date of the first running intake for the countdown timer
$endDate = !empty($intakes) ? new DateTime($intakes[0]['end_date']) : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, Admin!</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding-top: 50px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            padding: 20px;
        }

        .card-body h5 {
            margin-bottom: 20px;
            font-size: 1.25rem;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container .btn {
            margin-right: 10px;
        }

        .social-media-card {
            margin-bottom: 15px;
        }

        .countdown {
            font-size: 1.5rem;
            color: red;
        }
        @media (max-width: 768px) {
    .nav-links {
        display: none; /* Hide the nav links by default on small screens */
        flex-direction: column;
        position: absolute;
        top: 80px; /* Adjust this value based on your header height */
        left: 0;
        width: 100%;
        background-color: #333;
        padding: 1rem;
        box-sizing: border-box;
        z-index: 1;
    }

    .nav-links.active {
        display: flex; /* Display the nav links when active */
    }

    .nav-links a {
        width: 100%;
    }

    .menu-toggle {
        display: block; /* Display the menu toggle on small screens */
        cursor: pointer;
    }

    .menu-toggle.active {
        color: #fff;
    }
}

/* Optional: You can add more styles for main content, footer, etc. */
main {
    padding: 2rem;
}
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Welcome, Admin!</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($intakes)) : ?>
                    <h5>Ongoing Intakes</h5>
                    <div id="ongoing-intakes">
                        <?php foreach ($intakes as $intake) : ?>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5>Intake Year: <?php echo htmlspecialchars($intake['intake_year']); ?></h5>
                                    <p>Month: <?php echo htmlspecialchars($intake['intake_month']); ?></p>
                                    <p>Running from: <?php echo htmlspecialchars($intake['start_date']); ?> to <?php echo htmlspecialchars($intake['end_date']); ?></p>
                                    <?php
                                    $endDate = new DateTime($intake['end_date']);
                                    $now = new DateTime();
                                    $diff = $endDate->diff($now);
                                    ?>
                                    <p>EXPIRES IN : <?php echo $diff->m; ?> months, <?php echo $diff->d; ?> days</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>No Running Intakes</p>
                <?php endif; ?>

                <h5>Follow Us on Social Media</h5>
                <div id="social-media-links">
                <a href="https://twitter.com/youraccount" target="_blank">
                    <img src="images/twitter.png" alt="Twitter" style="width: 50px; margin-right: 10px;">
                </a>
                <a href="https://facebook.com/youraccount" target="_blank">
                    <img src="images/facebook.png" alt="Facebook" style="width: 50px; margin-right: 10px;">
                </a>
                <a href="https://tiktok.com/@youraccount" target="_blank">
                    <img src="images/tik-tok.png" alt="TikTok" style="width: 50px; margin-right: 10px;">
                </a>
                <a href="https://www.instagram.com/youraccount" target="_blank">
                    <img src="images/instagram.png" alt="Instagram" style="width: 50px; margin-right: 10px;">
                </a>
                <a href="https://www.instagram.com/youraccount" target="_blank">
                    <img src="images/youtube.png" alt="Youtube" style="width: 50px; margin-right: 10px;">
                </a>
            </div>

                <p>INTAKES CLOSES: <span id="countdown-timer" class="countdown">
                <?php
                    if ($endDate) {
                        $now = new DateTime();
                        $diff = $endDate->diff($now);
                        echo $diff->format('%m months: %d days: %h hours: %i minutes: %s seconds');
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </span></p>
            </div>
        </div>

        <div class="btn-container">
            <a href="https://www.lubeganursinginstitute.com" class="btn btn-primary"><i class="fas fa-globe"></i> Visit Website</a>
            <a href="../admin/index.php" class="btn btn-success"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="./admin/login-admin.php" class="btn btn-info"><i class="fas fa-sign-in-alt"></i> Login to Your Account</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Countdown timer
            var endDate = "<?php echo $endDate ? $endDate->format('Y-m-d H:i:s') : ''; ?>";
            if (endDate) {
                var countDownDate = new Date(endDate).getTime();

                var x = setInterval(function () {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("countdown-timer").innerHTML = days +""+ "DAYS" + hours + ""+"HOURS "
                        + minutes + ""+"MINUTES " + seconds + ""+"SECONDS ";

                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("countdown-timer").innerHTML = "EXPIRED";
                    }
                }, 1000);
            } else {
                document.getElementById("countdown-timer").innerHTML = "N/A";
            }
        });
    </script>
</body>

</html>
