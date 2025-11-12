<?php
session_start();
$pageTitle = 'Ballot BUZZ - Registration Receipt';

// Load session data
$receiptData = $_SESSION['receipt'] ?? [];

$fullname = $receiptData['fullname'] ?? '';
$age = $receiptData['age'] ?? '';
$birthday = $receiptData['birthday'] ?? '';
$address = $receiptData['address'] ?? '';
$validId = $receiptData['validId'] ?? '';
$username = $receiptData['username'] ?? '';
$password = $receiptData['password'] ?? '';

// Optional: clear session receipt so it doesn’t reload on refresh
unset($_SESSION['receipt']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: url('images/Bbuzzbg.png') no-repeat center center/cover;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
      z-index: 0;
    }

    .receipt-container {
      position: relative;
      z-index: 1;
      background: rgba(0, 0, 0, 0.85);
      padding: 2rem 2.2rem;
      border-radius: 0.8rem;
      box-shadow: 0 6px 20px rgba(0,0,0,0.7);
      max-width: 420px;
      width: 100%;
      color: #f5f5f5;
      text-align: left;
      animation: fadeIn 0.8s ease-in-out;
    }

    h1 {
      text-align: center;
      margin-bottom: 1.5rem;
      font-size: 1.6rem;
      color: #66b3ff;
      letter-spacing: 1px;
      text-shadow: 0 2px 6px rgba(0,0,0,0.6);
    }

    .receipt-item {
      margin: 0.8rem 0;
      padding: 0.7rem;
      background: rgba(255, 255, 255, 0.05);
      border-left: 3px solid #66b3ff;
      border-radius: 6px;
      font-size: 0.95rem;
      line-height: 1.4;
    }

    .receipt-item strong {
      display: inline-block;
      width: 110px;
      color: #99d0ff;
    }

    .login-button {
      display: block;
      width: 100%;
      margin-top: 1.5rem;
      padding: 0.8rem;
      background: #0045cc;
      color: white;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 40px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="receipt-container">
    <h1>Registration Receipt</h1>

    <div class="receipt-item"><strong>Full Name:</strong> <?= htmlspecialchars($fullname) ?></div>
<div class="receipt-item"><strong>Age:</strong> <?= htmlspecialchars($age) ?></div>
<div class="receipt-item"><strong>Birthday:</strong> <?= htmlspecialchars($birthday) ?></div>
<div class="receipt-item"><strong>Address:</strong> <?= htmlspecialchars($address) ?></div>
<div class="receipt-item"><strong>Valid ID:</strong> <?= htmlspecialchars($validId) ?></div>
<div class="receipt-item"><strong>Username:</strong> <?= htmlspecialchars($username) ?></div>
<div class="receipt-item"><strong>Password:</strong> <?= htmlspecialchars($password) ?></div>


    <form action="login.php" method="get">
      <button type="submit" class="login-button">Go to Login</button>
    </form>
  </div>
</body>
</html>
