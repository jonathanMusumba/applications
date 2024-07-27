<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lubega Institute of Nursing and Health Professionals</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" rel="stylesheet">
    <style>
        .post { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .pagination { margin-top: 20px; }
        .pagination .page-item { display: inline; margin-right: 5px; }
        .pagination .page-link { padding: 8px 16px; border: 1px solid #ddd; border-radius: 5px; text-decoration: none; }
        .pagination .page-link.active { background-color: #007bff; color: #fff; }
        .header-links a { margin: 0 10px; }
        .media-slider { max-width: 80%; margin: 0 auto; }
        .slick-slide img { width: 100%; height: auto; }
        .slick-caption { position: absolute; bottom: 10px; left: 10px; background: rgba(0, 0, 0, 0.5); color: #fff; padding: 5px; border-radius: 3px; }
        .intake-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        .courses { max-width: 80%; margin: 0 auto; }
        .course-card { border: 1px solid #ddd; border-radius: 5px; padding: 15px; background-color: #f9f9f9; text-align: center; }
        .course-card img { width: 100%; height: auto; }
        .course-card h3 { margin-top: 0; }
        .apply-button { display: inline-block; padding: 10px 20px; color: #fff; background-color: #d9534f; text-decoration: none; border-radius: 5px; margin-top: 10px; }
        .intake-card strong { color: #d9534f; }
        .countdown { font-weight: bold; }
        .apply-button { 
            display: inline-block; 
            padding: 10px 20px; 
            color: #fff; 
            background-color: #d9534f; 
            text-decoration: none; 
            border-radius: 5px; 
            margin-top: 10px; 
        }
        .intake-card .countdown {
            font-size: 1.5rem;
            color: #007bff;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
        .affiliations-slider {
            margin-top: 20px;
            padding: 20px;
            background: #f1f1f1;
        }
        .affiliations-slider .slick-slider img {
            width: 100%;
            height: auto;
        }
        .media-slider .slick-slide img {
            width: 100%;
        }
        .media-slider .slick-caption {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
        }
        .latest-posts {
            width: 75%;
            float: left;
        }
        .campus-news {
            width: 25%;
            float: left;
        }
        .current-intake {
            margin-top: 20px;
        }
        .intake-card {
            display: inline-block;
            width: 30%;
            margin-right: 2%;
            margin-bottom: 20px;
        }
        .need-help {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .need-help .card {
            width: 48%;
        }
        .card-about-institute {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-light">
        <div class="container">
            <div class="row py-2">
                <div class="col-md-6">
                    <a href="https://www.lubeganursinginstitute.com/" class="logo">
                        <img src="https://www.lubeganursinginstitute.com/wp-content/uploads/2017/07/logoe.png" alt="Lubega Institute" style="max-height: 50px;">
                    </a>
                </div>
                <div class="col-md-6 text-right header-links">
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/yourphonenumber" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
                    <a href="login.html">Login</a>
                    <a href="register.html">Register</a>
                    <a href="apply.html">Apply Now</a>
                </div>
            </div>
            <nav class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="courses.html">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-primary" href="apply.html">Apply Now</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main role="main" class="container mt-4">
        <!-- Media Content -->
        <section class="media-slider">
            <div class="slick-slider">
                <!-- Media items will be dynamically loaded here -->
            </div>
        </section>

        <!-- Content Area -->
        <div class="row">
            <div class="latest-posts">
                <h2>Latest Posts</h2>
                <div id="posts-container">
                    <!-- Posts will be dynamically loaded here -->
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination" id="pagination">
                        <!-- Pagination links will be dynamically loaded here -->
                    </ul>
                </nav>
            </div>
            <div class="campus-news">
                <h2>Campus News</h2>
                <div id="campus-news-container">
                    <!-- Campus News will be dynamically loaded here -->
                </div>
            </div>
        </div>

        <!-- Search -->
        <section class="search mt-4">
            <h2>Search</h2>
            <form id="
            <!-- Search Form -->
            <form id="search-form" class="form-inline mt-3">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </section>

        <!-- Current Intake -->
        <section class="current-intake mt-4">
            <h2>Current Intake</h2>
            <div class="row">
                <div class="col-md-4 intake-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Intake 1</h5>
                            <p class="card-text">Details about the intake.</p>
                            <p class="countdown">Countdown: 30 Days</p>
                            <a href="applicants/register.html" class="apply-button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 intake-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Intake 2</h5>
                            <p class="card-text">Details about the intake.</p>
                            <p class="countdown">Countdown: 45 Days</p>
                            <a href="applicants/register.html" class="apply-button">Apply Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 intake-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Intake 3</h5>
                            <p class="card-text">Details about the intake.</p>
                            <p class="countdown">Countdown: 60 Days</p>
                            <a href="applicants/register.html" class="apply-button">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Courses -->
        <section class="courses mt-4">
            <h2>Our Courses</h2>
            <div class="course-slider">
                <!-- Courses cards will be dynamically loaded here -->
            </div>
        </section>

        <!-- Need Help -->
        <section class="need-help mt-4">
            <div class="card card-about-institute">
                <div class="card-body">
                    <h5 class="card-title">About the Institute</h5>
                    <p class="card-text">Information about the Institute.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Contact Us</h5>
                    <form id="contact-form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer mt-4">
        <div class="container">
            <p>&copy; 2024 Lubega Institute of Nursing and Health Professionals. All Rights Reserved.</p>
            <p><a href="privacy-policy.html">Privacy Policy</a> | <a href="terms-of-service.html">Terms of Service</a> | <a href="contact.html">Contact Us</a></p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            // Initialize media slider
            $('.media-slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear'
            });

            // Initialize course slider
            $('.course-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                infinite: true,
                speed: 500
            });
        });
    </script>
</body>
</html>
