$(document).ready(function () {
    // O Level dynamic subjects
    let oLevelSubjectsCount = 0;
    $('#addOLevelSubject').click(function () {
        oLevelSubjectsCount++;
        const subjectRow = `
            <tr>
                <td>
                    <select class="form-control form-control-sm" name="oLevelSubject${oLevelSubjectsCount}" required>
                        <option value="">Select Subject</option>
                        <option value="Math">Math</option>
                        <option value="English">English</option>
                        <option value="Science">Science</option>
                        <!-- Add more subjects as needed -->
                    </select>
                </td>
                <td>
                    <select class="form-control form-control-sm" name="oLevelGrade${oLevelSubjectsCount}" required>
                        <option value="">Select Grade</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <!-- Add more grades as needed -->
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger removeOLevelSubject">Remove</button></td>
            </tr>`;
        $('#oLevelSubjectsTable tbody').append(subjectRow);
    });

    $(document).on('click', '.removeOLevelSubject', function () {
        $(this).closest('tr').remove();
    });

    $('#saveOLevel').click(function () {
        const oLevelData = $('#oLevelForm').serializeArray();
        localStorage.setItem('oLevelData', JSON.stringify(oLevelData));
        alert('O Level Information Saved!');
    });

    function loadOLevelData() {
        const savedData = JSON.parse(localStorage.getItem('oLevelData'));
        if (savedData) {
            savedData.forEach(field => {
                $(`[name="${field.name}"]`).val(field.value);
            });
        }
    }

    loadOLevelData();

    // A Level dynamic subjects
    let aLevelSubjectsCount = 0;

    $('#addSubject').click(function () {
        const subject = $('#subjectSelect').val();
        const grade = $('#gradeSelect').val();

        if (subject && grade) {
            aLevelSubjectsCount++;
            const subjectRow = `
                <tr>
                    <td>${subject}</td>
                    <td>${grade}</td>
                    <td><button type="button" class="btn btn-danger removeSubject">Remove</button></td>
                </tr>`;
            $('#aLevelSubjectsTable tbody').append(subjectRow);

            // Clear selections after adding
            $('#subjectSelect').val('');
            $('#gradeSelect').val('');
        } else {
            alert('Please select both subject and grade.');
        }
    });

    $(document).on('click', '.removeSubject', function () {
        $(this).closest('tr').remove();
    });

    $('#saveALevel').click(function () {
        const aLevelData = $('#aLevelForm').serializeArray();
        localStorage.setItem('aLevelData', JSON.stringify(aLevelData));
        alert('A Level Information Saved!');
    });

    function loadALevelData() {
        const savedData = JSON.parse(localStorage.getItem('aLevelData'));
        if (savedData) {
            savedData.forEach(field => {
                $(`[name="${field.name}"]`).val(field.value);
            });
        }
    }

    loadALevelData();
});
$("#oLevelSchool").autocomplete({
    source: function(request, response) {
        $.ajax({
            url: "autocomplete.php",
            dataType: "json",
            data: {
                query: request.term
            },
            success: function(data) {
                response($.map(data, function(item) {
                    return {
                        label: item.Center_Name,
                        value: item.Center_Name,
                        centerNo: item.CenterNo
                    };
                }));
            }
        });
    },
    select: function(event, ui) {
        $("#oLevelCenterNo").val(ui.item.centerNo);
    }
});

// Autocomplete for A Level School
$("#aLevelSchool").autocomplete({
    source: function(request, response) {
        $.ajax({
            url: "autocomplete.php",
            dataType: "json",
            data: {
                query: request.term
            },
            success: function(data) {
                response($.map(data, function(item) {
                    return {
                        label: item.Center_Name,
                        value: item.Center_Name,
                        centerNo: item.CenterNo
                    };
                }));
            }
        });
    },
    select: function(event, ui) {
        $("#aLevelCenterNo").val(ui.item.centerNo);
    }
});

