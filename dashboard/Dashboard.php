<!-- dashboard.php -->
<div class="container mt-4">
    <h2>Applicant Dashboard</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-clipboard-list"></i> Applications</h5>
                    <p class="card-text">Number of applications submitted: <!-- PHP code to fetch count --></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-graduation-cap"></i> Admissions</h5>
                    <p class="card-text">Number of forms admitted: <!-- PHP code to fetch count --></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-envelope"></i> Messages</h5>
                    <p class="card-text"><i class="fas fa-paper-plane"></i> Sent: <!-- PHP code to fetch count --></p>
                    <p class="card-text"><i class="fas fa-inbox"></i> Received: <!-- PHP code to fetch count --></p>
                </div>
            </div>
        </div>
    </div>
    <h3>Available Courses</h3>
    <div id="courseCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        
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
    
    <div class="faq-section">
        <?php include("faqs.php"); ?>
    </div>
</div>
