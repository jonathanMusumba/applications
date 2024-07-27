<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Qualifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-section {
            margin-top: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            display: none;
        }
        .warning-message {
            margin-top: 10px;
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            border: 1px solid #ffeeba;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header section-header">
            <span><i class="fas fa-id-badge"></i> OTHER QUALIFICATIONS</span>
            <div class="status" id="qualificationsStatus">
                <i class="fas fa-circle-stop"></i>
                <span class="badge badge-danger">NOT FILLED</span>
                <i class="fas fa-chevron-right ml-2"></i>
            </div>
        </div>

        <div class="card-body">
            <form id="qualificationsForm" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="checkbox" id="noQualification" name="noQualification" onchange="toggleFields()">
                    <label for="noQualification">I DON'T HAVE OTHER QUALIFICATION</label>
                </div>

                <div id="warningMessage" class="warning-message" style="display: none;">
                    <p>Note: Applications without supporting documents shall not be considered.</p>
                    <button type="button" id="confirmNoQualification" class="btn btn-danger">Confirm</button>
                </div>

                <div id="otherQualificationsSection">
                    <div class="form-group row mb-3">
                        <label for="registrationStatus" class="col-sm-3 col-form-label text-sm-end">Registration Status:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="registrationStatus" name="registrationStatus" onchange="toggleRegistrationFields()">
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div id="registrationDetails" style="display: none;">
                        <div class="form-group row mb-3">
                            <label for="registrationNumber" class="col-sm-3 col-form-label text-sm-end">Registration Number:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" placeholder="Enter registration number">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="yearOfRegistration" class="col-sm-3 col-form-label text-sm-end">Year of Registration:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="yearOfRegistration" name="yearOfRegistration" placeholder="Enter year of registration" min="1900" max="2024">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="yearsWorked" class="col-sm-3 col-form-label text-sm-end">Number of Years Worked:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="yearsWorked" name="yearsWorked" placeholder="Enter number of years worked" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="instituteName" class="col-sm-3 col-form-label text-sm-end">Institution Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="instituteName" name="instituteName" placeholder="Enter name of institute">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="awardObtained" class="col-sm-3 col-form-label text-sm-end">Award Obtained:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="awardObtained" name="awardObtained" placeholder="Enter award obtained">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="startYear" class="col-sm-3 col-form-label text-sm-end">Start Year:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="startYear" name="startYear" placeholder="Enter start year" min="1900" max="2024">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="endYear" class="col-sm-3 col-form-label text-sm-end">End Year:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="endYear" name="endYear" placeholder="Enter end year" min="1900" max="2024">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="placeOfWork" class="col-sm-3 col-form-label text-sm-end">Place of Work:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="placeOfWork" name="placeOfWork" placeholder="Enter place of work">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="designation" class="col-sm-3 col-form-label text-sm-end">Designation:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="supportDocuments" class="col-sm-3 col-form-label text-sm-end">Support Documents:</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file" id="supportDocuments" name="supportDocuments[]" multiple>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="button" id="addQualification" class="btn btn-primary">Add Qualification</button>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <table id="qualificationsTable" class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Name of Institute</th>
                                <th>Award Obtained</th>
                                <th>Start Year</th>
                                <th>End Year</th>
                                <th>Place of Work</th>
                                <th>Designation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Qualifications will be added here dynamically -->
                        </tbody>
                    </table>
                </div>
                <button type="button" onclick="saveQualifications()" id="saveQualifications" class="btn btn-success">Save</button>
            </form>
            <div id="qualificationsValidationMessage" class="mt-3"></div>
        </div>
    </div>
</div>

<script>
    function toggleFields() {
        const noQualification = document.getElementById('noQualification').checked;
        const warningMessage = document.getElementById('warningMessage');
        const otherQualificationsSection = document.getElementById('otherQualificationsSection');
        const registrationDetails = document.getElementById('registrationDetails');
        const saveQualifications = document.getElementById('saveQualifications');

        if (noQualification) {
            warningMessage.style.display = 'block';
            otherQualificationsSection.style.display = 'none';
            registrationDetails.style.display = 'none';
            saveQualifications.disabled = true;
        } else {
            warningMessage.style.display = 'none';
            otherQualificationsSection.style.display = 'block';
            saveQualifications.disabled = false;
        }
    }

    document.getElementById('confirmNoQualification').addEventListener('click', function () {
        saveQualifications(true);
    });

    document.getElementById('registrationStatus').addEventListener('change', function () {
        const registrationDetails = document.getElementById('registrationDetails');
        if (this.value === 'Yes') {
            registrationDetails.style.display = 'block';
        } else {
            registrationDetails.style.display = 'none';
        }
    });

    document.getElementById('addQualification').addEventListener('click', function () {
        const instituteName = document.getElementById('instituteName').value;
        const awardObtained = document.getElementById('awardObtained').value;
        const startYear = document.getElementById('startYear').value;
        const endYear = document.getElementById('endYear').value;
        const placeOfWork = document.getElementById('placeOfWork').value;
        const designation = document.getElementById('designation').value;
        const registrationStatus = document.getElementById('registrationStatus').value;
        const registrationNumber = document.getElementById('registrationNumber').value;
        const yearOfRegistration = document.getElementById('yearOfRegistration').value;
        const yearsWorked = document.getElementById('yearsWorked').value;

        if (instituteName && awardObtained && startYear && endYear && placeOfWork && designation) {
            const table = document.getElementById('qualificationsTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.insertCell(0).innerText = instituteName;
            newRow.insertCell(1).innerText = awardObtained;
            newRow.insertCell(2).innerText = startYear;
            newRow.insertCell(3).innerText = endYear;
            newRow.insertCell(4).innerText = placeOfWork;
            newRow.insertCell(5).innerText = designation;
            newRow.insertCell(6).innerText = registrationNumber;
            newRow.insertCell(7).innerText = yearOfRegistration;
            newRow.insertCell(8).innerText = yearsWorked;
            newRow.insertCell(9).innerHTML = '<button class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>';
        } else {
            alert('Please fill out all required fields.');
        }
    });

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    function saveQualifications(isConfirmed = false) {
        const noQualification = document.getElementById('noQualification').checked;
        const registrationStatus = document.getElementById('registrationStatus').value;
        const registrationNumber = document.getElementById('registrationNumber').value;
        const yearOfRegistration = document.getElementById('yearOfRegistration').value;
        const yearsWorked = document.getElementById('yearsWorked').value;
        const tbody = document.querySelector('#qualificationsTable tbody');
        const qualifications = [];

        if (noQualification) {
            qualifications.push({ status: 'N/A' });
        } else {
            Array.from(tbody.rows).forEach(row => {
                const instituteName = row.cells[0].innerText;
                const awardObtained = row.cells[1].innerText;
                const startYear = row.cells[2].innerText;
                const endYear = row.cells[3].innerText;
                const placeOfWork = row.cells[4].innerText;
                const designation = row.cells[5].innerText;
                const registrationStatus = row.cells[6].innerText;
                const registrationNumber = row.cells[7].innerText;
                const yearOfRegistration = row.cells[8].innerText;
                const yearsWorked = row.cells[9].innerText;

                qualifications.push({
                    instituteName,
                    awardObtained,
                    startYear,
                    endYear,
                    placeOfWork,
                    designation,
                    registrationStatus,
                    registrationNumber,
                    yearOfRegistration,
                    yearsWorked
                });
            });
        }

        const formData = new FormData();
        formData.append('qualifications', JSON.stringify({
            noQualification,
            registrationStatus,
            registrationNumber,
            yearOfRegistration,
            yearsWorked,
            qualifications
        }));
        formData.append('isConfirmed', isConfirmed);

        const files = document.getElementById('supportDocuments').files;
        for (let i = 0; i < files.length; i++) {
            formData.append('supportDocuments[]', files[i]);
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_qualifications.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                document.getElementById('qualificationsValidationMessage').innerText = response.message;
                if (response.success) {
                    document.getElementById('qualificationsValidationMessage').classList.add('alert', 'alert-success');
                } else {
                    document.getElementById('qualificationsValidationMessage').classList.add('alert', 'alert-danger');
                }
            }
        };
        xhr.send(formData);
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
