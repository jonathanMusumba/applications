$(document).ready(function() {
    // Users Section
    $('#sidebarRegisteredUsers').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/registered_users.php');
    });

    $('#sidebarManageUsers').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/manage_users.php');
    });

    // Applications Section
    $('#sidebarReceivedApplications').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/received_applications.php');
    });

    $('#sidebarManageApplications').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/manage_applications.php');
    });

    $('#sidebarAdmittedApplicants').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/admitted_applicants.php');
    });

    $('#sidebarPendingApplicants').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/pending_applicants.php');
    });

    // Messages Section
    $('#sidebarReceivedMessages').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/received_messages.php');
    });

    $('#sidebarSentMessages').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/sent_messages.php');
    });

    $('#sidebarSendNewMessage').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/send_new_message.php');
    });

    // Settings Section
    $('#sidebarSetNew').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/set_new.php');
    });

    $('#sidebarManageSettings').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/manage_settings.php');
    });

    // Admissions Section
    $('#sidebarAdmitStudent').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/admit_student.php');
    });

    $('#sidebarManageAdmissions').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/manage_admissions.php');
    });

    // Intakes Section
    $('#sidebarCreateIntake').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/create_intake.php');
    });

    $('#sidebarManageIntakes').click(function(e) {
        e.preventDefault();
        $('.main-content').load('scripts/manage_intakes.php');
    });
    $('#sidebarLogout').click(function(e) {
        e.preventDefault();
        window.location.href = 'logout.php'; // Redirects to logout script
    });
    
});

document.addEventListener('DOMContentLoaded', function() {
    // Users Gender Chart
    const ctxUsersGender = document.getElementById('usersGenderChart').getContext('2d');
    new Chart(ctxUsersGender, {
        type: 'pie',
        data: {
            labels: ['Male', 'Female', 'Other'],
            datasets: [{
                label: 'Gender Distribution',
                data: [30, 50, 20], // Replace with your dynamic data
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
            }]
        }
    });

    // Applications Overview Chart
    const ctxApplicationsOverview = document.getElementById('applicationsOverviewChart').getContext('2d');
    new Chart(ctxApplicationsOverview, {
        type: 'bar',
        data: {
            labels: ['Certificates', 'Diplomas', 'Undergraduate', 'Postgraduate'],
            datasets: [{
                label: 'Applications Overview',
                data: [10, 20, 30, 40], // Replace with your dynamic data
                backgroundColor: '#FF6384'
            }]
        }
    });

    // Traffic Overview Chart
    const ctxTrafficOverview = document.getElementById('trafficOverviewChart').getContext('2d');
    new Chart(ctxTrafficOverview, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Website Traffic',
                data: [500, 600, 700, 800, 900, 1000], // Replace with your dynamic data
                borderColor: '#36A2EB',
                fill: false
            }]
        }
    });
});