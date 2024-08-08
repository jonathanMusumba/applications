<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-container {
            margin-top: 20px;
        }
        .subjects-table {
            margin-top: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
 <!-- Academic Background Section -->
<div class="form-section" id="academic-background-section">
    <h4>Academic Background</h4>

    <!-- O Level Information -->
    <div class="form-group row">
        <label for="oLevelSchool" class="col-sm-2 col-form-label">O Level - School Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="oLevelSchool" required>
            <div class="invalid-feedback">School Name is required.</div>
        </div>
    </div>
    <div class="form-group row">
        <label for="oLevelIndex" class="col-sm-2 col-form-label">O Level - Index Number</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" id="oLevelIndex" required>
            <div class="invalid-feedback">Index Number is required.</div>
        </div>
    </div>
    <div class="form-group row">
        <label for="oLevelYear" class="col-sm-2 col-form-label">O Level - Year</label>
        <div class="col-sm-10">
            <input type="number" class="form-control form-control-sm" id="oLevelYear" required>
            <div class="invalid-feedback">Year is required.</div>
        </div>
    </div>

    <!-- O Level Subjects -->
    <div class="form-section" id="o-level-subjects-section">
        <h4>O Level - Subjects and Grades</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="oLevelSubjects">
                <!-- Subjects will be added here dynamically -->
            </tbody>
        </table>
        <div class="form-group row">
            <label for="oSubjectName" class="col-sm-2 col-form-label">Subject</label>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="oSubjectName">
            </div>
            <label for="oGrade" class="col-sm-2 col-form-label">Grade</label>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="oGrade">
            </div>
        </div>
        <button type="button" id="addOLevelSubject" class="btn btn-primary">Add Subject</button>
        <div class="invalid-feedback">At least 8 subjects including essential subjects are required.</div>
    </div>

    <!-- Optional A Level Information -->
    <div class="optional-section" id="aLevelSection">
        <h5>A Level (Optional)</h5>
        <div class="form-group row">
            <label for="aLevelSchool" class="col-sm-2 col-form-label">A Level - School Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="aLevelSchool">
            </div>
        </div>
        <div class="form-group row">
            <label for="aLevelIndex" class="col-sm-2 col-form-label">A Level - Index Number</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="aLevelIndex">
            </div>
        </div>
        <div class="form-group row">
            <label for="aLevelYear" class="col-sm-2 col-form-label">A Level - Year</label>
            <div class="col-sm-10">
                <input type="number" class="form-control form-control-sm" id="aLevelYear">
            </div>
        </div>

        <!-- A Level Principal Subjects -->
        <div class="form-section" id="a-level-principal-subjects-section">
            <h5>A Level - Principal Subjects</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="aLevelPrincipalSubjects">
                    <!-- Principal subjects will be added here dynamically -->
                </tbody>
            </table>
            <div class="form-group row">
                <label for="aPrincipalSubjectName" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="aPrincipalSubjectName">
                </div>
                <label for="aPrincipalGrade" class="col-sm-2 col-form-label">Grade</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="aPrincipalGrade">
                </div>
            </div>
            <button type="button" id="addPrincipalSubject" class="btn btn-primary">Add Principal Subject</button>
        </div>

        <!-- A Level Subsidiary Subjects -->
        <div class="form-section" id="a-level-subsidiary-subjects-section">
            <h5>A Level - Subsidiary Subjects</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="aLevelSubsidiarySubjects">
                    <!-- Subsidiary subjects will be added here dynamically -->
                </tbody>
            </table>
            <div class="form-group row">
                <label for="aSubsidiarySubjectName" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="aSubsidiarySubjectName">
                </div>
                <label for="aSubsidiaryGrade" class="col-sm-2 col-form-label">Grade</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="aSubsidiaryGrade">
                </div>
            </div>
            <button type="button" id="addSubsidiarySubject" class="btn btn-primary">Add Subsidiary Subject</button>
        </div>
    </div>

    <button type="button" id="saveOlevel" class="btn btn-success">Save O Level Information</button>
    <button type="button" id="saveAlevel" class="btn btn-success">Save A Level Information</button>
</div>

</body>
</html>
