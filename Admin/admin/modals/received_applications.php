<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="receivedApplicationsModal" tabindex="-1" role="dialog" aria-labelledby="receivedApplicationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receivedApplicationsModalLabel">Received Applications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search applications...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                    </div>
                </div>
                <!-- Table to display applications -->
                <table id="applicationsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Salutation</th>
                            <th>Surname</th>
                            <th>Other Names</th>
                            <th>Sex</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Entry Type</th>
                            <th>Course</th>
                            <th>Creation Date</th>
                            <th>Form ID Status</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows will be dynamically populated -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- Pagination buttons -->
                <nav id="paginationNav" aria-label="Applications Pagination">
                    <ul id="paginationUl" class="pagination justify-content-end">
                        <!-- Pagination buttons will be dynamically populated -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to fetch applications and populate the modal -->
<script>
    $(document).ready(function() {
        var currentPage = 1; // Current page number
        var itemsPerPage = 10; // Number of items per page
        var totalItems = 0; // Total items retrieved

        // Fetch applications from PHP script
        function fetchApplications() {
            $.ajax({
                url: 'fetch_applications.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    totalItems = data.length;
                    populateApplicationsTable(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching applications:', status, error);
                }
            });
        }

        // Function to populate applications table
        function populateApplicationsTable(applications) {
            var tableBody = $('#applicationsTable tbody');
            tableBody.empty();

            // Initialize SN counter
            var sn = (currentPage - 1) * itemsPerPage + 1;

            applications.forEach(function(application, index) {
                var row = $('<tr>');
                row.append($('<td>').text(sn + index));
                row.append($('<td>').text(application.talutation));
                row.append($('<td>').text(application.surname));
                row.append($('<td>').text(application.otherNames));
                row.append($('<td>').text(application.Sex));
                row.append($('<td>').text(application.Email));
                row.append($('<td>').text(application.telephone));
                row.append($('<td>').text(application.EntryType));
                row.append($('<td>').text(application.course));
                row.append($('<td>').text(application.createDate));
                row.append($('<td>').text(application.FormID));
                row.append($('<td>').text(application.Status));
                tableBody.append(row);
            });

            // Initialize pagination
            initializePagination();
        }

        // Function to initialize pagination
        function initializePagination() {
            var totalPages = Math.ceil(totalItems / itemsPerPage);
            var paginationUl = $('#paginationUl');
            paginationUl.empty();

            for (var i = 1; i <= totalPages; i++) {
                var pageLink = $('<li class="page-item">');
                var pageLinkInner = $('<a class="page-link">').text(i);
                pageLink.append(pageLinkInner);

                pageLinkInner.click(function() {
                    currentPage = parseInt($(this).text());
                    displayPage();
                });

                paginationUl.append(pageLink);
            }

            // Display the first page initially
            displayPage();
        }

        // Function to display applications for the current page
        function displayPage() {
            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;
            var filteredApplications = filterApplications($('#searchInput').val().trim());
            var applicationsToShow = filteredApplications.slice(startIndex, endIndex);

            var tableBody = $('#applicationsTable tbody');
            tableBody.empty();

            applicationsToShow.forEach(function(application, index) {
                var row = $('<tr>');
                row.append($('<td>').text(startIndex + index + 1));
                row.append($('<td>').text(application.salutation));
                row.append($('<td>').text(application.surname));
                row.append($('<td>').text(application.otherNames));
                row.append($('<td>').text(application.Sex));
                row.append($('<td>').text(application.Email));
                row.append($('<td>').text(application.telephone));
                row.append($('<td>').text(application.EntryType));
                row.append($('<td>').text(application.course));
                row.append($('<td>').text(application.createDate));
                row.append($('<td>').text(application.FormID));
                row.append($('<td>').text(application.Status));
                tableBody.append(row);
            });
        }

        // Function to filter applications based on search input
        function filterApplications(searchTerm) {
            var filteredApplications = [];

            // Apply filter based on searchTerm (in this example, filter by Email)
            if (searchTerm.length > 0) {
                filteredApplications = applications.filter(function(application) {
                    return application.Email.toLowerCase().includes(searchTerm.toLowerCase());
                });
            } else {
                filteredApplications = applications;
            }

            totalItems = filteredApplications.length;
            return filteredApplications;
        }

        // Handle search button click event
        $('#searchButton').click(function() {
            currentPage = 1; // Reset to first page when searching
            displayPage();
            initializePagination();
        });

        // Fetch applications when modal is shown
        $('#receivedApplicationsModal').on('shown.bs.modal', function() {
            fetchApplications();
        });
    });
</script>
