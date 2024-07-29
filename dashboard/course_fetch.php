<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination setup
$limit = 3; // Number of items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch data from course_eligibility with additional details
$query = "SELECT c.course_id, c.course_name, c.duration, c.entry_level, c.scheme, c.tuition, e.eligibility_criteria, e.photo_path
          FROM courses c
          JOIN course_eligibility e ON c.course_id = e.course_id
          LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

$courses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = $row;
}

// Fetch total number of courses for pagination
$total_query = "SELECT COUNT(*) AS total FROM courses";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_courses = $total_row['total'];
$total_pages = ceil($total_courses / $limit);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-inner .carousel-item {
            transition: transform 0.6s ease;
        }
        .card-img-left {
            width: 150px;
            height: 100px; /* Adjust height as needed */
            object-fit: cover;
        }
        .flip-card {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            perspective: 1000px;
        }
        .flip-card-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            transition: transform 0.8s;
            transform-style: preserve-3d;
            display: flex;
            flex-direction: column;
        }
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }
        .flip-card-front {
            background-color: #fff;
            z-index: 2;
            transform: rotateY(0deg);
        }
        .flip-card-back {
            background-color: #f8f9fa;
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .flip-card-back .btn-primary {
            margin-top: 10px;
        }
    </style>
    <title>Courses</title>
</head>
<body>

<div class="container mt-5">
    <h2>Course Eligibility</h2>
    <div id="courseCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($courses as $index => $course): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="card">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <?php if (!empty($course['photo_path'])): ?>
                                        <img src="<?php echo $course['photo_path']; ?>" class="card-img-left" alt="Course Image">
                                    <?php endif; ?>
                                    <div>
                                        <h5 class="card-title font-weight-bold"><?php echo htmlspecialchars($course['course_name']); ?></h5>
                                        <p class="card-text"><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?></p>
                                        <p class="card-text"><strong>Tuition:</strong> <?php echo htmlspecialchars($course['tuition']); ?></p>
                                        <p class="card-text"><strong>Entry Level:</strong> <?php echo htmlspecialchars($course['entry_level']); ?></p>
                                        <p class="card-text"><strong>Scheme:</strong> <?php echo htmlspecialchars($course['scheme']); ?></p>
                                        <button class="btn btn-secondary btn-flip">Check Eligibility</button>
                                    </div>
                                </div>
                                <div class="flip-card-back">
                                    <p class="card-text"><strong>Eligibility:</strong> <?php echo htmlspecialchars($course['eligibility_criteria']); ?></p>
                                    <a href="<?php echo htmlspecialchars($course['apply_link']); ?>" class="btn btn-primary" target="_blank">Apply Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#courseCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#courseCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

    <!-- Pagination Controls -->
    <nav aria-label="Page navigation">
        <ul class="pagination mt-4">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
