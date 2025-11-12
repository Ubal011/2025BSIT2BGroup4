<?php
$pageTitle = 'Ballot BUZZ - Sign Up';
$activePage = 'signup';

$pageStyles = <<<CSS
/* your CSS unchanged */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #001a3d;
  background-image: url('images/Bbuzzbg.png');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  color: white;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.bb-footer {
  margin-top: auto;
}

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

body > .container-wrapper {
  display: flex;
  justify-content: center; 
  align-items: center;
  flex-grow: 1;
  padding: 2rem;
  position: relative;
}

.container-wrapper::before,
.container-wrapper::after {
  content: '';
  position: absolute;
  width: 500px;
  height: 500px;
  background: rgba(255, 255, 255, 0.05);
  transform: rotate(8deg);
  z-index: 0;
}
.container-wrapper::after {
  transform: rotate(-8deg);
  background: rgba(255, 255, 255, 0.08);
}

.container {
  background-color: rgba(0, 0, 0, 0.7);
  padding: 2.5rem 3rem;
  border-radius: 1rem;
  box-shadow: 0 0 20px rgba(0,0,0,0.6);
  width: clamp(800px, 75vw, 1000px);
  max-width: 95vw;
  text-align: center;
  position: relative;
  z-index: 1;
}

input, select {
  width: 100%;
  height: 48px;
  padding: 0 1rem;
  margin: 0.5rem 0;
  border-radius: 50px;
  border: none;
  outline: none;
  font-size: 1rem;
}

button {
  width: 100%;
  height: 48px;
  background-color: #0045cc;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 50px;
  cursor: pointer;
  transition: background 0.3s ease;
}

@media (max-width: 430px) {
  body {
    background-image: url('images/phonebbuzz.png');
  }

  .container-wrapper {
    justify-content: center;
    align-items: flex-start;
    padding: 1rem;
  }

  .container-wrapper::before,
  .container-wrapper::after {
    display: none; 
  }

  .container {
    width: 100%;
    max-width: 360px;
    padding: 1.5rem;
    margin: 2rem auto; 
  }

  input, select, button {
    width: 100%; 
    font-size: 0.95rem;
  }
}
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

<div class="container-wrapper">
  <div class="container">
    <h1>Sign Up</h1>
    <form method="post" action="signup_process.php">
      <input type="text" name="fullname" placeholder="Full Name" required />
      <input type="number" name="age" placeholder="Age" min="1" required />
      <input type="date" name="birthday" placeholder="Birthday" required />
      <input type="text" name="address" placeholder="Address" required />
      <select name="validId" required>
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
</div>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>