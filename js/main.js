/* js/main.js */
document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');
  const loginBtn = document.getElementById('loginBtn');
  const logoutBtn = document.getElementById('logoutBtn');

  loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(loginForm);
    const res = await fetch('login.php', {
      method: 'POST',
      body: formData
    });
    const result = await res.text();
    alert(result);
    if (result.includes('başarı')) window.location.href = 'dashboard.php';
  });

  registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(registerForm);
    const res = await fetch('register.php', {
      method: 'POST',
      body: formData
    });
    const result = await res.text();
    alert(result);
  });

  logoutBtn.addEventListener('click', () => {
    window.location.href = 'logout.php';
  });
});
