<?php
session_start();
if (!isset($_SESSION['current_user']) || $_SESSION['current_user'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include "db.php";

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $validId = $_POST['validId'];
    $username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        // Hash the password before storing
        $raw_password = $_POST['password'];
        $password = password_hash($raw_password, PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (fullname, age, birthday, address, validId, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssss", $fullname, $age, $birthday, $address, $validId, $username, $password, $role);
    $stmt->execute();
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add User</title>
<style>
    body { font-family: Arial; background: #f0f4fa; }
    .form-container { background: white; margin: 2rem auto; padding: 1rem; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 90%; max-width: 500px; }
    input, select, button { display: block; width: 100%; margin: 0.5rem 0; padding: 0.5rem; }
    button { background:#012055; color:white; border:none; cursor:pointer; border-radius:5px; }
</style>
</head>
<body>
<div class="form-container">
<h2>Add New User</h2>
<form method="POST">
    <input type="text" name="fullname" placeholder="Full Name" required>
    <input type="number" name="age" placeholder="Age" required>
    <input type="date" name="birthday" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="text" name="validId" placeholder="Valid ID" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit" name="submit">Add User</button>
</form>
</div>
</body>
</html>
