$(document).ready(function() {
    $('#schoolName').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'fetch_schools.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.Center_Name,
                            value: item.CenterNo + ' ' + item.Center_Name
                        };
                    }));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            const centerNo = ui.item.value.split(' ')[0]; // Extract CenterNo from selected item
            $('#centerNumber').val(centerNo + '/');
        }
    }).data('ui-autocomplete')._renderItem = function(ul, item) {
        return $('<li>')
            .append('<div>' + item.label + '</div>')
            .appendTo(ul);
    };
});

function checkFormCompletion() {
    const schoolName = document.getElementById('schoolName').value;
    const centerNumber = document.getElementById('centerNumber').value;
    const candidateNumber = document.getElementById('candidateNumber').value;
    const yearOfSitting = document.getElementById('yearOfSitting').value;

    if (schoolName && centerNumber && candidateNumber && yearOfSitting) {
        document.getElementById('subjectSelectionSection').style.display = 'block';
    } else {
        document.getElementById('subjectSelectionSection').style.display = 'none';
    }
}
const currentYear = new Date().getFullYear();

        // Calculate the range of years
        const startYear = currentYear - 22;
        const endYear = currentYear - 1;

        // Get the select element
        const yearSelect = document.getElementById('yearOfSitting');

        // Generate options dynamically
        for (let year = endYear; year >= startYear; year--) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
// Add event listeners to form fields
document.getElementById('schoolName').addEventListener('input', checkFormCompletion);
document.getElementById('candidateNumber').addEventListener('change', checkFormCompletion);
document.getElementById('yearOfSitting').addEventListener('change', checkFormCompletion);
document.getElementById('didNotSit').addEventListener('change', function () {
    if (this.checked) {
        // Checkbox is checked, disable other form elements
        document.getElementById('subjectSelectionSection').style.display = 'none';
        document.getElementById('didNotSitWarning').style.display = 'block';

        // Clear values from other form fields
        document.getElementById('schoolName').value = '';
        document.getElementById('centerNumber').value = '';
        document.getElementById('candidateNumber').selectedIndex = 0;
        document.getElementById('yearOfSitting').selectedIndex = 0;
        const subjectsTable = document.getElementById('subjectsTable');
        subjectsTable.innerHTML = ''; // Clear all rows

        // Update summary values
        document.getElementById('pointsObtained').value = '';
        document.getElementById('resultCode').value = '';
        document.getElementById('principlePasses').textContent = '0';
        document.getElementById('subsidiaryPasses').textContent = '0';
        document.getElementById('failures').textContent = '0';
        const subjectJsonInput = document.getElementById('subjectJson');
        subjectJsonInput.value = '';

        // Disable the save button until the warning save button is clicked
        document.getElementById('saveResults').disabled = true;
    } else {
        // Checkbox is unchecked, enable form elements
        checkFormCompletion(); // Check form completion to show/hide subject selection section
        document.getElementById('didNotSitWarning').style.display = 'none';
    }
});

// Handle save button inside warning message
document.getElementById('saveEmptyResults').addEventListener('click', function () {
    // Submit the form with empty or default values
    document.getElementById('alevelSection').submit();
});
document.getElementById('saveResults').addEventListener('click', function () {
// Check if form is complete before submitting
if (document.getElementById('schoolName').value &&
    document.getElementById('centerNumber').value &&
    document.getElementById('candidateNumber').value &&
    document.getElementById('yearOfSitting').value) {
    document.getElementById('alevelSection').submit();
}
});