<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #chat-window {
            width: 100%;
            height: 500px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        #chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            border-bottom: 1px solid #ddd;
        }

        .chat-message.user {
            text-align: right;
            background-color: #e9ecef;
            border-radius: 10px;
            padding: 5px 10px;
            margin: 5px 0;
            display: inline-block;
        }

        .chat-message.admin {
            text-align: left;
            background-color: #007bff;
            color: white;
            border-radius: 10px;
            padding: 5px 10px;
            margin: 5px 0;
            display: inline-block;
        }

        #chat-input {
            padding: 10px;
            border-radius: 0 0 5px 5px;
            display: flex;
            align-items: center;
        }

        #chat-input input {
            flex: 1;
            padding: 5px;
            margin-right: 5px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        #chat-input button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Admin Chat Dashboard</h2>
    <div id="chat-window">
        <div id="chat-messages"></div>
        <div id="chat-input">
            <input type="text" id="admin-input" placeholder="Type a message...">
            <button onclick="sendAdminMessage()">Send</button>
        </div>
    </div>
</div>

<script>
    function fetchChatMessages() {
        fetch('get_chat_messages.php')
            .then(response => response.json())
            .then(data => {
                var chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML = '';
                data.forEach(message => {
                    var messageElement = document.createElement('div');
                    messageElement.classList.add('chat-message', message.sender);
                    messageElement.textContent = message.sender === 'admin' ? `Admin: ${message.message}` : `User: ${message.message}`;
                    chatMessages.appendChild(messageElement);
                });
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
    }

    function sendAdminMessage() {
        var adminInput = document.getElementById('admin-input');
        var message = adminInput.value.trim();
        if (message) {
            fetch('admin_chat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message: message }),
            })
            .then(response => response.json())
            .then(data => {
                adminInput.value = '';
                fetchChatMessages();
            })
            .catch(error => console.error('Error:', error));
        }
    }

    // Fetch chat messages periodically
    setInterval(fetchChatMessages, 3000);
</script>
</body>
</html>
