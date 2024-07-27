$(document).ready(function() {
    // Common setup
    $('#saveResults').prop('disabled', true);
    $('#saveResultsAlevel').prop('disabled', true);

    function resetDropdown(dropdown) {
        dropdown.selectedIndex = 0; // Reset selection to the first option
    }

    // O Level Form
    $('#addSubject').click(function() {
        var subjectCode = $('#subject').val();
        var subjectText = $('#subject option:selected').text();
        var grade = $('#grade').val();

        var exists = false;
        $('#subjectsTable tr').each(function() {
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
            '<td><button type="button" class="btn btn-danger removeSubject">Remove</button></td>' +
            '</tr>';
        $('#subjectsTable').append(row);

        updateCounters(grade, 1);

        if ($('#subjectsTable tr').length >= 8) {
            $('#saveResults').prop('disabled', false);
        }
    });

    $(document).on('click', '.removeSubject', function() {
        var row = $(this).closest('tr');
        var grade = row.find('td').eq(2).text().trim();
        row.remove();
    
        updateCounters(grade, -1);
    
        if ($('#subjectsTable tr').length < 8) {
            $('#saveResults').prop('disabled', true);
        } else {
            $('#saveResults').prop('disabled', false);
        }
    });

    var distinctions = 0;
    var credits = 0;
    var passes = 0;
    var failures = 0;

    function updateCounters(grade, increment) {
        increment = increment || 0;
        if (typeof distinctions === 'undefined') distinctions = 0;
        if (typeof credits === 'undefined') credits = 0;
        if (typeof passes === 'undefined') passes = 0;
        if (typeof failures === 'undefined') failures = 0;

    // Update counters based on the grade
    if (['D1', 'D2'].includes(grade)) {
        distinctions += increment;
    } else if (['C3', 'C4', 'C5', 'C6'].includes(grade)) {
        credits += increment;
    } else if (['P7', 'P8'].includes(grade)) {
        passes += increment;
    } else if (grade === 'F9') {
        failures += increment;
    }
    distinctions = Math.max(distinctions, 0);
    credits = Math.max(credits, 0);
    passes = Math.max(passes, 0);
    failures = Math.max(failures, 0);

    // Update the displayed counts
    $('#distinctions').text(distinctions);
    $('#credits').text(credits);
    $('#passes').text(passes);
    $('#failures').text(failures);

    // Return the current counts
    return {
        distinctions: distinctions,
        credits: credits,
        passes: passes,
        failures: failures
    };
}

    $('#saveResults').click(function() {
        var subjectsData = [];
        $('#subjectsTable tr').each(function() {
            var code = $(this).find('td').eq(0).text().trim();
            var grade = $(this).find('td').eq(2).text().trim();
            subjectsData.push({ code, grade });
        });

        $('#subjectsField').val(JSON.stringify(subjectsData));
        $('#indexNumberField').val($('#centerNumber').val().trim() + '/' + $('#candidateNumber').val().trim());

        $('#distinctionsInput').val($('#distinctions').text().trim() || '0');
        $('#creditsInput').val($('#credits').text().trim() || '0');
        $('#passesInput').val($('#passes').text().trim() || '0');
        $('#failuresInput').val($('#failures').text().trim() || '0');

        $('#olevelForm').submit();
    });
    console.log('Updating counters with grade:', grade, 'and increment:', increment);
    console.log('Current values - Distinctions:', distinctions, 'Credits:', credits, 'Passes:', passes, 'Failures:', failures);
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    if (status === 'success') {
        alert("O Level Data successfully saved!");
    } else if (status === 'error') {
        alert("There was an error saving the O Level data. Please try again.");
    }
    // A Level Form
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

    // Add event listeners to form fields to check when they change
    schoolUCE.addEventListener('input', checkSectionFilled);
    candidateNumber.addEventListener('change', checkSectionFilled);
    yearUCE.addEventListener('change', checkSectionFilled);
});


});


function toggleRegistrationFields() {
    var registrationStatus = document.getElementById('registrationStatus').value;
    var registrationDetails = document.getElementById('registrationDetails');
    if (registrationStatus === 'Yes') {
        registrationDetails.style.display = 'block';
    } else {
        registrationDetails.style.display = 'none';
    }
}

function collectFormData() {
    var formData = new FormData(document.getElementById('otherQualificationsForm'));

    var registrationStatus = document.getElementById('registrationStatus').value;
    var registrationDetails = {
        registrationStatus: registrationStatus
    };

    if (registrationStatus === 'Yes') {
        registrationDetails.registrationNumber = document.getElementById('registrationNumber').value;
        registrationDetails.yearOfRegistration = document.getElementById('yearOfRegistration').value;
        registrationDetails.yearsWorked = document.getElementById('yearsWorked').value;
    }

    formData.append('registrationDetails', JSON.stringify(registrationDetails));
    return formData;
}

document.getElementById('saveQualifications').addEventListener('click', function () {
    var formData = collectFormData();

    fetch('submit_other_qualifications.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Qualifications saved successfully!');
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const skipSectionButton = document.getElementById('skipSection');
    const subjectSelectionSection = document.getElementById('subjectSelectionSection');
    const schoolInput = document.getElementById('schoolUACE');
    const candidateNumberSelect = document.getElementById('candidateNumber');
    const yearSelect = document.getElementById('yearUACE');
    const addSubjectButton = document.getElementById('addSubject');
    const saveResultsButton = document.getElementById('saveResults');
    const subjectsTable = document.getElementById('subjectsTable');
    const validationMessage = document.getElementById('validationMessage');
    const subjects = [];

    // Skip Section button
    skipSectionButton.addEventListener('click', function () {
        subjectSelectionSection.style.display = 'block';
        // Mark section as complete or skipped
        skipSectionButton.disabled = true;
    });

    // Add Subject button
    addSubjectUACEButton.addEventListener('click', function () {
        const subject = document.getElementById('subject').value;
        const grade = document.getElementById('grade').value;

        if (subject && grade) {
            if (subjects.length >= 4) {
                alert('You can add up to 4 subjects only.');
                return;
            }

            subjects.push({ subject, grade });
            updateSubjectsTable();
        } else {
            alert('Please select both subject and grade.');
        }
    });

    function updateSubjectsTable() {
        subjectsTable.innerHTML = '';

        subjects.forEach((subj, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${subj.subject}</td>
                <td>${getSubjectName(subj.subject)}</td>
                <td>${subj.grade}</td>
                <td><button type="button" class="btn btn-danger btn-sm remove-subject" data-index="${index}">Remove</button></td>
            `;
            subjectsTable.appendChild(row);
        });

        // Enable or disable the Save Results button
        saveResultsButton.disabled = !isFormValid();

        // Add event listener for remove buttons
        document.querySelectorAll('.remove-subject').forEach(button => {
            button.addEventListener('click', function () {
                const index = this.dataset.index;
                subjects.splice(index, 1);
                updateSubjectsTable();
            });
        });
    }

    function isFormValid() {
        return subjects.length > 0 &&
            schoolInput.value.trim() !== '' &&
            candidateNumberSelect.value.trim() !== '' &&
            yearSelect.value.trim() !== '';
    }

    // Form submission handling
    document.getElementById('alevelForm').addEventListener('submit', function (event) {
        if (!isFormValid() && !skipSectionButton.disabled) {
            event.preventDefault();
            validationMessage.textContent = 'Please complete all required fields or skip the section.';
        }
    });
});