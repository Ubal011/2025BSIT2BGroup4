<?php
// --- SIGNUP BACKEND ---
// This is just a demo backend using PHP session (not database).
// In a real project, you’d connect to a database here.

session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $age = intval($_POST["age"]);
    $birthday = $_POST["birthday"];
    $address = trim($_POST["address"]);
    $validId = $_POST["valid_id"];
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (!$fullname || !$age || !$birthday || !$address || !$validId || !$username || !$password) {
        $error = "Please fill in all fields.";
    } elseif ($age < 1) {
        $error = "Age must be at least 1.";
    } elseif (isset($_SESSION["users"][$username])) {
        $error = "Username already taken.";
    } else {
        // Save in session (temporary storage)
        $_SESSION["users"][$username] = [
            "fullname" => $fullname,
            "age" => $age,
            "birthday" => $birthday,
            "address" => $address,
            "validId" => $validId,
            "password" => $password
        ];

        header("Location: login.php?registered=1");
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
  <title>Ballot BUZZ - Sign Up</title>
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
      margin-bottom: 1rem;
    }
    input, select {
      width: 100%;
      padding: 0.5rem;
      margin: 0.4rem 0 1rem 0;
      border-radius: 0.5rem;
      border: none;
    }
    button {
      width: 100%;
      background-color: #003b99;
      color: white;
      padding: 0.7rem;
      font-size: 1rem;
      border: none;
      border-radius: 0.5rem;
      cursor: pointer;
    }
    .error {
      color: #f44336;
      margin-bottom: 1rem;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Sign Up</h1>
    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="signup.php">
      <input type="text" name="fullname" placeholder="Full Name" required />
      <input type="number" name="age" placeholder="Age" min="1" required />
      <input type="date" name="birthday" placeholder="Birthday" required />
      <input type="text" name="address" placeholder="Address" required />
      <select name="valid_id" required>
        <option value="">Select Valid ID</option>
        <option>National ID</option>
        <option>Driver's License</option>
        <option>Senior Citizen</option>
        <option>Passport</option>
        <option>SSS ID</option>
      </select>
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Sign Up</button>
    </form>
  </div>
</body>
</html>
