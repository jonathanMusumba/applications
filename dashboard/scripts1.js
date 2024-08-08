$(document).ready(function () {
    function setActiveLink(target) {
        $('.nav-link, .sidebar-nav-link').removeClass('active');
        $(`.nav-link[data-target="${target}"], .sidebar-nav-link[data-target="${target}"]`).addClass('active');
    }
    function loadContent(target) {
        $.ajax({
            url: target + ".php",
            method: "GET",
            success: function (data) {
                $('#content-area').html(data);
                setActiveLink(target);
            },
            error: function () {
                $('#content-area').html('<div class="alert alert-danger">Error loading content.</div>');
            }
        });
    }  
    //Load the Innitial Dashboard for the Applicant. 
    loadContent('dashboard');

    function initializeAutocomplete(schoolInputId, centerNumberId) {
        var $schoolInput = $('#' + schoolInputId);
    
        $schoolInput.autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'fetch_schools.php', // Replace with your actual URL or mock data
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.Center_Name,
                                value: item.CenterNo + ' ' + item.Center_Name
                            };
                        }));
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                var centerNo = ui.item.value.split(' ')[0]; // Extract CenterNo from selected item
                $('#' + centerNumberId).val(centerNo + '/');
            }
        });
    
        // Override _renderItem to customize the item rendering
        $schoolInput.data('ui-autocomplete')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.label + '</div>')
                .appendTo(ul);
        };
    
        // Debugging: Check if autocomplete is properly initialized
        setTimeout(function() {
            console.log($schoolInput.data('ui-autocomplete')); // Should not be undefined
        }, 100);
    }
    
    function populateYearSelect(yearSelectId) {
        var $yearSelect = $('#' + yearSelectId);
        var currentYear = new Date().getFullYear();
        var endYear = currentYear - 1; // End year is currentYear - 1
        var startYear = endYear - 22; // Start year is endYear - 22
    
        // Clear existing options
        $yearSelect.empty();
    
        // Add placeholder option
        $yearSelect.append($('<option>', { value: "", text: "Select a year", disabled: true, selected: true }));
    
        // Add options in descending order
        for (var year = endYear; year >= startYear; year--) {
            $yearSelect.append($('<option>', { value: year, text: year }));
        }
    }
    
    $(document).ready(function() {
        initializeAutocomplete('schoolUCE', 'centerNumberUCE');
        initializeAutocomplete('schoolUACE', 'centerNumberUACE');
    
        // Populate year dropdowns when they gain focus
        $('#yearUCE').on('focus', function() {
            populateYearSelect('yearUCE');
        });
    
        $('#yearUACE').on('focus', function() {
            populateYearSelect('yearUACE');
        });
    });
    
    
   
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

    // Fetch courses and populate dropdown
    $.ajax({
        url: 'fetchCourses.php',
        method: 'GET',
        success: function (data) {
            console.log(data); // Debug: log the response
            // Assume data is already a JavaScript object/array
            data.forEach(course => {
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

    // Content Loading and UI Interactions
    function loadContent(target) {
        $('#content-area').load(target + '.php', function(response, status, xhr) {
            if (status == "error") {
                console.log("Error: " + xhr.status + ": " + xhr.statusText);
            }
        });
        $('.nav-link').removeClass('active');
        $('a[data-target="' + target + '"]').addClass('active');
    }

    // Use event delegation for dynamically loaded content
    $(document).on('click', '.nav-link', function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        loadContent(target);
    });
    $('.dropdown-item').on('click', function (e) {
        e.preventDefault();
        let target = $(this).data('target');
        loadContent(target);
    });

    // Ensure only one dropdown item is active at a time
    $(document).on('click', '.dropdown-menu a', function () {
        $('.dropdown-menu a').removeClass('active');
        $(this).addClass('active');
    });

    $('#modeToggle').on('change', function () {
        if ($(this).is(':checked')) {
            $('body').removeClass('light-mode').addClass('dark-mode');
            $('#modeTooltip').text('Light Mode');
        } else {
            $('body').removeClass('dark-mode').addClass('light-mode');
            $('#modeTooltip').text('Dark Mode');
        }
    });

    function showToast(message, redirectUrl = null) {
        var toastHTML = `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    ${message}
                </div>
            </div>`;
        $('#toastContainer').append(toastHTML);
        $('.toast').toast('show');
        if (redirectUrl) {
            setTimeout(function () {
                window.location.href = redirectUrl;
            }, 2000);
        }
    }
    loadContent('dashboard');
    $('#loginButton').on('click', function () {
        showToast('Login successful!');
    });

    $('#logoutButton').on('click', function () {
        showToast('Logout successful!', 'login.php');
    });

    $('#sessionExpiryButton').on('click', function () {
        showToast('Session expired! Please log in again.', 'login.php');
    });

    // Inactivity logout
    let logoutTimer;
    function resetLogoutTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(function () {
            window.location.href = 'login.php';
        }, 3600000); // 1 hour
    }

    $(window).on('mousemove keydown', resetLogoutTimer);
    resetLogoutTimer();

    // Flip card interaction
    $('.flip-card').click(function () {
        $(this).toggleClass('flipped');
    });
});
    // Event listener for dropdown menu links
    $('.dropdown-item').on('click', function (e) {
        e.preventDefault();
        let target = $(this).data('target');
        if (target === 'logout') {
            window.location.href = 'logout.php'; // Redirect to logout PHP script
        } else {
            loadContent(target);
        }
    });

    // Event listener for sidebar links
    $('.sidebar-nav-link').on('click', function (e) {
        e.preventDefault();
        let target = $(this).data('target');
        if (target === 'logout') {
            window.location.href = 'logout.php'; // Redirect to logout PHP script
        } else {
            loadContent(target);
        }
    });
    function loadContent(target) {
        let url = '';
        switch (target) {
            case 'profile':
                url = 'profile.php';
                break;
            case 'password_change':
                url = 'password_change.php';
                break;
            case 'apply_now':
                url = 'apply_now.php';
                break;
            case 'messages':
                url = 'messages.php';
                break;
            case 'applications':
                url = 'applications.php';
                break;
            case 'admissions':
                url = 'admissions.php';
                break;
        }
        $('#content-area').load(url); // Load content into main content area
    }

