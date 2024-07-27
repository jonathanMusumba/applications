<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Widget</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
 #chat-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: white;
        padding: 10px;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    #chat-window {
        display: none;
        position: fixed;
        bottom: 70px;
        right: 20px;
        width: 300px;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        flex-direction: column;
        overflow: hidden;
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
        
    </style>
</head>
<body>
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
            <img src="send-icon.png" alt="Send" style="width: 24px;">
        </button>
    </div>
</div>

    <script>
    // Function to toggle the chat widget
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
        var audio = new Audio('notification-sound.mp3');
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
    setTimeout(toggleChat, 120000); // 120000 ms = 2 minutes
</script>

</body>
</html>
