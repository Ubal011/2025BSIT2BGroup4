<?php
session_start();
if (!isset($_SESSION['current_user']) || $_SESSION['current_user'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reports - Ballot BUZZ</title>
<style>
body { font-family: Arial, sans-serif; background-color: #f0f4fa; margin: 0; }
header { background-color: #012055; color: white; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
.container { background: white; margin: 2rem auto; padding: 1rem; border-radius: 8px; width: 90%; max-width: 800px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
.report-item { border-bottom: 1px solid #ddd; padding: 1rem 0; }
.report-item:last-child { border-bottom: none; }
.report-title { font-weight: bold; color: #012055; }
.nav-btn { background: #012055; color: white; padding: 0.5rem 1rem; border-radius: 5px; text-decoration: none; }
</style>
</head>
<body>
<header>
  <h2>Reports</h2>
  <nav>
    <a href="admin_dashboard.php" class="nav-btn">🏠 Dashboard</a>
   <a href="admin_dashboard.php" class="nav-btn">👥 Users</a>

  </nav>
</header>

<div class="container" id="reportsList">
  <p>Loading reports...</p>
</div>

<script>
// Display reports from localStorage
const reportsList = document.getElementById('reportsList');
const reports = JSON.parse(localStorage.getItem('reports') || '[]');

if (reports.length === 0) {
  reportsList.innerHTML = '<p>No reports submitted yet.</p>';
} else {
  reportsList.innerHTML = '';
  reports.forEach(r => {
    const div = document.createElement('div');
    div.className = 'report-item';
    div.innerHTML = `
      <div class="report-title">${r.issueType || 'Unnamed Issue'}</div>
      <p><strong>Location:</strong> ${r.location}</p>
      <p><strong>Time:</strong> ${r.time} ${r.ampm}</p>
      <p><strong>Description:</strong> ${r.description}</p>
    `;
    reportsList.appendChild(div);
  });
}
</script>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
