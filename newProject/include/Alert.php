<div class="alert alert-info mt-3">
        <span class="circle-exclamation">
            <i class="fas fa-exclamation"></i>
        </span>
        <strong>APPLY FOR CERTIFICATE,DIPLOMA DIRECT AND FOR EXTENSIONS!</strong>
    </div>

    <!-- Intake Information Section -->
    <div class="container mt-4">
    <div class="row">
        <?php foreach ($activeIntakes as $index => $intake): ?>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">ACADEMIC YEAR: <?php echo htmlspecialchars($intake['intake_year']); ?></h5>
                        <p class="card-text">INTAKE: <?php echo htmlspecialchars($intake['intake_month']); ?></p>
                        <p class="card-text">RUNNING FROM: <?php echo htmlspecialchars($intake['start_date']); ?> TO <?php echo htmlspecialchars($intake['end_date']); ?></p>
                        <p class="card-text">REMAINING TIME: <!-- Calculation for remaining time here --></p>
                        <p class="card-text">NUMBER OF COURSES YOU CAN APPLY FOR: 1</p>
                        <p class="card-text">NUMBER OF FORMS YOU CAN FILL: 1</p>
                        <p class="card-text">APPLICATION STATUS: <?php echo htmlspecialchars($intake['intake_status']); ?></p>
                        <p class="card-text">DESCRIPTION: <?php echo htmlspecialchars($intake['description']); ?></p>
                        <p class="card-text">ADMISSION FEES: For Ugandans: UGX. 50,000, For NON-UGANDANS: UGX. 50,000</p>
                        <?php if (strtolower($intake['intake_status']) == 'running'): ?>
                            <button class="btn btn-success btn-apply-now" data-intake-year="<?php echo htmlspecialchars($intake['intake_year']); ?>" data-intake-month="<?php echo htmlspecialchars($intake['intake_month']); ?>">APPLY NOW</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>