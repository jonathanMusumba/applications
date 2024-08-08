
        $(document).ready(function() {
            let currentSectionIndex = 0;
            const sections = [
                '#personal-info-section',
                '#permanent-address-section',
                '#next-of-kin-section',
                '#course-of-study-section',
                '#academic-background-section',
                '#declaration-section'
            ];

            function showSection(index) {
                sections.forEach((selector, i) => {
                    $(selector).toggle(i === index);
                });
                localStorage.setItem('currentSectionIndex', index);
            }

            function validateSection(index) {
                let valid = true;
                const section = sections[index];
                $(section).find('input, select, textarea').each(function() {
                    if ($(this).prop('required') && !$(this).val()) {
                        $(this).addClass('is-invalid');
                        valid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                return valid;
            }
            $('#addOLevelSubject').click(function() {
                var newOLevelEntry = `
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <select class="form-control form-control-sm" name="oLevelSubject[]" required>
                                <option value="" disabled selected>Select Subject</option>
                                <option value="ENG">ENGLISH LANGUAGE</option>
                                <option value="CRE">CRE: CHRISTIAN LIVING TODAY</option>
                                <option value="HIS">HISTORY</option>
                                <option value="GEO">GEOGRAPHY</option>
                                <option value="MTC">MATHEMATICS</option>
                                <option value="AGR">AGRIC PRINCIPLES AND PRACTICES</option>
                                <option value="PHY">PHYSICS</option>
                                <option value="CHE">CHEMISTRY</option>
                                <option value="BIO">BIOLOGY</option>
                                <option value="COM">COMMERCE</option>
                                <option value="LUS">LUSOGA</option>
                                <option value="IPS">IPS (ART)</option>
                                <option value="KIS">KISWAHILI</option>
                                <option value="LUG">LUGANDA</option>
                                <option value="ICT">ICT</option>
                                <option value="ENT">ENTREPRENEURSHIP</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control form-control-sm" name="oLevelGrade[]" required>
                                <option value="" disabled selected>Select Grade</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="C3">C3</option>
                                <option value="C4">C4</option>
                                <option value="C5">C5</option>
                                <option value="C6">C6</option>
                                <option value="P7">P7</option>
                                <option value="P8">P8</option>
                                <option value="F9">F9</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-danger remove-btn">Remove</button>
                        </div>
                    </div>
                `;
                $('#oLevelSubjects').append(newOLevelEntry);
            });

            // Function to add a new Principal subject entry
            $('#addPrincipalSubject').click(function() {
                var newPrincipalEntry = `
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <select class="form-control form-control-sm" name="aLevelPrincipalSubject[]" required>
                                <option value="" disabled selected>Select Principal Subject</option>
                                <option value="MATHEMATICS">MATHEMATICS</option>
                                <option value="BIOLOGY">BIOLOGY</option>
                                <option value="CHEMISTRY">CHEMISTRY</option>
                                <option value="PHYSICS">PHYSICS</option>
                                <option value="AGRICULTURE">AGRICULTURE</option>
                                <option value="GEOGRAPHY">GEOGRAPHY</option>
                                <option value="LUSOGA">LUSOGA</option>
                                <option value="DIVINITY">DIVINITY</option>
                                <option value="LITERATURE">LITERATURE</option>
                                <option value="ECONOMICS">ECONOMICS</option>
                                <option value="ENTREPRENUERSHIP">ENTREPRENEURSHIP</option>
                                <option value="LUGANDA">LUGANDA</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control form-control-sm" name="aLevelPrincipalGrade[]" required>
                                <option value="" disabled selected>Select Grade</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="O">O</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-danger remove-btn">Remove</button>
                        </div>
                    </div>
                `;
                $('#aLevelPrincipalSubjects').append(newPrincipalEntry);
            });

            // Function to add a new Subsidiary subject entry
            $('#addSubsidiarySubject').click(function() {
                var newSubsidiaryEntry = `
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <select class="form-control form-control-sm" name="aLevelSubsidiarySubject[]">
                                <option value="" disabled selected>Select Subsidiary Subject</option>
                                <option value="GP">GENERAL PAPER (GP)</option>
                                <option value="ICT">SUB ICT (ICT)</option>
                                <option value="SUB_MTC">SUB MATH (SUB MTC)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control form-control-sm" name="aLevelSubsidiaryGrade[]">
                                <option value="" disabled selected>Select Grade</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="C3">C3</option>
                                <option value="C4">C4</option>
                                <option value="C5">C5</option>
                                <option value="C6">C6</option>
                                <option value="P7">P7</option>
                                <option value="P8">P8</option>
                                <option value="F9">F9</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-danger remove-btn">Remove</button>
                        </div>
                    </div>
                `;
                $('#aLevelSubsidiarySubjects').append(newSubsidiaryEntry);
            });

            // Remove subject entry
            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.form-row').remove();
            });

            function saveFormData() {
                if (validateSection(currentSectionIndex)) {
                    localStorage.setItem('formData', JSON.stringify($('#admission-form').serializeArray()));
                    $('#toast').toast('show');
                } else {
                    alert('Please fill out all required fields.');
                }
            }

            function updateOptionalSections() {
                const scheme = $('#scheme').val();
                const entryLevel = $('#entryLevel').val();

                if (scheme === 'Direct Entry' && entryLevel === 'Diploma') {
                    $('#aLevelSection').show();
                    $('#otherQualificationsSection').hide();
                } else if (scheme === 'Indirect Entry') {
                    $('#aLevelSection').hide();
                    $('#otherQualificationsSection').show();
                } else {
                    $('#aLevelSection').hide();
                    $('#otherQualificationsSection').hide();
                }
            }

            // Show the current section based on localStorage
            const savedIndex = localStorage.getItem('currentSectionIndex');
            if (savedIndex !== null) {
                currentSectionIndex = parseInt(savedIndex, 10);
            }
            showSection(currentSectionIndex);

            // Navigation buttons
            $('#next-section').on('click', function() {
                if (validateSection(currentSectionIndex)) {
                    saveFormData();
                    if (currentSectionIndex < sections.length - 1) {
                        currentSectionIndex++;
                        showSection(currentSectionIndex);
                    }
                }
            });

            $('#prev-section').on('click', function() {
                saveFormData();
                if (currentSectionIndex > 0) {
                    currentSectionIndex--;
                    showSection(currentSectionIndex);
                }
            });
            
            // Conditional section visibility
            $('#course, #scheme, #entryLevel').on('input change', updateOptionalSections);
            $('#aLevelSchool, #aLevelIndex, #aLevelYear, #aLevelSubjects').on('input', function() {
                $('#aLevelSection').toggle(!!$(this).val());
            });

            $('#institutionName, #courseOfStudy, #qualificationGrade').on('input', function() {
                $('#otherQualificationsSection').toggle(!!$(this).val());
            });

            // Auto-save when navigating
            $('#admission-form').on('change input', saveFormData);

            // Restore form data from localStorage
            const savedData = JSON.parse(localStorage.getItem('formData'));
            if (savedData) {
                savedData.forEach(field => {
                    $('#' + field.name).val(field.value);
                });
            }

            // Initialize Toast
            $('#toast').toast({ delay: 2000 });
        });
