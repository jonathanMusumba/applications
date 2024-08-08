document.addEventListener('DOMContentLoaded', function() {
    const content = document.getElementById('content');

    function loadContent(tab) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', tab + '.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                content.innerHTML = xhr.responseText;
            } else {
                content.innerHTML = '<p>Error loading content.</p>';
            }
        };
        xhr.send();
    }

    function setActive(tab) {
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.classList.toggle('active', link.getAttribute('data-tab') === tab);
        });

        document.querySelectorAll('.top-nav button').forEach(button => {
            button.classList.toggle('active', button.getAttribute('data-tab') === tab);
        });
    }

    document.querySelectorAll('.sidebar a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const tab = this.getAttribute('data-tab');
            setActive(tab);
            loadContent(tab);
        });
    });

    document.querySelectorAll('.top-nav button').forEach(button => {
        button.addEventListener('click', function() {
            const tab = this.getAttribute('data-tab');
            setActive(tab);
            loadContent(tab);
        });
    });

    // Load initial content
    loadContent('dashboard'); // Initial load
});
