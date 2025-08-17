<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (!$username || !$password) {
        $error = "Please enter username and password.";
    } elseif (!isset($_SESSION["users"][$username])) {
        $error = "User not found. Please sign up.";
    } elseif ($_SESSION["users"][$username]["password"] !== $password) {
        $error = "Incorrect password.";
    } else {
        // Login success → redirect to homepage
        $_SESSION["logged_in_user"] = $username;
        header("Location: home.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <link rel="stylesheet" href="styles.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ballot BUZZ - Login</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url("https://i.im.ge/2025/08/11/JxP26M.bbuzz.png");
      background-size: cover;
      background-position: center;
      color: white;
      display: flex;
      height: 100vh;
      align-items: center;
      justify-content: center;
    }
    .container {
      background-color: rgba(26, 26, 46, 0.95);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.5);
      width: 350px;
      margin-left: auto;
      margin-right: 20vw;
    }
    h1 {
      text-align: center;
      margin-bottom: 1.5rem;
    }
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
    .error {
      color: #f44336;
      font-weight: bold;
      margin-top: 1rem;
      text-align: center;
    }
    .signup-link {
      margin-top: 1rem;
      text-align: center;
    }
    .signup-link a {
      color: #00bfff;
      text-decoration: none;
    }
  </style>
</head>
<body>
  
  <div class="container">
    <h1>Log In</h1>
    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Log In</button>
    </form>
    <div class="signup-link">
      Don't have an account? <a href="signup.php">Sign Up</a>
    </div>
  </div>
</body>
</html>
