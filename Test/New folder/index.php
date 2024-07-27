<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            flex: 1 1 calc(33% - 20px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .contact-box, .info-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            background-color: #f9f9f9;
        }
        .affiliations-slider img {
            max-width: 100%;
            height: auto;
        }
        .media-container {
            margin-top: 15px;
        }
        
        .media-container img, .media-container video {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .carousel-item .card {
            margin: 0 15px;
        }
        .affiliation-logo {
            width: 100px;
            height: auto;
        }
        .affiliation-name {
            font-weight: bold;
        }

    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <?php include 'header.php'; ?>
    </header>

    <!-- Media Element Slider -->
    <div id="mediaSlider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <!-- PHP to fetch media items -->
            <?php include 'fetch_media.php'; ?>
        </div>
        <a class="carousel-control-prev" href="#mediaSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#mediaSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Posts and Announcements Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card-container">
                    <!-- PHP to fetch posts -->
                    <?php include 'fetch_posts.php'; ?>
                </div>
            </div>
           <div class="col-md-4">
                <!-- Announcements Box -->
                <h3>Announcements</h3>
                <div class="list-group">
                    <?php include 'fetch_announcements.php'; ?>
                </div>

                <!-- Intake Box -->
                <h3>Intakes</h3>
                <?php include 'fetch_intakes.php'; ?>
            </div>
        </div>
    </div>

    <!-- Our Courses Section -->
    <div class="container mt-4">
        <h2>Our Courses</h2>
        <div id="courseSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <!-- PHP to fetch courses -->
                <?php include 'fetch_courses.php'; ?>
            </div>
            <a class="carousel-control-prev" href="#courseSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#courseSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Campus News Section -->
    <div class="container mt-4">
        <h2>Campus News</h2>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-container">
                        <!-- PHP to fetch campus news -->
                        <?php include 'fetch_campus_news.php'; ?>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="info-box">
                    <h3>LINMS UGANDA</h3>
                    <p>Lubega institute of nursing and medical sciences is a registered private
                         training school for nurses and midwives founded in 2016. Its located in
                          Iganga district along Iganga – Malaba highway at busei village This school
                           is registered and licensed by the Ministry Of Education Science Technology
                            and Sports and Ministry Of Health</p>
                </div
                <div>
                    <h3>Top News</h3>
                    <!-- PHP to fetch top news -->
                    <?php include 'fetch_top_news.php'; ?>
                </div>
                <div>
                    <h3>Reach out to us</h3>
                    <button class="btn btn-primary" onclick="openMessageForm()">Contact Us</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Advertisements Section -->
    <div class="container mt-4">
        <h2>Advertisements</h2>
        <div id="advertSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <!-- PHP to fetch advertisements -->
                <?php include 'fetch_advertisements.php'; ?>
            </div>
            <a class="carousel-control-prev" href="#advertSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#advertSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Affiliations Section -->
    <div class="container mt-4">
        <h2>Our Affiliations</h2>
        <div id="affiliationSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner affiliations-slider">
                <?php include 'fetch_affiliations.php'; ?>
            </div>
            <a class="carousel-control-prev" href="#affiliationSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#affiliationSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- Contact Address Section -->
    <div class="container mt-4">
        <h2>Contact Address</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-box">
                    <h4>Campus Location</h4>
                    <p>1234 Main Street, City, Country</p>
                    <p>Phone: +123-456-7890</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-box">
                    <h4>Our Liaison Office</h4>
                    <p>5678 Side Street, City, Country</p>
                    <p>Email: contact@example.com</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-4 bg-light py-3">
        <div class="container text-center">
            <p>&copy; 2024 Your Institution. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function openMessageForm() {
            // Function to open a message form or modal
            alert('Contact form or modal to open.');
        }
    </script>
</body>
</html>

