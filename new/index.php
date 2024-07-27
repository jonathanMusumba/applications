<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institute of Medical & Business Studies</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="path/to/logo.png" alt="Institute Logo">
        </div>
        <nav class="nav-menu">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#courses">Courses</a></li>
                <li><a href="#admissions">Admissions</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <div class="header-icons">
            <a href="#search" class="icon"><i class="fas fa-search"></i></a>
            <a href="#profile" class="icon"><i class="fas fa-user"></i></a>
            <a href="#facebook" class="icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#twitter" class="icon"><i class="fab fa-twitter"></i></a>
            <a href="#instagram" class="icon"><i class="fab fa-instagram"></i></a>
        </div>
        <div class="user-menu">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <section id="topbar" class="d-flex align-items-center">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">info@example.com</a>
      <i class="bi bi-phone-fill phone-icon"></i> +1 5589 55488 55
    </div>
    <div class="social-links d-none d-md-block">
      <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
    </div>
  </div>
</section>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
  <div class="container d-flex align-items-center">
    <h1 class="logo me-auto"><a href="index.html">Green</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
        <li><a class="nav-link scrollto" href="#about">About</a></li>
        <li><a class="nav-link scrollto" href="#courses">Courses</a></li>
        <li><a class="nav-link scrollto " href="#admisions">Admissions</a></li>
        <li><a class="nav-link scrollto " href="#activities">Activities</a></li>
        <li><a class="nav-link scrollto" href="#gallery">gallery</a></li>
        <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
        <li><a href="#home">Home</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
  </div>
</header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Welcome to the Institute of Medical & Business Studies</h1>
            <p>Empowering the next generation of healthcare and business professionals.</p>
            <a href="#courses" class="btn-cta">Explore Our Courses</a>
            <a href="#contact" class="btn-cta apply-now">Apply Now</a>
        </div>
        <div class="hero-video">
            <video autoplay muted loop playsinline>
                <source src="LINMS.mp4" type="video/mp4">
                <source src="path/to/video.webm" type="video/webm">
                Your browser does not support the video tag.
            </video>
            <div class="overlay"></div>
        </div>
    </section>
    <!-- About Section -->
    <section id="about" class="about">
        <h2>About Us</h2>
        <p>Our institute offers a range of courses in medical, nursing, business, and food & science technology, providing students with the skills and knowledge needed to excel in their careers.</p>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="courses">
    <h2>Our Courses</h2>
    <div class="course-tabs">
        <button class="tab-button active" data-target="#medical-courses">Medical</button>
        <button class="tab-button" data-target="#nursing-courses">Nursing</button>
        <button class="tab-button" data-target="#business-courses">Business</button>
        <button class="tab-button" data-target="#food-science-courses">Food & Science Technology</button>
    </div>
    <div class="course-content">
        <div id="medical-courses" class="tab-content active">
            <!-- Medical courses loaded here -->
        </div>
        <div id="nursing-courses" class="tab-content">
            <!-- Nursing courses loaded here -->
        </div>
        <div id="business-courses" class="tab-content">
            <!-- Business courses loaded here -->
        </div>
        <div id="food-science-courses" class="tab-content">
            <!-- Food & Science Technology courses loaded here -->
        </div>
    </div>
 </section>

 <section id="admissions" class="admissions">
    <div class="admissions-content">
        <h2>Admissions</h2>
        <p>Join our community of learners and take the first step towards a rewarding career. Learn more about our admissions process and requirements.</p>
        <button class="btn-cta" id="learn-more-btn">Learn More</button>
        <a href="#contact" class="btn-cta">Apply Now</a>
    </div>
    
    <div class="admissions-info" id="admissions-info">
        <div class="accordion">
            <div class="accordion-item">
                <h3 class="accordion-header">Application Process</h3>
                <div class="accordion-content">
                    <p>Our application process is straightforward and designed to be student-friendly. Here are the steps to apply:</p>
                    <ul>
                        <li>Complete the online application form.</li>
                        <li>Submit required documents.</li>
                        <li>Pay the application fee.</li>
                        <li>Attend an interview (if required).</li>
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header">Requirements</h3>
                <div class="accordion-content">
                    <p>Ensure you meet the following requirements before applying:</p>
                    <ul>
                        <li>High school diploma or equivalent.</li>
                        <li>Official transcripts.</li>
                        <li>Proof of English proficiency (if applicable).</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Past Admissions and Interviews -->
        <div class="past-admissions">
            <h3>Past Admissions and Interviews</h3>
            <div class="card-slider">
                <div class="card">
                    <img src="https://via.placeholder.com/300" alt="Interview 1">
                    <div class="overlay">
                        <h4>Interview with Dr. Smith</h4>
                        <p>March 2023</p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://via.placeholder.com/300" alt="Interview 2">
                    <div class="overlay">
                        <h4>Interview with Ms. Johnson</h4>
                        <p>July 2022</p>
                    </div>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>

        <!-- Intake Information -->
        <div class="intake-info">
            <h3>Current Intake</h3>
            <p>Applications are open for the current intake starting in January 2024. Apply now to secure your spot!</p>
            
            <h3>Next Intake</h3>
            <p>The next intake will begin in September 2024. Stay tuned for more details and application dates.</p>
        </div>
    </div>
