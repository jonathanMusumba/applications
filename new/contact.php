<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Section Layout</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .contact .info {
            border-top: 3px solid #5cb874;
            border-bottom: 3px solid #5cb874;
            padding: 30px;
            background: #fff;
            width: 100%;
            box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12);
        }

        .contact .info i {
            font-size: 20px;
            color: #5cb874;
            float: left;
            width: 44px;
            height: 44px;
            background: #eaf6ed;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }

        .contact .info h4 {
            padding: 0 0 0 60px;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #222222;
        }

        .contact .info p {
            padding: 0 0 10px 60px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #555555;
        }

        .contact .info .social-links {
            padding-left: 60px;
        }

        .contact .info .social-links a {
            font-size: 18px;
            display: inline-block;
            background: #333;
            color: #fff;
            line-height: 1;
            padding: 8px 0;
            border-radius: 50%;
            text-align: center;
            width: 36px;
            height: 36px;
            transition: 0.3s;
            margin-right: 10px;
        }

        .contact .info .social-links a:hover {
            background: #5cb874;
            color: #fff;
        }

        .contact .info .email:hover i,
        .contact .info .address:hover i,
        .contact .info .phone:hover i {
            background: #5cb874;
            color: #fff;
        }

        .contact .php-email-form {
            width: 100%;
            border-top: 3px solid #5cb874;
            border-bottom: 3px solid #5cb874;
            padding: 30px;
            background: #fff;
            box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12);
        }

        .contact .php-email-form .form-group {
            padding-bottom: 8px;
        }

        .contact .php-email-form .error-message {
            display: none;
            color: #fff;
            background: #ed3c0d;
            text-align: left;
            padding: 15px;
            font-weight: 600;
        }

        .contact .php-email-form .error-message br+br {
            margin-top: 25px;
        }

        .contact .php-email-form .sent-message {
            display: none;
            color: #fff;
            background: #18d26e;
            text-align: center;
            padding: 15px;
            font-weight: 600;
        }

        .contact .php-email-form .loading {
            display: none;
            background: #fff;
            text-align: center;
            padding: 15px;
        }

        .contact .php-email-form .loading:before {
            content: "";
            display: inline-block;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            margin: 0 10px -6px 0;
            border: 3px solid #18d26e;
            border-top-color: #eee;
            animation: animate-loading 1s linear infinite;
        }

        .contact .php-email-form input,
        .contact .php-email-form textarea {
            border-radius: 0;
            box-shadow: none;
            font-size: 14px;
            border-radius: 4px;
        }

        .contact .php-email-form input:focus,
        .contact .php-email-form textarea:focus {
            border-color: #5cb874;
        }

        .contact .php-email-form input {
            height: 44px;
        }

        .contact .php-email-form textarea {
            padding: 10px 12px;
        }

        .contact .php-email-form button[type=submit] {
            background: #5cb874;
            border: 0;
            padding: 10px 24px;
            color: #fff;
            transition: 0.4s;
            border-radius: 4px;
        }

        .contact .php-email-form button[type=submit]:hover {
            background: #6ec083;
        }

        @keyframes animate-loading {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Contact</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>
            <div class="row">
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>
                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>
                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="email">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
