<style>
  .bb-footer {
  width: 100%;
  max-width: 100%;
  background: #012055;
  color: #fff;
  padding: 2rem 0 1rem 0;
  font-family: Arial, sans-serif;
  box-sizing: border-box;
}

.bb-footer-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 2rem;
}

.bb-footer-col {
  flex: 1 1 220px;
  min-width: 160px;
  display: flex;
  flex-direction: column;
  gap: 0.7rem;
}

.bb-footer-logo img {
  height: 50px;
  margin-bottom: 1rem;
}

.bb-footer-col h4 {
  margin: 0 0 0.7rem 0;
  color: #fff;
  font-size: 1.1rem;
  font-weight: bold;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.bb-footer-col ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.bb-footer-col ul li {
  margin-bottom: 0.5rem;
  font-size: 1rem;
  color: #dbe7fa;
  font-weight: 500;
  letter-spacing: 0.2px;
}

.bb-footer-col a {
  color: #dbe7fa;
  text-decoration: none;
  font-size: 1rem;
  font-weight: 500;
  transition: color 0.2s;
}

.bb-footer-col a:hover {
  color: #fff;
  text-decoration: underline;
}

.bb-footer-col p {
  margin: 0;
  font-size: 1rem;
  color: #dbe7fa;
  font-weight: 500;
  letter-spacing: 0.2px;
}

.bb-footer-social {
  display: flex;
  gap: 0.7rem;
  font-size: 1.3rem;
}

.bb-footer-social a {
  color: #dbe7fa;
  transition: color 0.2s;
}

.bb-footer-social a:hover {
  color: #fff;
}

.bb-footer-bottom {
  text-align: center;
  color: #b3c4dd;
  font-size: 1rem;
  margin-top: 2rem;
  letter-spacing: 0.5px;
  font-weight: 500;
}

@media (max-width: 900px) {
  .bb-footer-container {
    flex-direction: column;
    gap: 1.5rem;
    align-items: center;
    text-align: center;
  }
  .bb-footer-col {
    align-items: center;
    text-align: center;
  }
  .bb-footer-social {
    justify-content: center;
  }
}
</style>
<footer class="bb-footer">
  <div class="bb-footer-container">
    <div class="bb-footer-col">
      <a href="home.php" class="bb-footer-logo">
        <img src="images/Logo.png" alt="Ballot Buzz Logo">
      </a>
      <p>
        Ballot Buzz is dedicated to providing transparent, accessible, and up-to-date election information for everyone.
      </p>
    </div>
    <div class="bb-footer-col">
      <h4>Contact</h4>
      <ul>
        <li><strong>Email:</strong> <a href="mailto:info@ballotbuzz.com">info@ballotbuzz.com</a></li>
        <li><strong>Phone:</strong> <a href="tel:+1555652258">+1 555 652 258</a></li>
        <li><strong>Address:</strong> 123 Main Street, City, Country</li>
      </ul>
    </div>
    <div class="bb-footer-col">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="guides.php">Guides</a></li>
        <li><a href="candidates.php">Candidates</a></li>
        <li><a href="report.php">Report Issue</a></li>
      </ul>
    </div>
    <div class="bb-footer-col">
      <h4>Follow Us</h4>
      <div class="bb-footer-social">
        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>
  <div class="bb-footer-bottom">
    &copy; <?php echo date('Y'); ?> Ballot Buzz. All rights reserved.
  </div>
</footer>
