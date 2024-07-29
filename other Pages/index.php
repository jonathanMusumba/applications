<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        
        .card-container {
    max-width: 1200px; /* Adjust to your desired maximum width */
    margin: 0 auto; /* Center the container horizontally */
    padding: 20px; /* Add padding inside the container */
}

.card {
    margin-bottom: 1.5rem; /* Add space between cards */
}

.card-img-top {
    height: 200px; /* Adjust the height for media */
    object-fit: cover; /* Ensure media fits within the card */
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Ensure proper spacing inside the card */
    height: 100%; /* Make card body take full height */
}
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            flex: 1 1 calc(33% - 20px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .contact-box, .info-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            background-color: #f9f9f9;
        }
        .affiliations-slider img {
            max-width: 100%;
            height: auto;
        }
        .media-container {
            margin-top: 15px;
        }
        
        .media-container img, .media-container video {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .carousel-item .card {
            margin: 0 15px;
        }
        .affiliation-logo {
            width: 100px;
            height: auto;
        }
        .affiliation-name {
            font-weight: bold;
        }
        .carousel-item {
        height: 400px; /* Adjust the height as needed */
        overflow: hidden;
    }
    .carousel-item img, .carousel-item video {
        height: 100%;
        width: auto; /* Maintain aspect ratio */
        object-fit: cover; /* Cover the container */
    }
    .latest-news-strip {
            background-color: #007bff; /* Blue background */
            color: white;
            display: flex;
            align-items: center;
            padding: 10px;
            position: relative;
            overflow: hidden;
        }
        .latest-news-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-right: 20px;
        }
        .latest-news-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            position: relative;
        }
        .latest-news-tag {
            background-color: red;
            color: white;
            padding: 2px 5px;
            font-size: 0.75rem;
            border-radius: 3px;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .latest-news-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .latest-news-controls button {
            background-color: #ffffff;
            color: #007bff;
            border: 1px solid #007bff;
            border-radius: 50%;
        }
        .latest-news .news-items {
    animation: scroll 10s linear infinite;
}

@keyframes scroll {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}
.card-container, .info-box, .contact-box {
            padding: 15px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .info-box, .contact-box {
            background-color: #f8f9fa;
        }
        .carousel-inner img {
            width: 100%;
            height: auto;
        }
        #chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
            font-size: 16px;
            font-weight: bold;
        }

        #chat-window {
            display: none;
            position: fixed;
            bottom: 70px;
            right: 20px;
            width: 300px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
            flex-direction: column;
            overflow: hidden;
            display: flex;
            animation: slideIn 0.3s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(100%);
            }
            to {
                transform: translateY(0);
            }
        }

        #chat-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        #chat-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .close-chat {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-left: auto;
        }

        #chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        #chat-input {
            display: flex;
            align-items: center;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        #chat-input input {
            flex: 1;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        #chat-input button {
            background: none;
            border: none;
            margin-left: 5px;
            cursor: pointer;
        }

        .chat-message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .chat-message.user {
            background-color: #e1ffc7;
            align-self: flex-end;
        }

        .chat-message.assistant {
            background-color: #f1f1f1;
            align-self: flex-start;
        }

        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <?php include 'header.php'; ?>
    </header>

    <!-- Media Element Slider -->
    <div id="mediaSlider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <!-- PHP to fetch media items -->
        <?php include 'carousels.php'; ?>
    </div>
    <a class="carousel-control-prev" href="#mediaSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#mediaSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="latest-news-strip">
        <div class="latest-news-title">Latest News</div>
        <div class="latest-news-content">
            <span id="news-content">Loading...</span>
            <span id="news-tag" class="latest-news-tag" style="display:none;">New</span>
        </div>
        <div class="latest-news-controls">
            <button id="prev-news" class="btn btn-light">&lt;</button>
            <button id="next-news" class="btn btn-light">&gt;</button>
        </div>
    </div>
    <!-- Posts and Announcements Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card-container">
                    <!-- PHP to fetch posts -->
                    <?php include 'fetch_posts.php'; ?>
                </div>
            </div>
           <div class="col-md-4">
                <!-- Announcements Box -->
                <h3>Announcements</h3>
                <div class="list-group">
                    <?php include 'fetch_announcements.php'; ?>
                </div>

                <!-- Intake Box -->
                <h3>Intakes</h3>
                <?php include 'fetch_intakes.php'; ?>
            </div>
        </div>
    </div>

    <!-- Our Courses Section -->
    <div class="container mt-4">
        <h2>Our Courses</h2>
        <div id="courseSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <!-- PHP to fetch courses -->
                <?php include 'fetch_courses.php'; ?>
            </div>
            <a class="carousel-control-prev" href="#courseSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#courseSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Campus News Section -->
    <div class="container mt-4">
        <h2>Campus News</h2>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-container">
                        <!-- PHP to fetch campus news -->
                        <?php include 'fetch_campus_news.php'; ?>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="info-box">
                    <h3>LINMS UGANDA</h3>
                    <p>Lubega institute of nursing and medical sciences is a registered private
                         training school for nurses and midwives founded in 2016. Its located in
                          Iganga district along Iganga – Malaba highway at busei village This school
                           is registered and licensed by the Ministry Of Education Science Technology
                            and Sports and Ministry Of Health</p>
                </div
                <div class="container mt-4">
                    <h3>Top News</h3>
                    <?php include 'fetch_top_news.php'; ?>
                </div>
                <div>
                    <h3>Reach out to us</h3>
                    <button class="btn btn-primary" onclick="openMessageForm()">Contact Us</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Advertisements Section -->
    <div class="container mt-4">
        <h2>Advertisements</h2>
        <div id="advertSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <!-- PHP to fetch advertisements -->
                <?php include 'fetch_advertisements.php'; ?>
            </div>
            <a class="carousel-control-prev" href="#advertSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#advertSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Affiliations Section -->
    <div class="container mt-4">
        <h2>Our Affiliations</h2>
        <div id="affiliationSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner affiliations-slider">
                <?php include 'fetch_affiliations.php'; ?>
            </div>
            <a class="carousel-control-prev" href="#affiliationSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#affiliationSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- Contact Address Section -->
    <div class="container mt-4">
        <h2>Contact Address</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-box">
                    <h4>Campus Location</h4>
                    <p>1234 Main Street, City, Country</p>
                    <p>Phone: +123-456-7890</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-box">
                    <h4>Our Liaison Office</h4>
                    <p>5678 Side Street, City, Country</p>
                    <p>Email: contact@example.com</p>
                </div>
            </div>
        </div>
    </div>
    <div id="chat-widget" onclick="toggleChat()">Chat</div>
    <div id="chat-window">
        <div id="chat-header">
            <img src="avatar.png" alt="Avatar" id="chat-avatar">
            <span>Chat Assistant</span>
            <button onclick="closeChat()" class="close-chat">&times;</button>
        </div>
        <div id="chat-messages"></div>
        <div id="chat-input">
            <input type="text" id="user-input" placeholder="Type a message...">
            <button onclick="sendMessage()">
         <img src="send-icon.png" alt="Send" style="width: 24px; height: 24px;">
        </button>
        </div>
    </div>
    <!-- Footer -->
    <footer class="mt-4 bg-light py-3">
        <div class="container text-center">
            <p>&copy; 2024 Your Institution. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
         document.getElementById('chat-widget').onclick = function() {
            var chatWindow = document.getElementById('chat-window');
            if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
                chatWindow.style.display = 'block';
            } else {
                chatWindow.style.display = 'none';
            }
        };

        function sendMessage() {
            var userInput = document.getElementById('user-input').value;
            if (userInput.trim() !== '') {
                var messages = document.getElementById('chat-messages');
                var userMessage = document.createElement('div');
                userMessage.textContent = userInput;
                messages.appendChild(userMessage);

                document.getElementById('user-input').value = '';

                fetch('chat.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ message: userInput })
                })
                .then(response => response.json())
                .then(data => {
                    var botMessage = document.createElement('div');
                    botMessage.textContent = data.message;
                    messages.appendChild(botMessage);
                })
                .catch(error => console.error('Error:', error));
            }
        }
        function openMessageForm() {
            // Function to open a message form or modal
            alert('Contact form or modal to open.');
        }
        document.addEventListener('DOMContentLoaded', function() {
    const newsContent = document.getElementById('news-content');
    const newsTag = document.getElementById('news-tag');
    const prevButton = document.getElementById('prev-news');
    const nextButton = document.getElementById('next-news');

    let newsItems = [];
    let currentIndex = 0;

    // Fetch news items from the PHP script
    fetch('fetch_headlines.php')
        .then(response => response.json())
        .then(data => {
            newsItems = data;
            if (newsItems.length > 0) {
                updateNewsDisplay();
            }
        })
        .catch(error => console.error('Error fetching news:', error));

    // Update news display function
    function updateNewsDisplay() {
        if (newsItems.length > 0) {
            const newsItem = newsItems[currentIndex];
            newsContent.textContent = `${newsItem.title} - ${new Date(newsItem.date_posted).toLocaleDateString()}`;
            newsTag.style.display = newsItem.is_new ? 'block' : 'none';
        }
    }

    // Handle next button click
    nextButton.addEventListener('click', function() {
        if (newsItems.length > 0) {
            currentIndex = (currentIndex + 1) % newsItems.length;
            updateNewsDisplay();
        }
    });

    // Handle previous button click
    prevButton.addEventListener('click', function() {
        if (newsItems.length > 0) {
            currentIndex = (currentIndex - 1 + newsItems.length) % newsItems.length;
            updateNewsDisplay();
        }
    });
});
// chat.js
function toggleChat() {
            var chatWindow = document.getElementById('chat-window');
            if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
                chatWindow.style.display = 'flex';
                playNotificationSound();
                displayGreeting();
            } else {
                chatWindow.style.display = 'none';
            }
        }

        // Function to close the chat
        function closeChat() {
            document.getElementById('chat-window').style.display = 'none';
        }

        // Function to play notification sound
        function playNotificationSound() {
            var audio = new Audio('notification-sound.wav');
            audio.play();
        }

        // Function to display greeting message
        function displayGreeting() {
            var chatMessages = document.getElementById('chat-messages');
            var greeting = document.createElement('div');
            greeting.classList.add('chat-message', 'assistant');
            greeting.textContent = 'Hello, how may I help you today?';
            chatMessages.appendChild(greeting);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Function to send a message
        function sendMessage() {
            var userInput = document.getElementById('user-input');
            var message = userInput.value.trim();
            if (message) {
                var chatMessages = document.getElementById('chat-messages');

                // Append user's message to chat
                var userMessage = document.createElement('div');
                userMessage.classList.add('chat-message', 'user');
                userMessage.textContent = message;
                chatMessages.appendChild(userMessage);

                // Clear the input
                userInput.value = '';
                chatMessages.scrollTop = chatMessages.scrollHeight;

                // Send the message to the server
                fetch('chat.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ message: message }),
                })
                .then(response => response.json())
                .then(data => {
                    var botMessage = document.createElement('div');
                    botMessage.classList.add('chat-message', 'assistant');
                    botMessage.textContent = data.message;
                    chatMessages.appendChild(botMessage);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                });
            }
        }

        // Auto-open chat widget after 2 minutes
        setTimeout(toggleChat, 60000); // 120000 ms = 2 minutes
    </script>
</body>
</html>

