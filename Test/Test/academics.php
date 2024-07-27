<?php
include_once("scripts/uace.php");
include_once("scripts/uce.php");
include_once("scripts/academics.php");
include_once("academics_header.php");

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Information</title>
    <!-- Include jQuery and jQuery UI for autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="dashboard.css">
    <!-- Include Bootstrap for tabs (optional) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Academic Information</h2>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#olevel">O Level</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#alevel">A Level</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#other-qualifications">Other Qualifications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#review-submit">Submit Application</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="olevel" class="container tab-pane active"><br>
            <!-- O Level Form -->
            <?php include 'olevel-form.php'; ?>
        </div>
        <div id="alevel" class="container tab-pane fade"><br>
            <!-- A Level Form -->
            <?php include 'alevel-form.php'; ?>
        </div>
        <div id="other-qualifications" class="container tab-pane fade"><br>
            <!-- Other Qualifications Form -->
            <?php include 'other-qualifications-form.php'; ?>
        </div>
        <div id="review-submit" class="container tab-pane fade"><br>
            <!-- Review & Submit Form -->
            <?php include 'review-submit-form.php'; ?>
        </div>
    </div>
</div>
<script src="academic.js"></script>
<script>
    // JavaScript function to initialize autocomplete
    function initializeAutocomplete(schoolInputId, centerNumberId) {
        $('#' + schoolInputId).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: 'fetch_schools.php',
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
                const centerNo = ui.item.value.split(' ')[0]; // Extract CenterNo from selected item
                $('#' + centerNumberId).val(centerNo + '/');
            }
        }).data('ui-autocomplete')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.label + '</div>')
                .appendTo(ul);
        };
    }

    // Initialize autocomplete for O Level
    initializeAutocomplete('schoolUCE', 'centerNumberUCE');

    // Initialize autocomplete for A Level
    initializeAutocomplete('schoolUACE', 'centerNumberUACE');
    document.addEventListener('DOMContentLoaded', function() {
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
        // Change text color to white when dark mode is enabled
        document.querySelectorAll('.header li a').forEach(function(link) {
            link.style.color = '#fff';
        });
    }s

    // Function to enable light mode
    function enableLightMode() {
        document.body.classList.remove('dark-mode');
        // Reset text color when light mode is enabled (assuming your default styles handle this)
        document.querySelectorAll('.header li a').forEach(function(link) {
            link.style.color = ''; // Reset to default or CSS defined color
        });
    }
});


</script>

</body>
</html>
