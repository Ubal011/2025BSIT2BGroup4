<?php
session_start();
if (!isset($_SESSION['current_user']) || $_SESSION['current_user'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include "db.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $validId = $_POST['validId'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET fullname=?, age=?, birthday=?, address=?, validId=?, username=?, password=?, role=? WHERE id=?");
        $stmt->bind_param("sissssssi", $fullname, $age, $birthday, $address, $validId, $username, $password, $role, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET fullname=?, age=?, birthday=?, address=?, validId=?, username=?, role=? WHERE id=?");
        $stmt->bind_param("sisssssi", $fullname, $age, $birthday, $address, $validId, $username, $role, $id);
    }

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
<title>Edit User</title>
<style>
    body { font-family: Arial; background: #f0f4fa; }
    .form-container { background: white; margin: 2rem auto; padding: 1rem; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 90%; max-width: 500px; }
    input, select, button { display: block; width: 100%; margin: 0.5rem 0; padding: 0.5rem; }
    button { background:#012055; color:white; border:none; cursor:pointer; border-radius:5px; }
</style>
</head>
<body>
<div class="form-container">
<h2>Edit User</h2>
<form method="POST">
    <input type="text" name="fullname" value="<?= $user['fullname'] ?>" required>
    <input type="number" name="age" value="<?= $user['age'] ?>" required>
    <input type="date" name="birthday" value="<?= $user['birthday'] ?>" required>
    <input type="text" name="address" value="<?= $user['address'] ?>" required>
    <input type="text" name="validId" value="<?= $user['validId'] ?>" required>
    <input type="text" name="username" value="<?= $user['username'] ?>" required>
    <input type="password" name="password" placeholder="New Password (leave blank to keep current)">
    <select name="role">
        <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
        <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
    </select>
    <button type="submit" name="submit">Update User</button>
</form>
</div>
</body>
</html>
