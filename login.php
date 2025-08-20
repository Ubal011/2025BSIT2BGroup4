<?php
$pageTitle = 'Ballot BUZZ - Login';
$activePage = 'login';

$pageStyles = <<<CSS
/* Layout */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-image: url('images/bg.png.png');
  background-size: cover;
  background-position: center;
  color: white;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
/* Keep footer at bottom */
.bb-footer { margin-top: auto; }

/* Header/Nav (keeps site look consistent) */
header {
  background-color: #012055;
  color: white;
  padding: 1rem 2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
nav a {
  color: white;
  text-decoration: none;
  margin-left: 1rem;
  font-weight: bold;
}
nav a.active {
  background-color: white;
  color: #0a2e5c;
  padding: 0.3rem 0.6rem;
  border-radius: 5px;
}

/* Auth box aligned to right */
.container {
  background-color: rgba(26, 26, 46, 0.95);
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 0 20px rgba(0,0,0,0.5);
  width: 100%;
  max-width: 380px;
  margin-left: auto;
  margin-right: 20vw;
  margin-top: 3rem;
}
h1 { text-align: center; margin-bottom: 1.5rem; }
input {
  width: 100%;
  padding: 0.5rem;
  margin: 0.5rem 0;
  border-radius: 0.5rem;
  border: none;
}
button {
  width: 100%;
  background-color: #003b99;
  color: white;
  padding: 0.7rem;
  margin-top: 1rem;
  font-size: 1rem;
  border: none;
  border-radius: 0.5rem;
  cursor: pointer;
}
.error { color: #f44336; font-weight: bold; margin-top: 1rem; text-align: center; }
.signup-link { margin-top: 1rem; text-align: center; }
.signup-link a { color: #00bfff; text-decoration: none; }
CSS;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <style><?= $pageStyles ?></style>
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>

<div class="container">
  <h1>Log In</h1>
  <input type="text" id="username" placeholder="Username" />
  <input type="password" id="password" placeholder="Password" />
  <button id="login-btn">Log In</button>
  <div class="error" id="error-msg"></div>
  <div class="signup-link">
    Don't have an account? <a href="signup.php">Sign Up</a>
  </div>
</div>

<script>
const loginBtn = document.getElementById('login-btn');
const errorMsg = document.getElementById('error-msg');

loginBtn.addEventListener('click', () => {
  errorMsg.textContent = '';
  const username = document.getElementById('username').value.trim();
  const password = document.getElementById('password').value;

  if (!username || !password) {
    errorMsg.textContent = 'Please enter username and password.';
    return;
  }

  const userData = localStorage.getItem('user_' + username);
  if (!userData) {
    errorMsg.textContent = 'User not found. Please sign up.';
    return;
  }

  const user = JSON.parse(userData);
  if (user.password !== password) {
    errorMsg.textContent = 'Incorrect password.';
    return;
  }

  localStorage.setItem('current_user', username);
  window.location.href = 'index.php';
});
</script>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>