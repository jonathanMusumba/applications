<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Switch Test</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
</head>
<body class="light-mode">
    <div class="mode-toggle">
        <div class="switch">
            <input class="form-check-input" type="checkbox" id="modeToggle">
            <span class="slider"></span>
            <span class="icon moon" id="moonIcon"><i class="fas fa-moon"></i></span>
            <span class="icon sun" id="sunIcon"><i class="fas fa-sun"></i></span>
        </div>
    </div>

    <script>
        const modeToggle = document.getElementById('modeToggle');
        const moonIcon = document.getElementById('moonIcon');
        const sunIcon = document.getElementById('sunIcon');
        const body = document.body;

        modeToggle.addEventListener('change', () => {
            if (modeToggle.checked) {
                body.classList.add('dark-mode');
                body.classList.remove('light-mode');
                moonIcon.style.display = 'none';
                sunIcon.style.display = 'block';
            } else {
                body.classList.add('light-mode');
                body.classList.remove('dark-mode');
                moonIcon.style.display = 'block';
                sunIcon.style.display = 'none';
            }
        });
    </script>
</body>
</html>
