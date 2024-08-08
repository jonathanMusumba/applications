$(document).ready(function () {
    // Function to set the active link
    function setActiveLink(target) {
        console.log("Setting active link for:", target);
        $('.nav-link, .sidebar-nav-link').removeClass('active');
        $(`.nav-link[data-target="${target}"], .sidebar-nav-link[data-target="${target}"]`).addClass('active');
    }

    // Function to load content
    function loadContent(target) {
        console.log("Loading content for:", target);
        let url = target + ".php";
        $.ajax({
            url: url,
            method: "GET",
            success: function (data) {
                console.log("Content loaded successfully for:", target);
                $('#content-area').html(data);
                setActiveLink(target);
            },
            error: function (xhr, status, error) {
                console.error("Error loading content for:", target, "Status:", status, "Error:", error);
                $('#content-area').html('<div class="alert alert-danger">Error loading content.</div>');
            }
        });
    }

    // Load the initial dashboard for the applicant
    loadContent('dashboard');

    // Initialize autocomplete
    function initializeAutocomplete(schoolInputId, centerNumberId) {
        var $schoolInput = $('#' + schoolInputId);

        $schoolInput.autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'fetch_schools.php',
                    type: 'GET',
                    dataType: 'json',
                    data: { term: request.term },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return { label: item.Center_Name, value: item.CenterNo + ' ' + item.Center_Name };
                        }));
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                var centerNo = ui.item.value.split(' ')[0];
                $('#' + centerNumberId).val(centerNo + '/');
            }
        });

        $schoolInput.data('ui-autocomplete')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.label + '</div>')
                .appendTo(ul);
        };
    }

    // Populate year select
    function populateYearSelect(yearSelectId) {
        var $yearSelect = $('#' + yearSelectId);
        var currentYear = new Date().getFullYear();
        var endYear = currentYear - 1;
        var startYear = endYear - 22;

        $yearSelect.empty();
        $yearSelect.append($('<option>', { value: "", text: "Select a year", disabled: true, selected: true }));

        for (var year = endYear; year >= startYear; year--) {
            $yearSelect.append($('<option>', { value: year, text: year }));
        }
    }

    // Initialize dynamic content loading for forms
    function initializeForms() {
        initializeAutocomplete('schoolUCE', 'centerNumberUCE');
        initializeAutocomplete('schoolUACE', 'centerNumberUACE');

        $('#yearUCE').on('focus', function() {
            populateYearSelect('yearUCE');
        });

        $('#yearUACE').on('focus', function() {
            populateYearSelect('yearUACE');
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
                        </select>
                    </td>
                    <td>
                        <select class="form-control form-control-sm" name="oLevelGrade${oLevelSubjectsCount}" required>
                            <option value="">Select Grade</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
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
                data.forEach(course => {
                    $('#courseSelect').append(`<option value="${course.id}">${course.name}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching courses. Status:", status, "Error:", error);
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
                $('#tab-o-level').show();
                if (courseOfStudy === 'Diploma') {
                    $('#tab-a-level').show();
                    $('#tab-other-qualifications').show();
                } else {
                    $('#tab-a-level').hide();
                    $('#tab-other-qualifications').hide();
                }
            }
            $('#submitBtn').prop('disabled', !isFormComplete());
        }

        function isFormComplete() {
            return $('#bio-data').find('input').filter(function() { return !this.value; }).length === 0 &&
                $('#permanent-address').find('input').filter(function() { return !this.value; }).length === 0 &&
                $('#next-of-kin').find('input').filter(function() { return !this.value; }).length === 0 &&
                $('#courseSelect').val() &&
                ($('#o-level').find('input').filter(function() { return !this.value; }).length === 0 ||
                ($('#a-level').is(':visible') && $('#a-level').find('input').filter(function() { return !this.value; }).length === 0));
        }

        loadFormData();
        checkFormCompletion();
    }

    initializeForms();

    // Event listener for dropdown menu links
    $(document).on('click', '.dropdown-item', function (e) {
        e.preventDefault();
        let target = $(this).data('target');
        console.log("Dropdown item clicked:", target);
        if (target === 'logout') {
            window.location.href = 'logout.php';
        } else {
            loadContent(target);
        }
    });

    // Event listener for sidebar links
    $(document).on('click', '.sidebar-nav-link', function (e) {
        e.preventDefault();
        let target = $(this).data('target');
        console.log("Sidebar link clicked:", target);
        if (target === 'logout') {
            window.location.href = 'logout.php';
        } else {
            loadContent(target);
        }
    });

    // Mode toggle
    $('#modeToggle').on('change', function () {
        if ($(this).is(':checked')) {
            $('body').removeClass('light-mode').addClass('dark-mode');
            $('#modeTooltip').text('Light Mode');
        } else {
            $('body').removeClass('dark-mode').addClass('light-mode');
            $('#modeTooltip').text('Dark Mode');
        }
    });

    // Show toast
    function showToast(message, redirectUrl = null) {
        var toastHTML = `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">${message}</div>
            </div>`;
        $('#toastContainer').append(toastHTML);
        $('.toast').toast('show');
        if (redirectUrl) {
            setTimeout(function () {
                window.location.href = redirectUrl;
            }, 2000);
        }
    }

    // Example buttons to show toast messages
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
