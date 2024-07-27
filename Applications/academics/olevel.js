document.addEventListener('DOMContentLoaded', function() {
    var subjectSelectionSectionUCE = document.getElementById('subjectSelectionSectionUCE');

    function updateCompletionStatusUCE() {
        var completionStatusField = document.getElementById('completionStatus');
        var subjectsTableUCE = document.getElementById('subjectsTableUCE');
        var subjectsCountUCE = subjectsTableUCE.querySelectorAll('tr').length;

        if (subjectsCountUCE < 8) {
            completionStatusField.value = 'incomplete';
        } else {
            var requiredFields = ['schoolUCE', 'candidateNumberUCE', 'yearUCE'];
            var isFormComplete = true;

            requiredFields.forEach(function(id) {
                var field = document.getElementById(id);
                if (field && !field.value) {
                    isFormComplete = false;
                }
            });

            completionStatusField.value = isFormComplete ? 'complete' : 'incomplete';
        }
    }

    // Attach event listeners
    document.querySelectorAll('#subjectUCE, #gradeUCE').forEach(function(element) {
        element.addEventListener('change', updateCompletionStatusUCE);
    });
});
