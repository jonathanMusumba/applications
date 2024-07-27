document.addEventListener('DOMContentLoaded', function() {
    const postsContainer = document.getElementById('posts-container');
    const paginationContainer = document.getElementById('pagination');
    let currentPage = 1;

    function loadPosts(page) {
        fetch(`fetch_posts.php?page=${page}`)
            .then(response => response.json())
            .then(data => {
                postsContainer.innerHTML = '';
                data.posts.forEach(post => {
                    const postElement = document.createElement('div');
                    postElement.classList.add('post');
                    postElement.innerHTML = `
                        <h3>${post.title}</h3>
                        <p>${post.content}</p>
                        <p><small>Posted on ${post.created_at}</small></p>
                    `;
                    postsContainer.appendChild(postElement);
                });

                // Generate pagination links
                const totalPages = Math.ceil(data.total_posts / data.posts_per_page);
                paginationContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const pageItem = document.createElement('li');
                    pageItem.classList.add('page-item');
                    const pageLink = document.createElement('a');
                    pageLink.classList.add('page-link');
                    pageLink.href = '#';
                    pageLink.textContent = i;
                    if (i === currentPage) {
                        pageLink.classList.add('active');
                    }
                    pageLink.addEventListener('click', function(event) {
                        event.preventDefault();
                        currentPage = i;
                        loadPosts(currentPage);
                    });
                    pageItem.appendChild(pageLink);
                    paginationContainer.appendChild(pageItem);
                }
            })
            .catch(error => console.error('Error loading posts:', error));
    }

    loadPosts(currentPage);
});
document.addEventListener('DOMContentLoaded', function() {
    const intakeCard = document.getElementById('intake-card');

    function loadIntakes() {
        fetch('fetch_intakes.php')
            .then(response => response.json())
            .then(intakes => {
                intakeCard.innerHTML = '';

                intakes.forEach(intake => {
                    const cardElement = document.createElement('div');
                    cardElement.classList.add('intake-card');
                    
                    const startDate = new Date(intake.start_date);
                    const endDate = new Date(intake.end_date);
                    const now = new Date();

                    const countdown = endDate > now ? calculateCountdown(endDate) : 'Closed';

                    cardElement.innerHTML = `
                        <h3>${intake.intake_year} - ${intake.intake_month} Intake</h3>
                        <p><strong>Status:</strong> Running Strong</p>
                        <p><strong>Start Date:</strong> ${startDate.toDateString()}</p>
                        <p><strong>End Date:</strong> ${endDate.toDateString()}</p>
                        <p><strong>Closes in:</strong> <span class="countdown">${countdown}</span></p>
                        <a href="applicants/register.html" class="apply-button">Apply Now</a>
                    `;

                    intakeCard.appendChild(cardElement);
                });
            })
            .catch(error => console.error('Error loading intakes:', error));
    }

    function calculateCountdown(endDate) {
        const now = new Date();
        const totalMilliseconds = endDate - now;
        
        if (totalMilliseconds <= 0) return 'Closed';

        const totalSeconds = Math.floor(totalMilliseconds / 1000);
        const days = Math.floor(totalSeconds / (60 * 60 * 24));
        const hours = Math.floor((totalSeconds % (60 * 60 * 24)) / (60 * 60));
        const minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
        const seconds = Math.floor(totalSeconds % 60);

        return `${days} Days ${hours} Hours ${minutes} Minutes ${seconds} Seconds`;
    }

    loadIntakes();
});

// Update countdown every second
setInterval(() => {
    document.querySelectorAll('.countdown').forEach(elem => {
        const endDate = new Date(elem.dataset.endDate);
        elem.textContent = calculateCountdown(endDate);
    });
}, 1000);
$('#contact-form').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = {
        name: $('#name').val(),
        email: $('#email').val(),
        message: $('#message').val()
    };

    $.ajax({
        url: 'send_message.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message);
                $('#contact-form')[0].reset(); // Clear the form
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('An error occurred while sending your message.');
        }
    });
});
