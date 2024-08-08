$(document).ready(function () {
    // O Level dynamic subjects
    let oLevelSubjectsCount = 0;
    $('#addOLevelSubject').click(function () {
        oLevelSubjectsCount++;
        const subjectRow = `
            <tr>
                <td>
                    <select class="form-control form-control-sm" name="oLevelSubject${oLevelSubjectsCount}" required>
                        <option value="">Select Subject</option>
                        <option value="Math">Math</option>
                        <option value="English">English</option>
                        <option value="Science">Science</option>
                        <!-- Add more subjects as needed -->
                    </select>
                </td>
                <td>
                    <select class="form-control form-control-sm" name="oLevelGrade${oLevelSubjectsCount}" required>
                        <option value="">Select Grade</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <!-- Add more grades as needed -->
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger removeOLevelSubject">Remove</button></td>
            </tr>`;
        $('#oLevelSubjectsTable tbody').append(subjectRow);
    });

    $(document).on('click', '.removeOLevelSubject', function () {
        $(this).closest('tr').remove();
    });

    $('#saveOLevel').click(function () {
        const oLevelData = $('#oLevelForm').serializeArray();
        localStorage.setItem('oLevelData', JSON.stringify(oLevelData));
        alert('O Level Information Saved!');
    });

    function loadOLevelData() {
        const savedData = JSON.parse(localStorage.getItem('oLevelData'));
        if (savedData) {
            savedData.forEach(field => {
                $(`[name="${field.name}"]`).val(field.value);
            });
        }
    }

    loadOLevelData();

    // A Level dynamic subjects
    let aLevelSubjectsCount = 0;

    $('#addSubject').click(function () {
        const subject = $('#subjectSelect').val();
        const grade = $('#gradeSelect').val();

        if (subject && grade) {
            aLevelSubjectsCount++;
            const subjectRow = `
                <tr>
                    <td>${subject}</td>
                    <td>${grade}</td>
                    <td><button type="button" class="btn btn-danger removeSubject">Remove</button></td>
                </tr>`;
            $('#aLevelSubjectsTable tbody').append(subjectRow);

            // Clear selections after adding
            $('#subjectSelect').val('');
            $('#gradeSelect').val('');
        } else {
            alert('Please select both subject and grade.');
        }
    });

    $(document).on('click', '.removeSubject', function () {
        $(this).closest('tr').remove();
    });

    $('#saveALevel').click(function () {
        const aLevelData = $('#aLevelForm').serializeArray();
        localStorage.setItem('aLevelData', JSON.stringify(aLevelData));
        alert('A Level Information Saved!');
    });

    function loadALevelData() {
        const savedData = JSON.parse(localStorage.getItem('aLevelData'));
        if (savedData) {
            savedData.forEach(field => {
                $(`[name="${field.name}"]`).val(field.value);
            });
        }
    }

    loadALevelData();

    // Autocomplete for O Level School
    $("#oLevelSchool").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "autocomplete.php",
                dataType: "json",
                data: {
                    query: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.Center_Name,
                            value: item.Center_Name,
                            centerNo: item.CenterNo
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            $("#oLevelCenterNo").val(ui.item.centerNo);
        }
    });

    // Autocomplete for A Level School
    $("#aLevelSchool").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "autocomplete.php",
                dataType: "json",
                data: {
                    query: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.Center_Name,
                            value: item.Center_Name,
                            centerNo: item.CenterNo
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            $("#aLevelCenterNo").val(ui.item.centerNo);
        }
    });

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
        // Check if all required fields are filled
        return $('#bio-data input[required]').filter(function () {
            return !this.value;
        }).length === 0;
    }

    checkFormCompletion();
});
