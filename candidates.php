<?php
$pageTitle = 'Ballot Buzz - Candidates';
$activePage = 'candidates';
$pageStyles = <<<CSS
body { 
  font-family: Arial, sans-serif; 
  background-color: #f5f5f5; 
  margin: 0; 
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
  text-align: center; 
}
h1 { 
  color: #012055; 
  margin-bottom: 2rem; 
}
.search-container { 
  margin-bottom: 2rem; 
}
#search-input { 
  width: 100%; 
  max-width: 400px; 
  padding: 0.5rem 1rem; 
  font-size: 1rem; 
  border: 2px solid #012055; 
  border-radius: 25px; 
  outline: none; 
  transition: border-color 0.3s; 
  box-sizing: border-box; 
}
#search-input:focus { 
  border-color: #d9534f; 
}
.candidates-row { 
  display: flex; 
  justify-content: center; 
  gap: 2rem; 
  flex-wrap: wrap; 
}
.candidate-card { 
  background-color: #cfd8e6; 
  border-radius: 8px; 
  padding: 1rem; 
  box-shadow: 0 2px 6px rgba(0,0,0,0.1); 
  width: 300px; 
  display: flex; 
  flex-direction: column; 
  align-items: center; 
  text-align: center; 
  box-sizing: border-box; 
  min-height: 380px; 
  margin-top: 30px;
  margin-bottom: 70px;
  transition: transform 0.2s ease; 
  cursor: pointer; 
}
.candidate-card:hover { 
  transform: translateY(-5px); 
  box-shadow: 0 6px 12px rgba(0,0,0,0.15); 
}
.candidate-photo { 
  width: 120px; 
  height: 120px; 
  border-radius: 50%; 
  border: 4px solid #012055; 
  object-fit: cover; 
  margin-bottom: 1rem; 
  background-color: white; 
  flex-shrink: 0; 
}
.candidate-name { 
  font-size: 1.3rem; 
  font-weight: bold; 
  color: #012055; 
  margin-bottom: 0.3rem; 
}
.candidate-education { 
  font-size: 0.9rem; 
  font-style: italic; 
  margin-bottom: 0.7rem; 
  color: #333; 
}
.candidate-platform { 
  font-size: 1rem; 
  color: #0a2e5c; 
  flex-grow: 1; 
}
#prevBtn, #nextBtn {
  background-color: #012055;
  color: white;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  margin: 0 0.5rem;
  transition: background-color 0.3s, transform 0.2s;
}

#prevBtn:hover, #nextBtn:hover {
  background-color: #0141b8;
  transform: translateY(-2px);
}
CSS;

include __DIR__ . '/header.php';
?>

<main>
  <h1 style="margin-top: 50px;">Candidates</h1>
  <div class="search-container">
    <input type="text" id="search-input" placeholder="Search candidates by name or platform..." oninput="filterCandidates()" style="margin-top: 20px;" />
  </div>

  <div class="candidates-row" id="candidates-row"></div>

  <div style="text-align:center; margin-top: 20px;">
    <button id="prevBtn">Previous</button>
    <button id="nextBtn">Next</button>
  </div>
</main>

<!-- Candidate Modal -->
<div id="candidateModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
  <div style="background:white; padding:20px; border-radius:10px; max-width:400px; text-align:center;">
    <span id="closeModal" style="float:right; cursor:pointer; font-size:20px;">&times;</span>
    <img id="modalPhoto" src="" alt="" style="width:120px; height:120px; border-radius:50%; border:4px solid #012055; margin-bottom:1rem;">
    <h2 id="modalName"></h2>
    <p id="modalEducation" style="font-style:italic; color:#333;"></p>
    <p id="modalPlatform"></p>
  </div>
</div>

<script>
const candidates = [
  { name: "Gian Carlo", photo: "images/candidate1.png", education: "BS Computer Science", platform: "Supports digital literacy and youth empowerment." },
  { name: "Andrea Benitez", photo: "images/candidate2.png", education: "BA Communications", platform: "Advocates for transparency and student engagement." },
  { name: "Zara Medel", photo: "images/candidate3.png", education: "BS Education", platform: "Focuses on improving academic resources and inclusivity." },
  { name: "Kian Garcia", photo: "images/candidate2.png", education: "BS Mechanical Engineering", platform: "Promotes sustainable engineering projects on campus." },
  { name: "Dave Ditching", photo: "images/candidate3.png", education: "BS Business Administration", platform: "Encourages entrepreneurship and leadership programs." },
  { name: "Jane Doe", photo: "images/candidate1.png", education: "B.A. Political Science", platform: "Focuses on education reform and climate change policies." }
];

let currentIndex = 0;
const cardsPerPage = 3;
const row = document.getElementById("candidates-row");

function getFilteredCandidates() {
  const input = document.getElementById("search-input").value.toLowerCase();
  return candidates.filter(c =>
    c.name.toLowerCase().includes(input) ||
    c.platform.toLowerCase().includes(input) ||
    c.education.toLowerCase().includes(input)
  );
}

function renderCards() {
  row.innerHTML = "";
  const filtered = getFilteredCandidates();

  const slice = filtered.slice(currentIndex, currentIndex + cardsPerPage);
  slice.forEach(c => {
    const card = document.createElement("div");
    card.className = "candidate-card";
    card.innerHTML = `
      <img src="${c.photo}" alt="${c.name}" class="candidate-photo" />
      <div class="candidate-name">${c.name}</div>
      <div class="candidate-education">${c.education}</div>
      <div class="candidate-platform">${c.platform}</div>
    `;
    card.addEventListener("click", () => openModal(c));
    row.appendChild(card);
  });

  // Disable/enable buttons depending on available results
  document.getElementById("prevBtn").disabled = currentIndex === 0;
  document.getElementById("nextBtn").disabled = currentIndex + cardsPerPage >= filtered.length;
}

document.getElementById("nextBtn").addEventListener("click", () => {
  const filtered = getFilteredCandidates();
  if (currentIndex + cardsPerPage < filtered.length) {
    currentIndex += cardsPerPage;
    renderCards();
  }
});

document.getElementById("prevBtn").addEventListener("click", () => {
  if (currentIndex - cardsPerPage >= 0) {
    currentIndex -= cardsPerPage;
    renderCards();
  }
});

// Re-render when typing in search
document.getElementById("search-input").addEventListener("input", () => {
  currentIndex = 0; // reset to first page on new search
  renderCards();
});

// Modal functions
function openModal(c) {
  document.getElementById("modalPhoto").src = c.photo;
  document.getElementById("modalName").textContent = c.name;
  document.getElementById("modalEducation").textContent = c.education;
  document.getElementById("modalPlatform").textContent = c.platform;
  document.getElementById("candidateModal").style.display = "flex";
}

document.getElementById("closeModal").addEventListener("click", () => {
  document.getElementById("candidateModal").style.display = "none";
});

window.onclick = function(event) {
  const modal = document.getElementById("candidateModal");
  if (event.target === modal) {
    modal.style.display = "none";
  }
};

// Initial render
renderCards();
</script>




<?php include __DIR__ . '/footer.php'; ?>