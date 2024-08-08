$(document).ready(function () {
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
                <div class="toast-header">
                    <strong class="mr-auto">Notification</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">${message}</div>
            </div>`;
            
        $('.toast-container').append(toastHTML);
        $('.toast').toast('show');
    
        if (redirectUrl) {
            setTimeout(function() {
                window.location.href = redirectUrl;
            }, 3000); // Redirect after 3 seconds
        }
    }
    
    function handleLogout() {
        showToast("You have been logged out.", "index.php");
    }
    
    // For Login (on landing to dashboard)
    function handleLogin() {
        showToast("Welcome back to your dashboard.");
    }
    
    // For Session Expired
    function handleSessionExpired() {
        showToast("Session expired. Please log in again.", "index.php");
    }

    // Load initial content
    loadContent('dashboard');

    // Session expiry handling (1 hour of inactivity)
    let inactivityTimeout;
    function resetInactivityTimeout() {
        clearTimeout(inactivityTimeout);
        inactivityTimeout = setTimeout(function () {
            alert('Session expired due to inactivity.');
            window.location.href = 'logout.php';
        }, 3600000); // 1 hour = 3600000 ms
    }

    $(document).on('mousemove keydown click', resetInactivityTimeout);
    resetInactivityTimeout();

    // Flip card interaction
    $('.check-eligibility-btn').on('click', function() {
        $(this).closest('.carousel-item').find('.flip-card-inner').css('transform', 'rotateY(180deg)');
    });

    $('.btn-flip').on('click', function() {
        var cardInner = $(this).closest('.card').find('.flip-card-inner');
        var isFlipped = cardInner.css('transform') === 'rotateY(180deg)';
        cardInner.css('transform', isFlipped ? 'rotateY(0deg)' : 'rotateY(180deg)');
    });
});
document.getElementById('consentCheckbox').addEventListener('change', function() {
    document.getElementById('submitForm').disabled = !this.checked;
});

document.getElementById('addSubject').addEventListener('click', function() {
    let subject = document.getElementById('subject').value;
    let grade = document.getElementById('grade').value;

    if (subject && grade) {
        let table = document.getElementById('oLevelSubjectsTable').getElementsByTagName('tbody')[0];
        let newRow = table.insertRow();
        newRow.innerHTML = `<tr>
            <td>${subject}</td>
            <td>${grade}</td>
            <td><button type="button" class="btn btn-danger btn-sm removeSubject">Remove</button></td>
        </tr>`;

        // Remove subject row
        newRow.querySelector('.removeSubject').addEventListener('click', function() {
            table.removeChild(newRow);
        });
    } else {
        alert('Please select a subject and a grade.');
    }
});
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
