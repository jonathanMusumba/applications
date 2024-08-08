document.addEventListener('DOMContentLoaded', () => {
    loadOverviewData();
    loadRecentActivities();

    const patientDataForm = document.getElementById('patientDataForm');
    patientDataForm.addEventListener('submit', (e) => {
        e.preventDefault();
        submitPatientData(new FormData(patientDataForm));
    });

    const facilityDataForm = document.getElementById('facilityDataForm');
    facilityDataForm.addEventListener('submit', (e) => {
        e.preventDefault();
        submitFacilityData(new FormData(facilityDataForm));
    });
});

function openPatientForm() {
    document.getElementById('patient-form').style.display = 'block';
}

function closePatientForm() {
    document.getElementById('patient-form').style.display = 'none';
}

function openFacilityForm() {
    document.getElementById('facility-form').style.display = 'block';
}

function closeFacilityForm() {
    document.getElementById('facility-form').style.display = 'none';
}

function loadOverviewData() {
    // Fetch and display the overview data (use AJAX to call backend PHP script)
    fetch('fetchOverviewData.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-entries').textContent = data.totalEntries;
            document.getElementById('facilities-covered').textContent = data.facilitiesCovered;
            document.getElementById('patients-handled').textContent = data.patientsHandled;
        });
}

function loadRecentActivities() {
    // Fetch and display recent activities (use AJAX to call backend PHP script)
    fetch('fetchRecentActivities.php')
        .then(response => response.json())
        .then(entries => {
            const tbody = document.querySelector('#recent-entries tbody');
            entries.forEach(entry => {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td>${entry.id}</td><td>${entry.type}</td><td>${entry.date}</td>`;
                tbody.appendChild(tr);
            });
        });
}

function submitPatientData(formData) {
    // Submit patient data to backend PHP script
    fetch('submitPatientData.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            closePatientForm();
            loadRecentActivities();
            alert('Patient data submitted successfully!');
        }
    });
}

function submitFacilityData(formData) {
    // Submit facility data to backend PHP script
    fetch('submitFacilityData.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            closeFacilityForm();
            loadRecentActivities();
            alert('Facility data submitted successfully!');
        }
    });
}
