<?php
include ("scripts/academics.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>submit</title>
</head>
<body>
<div class="container mt-4">
    <div class="card">
                <div class="card-header section-header">
            <span><i class="fas fa-paper-plane"></i> Submit Application</span>
            <div class="status">
                <i class="fas fa-circle-stop"></i>
                <span class="badge badge-danger">NOT FILLED</span>
                <i class="fas fa-chevron-right ml-2"></i>
            </div>
        </div>
                <div id="previewSection" class="form-section mt-4">
                    <h2 class="text-center">REVIEW YOUR APPLICATION</h2>
                    <div id="previewContent">
                        <!-- Content will be loaded here from the database -->
                    </div>
                </div>
                <div id="submitApplicationSection" class="form-section">
                    <h2 class="text-center">SUBMIT YOUR APPLICATION FORM</h2>
                    <div class="alert alert-info mt-3">
                        <p>CLICK ON THE TEXT BELOW TO CONSENT AND SUBMIT YOUR FORM</p>
                    </div>
                    <div class="declaration my-3">
                        <input type="checkbox" class="declaration-checkbox" id="declarationCheckbox">
                        <label for="declarationCheckbox" class="text-danger">
                            I <strong> <?php echo htmlspecialchars($fullName); ?></strong>, DECLARE THAT TO THE BEST OF MY KNOWLEDGE THE INFORMATION I HAVE PROVIDED HERE IS TRUE AND I AGREE TO THE ONLINE APPLICATION TERMS AND CONDITIONS OF USE.
                        </label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-3" id="submitApplicationButton" disabled>SUBMIT FORM</button>
                    </div>
                    <div id="submitApplicationValidationMessage" class="mt-3"></div>
                </div>
                <div id="successMessage" class="alert alert-success" style="display: none;">
                    Your application has been submitted successfully!
                </div>
                <!-- Preview Section -->
                
            </div>
    </div>
    </div>
    <script>
        <script>
    $(document).ready(function() {
        // Load preview content on page load
        loadPreviewContent();

        // Function to load preview content via AJAX
        function loadPreviewContent() {
            $.ajax({
                url: 'fetch-preview.php', // Adjust URL to your PHP script fetching preview data
                type: 'GET',
                success: function(response) {
                    $('#previewContent').html(response); // Update preview content
                },
                error: function(xhr, status, error) {
                    console.error('Error loading preview content:', error);
                }
            });
        }

        // Function to enable/disable submit button based on checkbox state
        function toggleSubmitButton() {
            if ($('#declarationCheckbox').prop('checked')) {
                $('#submitApplicationButton').prop('disabled', false); // Enable submit button
            } else {
                $('#submitApplicationButton').prop('disabled', true); // Disable submit button
            }
        }

        // Initial state on page load
        toggleSubmitButton();

        // Checkbox change event listener
        $('#declarationCheckbox').change(function() {
            toggleSubmitButton(); // Toggle submit button whenever checkbox state changes
        });

        // Submit button click event
        $('#submitApplicationButton').click(function() {
            // Check if declaration checkbox is checked
            if ($('#declarationCheckbox').prop('checked')) {
                submitForm();
            } else {
                $('#submitApplicationValidationMessage').html('<div class="alert alert-danger">Please check the declaration box to submit the form.</div>');
            }
        });

        // Function to submit the form
        function submitForm() {
            // Perform AJAX submission or form submission logic
            $.ajax({
                url: 'submit-application.php', // Adjust URL to your PHP script handling form submission
                type: 'POST', // Example assuming POST method
                data: {
                    // Include any form data to submit if needed
                },
                success: function(response) {
                    $('#submitApplicationValidationMessage').html('<div class="alert alert-success">Form submitted successfully!</div>');
                    $('#successMessage').show(); // Show success message
                    // Optionally, reset form or redirect user
                },
                error: function(xhr, status, error) {
                    console.error('Error submitting form:', error);
                    $('#submitApplicationValidationMessage').html('<div class="alert alert-danger">Error submitting form. Please try again.</div>');
                }
            });
        }
    });
</script>

    </script>
</body>
</html>
