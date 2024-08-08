
    <div class="container">
        <h2>Application Form</h2>
        <ul class="nav nav-tabs" id="formTabs">
            <li class="nav-item">
                <a class="nav-link active" id="tab-bio-data" data-toggle="tab" href="#bio-data">Bio Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-permanent-address" data-toggle="tab" href="#permanent-address">Permanent Address</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-next-of-kin" data-toggle="tab" href="#next-of-kin">Next of Kin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-course-of-study" data-toggle="tab" href="#course-of-study">Course of Study</a>
            </li>
            <!-- Conditional tabs -->
            <li class="nav-item">
                <a class="nav-link" id="tab-o-level" data-toggle="tab" href="#o-level">O Level Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-a-level" data-toggle="tab" href="#a-level">A Level Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-other-qualifications" data-toggle="tab" href="#other-qualifications">Other Qualifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-submit" data-toggle="tab" href="#submit-form">Submit Form</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="bio-data">
                <?php include 'bio.php'; ?>
            </div>
            <div class="tab-pane fade" id="permanent-address">
                <?php include 'address.php'; ?>
            </div>
            <div class="tab-pane fade" id="next-of-kin">
                <?php include 'kin.php'; ?>
            </div>
            <div class="tab-pane fade" id="course-of-study">
                <?php include 'course.php'; ?>
            </div>
            <div class="tab-pane fade" id="o-level">
                <?php include 'olevel.php'; ?>
            </div>
            <div class="tab-pane fade" id="a-level">
                <?php include 'alevel.php'; ?>
            </div>
            <div class="tab-pane fade" id="other-qualifications">
                <?php include 'other_qualifications.php'; ?>
            </div>
            <div class="tab-pane fade" id="submit-form">
                <?php include 'submit.php'; ?>
            </div>
        </div>
    </div>

    
   