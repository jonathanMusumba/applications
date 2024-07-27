<div class="col-md-10 main-content">
    <div class="dashboard-overview">
        <div class="row">
            <!-- Registered Users -->
            <div class="col-md-3 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Registered Users</h5>
                        <p class="card-text"><?php echo $userCount; ?></p>
                    </div>
                </div>
            </div>
            <!-- Applications -->
            <div class="col-md-3 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Applications</h5>
                        <p class="card-text"><?php echo $applicationCount; ?></p>
                    </div>
                </div>
            </div>
            <!-- Completed Applications -->
            <div class="col-md-3 mb-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Completed</h5>
                        <p class="card-text"><?php echo $completedApplicationCount; ?></p>
                    </div>
                </div>
            </div>
            <!-- Pending Applications -->
            <div class="col-md-3 mb-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Pending</h5>
                        <p class="card-text"><?php echo $pendingApplicationCount; ?></p>
                    </div>
                </div>
            </div>
            <!-- Direct Entry (Certificates) -->
            <div class="col-md-3 mb-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Certificate-Direct</h5>
                        <p class="card-text"><?php echo $directCertificateCount; ?></p>
                    </div>
                </div>
            </div>
            <!-- Direct Entry (Diplomas) -->
            <div class="col-md-3 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Diploma-Direct</h5>
                        <p class="card-text"><?php echo $directDiplomaCount; ?></p>
                    </div>
                </div>
            </div>
            <!-- Indirect Entry (Diplomas) -->
            <div class="col-md-3 mb-4">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Diploma-Indirect</h5>
                        <p class="card-text"><?php echo $indirectDiplomaCount; ?></p>
                    </div>
                </div>
            </div>
            <!-- Admitted -->
            <div class="col-md-3 mb-4">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Admitted</h5>
                        <p class="card-text"><?php echo $admittedCount; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
    <div class="row">
        <!-- Recent Applications -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Recent Applications</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Entry Type</th>
                                <th>Course</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP loop to display recent applications -->
                            <?php foreach ($recentApplications as $application): ?>
                                <tr>
                                    <td><?php echo $application['surname'] . ' ' . $application['other_names']; ?></td>
                                    <td><?php echo $application['entry_type']; ?></td>
                                    <td><?php echo $application['course']; ?></td>
                                    <td><?php echo $application['status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Registered Users -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Recent Registered Users</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Applicant Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP loop to display recent registered users -->
                            <?php foreach ($recentUsers as $user): ?>
                                <tr>
                                    <td><?php echo $user['surname'] . ' ' . $user['other_names']; ?></td>
                                    <td><?php echo $user['sex']; ?></td>
                                    <td><?php echo $user['applicant_number']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Recent Activity -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Recent Activity</h5>
                    <ul class="list-group list-group-flush">
                    <?php
        // Combine all recent activities into one array
        $activities = [];

        // Add recent users registrations
        foreach ($recentUsers as $user) {
            $activities[] = [
                'message' => $user['surname'] . ' ' . $user['other_names'] . ' has registered.',
                'timestamp' => strtotime($user['registration_date']) // Example: Replace with actual registration timestamp
            ];
        }

        // Add recent completed applications
        foreach ($recentApplications as $application) {
            $activities[] = [
                'message' => $application['surname'] . ' ' . $application['other_names'] . ' has completed his/her application.',
                'timestamp' => strtotime($application['completion_date']) // Example: Replace with actual completion timestamp
            ];
        }

        // Add recent messages
        foreach ($recentMessages as $message) {
            $activities[] = [
                'message' => $message['sender_name'] . ' has messaged you: "' . $message['content'] . '".',
                'timestamp' => strtotime($message['timestamp']) // Example: Replace with actual message timestamp
            ];
        }

        // Sort activities by timestamp in descending order
        usort($activities, function($a, $b) {
            return $b['timestamp'] - $a['timestamp'];
        });

        // Display up to 10 recent activities or show "No Activity" if empty
        $count = 0;
        foreach ($activities as $activity) {
            if ($count >= 10) {
                break;
            }
            echo '<li class="list-group-item">' . htmlspecialchars($activity['message']) . '</li>';
            $count++;
        }

        if (empty($activities)) {
            echo '<li class="list-group-item">No Activity</li>';
        }
        ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Charts</h5>
                    <canvas "usersGenderChart"></canvas>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Applications Overview</h5>
                    <canvas id="applicationsOverviewChart"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Traffic Overview</h5>
                    <canvas id="trafficOverviewChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>