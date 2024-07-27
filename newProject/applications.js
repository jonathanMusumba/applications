document.getElementById('sourceOfInformation').addEventListener('change', function() {
    var radioOptions = document.getElementById('radioOptions');
    radioOptions.style.display = this.value === 'Radio Station' ? 'block' : 'none';
    validateForm();
});

document.getElementById('declarationCheckbox').addEventListener('change', validateForm);

function validateForm() {
    var source = document.getElementById('sourceOfInformation').value;
    var consentButton = document.getElementById('consentButton');
    var submitButton = document.getElementById('submitApplicationButton');
    
    if (source && (source !== 'Radio Station' || document.getElementById('radioStation').value)) {
        consentButton.disabled = false;
        if (document.getElementById('declarationCheckbox').checked) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    } else {
        consentButton.disabled = true;
        submitButton.disabled = true;
    }
}