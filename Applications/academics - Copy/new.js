$(document).ready(function() {
    var oLevelCompleted = <?php echo json_encode($oLevelCompleted); ?>;
    var aLevelCompleted = <?php echo json_encode($aLevelCompleted); ?>;
    var otherQualificationsCompleted = <?php echo json_encode($otherQualificationsCompleted); ?>;
    var entryType = '<?php echo $entryType; ?>';
    var level = '<?php echo $level; ?>';

    function showTab(tabId) {
        $('#' + tabId).show();
    }

    function hideTab(tabId) {
        $('#' + tabId).hide();
    }

    function checkCompletion() {
        var oLevelCompleted = $('#section-to-validateUCE').find('input, select').filter(function() { return $(this).val() === ""; }).length === 0;
        var aLevelCompleted = $('#section-to-validateUACE').find('input, select').filter(function() { return $(this).val() === ""; }).length === 0;
        var otherQualificationsCompleted = $('#otherQualificationsForm').find('input, select').filter(function() { return $(this).val() === ""; }).length === 0;

        // Direct & Certificate: O Level completed
        if (entryType === 'direct' && level === 'certificate') {
            if (oLevelCompleted) {
                $('#submit-tab').prop('disabled', false);
            } else {
                $('#submit-tab').prop('disabled', true);
            }
        }
        
        // Direct & Diploma: O Level and A Level completed
        else if (entryType === 'direct' && level === 'diploma') {
            if (oLevelCompleted && aLevelCompleted) {
                $('#submit-tab').prop('disabled', false);
            } else {
                $('#submit-tab').prop('disabled', true);
            }
        }
        
        // Indirect & Diploma: O Level and Other Qualifications completed (A Level optional)
        else if (entryType === 'indirect' && level === 'diploma') {
            if (oLevelCompleted && otherQualificationsCompleted) {
                $('#submit-tab').prop('disabled', false);
            } else {
                $('#submit-tab').prop('disabled', true);
            }
        }
    }

    // Show/Hide tabs based on entryType and level
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

    // Check completion when tabs are shown or hidden
    $('#olevel-tab, #alevel-tab, #other-qualifications-tab').on('change input', checkCompletion);

    // Initial check on page load
    checkCompletion();
});
