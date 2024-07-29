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

    // Event delegation for navigation links
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
