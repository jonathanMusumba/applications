$(document).ready(function() {
    let currentSectionIndex = localStorage.getItem('currentSectionIndex') || 0;
    const sections = [
        '#personal-info-section',
        '#permanent-address-section',
        '#next-of-kin-section',
        '#course-of-study-section',
        '#academic-background-section',
        '#declaration-section'
    ];

    // Function to show the current section
    function showSection(index) {
        sections.forEach((selector, i) => $(selector).toggle(i === index));
        localStorage.setItem('currentSectionIndex', index);
        updateButtonState();
    }

    // Function to validate the current section
    function validateSection(index) {
        let valid = true;
        $(sections[index]).find('input, select, textarea').each(function() {
            const $this = $(this);
            if ($this.prop('required') && !$this.val()) {
                $this.addClass('is-invalid');
                valid = false;
            } else {
                $this.removeClass('is-invalid');
            }
        });
        return valid;
    }

    // Save form data to localStorage
    function saveFormData() {
        if (validateSection(currentSectionIndex)) {
            localStorage.setItem('formData', JSON.stringify($('#admission-form').serializeArray()));
            $('#toast').toast('show');
        } else {
            $('#error-message').text('Please fill out all required fields.').show();
        }
    }

    // Update button states based on the current section index
    function updateButtonState() {
        $('#prev-section').prop('disabled', currentSectionIndex === 0);
        $('#next-section').prop('disabled', currentSectionIndex === sections.length - 1);
    }

    // Update sections based on scheme and entry level
    function updateOptionalSections() {
        const scheme = $('#scheme').val();
        const entryLevel = $('#entryLevel').val();
        $('#aLevelSection').toggle(scheme === 'Direct Entry' && entryLevel === 'Diploma');
        $('#otherQualificationsSection').toggle(scheme === 'Indirect Entry');
    }

    // Event Handlers for navigation
    $('#next-section').click(() => {
        if (validateSection(currentSectionIndex)) {
            saveFormData();
            if (currentSectionIndex < sections.length - 1) {
                showSection(++currentSectionIndex);
            }
        }
    });

    $('#prev-section').click(() => {
        saveFormData();
        if (currentSectionIndex > 0) {
            showSection(--currentSectionIndex);
        }
    });
    $('#scheme, #entryLevel').change(updateOptionalSections);

    // Initial setup
    showSection(currentSectionIndex);
    // Fetch course data and update form fields
    function fetchCourseData(course) {
        return $.ajax({
            url: 'get_courses.php',
            method: 'GET',
            data: { course: course },
            dataType: 'json'
        }).done(function(courseData) {
            if (courseData.error) {
                $('#error-message').text(courseData.error).show();
                $('#scheme').val('');
                $('#entryLevel').val('');
            } else {
                $('#scheme').val(courseData.scheme);
                $('#entryLevel').val(courseData.entry_level);
                updateOptionalSections();
            }
        }).fail(function() {
            $('#error-message').text('Failed to fetch course data.').show();
        });
    }
    $('#course, #scheme, #entryLevel').on('input change', updateOptionalSections);
    $('#admission-form').on('change input', saveFormData);

    const savedIndex = parseInt(localStorage.getItem('currentSectionIndex'), 10);
    if (!isNaN(savedIndex)) {
        currentSectionIndex = savedIndex;
    }
    showSection(currentSectionIndex);

    const savedData = JSON.parse(localStorage.getItem('formData'));
    if (savedData) {
        savedData.forEach(field => $('#' + field.name).val(field.value));
    }

    const addedSubjects = {
        oLevel: new Set(),
        aLevelPrincipal: new Set(),
        aLevelSubsidiary: new Set()
    };

    // Check if a subject has already been added
    function isSubjectAlreadyAdded(type, value) {
        return addedSubjects[type].has(value);
    }

    // Add a subject to the set of added subjects
    function addSubjectToSet(type, value) {
        addedSubjects[type].add(value);
    }

    // Remove a subject from the set of added subjects
    function removeSubjectFromSet(type, value) {
        addedSubjects[type].delete(value);
    }

    // Generate options for subject select elements
    function getSubjectOptions(type) {
        const options = {
            oLevel: `
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
            `,
            aLevelPrincipal: `
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
                <option value="ENTREPRENEURSHIP">ENTREPRENEURSHIP</option>
                <option value="LUGANDA">LUGANDA</option>
            `,
            aLevelSubsidiary: `
                <option value="GP">GENERAL PAPER (GP)</option>
                <option value="ICT">SUB ICT (ICT)</option>
                <option value="SUB_MTC">SUB MATH (SUB MTC)</option>
            `
        };
        return options[type];
    }

    // Generate options for grade select elements
    function getGradeOptions(type) {
        const options = {
            oLevel: `
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="C3">C3</option>
                <option value="C4">C4</option>
                <option value="C5">C5</option>
                <option value="C6">C6</option>
                <option value="P7">P7</option>
                <option value="P8">P8</option>
                <option value="F9">F9</option>
            `,
            aLevelPrincipal: `
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="O">O</option>
                <option value="F">F</option>
            `,
            aLevelSubsidiary: `
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="C3">C3</option>
                <option value="C4">C4</option>
                <option value="C5">C5</option>
                <option value="C6">C6</option>
                <option value="P7">P7</option>
                <option value="P8">P8</option>
                <option value="F9">F9</option>
            `
        };
        return options[type];
    }

    // Generate a new subject entry
    function generateSubjectEntry(type, index) {
        return `
            <tr class="form-row mb-2">
                <td>${index}</td>
                <td>
                    <select class="form-control form-control-sm" name="${type}Subject[]" required>
                        <option value="" disabled selected>Select Subject</option>
                        ${getSubjectOptions(type)}
                    </select>
                </td>
                <td>
                    <select class="form-control form-control-sm" name="${type}Grade[]" required>
                        <option value="" disabled selected>Select Grade</option>
                        ${getGradeOptions(type)}
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-btn">Remove</button>
                </td>
            </tr>
        `;
    }

    // Add new subject entry with duplicate check
    function addSubjectEntry(type) {
        const subjectSelect = $(`#${type}Subjects select[name="${type}Subject[]"]`).last();
        const selectedSubject = subjectSelect.val();
        if (selectedSubject) {
            if (!isSubjectAlreadyAdded(type, selectedSubject)) {
                const index = $(`#${type}Subjects table tbody tr`).length + 1;
                $(`#${type}Subjects table tbody`).append(generateSubjectEntry(type, index));
                addSubjectToSet(type, selectedSubject);
            } else {
                alert('This subject has already been added.');
            }
        } else {
            alert('Please select a subject.');
        }
    }

    // Bind click events
    $('#addOLevelSubject').click(() => addSubjectEntry('oLevel'));
    $('#addPrincipalSubject').click(() => addSubjectEntry('aLevelPrincipal'));
    $('#addSubsidiarySubject').click(() => addSubjectEntry('aLevelSubsidiary'));

    // Remove subject entry and update the set
    $(document).on('click', '.remove-btn', function() {
        const $row = $(this).closest('tr');
        const removedSubject = $row.find('select[name$="Subject[]"]').val();
        const type = $row.closest('.dynamic-fields').attr('id').replace('Subjects', '');
        removeSubjectFromSet(type, removedSubject);
        $row.remove();
        // Re-number remaining entries
        $(`#${type}Subjects table tbody tr`).each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    });

    // Navigation buttons handling
    $('#next-section').click(() => {
        if (validateSection(currentSectionIndex)) {
            saveFormData();
            if (currentSectionIndex < sections.length - 1) {
                showSection(++currentSectionIndex);
            }
        }
    });

    $('#prev-section').click(() => {
        saveFormData();
        if (currentSectionIndex > 0) {
            showSection(--currentSectionIndex);
        }
    });
    function populateSelects(districts) {
        // List of <select> element IDs to populate
        const selectElementIds = ['nextOfKinDistrict', 'addressDistrict', 'district'];

        selectElementIds.forEach(id => {
            const selectElement = $(`#${id}`);
            if (selectElement.length) {
                // Clear existing options
                selectElement.empty();
                selectElement.append('<option value="" disabled selected>Select District</option>');

                districts.forEach(district => {
                    const option = $('<option></option>');
                    const value = district.district_name.toLowerCase().replace(/\s+/g, '');
                    option.val(value).text(district.district_name);
                    selectElement.append(option);
                });
            }
        });
    }

    // Fetch districts from the server
    $.ajax({
        url: 'get_districts.php',
        method: 'GET',
        dataType: 'json',
        success: function(districts) {
            if (Array.isArray(districts)) {
                populateSelects(districts);
            } else {
                console.error('Invalid data format:', districts);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching districts:', error);
        }
    });

    $('#toast').toast({ delay: 2000 });
});
