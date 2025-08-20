<?php
$pageTitle = 'Ballot Buzz - Voting Guides';
$activePage = 'guides';
$pageStyles = <<<CSS
body { 
  font-family: Arial, sans-serif; 
  background-color: #f5f5f5; 
  margin: 0; 
  padding: 0; 
  display: flex; 
  flex-direction: column; 
  min-height: 100vh; 
}
nav a.active { 
  background-color: white; 
  color: #0a2e5c; 
  padding: 0.3rem 0.6rem; 
  border-radius: 5px; 
}
main { 
  flex: 1; 
  padding: 2rem; 
  max-width: 1200px; 
  margin: 0 auto; 
}
h1 { 
  color: #012055; 
  text-align: center; 
  margin-bottom: 2rem; 
}
.columns { 
  display: flex; 
  gap: 2rem; 
  justify-content: space-between; 
  flex-wrap: wrap; 
}
.column { 
  flex: 1 1 30%; 
  display: flex; 
  flex-direction: column; 
  gap: 1.5rem; 
}
.guide-box { 
  background-color: #cfd8e6; 
  padding: 1rem; 
  border-radius: 5px; 
  text-align: center; 
  box-shadow: 0 2px 6px rgba(0,0,0,0.1); 
}
.video-placeholder { 
  width: 100%; 
  height: 180px; 
  border: 3px dashed #012055; 
  border-radius: 5px; 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  color: #012055; 
  font-weight: bold; 
  font-size: 1.1rem; 
  user-select: none; 
}
ul.download-list { 
  list-style-type: none; 
  padding-left: 0; 
  text-align: left; 
  max-width: 100%; 
  margin: 0 auto; 
}
ul.download-list li { 
  margin: 0.5rem 0; 
}
ul.download-list li a { 
  color: #012055; 
  font-weight: bold; 
  text-decoration: none; 
}
ul.download-list li a:hover { 
  text-decoration: underline; 
}
audio { 
  width: 100%; 
  outline: none; 
  margin-top: 1rem; 
  border-radius: 5px; 
}
 
@media (max-width: 900px) { 
  .columns { 
    flex-direction: column; 
  } 
  .column { 
    flex: 1 1 100%; 
  } 
}
CSS;

// Include the header
include __DIR__ . '/header.php';
?>

<main>
  <h1>Voting Guides</h1>
  <div class="columns">
    <div class="column" id="video-column">
      <section class="guide-box">
        <h2>🎥 Video Guide 1</h2>
        <div class="video-placeholder">Video Player Placeholder</div>
      </section>
      <section class="guide-box">
        <h2>🎥 Video Guide 2</h2>
        <div class="video-placeholder">Video Player Placeholder</div>
      </section>
    </div>
    <div class="column" id="download-column">
      <section class="guide-box">
        <h2>📥 Downloadable File 1</h2>
        <ul class="download-list">
          <li><a href="files/voting-guide.pdf" download>Voting Guide PDF</a></li>
        </ul>
      </section>
      <section class="guide-box">
        <h2>📥 Downloadable File 2</h2>
        <ul class="download-list">
          <li><a href="files/sample-ballot.pdf" download>Sample Ballot PDF</a></li>
        </ul>
      </section>
    </div>
    <div class="column" id="audio-column">
      <section class="guide-box">
        <h2>🔊 Audio Guide 1</h2>
        <audio controls>
          <source src="audio/voting-guide1.mp3" type="audio/mpeg" />
          Your browser does not support the audio element.
        </audio>
      </section>
      <section class="guide-box">
        <h2>🔊 Audio Guide 2</h2>
        <audio controls>
          <source src="audio/voting-guide2.mp3" type="audio/mpeg" />
          Your browser does not support the audio element.
        </audio>
      </section>
    </div>
  </div>
</main>

<?php
// Include the footer
include __DIR__ . '/footer.php';
?>