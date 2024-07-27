<!-- Other Qualifications Form -->
<form id="otherQualificationsForm" method="POST" action="submit_other_qualifications.php"class="border p-4 rounded shadow-sm">

    <!-- Other qualifications fields -->
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
                        <label for="registrationStatus" class="col-sm-3 col-form-label text-sm-end">Registration Status(For Diploma Nursing,Midwifery-extension)</label>
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
</form>
