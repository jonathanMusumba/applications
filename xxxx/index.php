<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lubega Nursing Institute</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5W<link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" 
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            
            margin-left: auto;
            /* Ensure there is no padding */
        }

        .navbar-brand img {
            max-width: 100%;
            height: auto;
        }

        .slideshow {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .center .title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .center .btns button {
            margin: 10px;
            padding: 15px 30px;
            font-size: 1.2rem;
            border: none;
            color: white;
        }

        .btn-primary {
            background-color: #008000;
        }

        .btn-primary:hover {
            background-color: #006600;
        }

        .btn-secondary {
            background-color: #800000;
        }

        .btn-secondary:hover {
            background-color: #660000;
        }

        .shushing-smiley {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 2rem;
            animation: drop-bounce 1.5s infinite;
            cursor: pointer;
        }

        @keyframes drop-bounce {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(0);
            }
        }
        @media (max-width: 768px) {
    /* Navbar brand logo size adjustment */
    .navbar-brand img {
        max-width: 80%;
    }

    /* Centered title font size adjustment */
    .center .title {
        font-size: 2rem;
    }

    /* Button padding adjustment */
    .center .btns button {
        padding: 12px 24px;
    }

    /* Slideshow images size adjustment */
    .slide img {
        max-width: 100%;
        height: 100%;
    }

}
    </style>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="images/logo.png" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto"> <!-- ml-auto pushes the navbar items to the right -->
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://www.lubeganursinginstitute.com" target="_blank" rel="noopener noreferrer">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Applicants/index.php">Apply</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/index.php">Login Admin</a>
            </li>
        </ul>
    </div>
</nav>


    <div class="slideshow">
        <div class="slide active">
            <img src="images/img1.jpg" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="images/img2.JPG" alt="Slide 2">
        </div>
        <div class="slide">
            <img src="images/img4.JPG" alt="Slide 3">
        </div>
        <div class="slide">
            <img src="images/img5.JPG" alt="Slide 3">
        </div>
        <div class="slide">
            <img src="images/img6.JPG" alt="Slide 3">
        </div>
        <div class="slide">
            <img src="images/img7.JPG" alt="Slide 3">
        </div>
    </div>
    <div class="center">
        <div class="title">Enter to learn, go forth to serve</div>
        <div class="btns">
            <a href="https://www.lubeganursinginstitute.com" target="_blank" rel="noopener noreferrer">
                <button class="btn btn-primary">Learn More</button>
            </a>
            <a href="Applicants/index.php">
                <button class="btn btn-secondary">Apply Now</button>
            </a>
        </div>
    </div>

    <!-- Chat Emoji -->
    <div id="openMessageWidget" class="shushing-smiley" data-bs-toggle="modal" data-bs-target="#messageModal">&#129299;</div>

    <!-- Modal for Message Widget -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="container mt-3">
    <div id="alertContainer"></div>
</div>
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Send Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="messageForm">
                        <div class="mb-3">
                            <label for="senderName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="senderName" name="senderName" required>
                        </div>
                        <div class="mb-3">
                            <label for="senderEmail" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="senderEmail" name="senderEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="messageContent" class="form-label">Message</label>
                            <textarea class="form-control" id="messageContent" name="messageContent" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
           
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-QWTKZyjpPEjISv5Wb8jPOrVxE8qGYB3Kf5gsCYJYLf+Vh6Q6AzOqQ+q5thi67P7ea"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
       $(document).ready(function () {
    $('#messageForm').submit(function (e) {
        e.preventDefault();

        // Collect form data
        var senderName = $('#senderName').val();
        var senderEmail = $('#senderEmail').val();
        var messageContent = $('#messageContent').val();

        // AJAX request to send data to server
        $.ajax({
            url: 'php/save_message.php',
            type: 'POST',
            data: {
                senderName: senderName,
                senderEmail: senderEmail,
                messageContent: messageContent
            },
            dataType: 'json', // Expect JSON response
            success: function (response) {
                showAlert('success', response.message); // Show success message to user
                $('#messageModal').modal('hide'); // Close the modal upon successful submission
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showAlert('danger', 'An error occurred. Please try again.'); // Show error message to user
            }
        });
    });

    function showAlert(type, message) {
        // Create the alert element
        const alert = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        // Append the alert to the container
        $('#alertContainer').html(alert);

        // Automatically hide the alert after 5 seconds
        setTimeout(function () {
            $('.alert').alert('close');
        }, 8000);
    }
});
    </script>

</body>

</html>
