<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINMS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if formID and applicantNumber are provided
$formID = $_GET['formID'] ?? null;
$applicantNumber = $_GET['applicantNumber'] ?? null;

if ($formID && $applicantNumber) {
    // Fetch user data from the database
    $query = "SELECT entryType, level FROM applications WHERE formID = ? AND applicantNumber = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $formID, $applicantNumber);
    $stmt->execute();
    $stmt->bind_result($entryType, $level);
    $stmt->fetch();
    $stmt->close();
} else {
    die('Missing formID or applicantNumber.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Information</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Academic Information</h2>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" id="olevel-tab">
            <a class="nav-link active" data-toggle="tab" href="#olevel">O Level</a>
        </li>
        <li class="nav-item" id="alevel-tab">
            <a class="nav-link" data-toggle="tab" href="#alevel">A Level</a>
        </li>
        <li class="nav-item" id="other-qualifications-tab">
            <a class="nav-link" data-toggle="tab" href="#other-qualifications">Other Qualifications</a>
        </li>
        <li class="nav-item" id="submit-tab">
            <a class="nav-link" data-toggle="tab" href="#review-submit">Submit Application</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="olevel" class="container tab-pane active"><br>
            <?php include 'olevel-form.php'; ?>
        </div>
        <div id="alevel" class="container tab-pane fade"><br>
            <?php include 'alevel-form.php'; ?>
        </div>
        <div id="other-qualifications" class="container tab-pane fade"><br>
            <?php include 'other-qualifications-form.php'; ?>
        </div>
        <div id="review-submit" class="container tab-pane fade"><br>
            <?php include 'review-submit-form.php'; ?>
        </div>
    </div>
</div>
<script src="academics.js"></script>
<script src="qualifications.js"></script>
<script src="alevel.js"></script>
<script>
    $(document).ready(function() {
        var entryType = '<?php echo $entryType; ?>';
        var level = '<?php echo $level; ?>';

        function showTab(tabId) {
            $('#' + tabId).show();
        }

        function hideTab(tabId) {
            $('#' + tabId).hide();
        }

        if (entryType === 'direct') {
            if (level === 'certificate') {
                showTab('olevel-tab');
                showTab('submit-tab');
                hideTab('alevel-tab');
                hideTab('other-qualifications-tab');
            } else if (level === 'diploma') {
                showTab('olevel-tab');
                showTab('alevel-tab');
                showTab('submit-tab');
                hideTab('other-qualifications-tab');
            }
        } else if (entryType === 'indirect') {
            if (level === 'diploma') {
                showTab('olevel-tab');
                showTab('alevel-tab');
                showTab('other-qualifications-tab');
                showTab('submit-tab');
            }
        }

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
                    const centerNo = ui.item.value.split(' ')[0];
                    $('#' + centerNumberId).val(centerNo + '/');
                }
            }).data('ui-autocomplete')._renderItem = function(ul, item) {
                return $('<li>')
                    .append('<div>' + item.label + '</div>')
                    .appendTo(ul);
            };
        }

        initializeAutocomplete('schoolUCE', 'centerNumberUCE');
        initializeAutocomplete('schoolUACE', 'centerNumberUACE');

        // Dark Mode Functionality
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const currentMode = localStorage.getItem('darkMode');
        if (currentMode === 'dark') {
            enableDarkMode();
            darkModeToggle.checked = true;
        } else {
            enableLightMode();
            darkModeToggle.checked = false;
        }

        darkModeToggle.addEventListener('change', function() {
            if (darkModeToggle.checked) {
                enableDarkMode();
                localStorage.setItem('darkMode', 'dark');
            } else {
                enableLightMode();
                localStorage.setItem('darkMode', 'light');
            }
        });

        function enableDarkMode() {
            document.body.classList.add('dark-mode');
            $('.header li a').css('color', '#fff');
        }

        function enableLightMode() {
            document.body.classList.remove('dark-mode');
            $('.header li a').css('color', ''); // Reset color
        }
    });
</script>
</body>
</html>
