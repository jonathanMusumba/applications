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
        .header-links a {
            margin: 0 10px;
        }
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
            .affiliations-slider {
                margin: 20px auto;
            }
            
            .slick-slider img {
                width: 100%;
                height: auto;
            }
            
            .slick-caption {
                position: absolute;
                bottom: 10px;
                left: 10px;
                background: rgba(0, 0, 0, 0.5);
                color: #fff;
                padding: 5px;
            }
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
    
    .navbar-light {
        background-color: #007bff; /* Blue background for the navbar */
    }
    .navbar-light .navbar-nav .nav-link {
        color: #fff; /* White text color for links */
    }
    .navbar-light .navbar-toggler-icon {
        background-color: #fff; /* Toggler icon color */
    }
    .btn-primary {
        font-weight: bold;
        background-color: red; /* Red background */
        border: none;
    }
    .btn-primary:hover {
        background-color: darkred; /* Darker red on hover */
    }
    .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.page-item {
    margin: 0 5px;
}

.page-link {
    padding: 8px 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-decoration: none;
    color: #007bff;
}

.page-link.active {
    background-color: #007bff;
    color: #fff;
}

.page-link:hover {
    background-color: #0056b3;
    color: #fff;
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
                <!-- Media items should be dynamically added here -->
            </div>
        </section>

        <div class="col-md-8">
            <!-- Latest Posts -->
            <section class="latest-posts">
                <h2>Latest Posts</h2>
                <div id="posts-container">
                    <!-- Posts will be dynamically loaded here -->
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination" id="pagination">
                        <!-- Pagination links will be dynamically loaded here -->
                    </ul>
                </nav>
            </section>
        </div>
            <div class="col-md-4">
                <!-- Announcements -->
                <section class="announcements">
                    <h2>Announcements</h2>
                    <div id="announcements-container">
                        <!-- Announcements will be dynamically loaded here -->
                    </div>
                </section>
            </div>
        </div>

        <!-- Current Intake -->
        <section class="intake mb-4">
            <h2>Current Intake</h2>
            <div id="intake-card" class="intake-card">
                <!-- Intake card content will be dynamically loaded here -->
            </div>
        </section>

        <!-- Courses -->
        <section class="courses mb-4">
            <h2>Our Courses</h2>
            <div id="courses-container" class="slick-slider">
                <!-- Course cards will be dynamically loaded here -->
            </div>
        </section>

        <!-- Need Help -->
        <section class="need-help mb-4">
            <h2>Need Help?</h2>
            <button class="btn btn-info" data-toggle="modal" data-target="#helpModal">Contact Us</button>
            <!-- Modal -->
            <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="helpModalLabel">Contact Us</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="contact-form">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Affiliations Slider -->
    <section class="affiliations-slider">
        <div class="slick-slider">
            <!-- Affiliations items will be dynamically loaded here -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Lubega Institute of Nursing and Health Professionals. All rights reserved.</p>
            <a href="privacy-policy.html">Privacy Policy</a> | <a href="terms-of-service.html">Terms of Service</a> | <a href="contact.html">Contact Us</a>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function(){
            // Initialize sliders
                $('.slick-slider').slick({
                    autoplay: true,
                    autoplaySpeed: 10000,  // Slide delay of 10 seconds
                    dots: true,
                    arrows: false
                });
        
                // Fetch announcements
        
                // Fetch current intake
                function loadIntake() {
                    $.ajax({
                        url: 'php/fetch_intakes.php',
                        type: 'GET',
                        success: function(response) {
                            $('#intake-card').html(response);
                        }
                    });
                }
        
                // Fetch courses
                function loadCourses() {
                    $.ajax({
                        url: 'php/fetch_courses.php',
                        type: 'GET',
                        success: function(response) {
                            $('#courses-container').html(response);
                            $('.slick-slider').slick('slickAdd', response.courses);
                        }
                    });
                }
        
                // Fetch media
                function loadMedia() {
                    $.ajax({
                        url: 'php/fetch_media.php',
                        type: 'GET',
                        success: function(response) {
                            $('.media-slider').slick('slickAdd', response.media);
                        }
                    });
                }
        
                // Fetch affiliations
                function loadAffiliations() {
                    $.ajax({
                        url: 'php/fetch_affiliations.php',
                        type: 'GET',
                        success: function(response) {
                            $('.affiliations-slider .slick-slider').slick('slickAdd', response.affiliations);
                        }
                    });
                }
        
                // Handle form submission
                $('#contact-form').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: 'php/save_message.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            alert('Message sent successfully!');
                            $('#helpModal').modal('hide');
                        },
                        error: function() {
                            alert('There was an error sending your message.');
                        }
                    });
                });
        
                // Initial load of content
                loadPosts();
                loadAnnouncements();
                loadIntake();
                loadCourses();
                loadMedia();
                loadAffiliations();
            });
            </script>
        </body>
        </html>
        