 <!-- Bio Data -->
                <form id="bioDataForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salutation" class="required">Salutation</label>
                                <select class="form-control form-control-sm" id="salutation" required>
                                    <option value="">Select</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Dr">Dr</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surname" class="required">Surname</label>
                                <input type="text" class="form-control form-control-sm" id="surname" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="otherNames" class="required">Other Names</label>
                                <input type="text" class="form-control form-control-sm" id="otherNames" required pattern="[A-Za-z\s]+" title="Only alphabets are allowed">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sex" class="required">Sex</label>
                                <select class="form-control form-control-sm" id="sex" required>
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob" class="required">Date of Birth</label>
                                <input type="date" class="form-control form-control-sm" id="dob" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="maritalStatus" class="required">Marital Status</label>
                                <select class="form-control form-control-sm" id="maritalStatus" required>
                                    <option value="">Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="religion" class="required">Religion</label>
                                <select class="form-control form-control-sm" id="religion" required>
                                    <option value="">Select</option>
                                    <option value="Christianity">Christianity</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Hinduism">Hinduism</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="required">Email</label>
                                <input type="email" class="form-control form-control-sm" id="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="required">Phone</label>
                                <input type="tel" class="form-control form-control-sm" id="phone" required pattern="^\+[0-9]{1,3}-[0-9]{9,10}$" title="Phone number with country code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality" class="required">Nationality</label>
                                <input type="text" class="form-control form-control-sm" id="nationality" required pattern="[A-Za-z\s]+" title="Only valid country names">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="districtOfBirth" class="required">District of Birth</label>
                                <input type="text" class="form-control form-control-sm" id="districtOfBirth" required pattern="[A-Za-z\s]{1,30}" title="Only alphabets, max 30 characters">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ninNumber">NIN Number</label>
                                <input type="text" class="form-control form-control-sm" id="ninNumber" pattern="^[CFM]{1}[0-9A-Za-z]{13}$" title="Starts with C, F, or M, max 14 characters">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="linNumber">LIN Number</label>
                                <input type="text" class="form-control form-control-sm" id="linNumber" pattern="^[A-Za-z0-9]+$" title="No special characters">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="disability">Any Physical Disability</label>
                                <textarea class="form-control form-control-sm" id="disability" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="saveBioData">Save Bio Information</button>
                </form>
