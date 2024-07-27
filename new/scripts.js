document.addEventListener("DOMContentLoaded", function () {
    // Menu Toggle for Mobile
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('open');
    });

    // AJAX Content Loading for Courses
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            const target = this.getAttribute('data-target');
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            this.classList.add('active');
            document.querySelector(target).classList.add('active');
            
            // Load content dynamically (example)
            fetch(`load-content.php?course=${target}`)
                .then(response => response.text())
                .then(data => {
                    document.querySelector(target).innerHTML = data;
                })
                .catch(error => console.error('Error loading content:', error));
        });
    });

    // Scroll Animation
    document.addEventListener('scroll', function () {
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach(element => {
            if (element.getBoundingClientRect().top < window.innerHeight) {
                element.classList.add('visible');
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    // Select all tab buttons
    const tabButtons = document.querySelectorAll('.tab-button');
    // Select all tab contents
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            tabButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to the clicked button
            button.classList.add('active');

            // Remove active class from all tab contents
            tabContents.forEach(content => content.classList.remove('active'));
            // Get the target content based on the clicked button
            const target = button.getAttribute('data-target');
            // Add active class to the target content
            document.querySelector(target).classList.add('active');

            // Load content dynamically using AJAX
            loadCourses(target);
        });
    });

    // Function to load courses using AJAX
    function loadCourses(target) {
        // Dummy data URL, replace with your actual API endpoint
        const url = 'path-to-your-api/courses?category=' + target.substring(1);
        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Clear the current content
                document.querySelector(target).innerHTML = '';
                // Loop through the data and create course cards
                data.courses.forEach(course => {
                    const courseCard = `
                        <div class="course-card">
                            <div class="course-image">
                                <img src="${course.image}" alt="${course.title}">
                            </div>
                            <div class="course-info">
                                <h3>${course.title}</h3>
                                <p>${course.description}</p>
                                <button class="view-details" onclick="openModal('${course.id}')">View Details</button>
                            </div>
                        </div>
                    `;
                    document.querySelector(target).innerHTML += courseCard;
                });
            })
            .catch(error => console.error('Error loading courses:', error));
    }

    // Load initial content for the first tab
    loadCourses('#medical-courses');
});
document.addEventListener("DOMContentLoaded", function() {
    const accordionHeaders = document.querySelectorAll('.accordion-header');

    accordionHeaders.forEach(header => {
        header.addEventListener('click', () => {
            // Toggle active class
            header.classList.toggle('active');
            // Toggle content display
            const content = header.nextElementSibling;
            content.style.display = content.style.display === 'block' ? 'none' : 'block';
        });
    });

    document.getElementById('learn-more-btn').addEventListener('click', () => {
        document.getElementById('admissions-info').scrollIntoView({ behavior: 'smooth' });
    });
});

