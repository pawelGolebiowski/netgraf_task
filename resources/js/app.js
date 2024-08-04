document.addEventListener('DOMContentLoaded', (event) => {
    const statusForm = document.getElementById('statusForm');
    if (statusForm) {
        statusForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const status = document.getElementById('status').value;
            const url = this.action + '?status=' + encodeURIComponent(status);

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('main').innerHTML = html;
                })
                .catch(error => console.error('Error fetching pets:', error));
        });
    }
});
