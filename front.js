// front.js
document.addEventListener("DOMContentLoaded", function() {
  const loginBtn = document.querySelector('.login-btn');
  const formPopup = document.querySelector('.form-popup');

  loginBtn.addEventListener('click', function() {
      formPopup.style.display = 'block';
  });

  const closeBtn = document.querySelectorAll('.close-btn');
  closeBtn.forEach(btn => {
      btn.addEventListener('click', function() {
          formPopup.style.display = 'none';
      });
  });
});
