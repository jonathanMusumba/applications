<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tab Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="Olevel-tab" data-bs-toggle="tab" data-bs-target="#Olevel-tab-pane" type="button" role="tab" aria-controls="Olevel-tab-pane" aria-selected="true">O Level Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="Alevel-tab" data-bs-toggle="tab" data-bs-target="#Alevel-tab-pane" type="button" role="tab" aria-controls="Alevel-tab-pane" aria-selected="false">A Level Information</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="qualifications-tab" data-bs-toggle="tab" data-bs-target="#qualifications-tab-pane" type="button" role="tab" aria-controls="qualifications-tab-pane" aria-selected="false">Other Qualifications</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="submit-tab" data-bs-toggle="tab" data-bs-target="#submit-tab-pane" type="button" role="tab" aria-controls="submit-tab-pane" aria-selected="false">Review & Submit</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="Olevel-tab-pane" role="tabpanel" aria-labelledby="Olevel-tab" tabindex="0">
        <!-- Content will be loaded dynamically here -->
    </div>
    <div class="tab-pane fade" id="Alevel-tab-pane" role="tabpanel" aria-labelledby="Alevel-tab" tabindex="0">
        <!-- Content will be loaded dynamically here -->
    </div>
    <div class="tab-pane fade" id="qualifications-tab-pane" role="tabpanel" aria-labelledby="qualifications-tab" tabindex="0">
        <!-- Content will be loaded dynamically here -->
    </div>
    <div class="tab-pane fade" id="submit-tab-pane" role="tabpanel" aria-labelledby="submit-tab" tabindex="0">
        <!-- Content will be loaded dynamically here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Load the default tab content on page load
        loadTabContent('Olevel-tab', 'O-level information.php');

        // Handle tab click events
        $('#myTab button').click(function(event) {
            event.preventDefault();
            var tabId = $(this).attr('id');
            var tabContentFile = '';

            switch (tabId) {
                case 'Olevel-tab':
                    tabContentFile = 'O-level information.php';
                    break;
                case 'Alevel-tab':
                    tabContentFile = 'A-level information.php';
                    break;
                case 'qualifications-tab':
                    tabContentFile = 'other-qualifications.php';
                    break;
                case 'submit-tab':
                    tabContentFile = 'submit.php';
                    break;
                default:
                    break;
            }

            // Load content for the clicked tab
            loadTabContent(tabId, tabContentFile);
        });

        // Function to load tab content via AJAX
        function loadTabContent(tabId, tabContentFile) {
            $.ajax({
                url: tabContentFile,
                type: 'GET',
                success: function(response) {
                    // Update the correct tab pane with the loaded content
                    $('#myTabContent').find('.tab-pane').removeClass('show active');
                    $('#' + tabId + '-pane').html(response).addClass('show active');
                },
                error: function(xhr, status, error) {
                    console.error('Error loading tab content:', error);
                }
            });
        }
    });
</script>

</body>
</html>
