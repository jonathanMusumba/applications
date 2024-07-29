<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linms";

$conn = new mysqli($servername, $username, $password, $dbname);
$query = "SELECT id, question, answer FROM faqs ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

$faqs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $faqs[] = $row;
}
?>

<div class="container mt-5">
    <h2>Frequently Asked Questions</h2>
    <div id="accordion">
        <?php foreach ($faqs as $index => $faq): ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $index; ?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $index; ?>" aria-expanded="true" aria-controls="collapse<?php echo $index; ?>">
                            <?php echo $faq['question']; ?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?php echo $index; ?>" class="collapse <?php echo $index === 0 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $index; ?>" data-parent="#accordion">
                    <div class="card-body">
                        <?php echo $faq['answer']; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

