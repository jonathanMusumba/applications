$(document).ready(function() {
    // Your JavaScript code here

function toggleRadioStationInput(source) {
    var radioStationInput = document.getElementById("radioStationInput");
    if (source === "Radio") {
        radioStationInput.style.display = "block";
    } else {
        radioStationInput.style.display = "none";
    }
}
document.getElementById('course').addEventListener('change', function() {
        var selectedCourse = this.value;
        console.log('Selected Course:', selectedCourse);
        // You can do further processing or validation here if needed
    });
    document.getElementById('continueButton').addEventListener('click', function() {
    document.getElementById('continueSection').style.display = 'block';
});
$(document).ready(function() {
var totalSections = $('.progress-section').length; // Total number of sections with class 'progress-section'

// Function to calculate and update progress
function updateProgress() {
    var completedSections = 0;
    
    // Check each section with class 'progress-section' for completion
    $('.progress-section').each(function() {
        var $section = $(this);
        
        // Count completed sections based on filled required fields (including readonly)
        if ($section.find('input[required], select[required]').filter(function() { 
            if ($(this).prop('readonly')) {
                return true; // Consider readonly fields as filled
            } else {
                return $(this).val(); // Check for non-readonly fields with a value
            }
        }).length > 0) {
            completedSections++;
        }
    });
    
    // Calculate progress percentage
    var progress = (completedSections / totalSections) * 100;
    
    // Update the progress bar
    $('#progress').css('width', progress + '%').attr('aria-valuenow', progress).text(progress.toFixed(2) + '%');
}

// Call updateProgress initially and whenever something changes in your form sections
updateProgress();

// Example event listeners (replace with actual form logic triggering progress update)
$('input[required], select[required]').on('change keyup', function() {
    // Trigger updateProgress whenever a required field changes
    updateProgress();
});
});
    // JavaScript for navigation and dark mode toggle
    document.querySelectorAll('.navigation li a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.navigation li a.active').classList.remove('active');
            this.classList.add('active');
            loadContent(this.classList[0]);
        });
    });

   // Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function() {
    // Get the checkbox element
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    
    // Check if dark mode preference is saved in local storage
    const currentMode = localStorage.getItem('darkMode');
    if (currentMode === 'dark') {
        enableDarkMode();
        darkModeToggle.checked = true;
    } else {
        enableLightMode(); // Default to light mode
        darkModeToggle.checked = false;
    }
    
    // Listen for changes in the checkbox
    darkModeToggle.addEventListener('change', function() {
        if (darkModeToggle.checked) {
            enableDarkMode();
            localStorage.setItem('darkMode', 'dark'); // Save dark mode preference
        } else {
            enableLightMode();
            localStorage.setItem('darkMode', 'light'); // Save light mode preference
        }
    });
    
    // Function to enable dark mode
    function enableDarkMode() {
        document.body.classList.add('dark-mode');
        // Add any additional classes or styles for dark mode
    }
    
    // Function to enable light mode
    function enableLightMode() {
        document.body.classList.remove('dark-mode');
        // Remove any dark mode specific classes or styles
    }
});


    function loadContent(page) {
        const content = document.getElementById('content');
        switch (page) {
            case 'apply-now':
                content.innerHTML = '<h2>Apply Now</h2><p>Welcome to the application portal. Click on "My Applications" to view your submitted and pending application forms.</p>';
                break;
            case 'applications':
                content.innerHTML = '<h2>My Applications</h2><p>Here you can view your submitted and pending application forms.</p>';
                break;
            case 'admissions':
                content.innerHTML = '<h2>My Admissions</h2><p>Here you can view your admission information and download your admission letter.</p><div class="alert alert-success">New admission available!</div>';
                break;
            default:
                content.innerHTML = '<h2>Apply Now</h2><p>Welcome to the application portal. Click on "My Applications" to view your submitted and pending application forms.</p>';
                break;
        }
    }

    document.querySelector('.logout-btn').addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = 'logout.php'; // Redirect to the logout page
    });

    document.querySelector('.login-btn').addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = 'login.php'; // Redirect to the login page
    });
});