<?php
$pageTitle = 'Ballot BUZZ - Home';
$activePage = 'home';

$pageStyles = <<<CSS
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  width: 100vw;
  min-width: 100vw;
  max-width: 100vw;
  overflow-x: hidden;
}

body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  width: 100%;
  overflow-x: hidden;
}

nav a.active { 
  background-color: white; 
  color: #0a2e5c; 
  padding: 0.3rem 0.6rem; 
  border-radius: 5px; 
}

main { 
  flex: 1; 
  padding: 1.5rem; 
  width: 100vw;
  min-width: 100vw;
  max-width: 100vw;
}

.top-row { 
  display: flex; 
  gap: 1rem; 
  margin-bottom: 1rem; 
  flex-wrap: wrap; 
}

.updates, .presentation, .alerts { 
  background-color: #cfd8e6; 
  padding: 20px; 
  border-radius: 3px; 
  text-align: center; 
}

.updates, .alerts { 
  flex: 1; 
  min-height: 200px; 
}

.alerts { 
  min-height: 300px;
}

.presentation { 
  flex: 2; 
  min-height: 200px; 
  font-weight: bold; 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  position: relative; 
  overflow: hidden; 
  border-radius: 5px; 
}

.presentation iframe { 
  position: absolute; 
  top: 0; 
  left: 0; 
  width: 100%; 
  height: 100%; 
  border: none; 
  border-radius: 5px; 
}

.alert-box { 
  background-color: white; 
  padding: 0.5rem; 
  margin-top: 1.5rem; 
  display: flex; 
  align-items: center; 
  border-radius: 5px; 
}

.alert-box span { 
  font-size: 1.2rem; 
  margin-right: 0.5rem; 
  color: orange; 
}

.text-row { 
  background-color: #cfd8e6; 
  padding: 0.7rem 1rem; 
  text-align: center; 
  font-weight: bold; 
  border-radius: 5px; 
  max-width: 600px; 
  margin: 0 auto 1rem auto; 
  margin-top: 50px;
  margin-bottom: 50px;
}

.button-row { 
  display: flex; 
  justify-content: center; 
  gap: 1rem; 
  margin-top: 50px;
  margin-bottom: 2rem; 
  flex-wrap: wrap; 
}

.button-row div { 
  background-color: #cfd8e6; 
  padding: 3rem; 
  text-align: center; 
  font-weight: bold; 
  border-radius: 5px; 
  width: 200px; 
  cursor: pointer; 
  transition: background 0.3s; 
}

.button-row div:hover { 
  background-color: #b3c4dd; 
}

@media (max-width: 1440px) {
  .top-row { 
    flex-direction: row; 
  }
  .button-row div {
    width: 100%;
    min-width: 320px;
  }
}

@media (max-width: 1024px) {
  .top-row { 
    flex-direction: row; 
  }
  .button-row div {
    width: 100%;
    min-width: 320px;
  }
}

@media (max-width: 430px) {
  .top-row { 
    flex-direction: column; 
    gap: 0;
    margin: 0;
  }
  .updates, .presentation, .alerts {
    flex: 1;
    width: 100%;
    min-width: 100%;
    margin: 0;
    border-radius: 0;
  }
  .presentation {
    flex: 1;
  }
  .button-row div {
    width: 100%;
    min-width: 100%;
    padding: 2rem;
    margin: 0;
    border-radius: 0;
  }
  main {
    padding: 0;
    margin: 0;
  }
  .text-row {
    margin: 1rem 0;
    border-radius: 0;
  }
  .button-row {
    margin: 1rem 0;
    gap: 0;
  }
}

@media (max-width: 300px) {
  html, body {
    margin: 0;
    padding: 0;
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
    overflow-x: hidden;
  }
  
  main {
    padding: 0;
    margin: 0;
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
  }
  
  .top-row {
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
    margin: 0;
    padding: 0;
  }
  
  .updates, .presentation, .alerts {
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
    margin: 0;
    padding: 15px;
    border-radius: 0;
    box-sizing: border-box;
  }
  
  .text-row {
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
    margin: 0.5rem 0;
    border-radius: 0;
    box-sizing: border-box;
  }
  
  .button-row {
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
    margin: 0.5rem 0;
    gap: 0;
  }
  
  .button-row div {
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
    margin: 0;
    padding: 1.5rem;
    border-radius: 0;
    box-sizing: border-box;
  }
  
  
  .updates *, .presentation *, .alerts *, .text-row *, .button-row * {
    max-width: 100vw;
    width: auto;
  }
}

@media (max-width: 200px) {
  html, body, main, .top-row, .updates, .presentation, .alerts, .text-row, .button-row, .button-row div {
    width: 100vw;
    min-width: 100vw;
    max-width: 100vw;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  .updates, .presentation, .alerts {
    padding: 10px;
  }
  
  .button-row div {
    padding: 1rem;
  }
}
CSS;

include __DIR__ . '/header.php';
?>

<main>
  <div class="top-row">
      <div class="updates">
      <h3 style="color: #012055; font-weight: bold; margin-top: 1px;">Updates</h3>
      <a href="https://www.gmanetwork.com/news/topstories/nation/905743/comelec-over-2-5-million-new-voters-registered-for-2025-polls/story/" target="_blank" style="text-decoration:none; color: inherit;">
        <img src="https://images.gmanews.tv/webpics/2024/03/comelec1_2024_03_05_10_31_20.jpg" alt="Comelec News" style="width:100%; border-radius: 5px;" />
        <p style="margin-top: 0.5rem; font-weight: bold; color: #0a2e5c;">
          Comelec: <span style="color: #d9534f;">Over 2.5 million new voters</span> registered for 2025 polls<br>
          <small style="color: #6c757d;">By GMA Integrated News<br>Published May 5, 2024 9:00am</small>
        </p>
      </a>
  </div>

    <div class="presentation">
      <iframe src="https://www.youtube.com/embed/pfjT0uBXV08?start=14" title="8 Hakbang sa Pagboto" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="alerts">
      <h3>Live Alerts & Reminders</h3>
      <div class="alert-box"><span>⚠️</span> Polling stations will open at 6:00 AM.</div>
      <div class="alert-box"><span>⚠️</span> Bring a valid government-issued ID on voting day.</div>
      <div class="alert-box"><span>⚠️</span> Deadline for absentee voting registration: Sept 15, 2025.</div>
      <div class="alert-box"><span>⚠️</span> Avoid wearing campaign shirts inside polling places.</div>
      <div class="alert-box"><span>⚠️</span> If your voting machine is broken, inform the election officer immediately for assistance.</div>
    </div>
  </div>

  <div class="text-row">Welcome to <span style="color: #0a2e5c;">Ballot BUZZ!</span> Stay informed, get the latest election updates, and access helpful guides to make your voting experience smooth and secure.</div>

  <div class="button-row">
    <div onclick="location.href='candidates.php'">View Candidates</div>
    <div onclick="location.href='guides.php'">Download Guides ⬇</div>
    <div onclick="location.href='report.php'">Report Issue</div>
  </div>

</main>

<?php include __DIR__ . '/footer.php'; ?>