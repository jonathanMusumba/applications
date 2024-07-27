<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Media Gallery - Academic Institute</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include '../header.php'; ?>
  <header class="theme-primary text-center py-5">
    <h1>Media Gallery</h1>
    <p>Explore our gallery of photos, videos, and more</p>
  </header>

  <section class="media-gallery py-5">
    <div class="container">
      <ul class="nav nav-pills mb-4" id="media-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab" aria-controls="pills-photos" aria-selected="true">Photos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-videos-tab" data-toggle="pill" href="#pills-videos" role="tab" aria-controls="pills-videos" aria-selected="false">Videos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-events-tab" data-toggle="pill" href="#pills-events" role="tab" aria-controls="pills-events" aria-selected="false">Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-testimonials-tab" data-toggle="pill" href="#pills-testimonials" role="tab" aria-controls="pills-testimonials" aria-selected="false">Testimonials</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-podcasts-tab" data-toggle="pill" href="#pills-podcasts" role="tab" aria-controls="pills-podcasts" aria-selected="false">Podcasts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-webinars-tab" data-toggle="pill" href="#pills-webinars" role="tab" aria-controls="pills-webinars" aria-selected="false">Webinars</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-infographics-tab" data-toggle="pill" href="#pills-infographics" role="tab" aria-controls="pills-infographics" aria-selected="false">Infographics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-press-releases-tab" data-toggle="pill" href="#pills-press-releases" role="tab" aria-controls="pills-press-releases" aria-selected="false">Press Releases</a>
        </li>
      </ul>
      <div class="tab-content" id="media-tabContent">
        <div class="tab-pane fade show active" id="pills-photos" role="tabpanel" aria-labelledby="pills-photos-tab">
          <!-- Photos Gallery -->
          <div class="row">
            <div class="col-md-4 mb-4">
              <img src="assets/img/photo1.jpg" class="img-fluid" alt="Photo 1">
            </div>
            <div class="col-md-4 mb-4">
              <img src="assets/img/photo2.jpg" class="img-fluid" alt="Photo 2">
            </div>
            <div class="col-md-4 mb-4">
              <img src="assets/img/photo3.jpg" class="img-fluid" alt="Photo 3">
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
          <!-- Videos Gallery -->
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/example-video" allowfullscreen></iframe>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/example-video2" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-events" role="tabpanel" aria-labelledby="pills-events-tab">
          <!-- Events Gallery -->
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="event-item">
                <h3>Event Title 1</h3>
                <p>Date: 2024-08-01</p>
                <p>Description of the event...</p>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="event-item">
                <h3>Event Title 2</h3>
                <p>Date: 2024-09-01</p>
                <p>Description of the event...</p>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-testimonials" role="tabpanel" aria-labelledby="pills-testimonials-tab">
          <!-- Testimonials -->
          <div class="testimonial">
            <blockquote>
              <p>"This institute has changed my life! The faculty and resources are top-notch."</p>
              <footer>— Student Name, Course</footer>
            </blockquote>
          </div>
          <div class="testimonial">
            <blockquote>
              <p>"Excellent programs and wonderful support. Highly recommend!"</p>
              <footer>— Student Name, Course</footer>
            </blockquote>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-podcasts" role="tabpanel" aria-labelledby="pills-podcasts-tab">
          <!-- Podcasts -->
          <div class="podcast">
            <audio controls>
              <source src="assets/audio/podcast1.mp3" type="audio/mpeg">
              Your browser does not support the audio element.
            </audio>
            <p>Podcast Episode 1: Introduction to the Institute</p>
          </div>
          <div class="podcast">
            <audio controls>
              <source src="assets/audio/podcast2.mp3" type="audio/mpeg">
              Your browser does not support the audio element.
            </audio>
            <p>Podcast Episode 2: Career Opportunities</p>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-webinars" role="tabpanel" aria-labelledby="pills-webinars-tab">
          <!-- Webinars -->
          <div class="webinar">
            <h3>Webinar Title 1</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/webinar1" allowfullscreen></iframe>
            </div>
            <p>Description of the webinar...</p>
          </div>
          <div class="webinar">
            <h3>Webinar Title 2</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/webinar2" allowfullscreen></iframe>
            </div>
            <p>Description of the webinar...</p>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-infographics" role="tabpanel" aria-labelledby="pills-infographics-tab">
          <!-- Infographics -->
          <div class="row">
            <div class="col-md-6 mb-4">
              <img src="assets/img/infographic1.jpg" class="img-fluid" alt="Infographic 1">
            </div>
            <div class="col-md-6 mb-4">
              <img src="assets/img/infographic2.jpg" class="img-fluid" alt="Infographic 2">
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-press-releases" role="tabpanel" aria-labelledby="pills-press-releases-tab">
          <!-- Press Releases -->
          <div class="press-release">
            <h3>Press Release Title 1</h3>
            <p>Date: 2024-07-01</p>
            <p>Details about the press release...</p>
          </div>
          <div class="press-release">
            <h3>Press Release Title 2</h3>
            <p>Date: 2024-06-01</p>
            <p>Details about the press release...</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 Academic Institute. All rights reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      // Optional: Add any custom JS here
    });
  </script>
</body>
</html>

