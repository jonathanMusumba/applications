$(document).ready(function () {
    // Fetch all messages initially
    fetchMessages();

    // Function to fetch messages
    function fetchMessages() {
        $.ajax({
            url: 'php/manage_messages.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    displayMessages(response.messages);
                } else {
                    showAlert('danger', 'Error fetching messages.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showAlert('danger', 'Error fetching messages.');
            }
        });
    }

    // Function to display messages
    function displayMessages(messages) {
        var messageList = $('#messageList');
        messageList.empty(); // Clear previous messages

        messages.forEach(function (message) {
            var html = `
                <div class="message">
                    <h5>${message.sender}</h5>
                    <p>${message.message}</p>
                    <small>Email: ${message.email}</small>
                    <small>Status: ${message.status}</small>
                    <small>Time Sent: ${message.created_at}</small>
                    <button class="btn btn-primary view-message" data-toggle="modal" data-target="#viewMessageModal" data-message-id="${message.id}">View</button>
                    <button class="btn btn-danger delete-message" data-message-id="${message.id}">Delete</button>
                    <hr>
                </div>
            `;
            messageList.append(html);
        });

        // Attach event listeners for view and delete buttons
        $('.view-message').click(function () {
            var messageId = $(this).data('message-id');
            // Call function to populate view message modal
            populateViewMessageModal(messageId);
        });

        $('.delete-message').click(function () {
            var messageId = $(this).data('message-id');
            // Call function to delete message
            deleteMessage(messageId);
        });
    }

    // Function to populate view message modal
    function populateViewMessageModal(messageId) {
        // AJAX request to fetch message details
        $.ajax({
            url: 'php/manage_messages.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'fetch_message_details',
                message_id: messageId
            },
            success: function (response) {
                if (response.status === 'success') {
                    var message = response.message;
                    $('#viewMessageModal .modal-title').text('Message Details');
                    $('#viewMessageModal .modal-body').html(`
                        <p><strong>Sender:</strong> ${message.sender}</p>
                        <p><strong>Email:</strong> ${message.email}</p>
                        <p><strong>Message:</strong></p>
                        <p>${message.message}</p>
                        <p><strong>Status:</strong> ${message.status}</p>
                        <p><strong>Time Sent:</strong> ${message.created_at}</p>
                        <button class="btn btn-primary reply-message" data-toggle="modal" data-target="#replyMessageModal" data-message-id="${message.id}">Reply</button>
                        <button class="btn btn-danger delete-message" data-message-id="${message.id}">Delete</button>
                    `);
                    $('#viewMessageModal').modal('show');

                    // Mark message as read (if unread)
                    if (message.status === 'Unread') {
                        markMessageAsRead(messageId);
                    }
                } else {
                    showAlert('danger', 'Error fetching message details.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showAlert('danger', 'Error fetching message details.');
            }
        });
    }

    // Function to delete message
    function deleteMessage(messageId) {
        // Confirm deletion
        if (confirm('Are you sure you want to delete this message?')) {
            // AJAX request to delete message
            $.ajax({
                url: 'php/manage_messages.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'delete_message',
                    message_id: messageId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        showAlert('success', response.message);
                        fetchMessages(); // Refresh message list
                    } else {
                        showAlert('danger', 'Error deleting message.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    showAlert('danger', 'Error deleting message.');
                }
            });
        }
    }

    // Function to mark message as read
    function markMessageAsRead(messageId) {
        // AJAX request to mark message as read
        $.ajax({
            url: 'php/manage_messages.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'mark_as_read',
                message_id: messageId
            },
            success: function (response) {
                if (response.status === 'success') {
                    // Update UI or perform action upon success
                } else {
                    showAlert('danger', 'Error marking message as read.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showAlert('danger', 'Error marking message as read.');
            }
        });
    }

    // Function to show alerts
    function showAlert(type, message) {
        var alert = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        $('#alertContainer').html(alert);
    }

    // Example: Handling reply modal and submit
    $('#replyMessageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var messageId = button.data('message-id');
        var modal = $(this);
        modal.find('.modal-body input[name="message_id"]').val(messageId);
    });

    $('#replyForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serializeArray();
        // AJAX request to handle reply submission
        $.ajax({
            url: 'php/manage_messages.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    showAlert('success', 'Reply sent successfully.');
                    $('#replyMessageModal').modal('hide');
                } else {
                    showAlert('danger', 'Error sending reply.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showAlert('danger', 'Error sending reply.');
            }
        });
    });
});
</script>