</section>
    <!-- Events & News Section -->
    <section id="events-news" class="events-news">
        <h2>Events & News</h2>
        <div class="events-slider">
            <!-- Events dynamically loaded via AJAX -->
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="community-engagement" class="community-engagement">
    <h2>Community & Engagement</h2>

    <!-- Student Testimonials -->
    <div class="testimonials">
        <h3>What Our Students Say</h3>
        <div class="testimonials-slider">
            <!-- Testimonials dynamically loaded via AJAX -->
        </div>
    </div>

    <!-- Community Activities -->
    <div class="community-activities">
        <h3>Community Activities</h3>
        <div class="activities-slider">
            <div class="activity-card">
                <img src="path/to/image1.jpg" alt="Community Cleaning">
                <div class="activity-info">
                    <h4>General Cleaning</h4>
                    <p>Our students participate in regular community cleaning to promote a healthy environment.</p>
                </div>
            </div>
            <div class="activity-card">
                <img src="path/to/image2.jpg" alt="Medical Camp">
                <div class="activity-info">
                    <h4>Medical Camps</h4>
                    <p>Organizing medical camps for communities in need, providing essential healthcare services.</p>
                </div>
            </div>
            <!-- Additional activity cards -->
        </div>
    </div>

    <!-- Facilities -->
    <div class="facilities">
        <h3>Our Facilities</h3>
        <div class="facilities-grid">
            <div class="facility-card">
                <img src="path/to/resource-center.jpg" alt="Resource Center">
                <h4>Resource Center</h4>
                <p>Our Resource Center offers a wide range of educational materials and resources.</p>
            </div>
            <div class="facility-card">
                <img src="path/to/laboratory.jpg" alt="Laboratory">
                <h4>Laboratory</h4>
                <p>State-of-the-art laboratories for hands-on learning and research.</p>
            </div>
            <div class="facility-card">
                <img src="path/to/computer-lab.jpg" alt="Computer Lab">
                <h4>Computer Lab</h4>
                <p>Fully equipped computer labs for all our students and staff.</p>
            </div>
            <!-- Additional facility cards -->
        </div>
    </div>

    <!-- Student Clubs & Associations -->
    <div class="clubs-associations">
        <h3>Student Clubs & Associations</h3>
        <p>Our institute offers a variety of clubs and associations to foster social and leadership skills, including:</p>
        <ul>
            <li>Leadership Club</li>
            <li>Tribal Associations</li>
            <li>Sports and Recreation</li>
            <!-- Additional clubs and associations -->
        </ul>
    </div>

    <!-- Staff Profiles -->
    <div class="staff-profiles">
        <h3>Meet Our Team</h3>
        <div class="staff-grid">
            <div class="staff-card">
                <img src="path/to/director.jpg" alt="Director">
                <h4>Director</h4>
                <p>Our visionary leader guiding the institute's mission and vision.</p>
            </div>
            <div class="staff-card">
                <img src="path/to/dean.jpg" alt="Dean of School">
                <h4>Dean of School</h4>
                <p>Head of the academic department, ensuring quality education.</p>
            </div>
            <div class="staff-card">
                <img src="path/to/head-department.jpg" alt="Head of Department">
                <h4>Head of Department</h4>
                <p>Leading the department with expertise and dedication.</p>
            </div>
            <!-- Additional staff cards -->
        </div>
    </div>
</section>
<section id="contact" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Contact</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>
            <div class="row">
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>
                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>
                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="email">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Institute of Medical & Business Studies. All rights reserved.</p>
            <div class="social-media">
                <a href="#"><img src="path/to/facebook-icon.png" alt="Facebook"></a>
                <a href="#"><img src="path/to/twitter-icon.png" alt="Twitter"></a>
                <a href="#"><img src="path/to/instagram-icon.png" alt="Instagram"></a>
            </div>
            <div class="newsletter-signup">
                <input type="email" placeholder="Subscribe to our newsletter">
                <button>Subscribe</button>
            </div>
        </div>
    </footer>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="scripts.js"></script>
</body>
</html>
