<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Academic Institute</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .carousel-inner img {
      width: 100%;
      height: 60vh;
    }
    .contact-us {
      background-color: #f8f9fa;
      padding: 2rem 0;
    }
    .contact-us h2 {
      margin-bottom: 1rem;
    }
    .faq {
      background-color: #e9ecef;
      padding: 2rem 0;
    }
    .faq .card {
      margin-bottom: 1rem;
    }
    .faq .btn-link {
      text-decoration: none;
    }
    footer {
      background-color: #343a40;
      color: white;
    }
    #whatsapp-widget {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #25D366;
      color: white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      font-size: 24px;
    }
  </style>
</head>
<body>
  <?php include("header.php");?>
<header class="bg-primary text-white text-center py-5">
    <h1>Contact Us</h1>
    <p>We'd love to hear from you</p>
  </header>

  <section class="contact-us py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>Get in Touch</h2>
          <p>If you have any questions, please feel free to reach out to us. Our team is here to assist you with any inquiries or support you may need.</p>
          <ul class="list-unstyled">
            <li><strong>Email:</strong> info@academicinstitute.com</li>
            <li><strong>Phone:</strong> +123 456 7890</li>
            <li><strong>Address:</strong> 123 Academic Lane, Knowledge City</li>
          </ul>
          <h3>Our Addresses</h3>
          <ul class="list-unstyled">
            <li><strong>Campus 1:</strong> 123 Medical Ave, Health City</li>
            <li><strong>Campus 2:</strong> 456 Business Rd, Commerce Town</li>
            <li><strong>Campus 3:</strong> 789 Food Science Blvd, Nutrition Valley</li>
          </ul>
        </div>
        <div class="col-md-6">
          <h2>Send Us a Message</h2>
          <form>
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
              <textarea class="form-control" id="message" rows="4" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="faq bg-light py-5">
    <div class="container">
      <h2 class="text-center">Frequently Asked Questions</h2>
      <div class="accordion" id="faqAccordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                What programs do you offer?
              </button>
            </h2>
          </div>
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
            <div class="card-body">
              We offer programs in Medical Sciences, Nursing, Business, and Food Science. Please visit our Courses page for more details.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                How can I apply for a course?
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
            <div class="card-body">
              You can apply for our courses online through our application portal. For more information, please visit our Admissions page.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                What are the tuition fees?
              </button>
            </h2>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
            <div class="card-body">
              Our tuition fees vary depending on the program. Please visit our Tuition & Fees page for detailed information.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center py-3 bg-dark text-white">
    <p>&copy; 2024 Academic Institute. All rights reserved.</p>
  </footer>

  <div id="whatsapp-widget">
    <a href="https://wa.me/+1234567890" target="_blank" style="color: white;">
      <i class="fab fa-whatsapp"></i>
    </a>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
