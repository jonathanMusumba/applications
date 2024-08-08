
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

