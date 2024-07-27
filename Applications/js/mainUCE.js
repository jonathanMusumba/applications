$(document).ready(function() {
    // Initialize variables
    var distinctions = 0, credits = 0, passes = 0, failures = 0;
    var requiredSubjects = ['112', '456', '545', '553', '535']; // Subject codes for English, Mathematics, Chemistry, Biology, Physics

    // Autocomplete initialization
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

    // Year dropdown initialization
    const currentYear = new Date().getFullYear();
    const startYear = currentYear - 15;
    const endYear = currentYear - 1;
    const yearSelect = document.getElementById('yearOfSitting');

    for (let year = endYear; year >= startYear; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }

    // Add subject functionality
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

        var subjectsCount = $('#subjectsTable tr').length;
        if (subjectsCount >= 8) {
            $('#saveResults').prop('disabled', false);
        } else {
            $('#saveResults').prop('disabled', true);
        }
    });

    // Remove subject functionality
    $(document).on('click', '.removeSubject', function() {
        var row = $(this).closest('tr');
        var grade = row.find('td').eq(2).text();
        row.remove();

        updateCounters(grade, -1);

        var subjectsCount = $('#subjectsTable tr').length;
        if (subjectsCount < 8) {
            $('#saveResults').prop('disabled', true);
        }
    });

    // Update counters
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

    // Prepare form submission
    document.getElementById('saveResults').addEventListener('click', function() {
        // Prepare subjects data
        const subjectsData = [];
        const subjectsTable = document.getElementById('subjectsTable');
        const rows = subjectsTable.rows;

        for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
            const code = rows[i].cells[0].textContent.trim();
            const grade = rows[i].cells[2].textContent.trim();
            subjectsData.push({ code, grade });
        }
        const subjectsJSON = JSON.stringify(subjectsData);

        // Make sure to include subjectsJSON in the form data submission
        document.getElementById('subjectsField').value = subjectsJSON;
        const centerNumber = document.getElementById('centerNumber').value.trim() || '';
        const candidateNumber = document.getElementById('candidateNumber').value.trim() || '';

        // Format the index number correctly
        const indexNumber = centerNumber + '/' + candidateNumber;

        // Include indexNumber in the form data submission
        document.getElementById('indexNumberField').value = indexNumber;

        // Prepare aggregate and division
        const aggregate = document.getElementById('aggregate').value;
        const division = document.getElementById('division').value;

        // Prepare summary values
        const distinctions = document.getElementById('distinctions').textContent;
        const credits = document.getElementById('credits').textContent;
        const passes = document.getElementById('passes').textContent;
        const failures = document.getElementById('failures').textContent;

        // Create hidden input for subjects data
        const subjectJsonInput = document.createElement('input');
        subjectJsonInput.type = 'hidden';
        subjectJsonInput.name = 'subjectJson';
        subjectJsonInput.value = JSON.stringify(subjectsData);
        document.getElementById('olevelSection').appendChild(subjectJsonInput);

        // Create hidden inputs for aggregate and division
        const aggregateInput = document.createElement('input');
        aggregateInput.type = 'hidden';
        aggregateInput.name = 'aggregate';
        aggregateInput.value = aggregate;
        document.getElementById('olevelSection').appendChild(aggregateInput);

        const divisionInput = document.createElement('input');
        divisionInput.type = 'hidden';
        divisionInput.name = 'division';
        divisionInput.value = division;
        document.getElementById('olevelSection').appendChild(divisionInput);

        // Create hidden inputs for summary values
        const distinctionsInput = document.createElement('input');
        distinctionsInput.type = 'hidden';
        distinctionsInput.name = 'distinctions';
        distinctionsInput.value = distinctions;
        document.getElementById('olevelSection').appendChild(distinctionsInput);

        const creditsInput = document.createElement('input');
        creditsInput.type = 'hidden';
        creditsInput.name = 'credits';
        creditsInput.value = credits;
        document.getElementById('olevelSection').appendChild(creditsInput);

        const passesInput = document.createElement('input');
        passesInput.type = 'hidden';
        passesInput.name = 'passes';
        passesInput.value = passes;
        document.getElementById('olevelSection').appendChild(passesInput);

        const failuresInput = document.createElement('input');
        failuresInput.type = 'hidden';
        failuresInput.name = 'failures';
        failuresInput.value = failures;
        document.getElementById('olevelSection').appendChild(failuresInput);

        // Submit the form
        document.getElementById('olevelSection').submit();
    });

    // Reset dropdown to default option
    function resetDropdown(dropdown) {
        dropdown.selectedIndex = 0; // Reset selection to the first option
    }

    function addValuesToTable() {
        var subject = $('#subject').val();
        var grade = $('#grade').val();

        if (subject !== '' && grade !== '') {
            var newRow = $('<tr>');
            newRow.append($('<td>').text(subject));
            newRow.append($('<td>').text(grade));

            $('#valuesTable tbody').append(newRow);

            // Reset dropdowns after adding values to the table
            resetDropdown(document.getElementById('subject'));
            resetDropdown(document.getElementById('grade'));
        } else {
            alert('Please select both subject and grade.');
        }
    }

    $('#addSubject').on('click', function() {
        addValuesToTable();
    });
    // Initial saveResults button state
    $('#saveResults').prop('disabled', true);
});
