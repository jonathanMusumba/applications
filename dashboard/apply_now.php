<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .tab-content {
            margin-top: 20px;
        }
        .tab-pane {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
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
            <li class="nav-item" id="tab-o-level">
                <a class="nav-link" data-toggle="tab" href="#o-level">O Level Information</a>
            </li>
            <li class="nav-item" id="tab-a-level">
                <a class="nav-link" data-toggle="tab" href="#a-level">A Level Information</a>
            </li>
            <li class="nav-item" id="tab-other-qualifications">
                <a class="nav-link" data-toggle="tab" href="#other-qualifications">Other Qualifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-submit" data-toggle="tab" href="#submit-form">Submit Form</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="bio-data">
                <form id="application-form">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" required>
                    </div>
                    <!-- Additional bio data fields -->
                </form>
            </div>
            <div class="tab-pane fade" id="permanent-address">
                <!-- Permanent Address form fields -->
            </div>
            <div class="tab-pane fade" id="next-of-kin">
                <!-- Next of Kin form fields -->
            </div>
            <div class="tab-pane fade" id="course-of-study">
                <select id="courseSelect" class="form-control">
                    <!-- Populate with courses from the database -->
                </select>
            </div>
            <div class="tab-pane fade" id="o-level">
            <?php include 'olevel.php'; ?>
            </div>
            <div class="tab-pane fade" id="a-level">
            <?php include 'alevel.php'; ?>
            </div>
            <div class="tab-pane fade" id="other-qualifications">
                <!-- Other Qualifications form fields -->
            </div>
            <div class="tab-pane fade" id="submit-form">
                <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch courses and populate dropdown
            $.ajax({
                url: 'fetchCourses.php',
                method: 'GET',
                success: function (data) {
                    const courses = JSON.parse(data);
                    courses.forEach(course => {
                        $('#courseSelect').append(`<option value="${course.id}">${course.name}</option>`);
                    });
                }
            });

            // Save form data as JSON
            function saveFormData() {
                const formData = {
                    bioData: $('#bio-data').find('form').serializeArray(),
                    permanentAddress: $('#permanent-address').find('form').serializeArray(),
                    nextOfKin: $('#next-of-kin').find('form').serializeArray(),
                    courseOfStudy: $('#courseSelect').val(),
                    oLevel: $('#o-level').find('form').serializeArray(),
                    aLevel: $('#a-level').find('form').serializeArray(),
                    otherQualifications: $('#other-qualifications').find('form').serializeArray()
                };
                localStorage.setItem('applicationFormData', JSON.stringify(formData));
            }

            // Load saved form data
            function loadFormData() {
                const savedData = localStorage.getItem('applicationFormData');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    // Populate form fields with saved data
                    // Example for bio-data
                    formData.bioData.forEach(field => {
                        $(`#${field.name}`).val(field.value);
                    });
                    $('#courseSelect').val(formData.courseOfStudy);
                }
            }

            // On tab change, save data and check conditions
            $('#formTabs a').on('shown.bs.tab', function (e) {
                saveFormData();
                checkFormCompletion();
            });

            function checkFormCompletion() {
                const courseOfStudy = $('#courseSelect').val();
                if (courseOfStudy) {
                    // Show/hide tabs based on course selection
                    $('#tab-o-level').show();
                    if (courseOfStudy === 'Diploma') {
                        $('#tab-a-level').show();
                        $('#tab-other-qualifications').show();
                    } else {
                        $('#tab-a-level').hide();
                        $('#tab-other-qualifications').hide();
                    }
                }
                // Enable or disable submit button
                $('#submitBtn').prop('disabled', !isFormComplete());
            }

            function isFormComplete() {
                // Check if all required tabs are filled
                return $('#bio-data').find('input').filter(function() { return !this.value; }).length === 0 &&
                       $('#permanent-address').find('input').filter(function() { return !this.value; }).length === 0 &&
                       $('#next-of-kin').find('input').filter(function() { return !this.value; }).length === 0 &&
                       $('#courseSelect').val() &&
                       ($('#o-level').find('input').filter(function() { return !this.value; }).length === 0) &&
                       ($('#a-level').is(':visible') ? $('#a-level').find('input').filter(function() { return !this.value; }).length === 0 : true) &&
                       ($('#other-qualifications').is(':visible') ? $('#other-qualifications').find('input').filter(function() { return !this.value; }).length === 0 : true);
            }

            // Initialize form
            loadFormData();
            checkFormCompletion();
        });
    </script>
</body>
</html>
