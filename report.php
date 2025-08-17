<!DOCTYPE html>
<html lang="en">
<head> <link rel="stylesheet" href="styles.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ballot BUZZ - Report Issue</title>
  <style>
    /* Reset & basic */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f5f5f5;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    header {
      background: #012055;
      padding: 0.5rem 2rem;
      display: flex;
      align-items: center;
    }
    header img {
      height: 60px;
    }

    main {
      flex: 1;
      display: flex;
      padding: 2rem;
      gap: 2rem;
    }

    /* Left side container */
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

    /* Tabs for Create Report and My Reports */
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

    /* Form */
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

    /* Time and AM/PM select container */
    .time-container {
      display: flex;
      gap: 0.5rem;
      align-items: center;
    }

    /* Right side container */
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

    /* Buttons below textarea */
    .buttons-row {
      margin-top: 1rem;
      display: flex;
      gap: 1rem;
      justify-content: flex-start;
    }

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
    button:hover {
      background-color: #0141b8;
    }

    /* My Reports list */
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
    .report-item:last-child {
      border-bottom: none;
    }
    .report-status {
      font-weight: bold;
      font-size: 0.9rem;
      padding: 0.2rem 0.5rem;
      border-radius: 4px;
      color: white;
      display: inline-block;
      margin-left: 0.5rem;
    }
    .status-inprogress {
      background-color: #f0ad4e;
    }
    .status-resolved {
      background-color: #5cb85c;
    }
    .status-pending {
      background-color: #d9534f;
    }
  </style>
</head>
<body>
  <header>
  <div>
    <img src="C:\Web Ballot Buzz\Logo.png" alt="Logo" style="max-height: 80px;">
  </div>
  <nav>
    <a href="home.php">Home</a>
    <a href="report.php" class="active">Report Issue</a>
    <a href="guides.php">Guides</a>
    <a href="candidates.php">Candidates</a>
    <a href="login.php">Log Out</a>
  </nav>
</header>

<style>
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


  <main>
    <div class="left-panel">
      <h2>Report Issue</h2>

      <div class="tabs">
        <div class="tab active" id="createTab">Create Report</div>
        <div class="tab" id="myReportsTab">My Reports</div>
      </div>

      <!-- Create Report Form -->
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

      <!-- My Reports List - initially hidden -->
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
    // Tab switching logic
    const createTab = document.getElementById('createTab');
    const myReportsTab = document.getElementById('myReportsTab');
    const form = document.getElementById('reportForm');
    const myReports = document.getElementById('myReports');

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
    });

    // Photo button - just a placeholder, can be connected to file input later
    document.getElementById('photoBtn').addEventListener('click', () => {
      alert('Photo upload feature coming soon!');
    });

    // Send button - just placeholder
    document.getElementById('sendBtn').addEventListener('click', () => {
      alert('Report sent! (Functionality not implemented)');
    });
  </script>

</body>
</html>
