<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control-sm {
            height: calc(1.5em + .75rem + 2px);
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Course Selection</h2>
        <form id="course-form">
            <div class="form-group">
                <label for="schemeSelect">Select Scheme</label>
                <select id="schemeSelect" class="form-control form-control-sm">
                    <option value="">Select Scheme</option>
                    <option value="Direct Entry">Direct Entry</option>
                    <option value="Indirect Entry">Indirect Entry</option>
                </select>
                <small class="form-text text-muted">Select Direct Entry if you are just from school (O and A level Leavers). Select Indirect Entry if you are upgrading.</small>
            </div>

            <div class="form-group">
                <label for="levelSelect">Select Level</label>
                <select id="levelSelect" class="form-control form-control-sm">
                    <option value="">Select Level</option>
                    <option value="Certificate">Certificate</option>
                    <option value="Diploma">Diploma</option>
                </select>
            </div>

            <div class="form-group">
                <label for="courseSelect">Select Course</label>
                <select id="courseSelect" class="form-control form-control-sm">
                    <option value="">Select Course</option>
                </select>
            </div>

            <button type="button" class="btn btn-primary" id="saveCourseBtn">Save Course</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {
    $('#schemeSelect, #levelSelect').change(function () {
        const scheme = $('#schemeSelect').val();
        const level = $('#levelSelect').val();

        console.log('Scheme:', scheme);
        console.log('Level:', level);

        if (scheme && level) {
            $.ajax({
                url: 'fetchCourses.php',
                method: 'GET',
                data: { level: level, scheme: scheme },
                success: function (data) {
                    console.log('Data received from server:', data); // Debugging line
                    try {
                        const courses = JSON.parse(data);
                        console.log('Parsed courses:', courses); // Debugging line
                        $('#courseSelect').empty().append('<option value="">Select Course</option>');
                        courses.forEach(course => {
                            $('#courseSelect').append(`<option value="${course.course_id}">${course.course_name}</option>`);
                        });
                    } catch (e) {
                        console.error('Error parsing JSON data:', e);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX request failed:', textStatus, errorThrown);
                }
            });
        } else {
            $('#courseSelect').empty().append('<option value="">Select Course</option>');
        }
    });
});

    </script>
</body>
</html>
