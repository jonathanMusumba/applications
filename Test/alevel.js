$(document).ready(function() {
    // Populate year selection
    var currentYear = new Date().getFullYear();
    for (var year = currentYear; year >= 1980; year--) {
        $('#yearUACE').append($('<option>', { value: year, text: year }));
    }

    // Handle "Did Not Sit" checkbox
    $('#didNotSitAlevel').change(function() {
        if ($(this).is(':checked')) {
            clearAndDisableFormAlevel();
        } else {
            enableFormAlevel();
        }
    });

    function clearAndDisableFormAlevel() {
        $('#alevelSection .form-control').val('');
        $('#alevelSection .form-control').prop('disabled', true);
        $('#alevelSection .form-check-input').prop('disabled', true);
        $('#alevelSection select').prop('disabled', true);
        $('#subjectSelectionSectionAlevel').hide();
    }

    function enableFormAlevel() {
        $('#alevelSection .form-control').prop('disabled', false);
        $('#alevelSection .form-check-input').prop('disabled', false);
        $('#alevelSection select').prop('disabled', false);
        $('#subjectSelectionSectionAlevel').show();
    }

    // Handle adding subjects
    $('#addSubjectBtnAlevel').click(function() {
        var subject = $('#subjectAlevel').val();
        var subjectText = $('#subjectAlevel option:selected').text();
        var grade = $('#gradeAlevel').val();

        if (subject && grade) {
            var row = '<tr>' +
                '<td>' + subjectText + '</td>' +
                '<td>' + subject + '</td>' +
                '<td>' + grade + '</td>' +
                '<td><button type="button" class="btn btn-danger removeSubjectBtnAlevel">Remove</button></td>' +
                '</tr>';
            $('#subjectsTableAlevel tbody').append(row);
            $('#subjectAlevel').val('');
            $('#gradeAlevel').val('');
        } else {
            alert('Please select both subject and grade.');
        }
    });

    // Handle removing subjects
    $('#subjectsTableAlevel').on('click', '.removeSubjectBtnAlevel', function() {
        $(this).closest('tr').remove();
    });

    
});