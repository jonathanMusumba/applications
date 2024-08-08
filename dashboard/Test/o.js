$(document).ready(function() {
    let oSubjects = [];
    let aSubjects = [];

    function renderSubjectsTable(level) {
        let subjectsTableBody;
        if (level === 'O') {
            subjectsTableBody = $('#oSubjectsTableBody');
        } else {
            subjectsTableBody = $('#aSubjectsTableBody');
        }

        subjectsTableBody.empty();

        const subjects = level === 'O' ? oSubjects : aSubjects;
        subjects.forEach((subject, index) => {
            subjectsTableBody.append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${subject.name}</td>
                    <td>${subject.grade}</td>
                    <td><button class="btn btn-danger" onclick="removeSubject('${level}', ${index})">Remove</button></td>
                </tr>
            `);
        });
    }

    $('#addOSubjectBtn').on('click', function() {
        const subjectName = $('#oSubjectName').val();
        const grade = $('#oGrade').val();

        if (!subjectName || !grade) {
            alert('Please fill out both the subject and grade fields.');
            return;
        }

        if (oSubjects.length >= 10) {
            alert('O level subjects should not exceed 10.');
            return;
        }

        const newSubject = {
            name: subjectName,
            grade: grade
        };

        if (!oSubjects.find(subject => subject.name === subjectName)) {
            oSubjects.push(newSubject);
            renderSubjectsTable('O');
        } else {
            alert('This subject is already added.');
        }
    });

    $('#addASubjectBtn').on('click', function() {
        const subjectName = $('#aSubjectName').val();
        const grade = $('#aGrade').val();

        if (!subjectName || !grade) {
            alert('Please fill out both the subject and grade fields.');
            return;
        }

        if (aSubjects.length >= 5) {
            alert('A level subjects should not exceed 5.');
            return;
        }

        const newSubject = {
            name: subjectName,
            grade: grade
        };

        if (!aSubjects.find(subject => subject.name === subjectName)) {
            aSubjects.push(newSubject);
            renderSubjectsTable('A');
        } else {
            alert('This subject is already added.');
        }
    });

    $('#saveOlevel').on('click', function() {
        if (oSubjects.length < 8 || oSubjects.length > 10) {
            alert('O level subjects should be between 8 and 10.');
            return;
        }

        const oLevelData = {
            school: $('#oSchoolName').val(),
            indexNumber: $('#oIndexNumber').val(),
            yearOfSitting: $('#oYearOfSitting').val(),
            subjects: oSubjects
        };

        const json = JSON.stringify(oLevelData);
        console.log(json);
    });

    $('#saveAlevel').on('click', function() {
        if (aSubjects.length < 3 || aSubjects.length > 5) {
            alert('A level subjects should be between 3 and 5.');
            return;
        }

        const aLevelData = {
            school: $('#aSchoolName').val(),
            indexNumber: $('#aIndexNumber').val(),
            yearOfSitting: $('#aYearOfSitting').val(),
            subjects: aSubjects
        };

        const json = JSON.stringify(aLevelData);
        console.log(json);
    });

    window.removeSubject = function(level, index) {
        if (level === 'O') {
            oSubjects.splice(index, 1);
            renderSubjectsTable('O');
        } else {
            aSubjects.splice(index, 1);
            renderSubjectsTable('A');
        }
    };
});
