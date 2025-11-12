<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }


$pageTitle = isset($pageTitle) ? $pageTitle : 'Ballot BUZZ';
$activePage = isset($activePage) ? $activePage : '';
$pageStyles = isset($pageStyles) ? $pageStyles : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="footer.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <?php if (!empty($pageStyles)) { echo "<style>\n" . $pageStyles . "\n</style>\n"; } ?>
</head>
<body>
<header>
  <div class="logo-container">
    <img src="images/Logo.png" alt="Ballot Buzz Logo" class="logo">
  </div>
  <button id="hamburger"><i class="fas fa-bars"></i></button>
  
  <nav>
    <a href="index.php" class="<?php echo $activePage === 'index' ? 'active' : ''; ?>">Home</a>
    <a href="report.php" class="<?php echo $activePage === 'report' ? 'active' : ''; ?>">Report Issue</a>
    <a href="guides.php" class="<?php echo $activePage === 'guides' ? 'active' : ''; ?>">Guides</a>
    <a href="candidates.php" class="<?php echo $activePage === 'candidates' ? 'active' : ''; ?>">Candidates</a>

    <?php if (isset($_SESSION['current_user'])): ?>
        <!-- ✅ If logged in, show Logout -->
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <!-- 🟡 If not logged in, show Login -->
        <a href="login.php" class="<?php echo $activePage === 'login' ? 'active' : ''; ?>">Login</a>
    <?php endif; ?>
  </nav>
</header>

<script>
const hamburger = document.getElementById('hamburger');
const nav = document.querySelector('header nav');

hamburger.addEventListener('click', () => {
  nav.classList.toggle('active');
});
</script>
