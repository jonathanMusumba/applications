<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institute of Medical Science, Nursing, Business & Food Science</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="index.html"><img src="images/logo.png" alt="Institute Logo" class="logo"></a>
                    </div>
                    <div class="col-md-6 text-right">
                        <ul class="quick-links">
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>
                            <li><a href="apply.html" class="btn btn-primary">Apply Now</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="programs.html">Programs</a></li>
                        <li class="nav-item"><a class="nav-link" href="admissions.html">Admissions</a></li>
                        <li class="nav-item"><a class="nav-link" href="news.html">News</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Carousel -->
    <section class="carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slide1.jpg" class="d-block w-100" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Excellence in Medical Science</h5>
                        <p>Leading the way in healthcare education.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/slide2.jpg" class="d-block w-100" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Empowering Future Nurses</h5>
                        <p>Join our renowned nursing programs.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/slide3.jpg" class="d-block w-100" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Innovations in Food Science</h5>
                        <p>Pioneering research and education in food technology.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    
    <!-- Welcome Strip -->
    <section class="welcome-strip">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>Welcome to Our Institute</h2>
                    <p>We are dedicated to providing the highest quality education in Medical Science, Nursing, Business, and Food Science & Technology.</p>
                </div>
                <div class="col-md-4">
                    <div class="whats-new">
                        <h3>What's New</h3>
                        <ul>
                            <li>New Research Program in Biotechnology</li>
                            <li>Scholarship Opportunities for 2024</li>
                            <li>Upcoming Webinars on Health and Nutrition</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Our institute is committed to providing top-tier education in various fields. Our mission is to develop knowledgeable and skilled professionals who are ready to contribute to the global community.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="programs.html">Programs</a></li>
                        <li><a href="admissions.html">Admissions</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>1234 Street Name, City, State, 56789</p>
                    <p>Email: info@institute.com</p>
                    <p>Phone: (123) 456-7890</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; 2024 Institute of Medical Science, Nursing, Business & Food Science. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
