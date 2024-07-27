$(document).ready(function() {
    document.addEventListener('DOMContentLoaded', function () {
        // UCE Form JavaScript
        const uceSaveResultsButton = document.getElementById('saveResultsUCE');
        const uceSubjectsTable = document.getElementById('subjectsTableUCE');
        const uceSubjectSelect = document.getElementById('subjectUCE');
        const uceGradeSelect = document.getElementById('gradeUCE');
        const uceSchoolInput = document.getElementById('schoolUCE');
        const uceCandidateNumberSelect = document.getElementById('candidateNumberUCE');
    
        function validateUCEForm() {
            const schoolName = uceSchoolInput.value.trim();
            const candidateNumber = uceCandidateNumberSelect.value;
            const subjectsCount = uceSubjectsTable.querySelectorAll('tr').length;
    
            uceSaveResultsButton.disabled = !(schoolName && candidateNumber && subjectsCount > 0 && subjectsCount <= 6);
        }
    
        document.getElementById('addSubjectUCE').addEventListener('click', function () {
            const subjectCode = uceSubjectSelect.value;
            const subjectText = uceSubjectSelect.options[uceSubjectSelect.selectedIndex].text;
            const grade = uceGradeSelect.value;
    
            if (subjectCode && grade) {
                const row = uceSubjectsTable.insertRow();
                row.innerHTML = `<td>${subjectCode}</td><td>${subjectText}</td><td>${grade}</td><td><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">Remove</button></td>`;
                
                validateUCEForm();
            }
        });
    
        // UACE Form JavaScript
        const skipSectionButton = document.getElementById('skipSection');
        const saveResultsButton = document.getElementById('saveResults');
        const subjectSelectionSection = document.getElementById('subjectSelectionSection');
        const addSubjectButton = document.getElementById('addSubjectUACE');
        const subjectsTable = document.getElementById('subjectsTable');
        const schoolInput = document.getElementById('schoolUACE');
        const candidateNumberSelect = document.getElementById('candidateNumber');
    
        function validateUACEForm() {
            const schoolName = schoolInput.value.trim();
            const candidateNumber = candidateNumberSelect.value;
            const subjectsCount = subjectsTable.querySelectorAll('tr').length;
    
            saveResultsButton.disabled = !(
                schoolName && candidateNumber && subjectsCount > 0 && subjectsCount <= 4
            );
        }
    
        skipSectionButton.addEventListener('click', function () {
            document.getElementById('skipSectionStatus').value = 'true';
            subjectSelectionSection.style.display = 'none';
            validateUACEForm();
        });
    
        addSubjectButton.addEventListener('click', function () {
            const subjectSelect = document.getElementById('subject');
            const gradeSelect = document.getElementById('grade');
            const subjectCode = subjectSelect.value;
            const subjectText = subjectSelect.options[subjectSelect.selectedIndex].text;
            const grade = gradeSelect.value;
    
            if (subjectCode && grade) {
                const row = subjectsTable.insertRow();
                row.innerHTML = `<td>${subjectCode}</td><td>${subjectText}</td><td>${grade}</td><td><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">Remove</button></td>`;
                
                validateUACEForm();
            }
        });
    
        // Initial validation for both forms
        validateUCEForm();
        validateUACEForm();
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
});
