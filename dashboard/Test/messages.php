<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .message-box {
            max-height: 300px; /* Adjust the height as needed */
            overflow-y: auto;
            margin-bottom: 20px; /* Space between inbox and outbox */
        }
        .message-item {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        .whatsapp-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .whatsapp-widget a {
            color: white;
            font-size: 24px;
            text-decoration: none;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            margin-right: 10px;
        }
    </style>
    <title>My Messages</title>
</head>
<body>

<div class="container mt-5">
    <div class="alert alert-info mt-3">
        <strong>MY MESSAGES</strong>
        <a href="#" class="btn btn-danger btn-sm float-right" onclick="window.location.reload();">Reload</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-secondary">Inbox</div>
            <div class="message-box">
                <!-- Example of inbox messages -->
                <div class="message-item">
                    <strong>Sender Name</strong>
                    <p>Message content goes here...</p>
                </div>
                <!-- Dynamically load messages here -->
            </div>
            <div class="alert alert-secondary">Outbox</div>
            <div class="message-box">
                <!-- Example of outbox messages -->
                <div class="message-item">
                    <strong>Recipient Name</strong>
                    <p>Message content goes here...</p>
                </div>
                <!-- Dynamically load messages here -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-secondary">Send a Message</div>
            <form id="messageForm">
                <div class="form-group">
                    <label for="recipient">Recipient</label>
                    <input type="text" class="form-control" id="recipient" placeholder="Recipient Name" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Type your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <!-- Add more social links as needed -->
            </div>
        </div>
    </div>
</div>

<!-- WhatsApp Widget -->
<div class="whatsapp-widget">
    <a href="https://wa.me/YOUR_PHONE_NUMBER" target="_blank"><i class="fab fa-whatsapp"></i></a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
