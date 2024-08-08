<div class="tab-pane fade" id="a-level">
        <form id="aLevelForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aLevelSchool" class="required">A Level School</label>
                        <input type="text" class="form-control form-control-sm" id="aLevelSchool" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aLevelIndexNumber" class="required">A Level Index Number</label>
                        <input type="text" class="form-control form-control-sm" id="aLevelCenterNumber" placeholder="Center Number" required pattern="[0-9]+" title="Numbers only">
                        <input type="text" class="form-control form-control-sm" id="aLevelCandidateNumber" placeholder="Candidate Number" required pattern="[0-9]+" title="Numbers only">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aLevelYear" class="required">A Level Year</label>
                        <input type="number" class="form-control form-control-sm" id="aLevelYear" required min="1900" max="2099">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="aLevelSubjects" class="required">A Level Subjects</label>
                <div id="aLevelSubjects">
                    <div class="form-row">
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" id="subject" required>
                                <option value="">Select Subject</option>
                                <option value="Math">Math</option>
                                <option value="English">English</option>
                                <option value="Biology">Biology</option>
                                <!-- Add more subjects as needed -->
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" id="grade" required>
                                <option value="">Select Grade</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <!-- Add more grades as needed -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-secondary" id="addSubject">Add Subject</button>
                        </div>
                    </div>
                    <table class="table table-bordered mt-2" id="aLevelSubjectsTable">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Subjects will be appended here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="saveALevel">Save A Level Information</button>
        </form>
    </div>
