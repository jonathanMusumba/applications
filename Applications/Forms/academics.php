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
            <a class="nav-link" data-toggle="tab" href="#review-submit">Review & Submit</a>
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
            <?php include 'other-Qualifications-form.php'; ?>
        </div>
        <div id="review-submit" class="container tab-pane fade"><br>
            <!-- Review & Submit Form -->
            <?php include 'review-submit-form.php'; ?>
        </div>
    </div>
</div>

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
</script>

</body>
</html>
