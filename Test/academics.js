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
        var grade = row.find('td').eq(2).text();
        row.remove();

        updateCounters(grade, -1);

        if ($('#subjectsTable tr').length < 8) {
            $('#saveResults').prop('disabled', true);
        }
    });

    function updateCounters(grade, increment) {
        if (['D1', 'D2'].includes(grade)) {
            distinctions += increment;
        } else if (['C3', 'C4', 'C5', 'C6'].includes(grade)) {
            credits += increment;
        } else if (['P7', 'P8'].includes(grade)) {
            passes += increment;
        } else if (grade === 'F9') {
            failures += increment;
        }
        $('#distinctions').text(distinctions);
        $('#credits').text(credits);
        $('#passes').text(passes);
        $('#failures').text(failures);
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

        $('#olevelForm').submit();
    });

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
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    // Check if dark mode preference is saved in local storage
    const currentMode = localStorage.getItem('darkMode');
    if (currentMode === 'dark') {
        enableDarkMode();
        darkModeToggle.checked = true;
    } else {
        enableLightMode(); // Default to light mode
        darkModeToggle.checked = false;
    }

    // Listen for changes in the checkbox
    darkModeToggle.addEventListener('change', function() {
        if (darkModeToggle.checked) {
            enableDarkMode();
            localStorage.setItem('darkMode', 'dark'); // Save dark mode preference
        } else {
            enableLightMode();
            localStorage.setItem('darkMode', 'light'); // Save light mode preference
        }
    });

    // Function to enable dark mode
    function enableDarkMode() {
        document.body.classList.add('dark-mode');
        // Change text color to white when dark mode is enabled
        document.querySelectorAll('.header li a').forEach(function(link) {
            link.style.color = '#fff';
        });
    }s

    // Function to enable light mode
    function enableLightMode() {
        document.body.classList.remove('dark-mode');
        // Reset text color when light mode is enabled (assuming your default styles handle this)
        document.querySelectorAll('.header li a').forEach(function(link) {
            link.style.color = ''; // Reset to default or CSS defined color
        });
    }
});

