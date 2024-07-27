
document.getElementById('saveResults').addEventListener('click', function () {
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
    document.getElementById('subject').addEventListener('change', function() {
        // Reset to the default option if any option is selected
        if (this.value !== '') {
            this.value = ''; // Reset the value to empty
            this.selectedIndex = 0; // Reset selection to the first option
        }
    });
    document.getElementById('subject').addEventListener('change', function() {
    resetDropdown(this);
});

// Add event listener to the grade dropdown
document.getElementById('grade').addEventListener('change', function() {
    resetDropdown(this);
});

// Function to reset a dropdown to its default state
function resetDropdown(dropdown) {
    // Reset to the default option if any option is selected
    if (dropdown.value !== '') {
        dropdown.value = ''; // Reset the value to empty
        dropdown.selectedIndex = 0; // Reset selection to the first option
    }
}

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
