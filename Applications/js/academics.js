$(document).ready(function () {
    var loadedTabs = [];

    // Load content when tab is shown
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // activated tab
        var url = $(e.target).attr("data-url"); // URL for the content

        // Hide all tab panes except the current one
        $('.tab-pane').not(target).removeClass('active show');

        // Load content only if not already loaded
        if ($.inArray(target, loadedTabs) === -1 && url) {
            $(target).load(url, function () {
                loadedTabs.push(target);
                $(target).addClass('active show');
            });
        } else {
            $(target).addClass('active show');
        }
    });

    // Trigger the first tab to load its content by default
    $('a[data-toggle="tab"]:first').trigger('shown.bs.tab');
});

            // Enable submit button when checkbox is checked
            $('#declarationCheckbox').change(function () {
                $('#submitApplicationButton').prop('disabled', !this.checked);
            });

            // Form submission
            $('#submitApplicationButton').click(function () {
                // Gather form data and submit
                $.ajax({
                    url: 'submit_application.php', // Replace with the URL to your submission script
                    method: 'POST',
                    data: {
                        fullName: '<?php echo htmlspecialchars($fullName); ?>',
                        // Add other form data here
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#successMessage').show();
                            $('#submitApplicationStatus').html('<i class="fas fa-check-circle"></i> SUBMITTED');
                        } else {
                            $('#submitApplicationValidationMessage').text(response.message);
                        }
                    }
                });
            });

            // Load preview content
            function loadPreview() {
                $.ajax({
                    url: 'load_preview.php', // Replace with the URL to your preview loading script
                    method: 'GET',
                    success: function (response) {
                        $('#previewContent').html(response);
                    }
                });
            }

            // Load preview when the tab is shown
            $('a[href="#review-submit"]').on('shown.bs.tab', function () {
                loadPreview();
            });
       