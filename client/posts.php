<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Posts - Academic Institute</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .theme-primary {
      background-color: #0056b3;
      color: #fff;
    }
  </style>
</head>
<body>
<?php include '../header.php'; ?>
<header class="theme-primary text-center py-5">
    <h1>Posts</h1>
    <p>Read our latest updates and news</p>
  </header>

  <section class="posts py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="post mb-4">
            <h2 class="post-title">Post Title 1</h2>
            <p class="post-meta">Posted on July 24, 2024 by Admin</p>
            <div class="post-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <a href="post-details.html" class="btn btn-primary">Read More</a>
            </div>
          </div>

          <div class="post mb-4">
            <h2 class="post-title">Post Title 2</h2>
            <p class="post-meta">Posted on July 22, 2024 by Admin</p>
            <div class="post-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <a href="post-details.html" class="btn btn-primary">Read More</a>
            </div>
          </div>

          <div class="post mb-4">
            <h2 class="post-title">Post Title 3</h2>
            <p class="post-meta">Posted on July 20, 2024 by Admin</p>
            <div class="post-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <a href="post-details.html" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-header">
              <h5>Recent Posts</h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="#">Post Title 1</a></li>
              <li class="list-group-item"><a href="#">Post Title 2</a></li>
              <li class="list-group-item"><a href="#">Post Title 3</a></li>
            </ul>
          </div>
          
          <div class="card mb-4">
            <div class="card-header">
              <h5>Categories</h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="#">News</a></li>
              <li class="list-group-item"><a href="#">Events</a></li>
              <li class="list-group-item"><a href="#">Updates</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center py-3 bg-dark text-white">
    <p>&copy; 2024 Academic Institute. All rights reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
