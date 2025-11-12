<?php
$pageTitle = 'Report Issue';
$activePage = 'report';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="styles.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($pageTitle) ?></title>

  <style>
    * { box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f5f5f5;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1;
      display: flex;
      padding: 2rem;
      gap: 2rem;
    }

    .left-panel {
      flex: 1;
      background: #cfd8e6;
      padding: 1.5rem;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      min-width: 320px;
    }
    .left-panel h2 {
      margin: 0 0 1rem 0;
      color: #012055;
    }

    .tabs {
      display: flex;
      gap: 1rem;
      margin-bottom: 1rem;
    }
    .tab {
      flex: 1;
      padding: 0.7rem;
      background: white;
      text-align: center;
      font-weight: bold;
      color: #012055;
      border-radius: 5px;
      cursor: pointer;
      user-select: none;
      box-shadow: 0 0 4px rgba(0,0,0,0.1);
    }
    .tab.active {
      background: #012055;
      color: white;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    label {
      font-weight: bold;
      color: #0a2e5c;
    }
    input[type="text"],
    select,
    input[type="time"] {
      padding: 0.5rem;
      border-radius: 5px;
      border: 1px solid #999;
      width: 100%;
    }

    .time-container {
      display: flex;
      gap: 0.5rem;
      align-items: center;
    }

    .right-panel {
      flex: 1.2;
      background: #cfd8e6;
      padding: 1.5rem;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
    }
    .right-panel h2 {
      color: #012055;
      margin-bottom: 0.8rem;
    }

    textarea {
      flex: 1;
      padding: 1rem;
      border-radius: 5px;
      border: 1px solid #999;
      resize: vertical;
      min-height: 200px;
      font-size: 1rem;
      font-family: Arial, sans-serif;
    }

    .buttons-row {
      margin-top: 1rem;
      display: flex;
      gap: 1rem;
      justify-content: flex-start;
      flex-wrap: wrap;
    }
    .buttons-row button { flex: 1 1 180px; }
    button {
      background-color: #012055;
      color: white;
      border: none;
      padding: 0.7rem 1.5rem;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s;
    }
    button:hover { background-color: #0141b8; }

    .reports-list {
      background: white;
      padding: 1rem;
      border-radius: 6px;
      flex: 1;
      overflow-y: auto;
      box-shadow: 0 0 8px rgb(0 0 0 / 0.1);
    }
    .report-item {
      border-bottom: 1px solid #ddd;
      padding: 0.5rem 0;
    }
    .report-item:last-child { border-bottom: none; }
    .report-status {
      font-weight: bold;
      font-size: 0.9rem;
      padding: 0.2rem 0.5rem;
      border-radius: 4px;
      color: white;
      display: inline-block;
      margin-left: 0.5rem;
    }
    .status-inprogress { background-color: #f0ad4e; }
    .status-resolved { background-color: #5cb85c; }
    .status-pending  { background-color: #d9534f; }

    /* Responsive */
    @media (max-width: 768px) {
      main { flex-direction: column; padding: 1rem; }
      .left-panel, .right-panel { min-width: auto; }
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
  </style>
</head>
<body>
<?php require_once __DIR__ . '/header.php'; ?>

<main>
  <div class="left-panel">
    <h2>Report Issue</h2>

    <div class="tabs">
      <div class="tab active" id="createTab">Create Report</div>
      <div class="tab" id="myReportsTab">My Reports</div>
    </div>

    <form id="reportForm">
      <label for="location">Location</label>
      <input type="text" id="location" name="location" placeholder="Enter location" />

      <label for="time">Time</label>
      <div class="time-container">
        <input type="time" id="time" name="time" />
        <select id="ampm" name="ampm" aria-label="AM or PM">
          <option value="AM">AM</option>
          <option value="PM">PM</option>
        </select>
      </div>

      <label for="issueType">Type of Issue</label>
      <input type="text" id="issueType" name="issueType" placeholder="Enter issue type" />
    </form>

    <div class="reports-list" id="myReports" style="display:none;">
      <div class="report-item">
        <strong>Issue with voting machine</strong>
        <span class="report-status status-inprogress">In Progress</span>
        <p>Reported at Barangay Hall</p>
      </div>
      <div class="report-item">
        <strong>Long queue at polling station</strong>
        <span class="report-status status-resolved">Resolved</span>
        <p>Reported at City Hall</p>
      </div>
      <div class="report-item">
        <strong>Confusing ballot design</strong>
        <span class="report-status status-pending">Pending</span>
        <p>Reported at Community Center</p>
      </div>
    </div>
  </div>

  <div class="right-panel">
    <h2>Description</h2>
    <textarea id="description" placeholder="Describe the problem in detail..."></textarea>
    <div class="buttons-row">
      <button type="button" id="photoBtn">Submit Photo</button>
      <button type="button" id="sendBtn">Send</button>
    </div>
  </div>
</main>

<script>
  const createTab   = document.getElementById('createTab');
  const myReportsTab = document.getElementById('myReportsTab');
  const form        = document.getElementById('reportForm');
  const myReports   = document.getElementById('myReports');
  const description = document.getElementById('description');
  const sendBtn     = document.getElementById('sendBtn');

  function loadReports() {
    myReports.innerHTML = '';
    const reports = JSON.parse(localStorage.getItem('reports') || '[]');
    if (reports.length === 0) {
      myReports.innerHTML = '<p>No reports yet.</p>';
      return;
    }
    reports.forEach(r => {
      const div = document.createElement('div');
      div.className = 'report-item';
      div.innerHTML = `
        <strong>${r.issueType || 'Unnamed Issue'}</strong>
        <span class="report-status status-pending">Pending</span>
        <p>Reported at ${r.location || 'Unknown location'} - ${r.time} ${r.ampm}</p>
        <p>${r.description}</p>
      `;
      myReports.appendChild(div);
    });
  }

  createTab.addEventListener('click', () => {
    createTab.classList.add('active');
    myReportsTab.classList.remove('active');
    form.style.display = 'flex';
    myReports.style.display = 'none';
  });

  myReportsTab.addEventListener('click', () => {
    myReportsTab.classList.add('active');
    createTab.classList.remove('active');
    form.style.display = 'none';
    myReports.style.display = 'block';
    loadReports();
  });

  sendBtn.addEventListener('click', () => {
    const location = document.getElementById('location').value.trim();
    const time = document.getElementById('time').value;
    const ampm = document.getElementById('ampm').value;
    const issueType = document.getElementById('issueType').value.trim();
    const desc = description.value.trim();

    if (!location || !time || !issueType || !desc) {
      alert('Please fill out all fields.');
      return;
    }

    const report = { location, time, ampm, issueType, description: desc };
    const reports = JSON.parse(localStorage.getItem('reports') || '[]');
    reports.push(report);
    localStorage.setItem('reports', JSON.stringify(reports));

    alert('Report submitted successfully!');
    form.reset();
    description.value = '';
  });

  document.getElementById('photoBtn').addEventListener('click', () => {
    alert('Photo upload feature coming soon!');
  });
</script>


<?php require_once __DIR__ . '/footer.php'; ?>
</body>
</html>