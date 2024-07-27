document.addEventListener('DOMContentLoaded', () => {
    const skipButton = document.getElementById('skipSection');
    const subjectSelectionSection = document.getElementById('subjectSelectionSection');
    const schoolInput = document.getElementById('schoolUACE');
    const candidateNumberSelect = document.getElementById('candidateNumber');
    const yearSelect = document.getElementById('yearUACE');
    const saveButton = document.getElementById('saveResults');
    const subjectsTable = document.getElementById('subjectsTable');
    let subjects = [];

    // Skip Section Button Handler
    skipButton.addEventListener('click', () => {
        document.getElementById('validationMessage').innerHTML = "Section Skipped.";
        subjectSelectionSection.style.display = 'block';
        // Optionally, you can add a logic to mark this section as complete
    });

    // Add Subject Button Handler
    document.getElementById('addSubject').addEventListener('click', () => {
        const subject = document.getElementById('subject').value;
        const grade = document.getElementById('grade').value;

        if (!subject || !grade) {
            alert('Please select both subject and grade.');
            return;
        }

        // Check if required fields are filled
        if (!schoolInput.value || !candidateNumberSelect.value || !yearSelect.value) {
            alert('Please fill in all required fields before adding subjects.');
            return;
        }

        if (subjects.length >= 4) {
            alert('You can only add up to 4 subjects.');
            return;
        }

        subjects.push({ subject, grade });
        updateSubjectsTable();
    });

    function updateSubjectsTable() {
        subjectsTable.innerHTML = '';
        subjects.forEach((subj, index) => {
            subjectsTable.innerHTML += `
                <tr>
                    <td>${subj.subject}</td>
                    <td>${getSubjectName(subj.subject)}</td>
                    <td>${subj.grade}</td>
                    <td><button type="button" onclick="removeSubject(${index})" class="btn btn-danger btn-sm">Remove</button></td>
                </tr>
            `;
        });

        // Enable Save Results button if all required fields are filled and subjects are added
        const areFieldsFilled = schoolInput.value && candidateNumberSelect.value && yearSelect.value;
        saveButton.disabled = !areFieldsFilled || subjects.length === 0;
    }

    window.removeSubject = function(index) {
        subjects.splice(index, 1);
        updateSubjectsTable();
    };

    function getSubjectName(code) {
        // You can map the subject code to a subject name
        const subjectMap = {
            'P530': 'Biology',
            'P525': 'Chemistry',
            'P425': 'Mathematics',
            'P515': 'Agriculture',
            'P250': 'Geography',
            'P510': 'Physics',
            'S101': 'General Paper',
            'S850/S475': 'SUBSIDIARY ICT',
            'S475': 'SUBSIDIARY MATH'
        };
        return subjectMap[code] || 'Unknown Subject';
    }

    // Handle changes in the input fields
    [schoolInput, candidateNumberSelect, yearSelect].forEach(el => {
        el.addEventListener('change', updateSubjectsTable);
    });

    // Validate form before submission
    document.getElementById('alevelForm').addEventListener('submit', (event) => {
        if (subjects.length === 0 && !document.getElementById('skipSection').clicked) {
            event.preventDefault();
            alert('Please add at least one subject or skip this section.');
        }
    });
});