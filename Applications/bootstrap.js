
        $(document).ready(function () {
            // Function to update progress bar and circular progress
            function updateProgress(progress) {
                // Update Bootstrap progress bar
                $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress).text(Math.round(progress) + '%');
                
                // Update circular progress

            // Calculate initial progress based on loaded tab content
            var activeTab = $('.nav-link.active').attr('id');
            switch (activeTab) {
                case 'o-level-tab':
                    updateProgress(<?php echo $progress * 0.25; ?>);
                    break;
                case 'a-level-tab':
                    updateProgress(<?php echo $progress * 0.5; ?>);
                    break;
                case 'other-qualifications-tab':
                    updateProgress(<?php echo $progress * 0.75; ?>);
                    break;
                case 'review-submit-tab':
                    updateProgress(<?php echo $progress; ?>);
                    break;
                default:
                    updateProgress(0);
                    break;
            }

            // Toggle progress on tab change
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("id");
                switch (target) {
                    case 'o-level-tab':
                        updateProgress(<?php echo $progress * 0.25; ?>);
                        break;
                    case 'a-level-tab':
                        updateProgress(<?php echo $progress * 0.5; ?>);
                        break;
                    case 'other-qualifications-tab':
                        updateProgress(<?php echo $progress * 0.75; ?>);
                        break;
                    case 'review-submit-tab':
                        updateProgress(<?php echo $progress; ?>);
                        break;
                    default:
                        updateProgress(0);
                        break;
                }
            });

            // Load tab content only once on first activation
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href"); // activated tab
                if ($(target).is(':empty')) {
                    $(target).load($(e.target).attr("data-url")); // load the content using AJAX
                }
            });

            // Validation and form submission
            $('#academicForm').submit(function (event) {
                // Validation logic here
                if (!validateForm()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });

            // Function to validate the form
            function validateForm() {
                var isValid = true;

                // Example validation for UCE section
                if ($('#indexNumberUCE').val().trim() === '') {
                    alert('Please enter UCE Index Number.');
                    isValid = false;
                }

                // Additional validation logic for other sections can be added similarly

                // Enable submit button if all sections are valid
                if (isValid) {
                    $('#submitApplicationButton').prop('disabled', false);
                }

                return isValid;
            }
        });
   