<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocomplete Form</title>
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Custom Script -->
    <script src="scripts.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>Autocomplete Form</h1>
    <form id="testForm">
        <!-- UCE Part -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="schoolUCE">School Name<span class="text-danger">*</span>:</label>
                <input type="text" class="form-control" id="schoolUCE" name="schoolName" placeholder="Start typing to search and select a school" required>
                <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
            </div>

            <div class="form-group col-md-4">
                <label for="centerNumberUCE" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="centerNumberUCE" name="centerNumber" placeholder="Center No." value="U0000" readonly>
                    <input type="hidden" id="indexNumberField" name="indexNumberUCE" value="">
                    <div class="input-group-append">
                        <select class="custom-select" id="candidateNumber" name="candidateNumber" required>
                            <option value="">Select candidate number</option>
                            <?php
                            for ($i = 1; $i <= 499; $i++) {
                                printf('<option value="%03d">%03d</option>', $i, $i);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <small id="indexNumberHelpBlock" class="form-text text-muted">Format: U1234/123</small>
            </div>

            <div class="form-group col-md-4">
                <label for="yearUCE" class="required-field">Year of Sitting<span class="text-danger">*</span>:</label>
                <select class="form-control" id="yearUCE" name="yearOfSitting" required>
                    <option value="" disabled selected>Select a year</option>
                </select>
            </div>
        </div>

        <!-- UACE Part -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="schoolUACE">School Name<span class="text-danger">*</span>:</label>
                <input type="text" class="form-control" id="schoolUACE" name="schoolName" placeholder="Start typing to search and select a school" required>
                <small id="schoolNameHelpBlock" class="form-text text-muted">Start typing to search and select a school.</small>
            </div>

            <div class="form-group col-md-4">
                <label for="centerNumberUACE" class="required-field">Index Number<span class="text-danger">*</span>:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="centerNumberUACE" name="centerNumber" placeholder="Center No." value="U0000" readonly>
                    <div class="input-group-append">
                        <select class="custom-select" id="candidateNumberUACE" name="candidateNumber" required>
                            <option value="">Select candidate number</option>
                            <?php
                            for ($i = 501; $i <= 999; $i++) {
                                printf('<option value="%03d">%03d</option>', $i, $i);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <small id="indexNumberHelpBlock" class="form-text text-muted">Format: U1234/123</small>
            </div>

            <div class="form-group col-md-4">
                <label for="yearUACE" class="required-field">Year of Sitting<span class="text-danger">*</span>:</label>
                <select class="form-control" id="yearUACE" name="yearOfSitting" required>
                    <option value="" disabled selected>Select a year</option>
                </select>
            </div>
        </div>
    </form>

    <script>
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


    </script>
</body>
</html>
