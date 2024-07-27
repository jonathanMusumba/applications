<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Intakes - Academic Institute</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    /* Custom Theme Color (Admin can choose) */
    .theme-primary {
      background-color: #0056b3;
      color: #fff;
    }
  </style>
</head>
<body>
<?php include '../header.php'; ?>
  <header class="theme-primary text-center py-5">
    <h1>Intakes</h1>
    <p>Discover our previous and ongoing intakes</p>
  </header>

  <section class="intakes py-5">
    <div class="container">
      <h2 class="text-center">Current Intake</h2>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Ongoing Intake for August 2024</h5>
              <p class="card-text">Join our diverse range of programs in Medical Sciences, Nursing, Business, and Food Science. Applications are open until August 15, 2024.</p>
              <a href="apply-now.html" class="btn btn-primary">Apply Now</a>
            </div>
          </div>
        </div>
      </div>
      
      <h2 class="text-center mt-5">Previous Intakes</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">May 2024 Intake</h5>
              <p class="card-text">This intake included new courses in Data Science and Digital Marketing. The intake period ended on May 31, 2024.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">January 2024 Intake</h5>
              <p class="card-text">This intake focused on expanding our Nursing and Medical Sciences programs. The intake period ended on January 31, 2024.</p>
            </div>
          </div>
        </div>
      </div>
      
      <h2 class="text-center mt-5">Eligibility Criteria</h2>
      <div class="row">
        <div class="col-md-12">
          <div class="accordion" id="eligibilityAccordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Medical Sciences
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#eligibilityAccordion">
                <div class="card-body">
                  Applicants must have a minimum of two science subjects at A-Level and a strong O-Level background.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Nursing
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#eligibilityAccordion">
                <div class="card-body">
                  Applicants must have a background in biology and chemistry, with a strong passion for healthcare.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Business
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#eligibilityAccordion">
                <div class="card-body">
                  A strong foundation in mathematics and business-related subjects is required. Applicants with work experience are preferred.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Food Science
                  </button>
                </h2>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#eligibilityAccordion">
                <div class="card-body">
                  A background in biology or chemistry is required. Experience in food-related industries is an advantage.
                </div>
              </div>
            </div>
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
