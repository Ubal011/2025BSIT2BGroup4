<?php
  // Header include for Ballot Buzz
  // Expected variables (optional):
  // - $pageTitle: string for <title>
  // - $activePage: one of 'home', 'report', 'guides', 'candidates', 'login'
  // - $pageStyles: string of additional CSS to inject into <head>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2Pkf6N5s8F8Hv2VQF5VbQZ1YUg1nTQ6Xo8XrYq+Q0tLdLu2vCw8KqYx4Yg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <?php if (!empty($pageStyles)) { echo "<style>\n" . $pageStyles . "\n</style>\n"; } ?>
</head>
<body>
  <header>
    <div>
      <img src="images/Logo.png" alt="Ballot Buzz Logo" style="max-height: 80px;">
    </div>
    <nav>
      <a href="home.php" class="<?php echo $activePage === 'home' ? 'active' : ''; ?>">Home</a>
      <a href="report.php" class="<?php echo $activePage === 'report' ? 'active' : ''; ?>">Report Issue</a>
      <a href="guides.php" class="<?php echo $activePage === 'guides' ? 'active' : ''; ?>">Guides</a>
      <a href="candidates.php" class="<?php echo $activePage === 'candidates' ? 'active' : ''; ?>">Candidates</a>
      <a href="login.php" class="<?php echo $activePage === 'login' ? 'active' : ''; ?>">Log Out</a>
    </nav>
  </header>


