<?php
// Your PHP logic here, if any
?>

    <div class="container mt-4">
        <div class="card">
            <    <div class="card">
                <div class="card-header section-header">
            <span><i class="fas fa-paper-plane"></i> Submit Application</span>
            <div class="status">
                <i class="fas fa-circle-stop"></i>
                <span class="badge badge-danger">NOT FILLED</span>
                <i class="fas fa-chevron-right ml-2"></i>
            </div>
        </div>

            <div class="card-body">
                <div id="previewSection" class="form-section">
                    <h2 class="text-center">Review Your Application</h2>
                    <div id="previewContent">
                        <!-- Content will be loaded here from the database -->
                    </div>
                </div>
                <div id="submitApplicationSection" class="form-section mt-4">
                    <h2 class="text-center">Submit Your Application Form</h2>
                    <div class="alert alert-info mt-3">
                        <p>Click on the checkbox below to consent and submit your form.</p>
                    </div>
                    <div class="declaration my-3">
                        <input type="checkbox" class="declaration-checkbox" id="declarationCheckbox">
                        <label for="declarationCheckbox" class="text-danger">
                            I <strong>Your Name Here</strong>, declare that to the best of my knowledge the information I have provided here is true and I agree to the online application terms and conditions of use.
                        </label>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-success mt-3" id="submitApplicationButton" disabled>Submit Form</button>
                    </div>
                    <div id="submitApplicationValidationMessage" class="mt-3"></div>
                </div>
                <div id="successMessage" class="alert alert-success" style="display: none;">
                    Your application has been submitted successfully!
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        loadPreviewContent();

        function loadPreviewContent() {
            $.ajax({
                url: 'fetch-preview.php',
                type: 'GET',
                success: function(response) {
                    $('#previewContent').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading preview content:', error);
                }
            });
        }

        function toggleSubmitButton() {
            if ($('#declarationCheckbox').prop('checked')) {
                $('#submitApplicationButton').prop('disabled', false);
            } else {
                $('#submitApplicationButton').prop('disabled', true);
            }
        }

        toggleSubmitButton();

        $('#declarationCheckbox').change(function() {
            toggleSubmitButton();
        });

        $('#submitApplicationButton').click(function() {
            if ($('#declarationCheckbox').prop('checked')) {
                submitForm();
            } else {
                $('#submitApplicationValidationMessage').html('<div class="alert alert-danger">Please check the declaration box to submit the form.</div>');
            }
        });

        function submitForm() {
            $.ajax({
                url: 'submit-application.php',
                type: 'POST',
                data: { action: 'submit' },
                success: function(response) {
                    $('#submitApplicationValidationMessage').html('<div class="alert alert-success">Form submitted successfully!</div>');
                    $('#successMessage').show();
                    $('#submitApplicationButton').hide();
                },
                error: function(xhr, status, error) {
                    console.error('Error submitting form:', error);
                    $('#submitApplicationValidationMessage').html('<div class="alert alert-danger">Error submitting form. Please try again.</div>');
                }
            });
        }
    });
    </script>
