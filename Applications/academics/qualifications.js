$(document).ready(function() {
    $('#saveQualifications').click(function() {
        $('#otherQualificationsForm').submit();
    });

    $('#registrationStatus').change(function() {
        toggleRegistrationFields();
    });

    $('#addQualification').click(function() {
        addQualification();
    });
});

function toggleRegistrationFields() {
    if ($('#registrationStatus').val() === 'Yes') {
        $('#registrationDetails').show();
    } else {
        $('#registrationDetails').hide();
    }
}

function addQualification() {
    const instituteName = $('#instituteName').val();
    const awardObtained = $('#awardObtained').val();
    const startYear = $('#startYear').val();
    const endYear = $('#endYear').val();
    const placeOfWork = $('#placeOfWork').val();
    const designation = $('#designation').val();

    const row = `<tr>
                    <td>${instituteName}</td>
                    <td>${awardObtained}</td>
                    <td>${startYear}</td>
                    <td>${endYear}</td>
                    <td>${placeOfWork}</td>
                    <td>${designation}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeQualification(this)">Remove</button></td>
                </tr>`;

    $('#qualificationsTable tbody').append(row);
    clearQualificationFields();
}

function clearQualificationFields() {
    $('#instituteName').val('');
    $('#awardObtained').val('');
    $('#startYear').val('');
    $('#endYear').val('');
    $('#placeOfWork').val('');
    $('#designation').val('');
}

function removeQualification(button) {
    $(button).closest('tr').remove();
}

function saveQualifications() {
    const qualifications = [];
    $('#qualificationsTable tbody tr').each(function() {
        const instituteName = $(this).find('td').eq(0).text();
        const awardObtained = $(this).find('td').eq(1).text();
        const startYear = $(this).find('td').eq(2).text();
        const endYear = $(this).find('td').eq(3).text();
        const placeOfWork = $(this).find('td').eq(4).text();
        const designation = $(this).find('td').eq(5).text();

        qualifications.push({
            instituteName: instituteName,
            awardObtained: awardObtained,
            startYear: startYear,
            endYear: endYear,
            placeOfWork: placeOfWork,
            designation: designation
        });
    });

    const registrationStatus = $('#registrationStatus').val();
    const registrationNumber = $('#registrationNumber').val();
    const yearOfRegistration = $('#yearOfRegistration').val();
    const yearsWorked = $('#yearsWorked').val();

    const formData = {
        registrationStatus: registrationStatus,
        registrationNumber: registrationNumber,
        yearOfRegistration: yearOfRegistration,
        yearsWorked: yearsWorked,
        qualifications: qualifications
    };

    $.ajax({
        type: 'POST',
        url: 'submit_other_qualifications.php',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: function(response) {
            $('#qualificationsValidationMessage').html('<div class="alert alert-success">Qualifications saved successfully!</div>');
        },
        error: function() {
            $('#qualificationsValidationMessage').html('<div class="alert alert-danger">Error saving qualifications. Please try again.</div>');
        }
    });
}


function updateCompletionStatus() {
    var completionStatusField = document.getElementById('completionStatus');
    var isFormComplete = true;

    // Add validation logic to check if the form is complete
    var fieldsToCheck = [
        'registrationStatus',
        'instituteName',
        'awardObtained',
        'startYear',
        'endYear',
        'placeOfWork',
        'designation'
    ];

    fieldsToCheck.forEach(function(id) {
        var field = document.getElementById(id);
        if (field && !field.value) {
            isFormComplete = false;
        }
    });

    // Additional checks for the registration details section if it's visible
    var registrationStatus = document.getElementById('registrationStatus');
    if (registrationStatus && registrationStatus.value === 'Yes') {
        var registrationNumber = document.getElementById('registrationNumber');
        var yearOfRegistration = document.getElementById('yearOfRegistration');
        var yearsWorked = document.getElementById('yearsWorked');
        
        if (!registrationNumber.value || !yearOfRegistration.value || !yearsWorked.value) {
            isFormComplete = false;
        }
    }

    // Set completion status
    completionStatusField.value = isFormComplete ? 'complete' : 'incomplete';
}

// Attach event listeners to relevant fields
document.querySelectorAll('input, select').forEach(function(element) {
    element.addEventListener('change', updateCompletionStatus);
});

// Call the function initially to set the right status on page load
updateCompletionStatus();
