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

$(document).ready(function() {
    var distinctions = 0, credits = 0, passes = 0, failures = 0;
    var requiredSubjects = ['112', '456', '545', '553', '535']; // Subject codes for English, Mathematics, Chemistry, Biology, Physics


    function areMinimumSubjectsAdded() {
        var subjectsCount = $('#subjectsTable tr').length;
        return subjectsCount >= 8;
    }

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

    $('#saveResults').prop('disabled', true);
});
