<div class="modal fade" id="manageApplicationsModal" tabindex="-1" role="dialog" aria-labelledby="manageApplicationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageApplicationsModalLabel">Manage Applications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content for managing applications -->
                <div class="container">
                    <h1>Manage Applications</h1>
                    <form method="post" class="form-inline mb-4">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="year" class="sr-only">Year</label>
                            <select id="year" name="year" class="form-control">
                                <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                                    <option value="<?php echo $i; ?>" <?php echo ($i == $year) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search by Name" value="<?php echo htmlspecialchars($searchTerm); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </form>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Salutation</th>
                                <th>Applicant Name</th>
                                <th>Level</th>
                                <th>Course</th>
                                <th>Dob</th>
                                <th>Sex</th>
                                <th>Marital Status</th>
                                <th>Religion</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>District</th>
                                <th>Form ID</th>
                                <th>Create Date</th>
                                <th>Submit Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['salutation']); ?></td>
                                    <td><?php echo htmlspecialchars($row['surname'] . ' ' . $row['otherNames']); ?></td>
                                    <td><?php echo htmlspecialchars($row['level']); ?></td>
                                    <td><?php echo htmlspecialchars($row['course']); ?></td>
                                    <td><?php echo htmlspecialchars($row['dob']); ?></td>
                                    <td><?php echo htmlspecialchars($row['sex']); ?></td>
                                    <td><?php echo htmlspecialchars($row['maritalStatus']); ?></td>
                                    <td><?php echo htmlspecialchars($row['religion']); ?></td>
                                    <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['district']); ?></td>
                                    <td><?php echo htmlspecialchars($row['FormID']); ?></td>
                                    <td><?php echo htmlspecialchars($row['createDate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['submitDate']); ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal" data-id="<?php echo $row['id']; ?>">View</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- End content for managing applications -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- Additional buttons or actions here -->
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for handling view modal
    $('#viewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var applicantId = button.data('id'); // Extract applicant ID from data-id attribute
        var modal = $(this);

        // AJAX request to fetch applicant details and display in modal
        $.ajax({
            url: 'fetch_applicant.php', // PHP script to fetch applicant details
            type: 'POST',
            data: { id: applicantId }, // Send applicant ID as POST data
            success: function(response) {
                modal.find('#applicant-details').html(response); // Update modal body with fetched data
            }
        });
    });

    // JavaScript for handling actions within the view modal
    $('#admitButton').click(function() {
        // Handle admit student functionality here
    });
</script>
