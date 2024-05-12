document.addEventListener('DOMContentLoaded', function () {
    const roomForm = document.getElementById('roomForm');
    const messageDiv = document.getElementById('message');
  
    roomForm.addEventListener('submit', function (event) {
      event.preventDefault();
  
      const formData = new FormData(roomForm);
  
      fetch(roomForm.getAttribute('action'), {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        messageDiv.textContent = data;
        roomForm.reset();
      })
      .catch(error => {
        console.error('Error:', error);
        messageDiv.textContent = 'An error occurred. Please try again.';
      });
    });
  });
  