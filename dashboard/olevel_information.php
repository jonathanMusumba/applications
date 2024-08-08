<div class="tab-pane fade" id="o-level">
<div id=" <div id="o-level" class="mt-4">
        <form id="oLevelForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oLevelSchool" class="required">O Level School</label>
                        <input type="text" class="form-control form-control-sm" id="oLevelSchool" required>
                        <input type="hidden" id="oLevelCenterNo" name="oLevelCenterNo">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oLevelIndexNumber" class="required">O Level Index Number</label>
                        <input type="text" class="form-control form-control-sm" id="oLevelCenterNumber" placeholder="Center Number" required pattern="[0-9]+" title="Numbers only">
                        <input type="text" class="form-control form-control-sm" id="oLevelCandidateNumber" placeholder="Candidate Number" required pattern="[0-9]+" title="Numbers only">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oLevelYear" class="required">O Level Year</label>
                        <input type="number" class="form-control form-control-sm" id="oLevelYear" required min="1900" max="2099">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="oLevelSubjects" class="required">O Level Subjects</label>
                <div id="oLevelSubjects">
                    <div class="form-row">
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" id="subject" required>
                                <option value="">Select Subject</option>
                                <option value="Math">Math</option>
                                <option value="English">English</option>
                                <option value="Science">Science</option>
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
                    <table class="table table-bordered mt-2" id="oLevelSubjectsTable">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oLevelAggregates">Aggregates</label>
                        <input type="number" class="form-control form-control-sm" id="oLevelAggregates" min="8" max="64" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oLevelDivision">Division</label>
                        <input type="number" class="form-control form-control-sm" id="oLevelDivision" min="1" max="4" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="saveOLevel">Save O Level Information</button>
        </form>
    </div>