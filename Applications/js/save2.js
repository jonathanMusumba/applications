document.getElementById('saveResults').addEventListener('click', function () {
    // Prepare subjects data
    const subjectsData = [];
    const subjectsTable = document.getElementById('subjectsTable');
    const rows = subjectsTable.rows;

    for (let i = 0; i < rows.length; i++) {
        const code = rows[i].cells[0].textContent;
        const grade = rows[i].cells[2].textContent;
        subjectsData.push({ code, grade });
    }

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
