$(document).ready(function() {
    $('#dropdownProfile').on('click', function(e) {
        e.preventDefault();
        $('.main-content').load('profile.php');
    });

    $('#dropdownChangePassword').on('click', function(e) {
        e.preventDefault();
        $('.main-content').load('change_password.php');
    });

    $('#dropdownLogout').on('click', function(e) {
        e.preventDefault();
        window.location.href = 'logout.php';
    });
});