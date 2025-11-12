<?php
session_start();
include 'dbconnect.php'; // connect to database

$pageTitle = 'Ballot BUZZ - Login';
$activePage = 'login';

$pageStyles = <<<CSS
/* (your same CSS here — unchanged) */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-image: url('images/Bbuzzbg.png');
  background-position: center;
  color: white;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
.bb-footer { margin-top: 400px; }
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
.container {
  background-color: rgba(26, 26, 46, 0.95);
  padding: 70px 20px;
  border-radius: 1rem;
  box-shadow: 0 0 20px rgba(0,0,0,0.5);
  width: 100%;
  max-width: 400px;
  margin-left: auto;    
  margin-right: 20vw;  
  margin-top: 300px;
}
h1 { text-align: center; margin-bottom: 50px; color: white; }
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
@media (max-width: 430px) {
  body { background-image: url('images/phonebbuzz.png'); }
  .container {
    width: 100%;
    max-width: 360px;
    padding: 2rem 1.5rem;
    margin: 2rem auto;
  }
  input, button { width: 100%; font-size: 0.95rem; height: 44px; }
}
.error { color: #f44336; font-weight: bold; margin-top: 1rem; text-align: center; }
.signup-link { margin-top: 1rem; text-align: center; }
.signup-link a { color: #00bfff; text-decoration: none; }
CSS;

$errorMsg = '';

// Run login logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errorMsg = 'Please enter username and password.';
    } else {
        // Prepared statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
      $user = $result->fetch_assoc();

      // Support hashed passwords (password_hash) and legacy plain-text passwords.
      $stored = $user['password'];
      $login_ok = false;

      // If password is hashed, verify it
      if (password_verify($password, $stored)) {
        $login_ok = true;
      } elseif ($password === $stored) {
        // Legacy plain-text password: accept login and upgrade to a secure hash
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        if (isset($user['id'])) {
          $update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
          $update->bind_param("si", $newHash, $user['id']);
          $update->execute();
          $update->close();
        }
        $login_ok = true;
      }

      if ($login_ok) {
        $_SESSION['current_user'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
          header("Location: admin_dashboard.php");
        } else {
          header("Location: index.php?user=" . urlencode($user['username']));
        }
        exit;
      } else {
        $errorMsg = 'Incorrect password.';
      }
        } else {
            $errorMsg = 'User not found.';
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <style><?= $pageStyles ?></style>
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>

<div class="container">
  <h1>Log In</h1>
  <form method="post" action="login.php">
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Log In</button>
  </form>

  <?php if (!empty($errorMsg)): ?>
    <div class="error"><?= htmlspecialchars($errorMsg) ?></div>
  <?php endif; ?>

  <div class="signup-link">
    Don't have an account? <a href="signup.php">Sign Up</a>
  </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
