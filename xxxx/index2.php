<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lubega Nursing Institute</title>
    <link rel="stylesheet" href="css/styles.css">
    
    <link rel="stylesheet" href="css/styles.css">
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
	.carousel-container {
    position: relative;
}

.center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 1; /* Ensure the content is on top of the carousel */
}

.title {
    font-size: 36px; /* Increase font size */
    font-weight: bold; /* Make it bold */
    color: white;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add text shadow for better visibility */
}


.btns {
    display: flex;
    justify-content: center;
}

.btns a {
    margin: 0 10px;
}

.btns button {
    padding: 10px 20px;
    font-size: 16px;
}

	</style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5W<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slides = document.querySelectorAll(".slide");
            const title = document.querySelector(".title");

            let currentSlide = 0;
            let currentColor = 0;

            setInterval(() => {
                // Change slide opacity
                slides[currentSlide].classList.remove("active");
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add("active");

                // Change title color
                const colors = ["#FFF", "#008000", "#800000"]; // White, Green, Maroon
                title.style.color = colors[currentColor];
                currentColor = (currentColor + 1) % colors.length;
            }, 5000);
        });
    </script>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-green shadow">
        <div class="container">
            <a class="navbar-brand" href="# "><img src="images/logo.png "></a>
            <button class="navbar-toggler " type="button " data-bs-toggle="collapse " data-bs-target="#navbarSupportedContent " aria-controls="navbarSupportedContent " aria-expanded="false " aria-label="Toggle navigation ">
            <span class="navbar-toggler-icon "></span>
          </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent ">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                    <li class="nav-item ">
                        <a class="nav-link active " aria-current="page " href="https://www.lubeganursinginstitute.com" target="_blank" rel="noopener noreferrer">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="Applications/Biodata.html">Apply</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="login.html">Login Admin</a>
                    </li>
            </div>
        </div>
    </nav>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <!-- Add more indicators as needed -->
    </ol>
    <div class="carousel-container">
        <div class="carousel-item active">
            <img class="d-block w-100" src="images/img1.jpg" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="images/img2.JPG" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="images/img4.JPG" alt="Slide 3">
        </div>
        <!-- Add more carousel items as needed -->
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

<div class="center">
    <div class="title">Enter to learn go forth to serve</div>
    <div class="btns">
        <a href="https://www.lubeganursinginstitute.com" target="_blank" rel="noopener noreferrer">
            <button>Learn More</button>
        </a>
        <a href="Applications/Biodata.html">
            <button>Apply Now</button>
        </a>
    </div>
</div>


</body>

</html>