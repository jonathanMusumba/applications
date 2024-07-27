$('#addSubjectAlevel').click(function() {
    var subjectCode = $('#subjectAlevel').val();
    var subjectText = $('#subjectAlevel option:selected').text();
    var grade = $('#gradeAlevel').val();

    var exists = false;
    $('#subjectsTableAlevel tr').each(function() {
        if ($(this).find('td').eq(0).text() === subjectCode) {
            exists = true;
            return false;
        }
    });
    if (exists) {
        alert('Subject already added.');
        return;
    }

    var row = '<tr>' +
        '<td>' + subjectCode + '</td>' +
        '<td>' + subjectText + '</td>' +
        '<td>' + grade + '</td>' +
        '<td><button type="button" class="btn btn-danger removeSubjectAlevel">Remove</button></td>' +
        '</tr>';
    $('#subjectsTableAlevel').append(row);

    updateCountersAlevel(grade, 1);
    increment = increment || 0;
    if ($('#subjectsTableAlevel tr').length >= 3) { // Adjust the number based on A Level requirements
        $('#saveResultsAlevel').prop('disabled', false);
    }
});

$(document).on('click', '.removeSubjectAlevel', function() {
    var row = $(this).closest('tr');
    var grade = row.find('td').eq(2).text();
    row.remove();

    updateCountersAlevel(grade, -1);

    if ($('#subjectsTableAlevel tr').length < 3) { // Adjust the number based on A Level requirements
        $('#saveResultsAlevel').prop('disabled', true);
    }
});

function updateCountersAlevel(grade, increment) {

    if (['A', 'B'].includes(grade)) {
        distinctionsAlevel += increment;
    } else if (['C', 'D'].includes(grade)) {
        creditsAlevel += increment;
    } else if (['E'].includes(grade)) {
        passesAlevel += increment;
    } else if (grade === 'U') {
        failuresAlevel += increment;
    }
    $('#distinctionsAlevel').text(distinctionsAlevel);
    $('#creditsAlevel').text(creditsAlevel);
    $('#passesAlevel').text(passesAlevel);
    $('#failuresAlevel').text(failuresAlevel);
}

$('#saveResultsAlevel').click(function() {
    var subjectsData = [];
    $('#subjectsTableAlevel tr').each(function() {
        var code = $(this).find('td').eq(0).text().trim();
        var grade = $(this).find('td').eq(2).text().trim();
        subjectsData.push({ code, grade });
    });

    $('#subjectsFieldAlevel').val(JSON.stringify(subjectsData));
    $('#indexNumberFieldAlevel').val($('#centerNumberAlevel').val().trim() + '/' + $('#candidateNumberAlevel').val().trim());

    $('#alevelForm').submit();
});

// Other Qualifications Form
$('#saveOtherQualifications').click(function() {
    $('#otherQualificationsForm').submit();
});
});

document.addEventListener('DOMContentLoaded', function() {
// Get the form elements
const schoolUCE = document.getElementById('schoolUCE');
const centerNumberUCE = document.getElementById('centerNumberUCE');
const candidateNumber = document.getElementById('candidateNumber');
const yearUCE = document.getElementById('yearUCE');
const subjectSelectionSectionUCE = document.getElementById('subjectSelectionSectionUCE');

// Function to check if the form section is filled
function checkSectionFilled() {
    // Check if all required fields are filled
    if (schoolUCE.value && centerNumberUCE.value && candidateNumber.value && yearUCE.value) {
        subjectSelectionSectionUCE.style.display = 'block';
    } else {
        subjectSelectionSectionUCE.style.display = 'none';
    }
}