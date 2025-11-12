<?php
session_start();
if (!isset($_SESSION['current_user']) || $_SESSION['current_user'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'dbconnect.php';

// Handle form submission
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $validId = $_POST['validId'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    if ($_POST['password'] !== '') {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("UPDATE users SET fullname=?, age=?, birthday=?, address=?, validId=?, username=?, password=?, role=? WHERE id=?");
            $stmt->bind_param("sissssssi", $fullname, $age, $birthday, $address, $validId, $username, $password, $role, $id);
            $stmt->execute();
        } else { // add
            $stmt = $conn->prepare("INSERT INTO users (fullname, age, birthday, address, validId, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sissssss", $fullname, $age, $birthday, $address, $validId, $username, $password, $role);
            $stmt->execute();
        }
    } else { // password empty on edit
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("UPDATE users SET fullname=?, age=?, birthday=?, address=?, validId=?, username=?, role=? WHERE id=?");
            $stmt->bind_param("sisssssi", $fullname, $age, $birthday, $address, $validId, $username, $role, $id);
            $stmt->execute();
        }
    }
    header("Location: admin_dashboard.php");
    exit;
}

// Load user for editing if needed
$editUser = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $editUser = $result->fetch_assoc();
}

// Delete user if requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: admin_dashboard.php");
    exit;
}

// --- SELECT FUNCTION ---
$search = $_GET['search'] ?? '';
if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE fullname LIKE ? OR username LIKE ?");
    $term = "%$search%";
    $stmt->bind_param("ss", $term, $term);
    $stmt->execute();
    $users = $stmt->get_result();
} else {
    $users = $conn->query("SELECT * FROM users");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Dashboard - Ballot BUZZ</title>
<style>
body {font-family: Arial, sans-serif;margin: 0;background-color: #f0f4fa;}
header {background-color: #012055;color: white;padding: 1rem 2rem;display: flex;justify-content: space-between;align-items: center;}
.logout-btn {background: #ff5555;color: white;border: none;padding: 0.5rem 1rem;border-radius: 5px;cursor: pointer;font-weight: bold;}
.navbar a {color: white;margin: 0 10px;text-decoration: none;}
.navbar a:hover {text-decoration: underline;}
h1 {margin: 1rem 0;color: #012055;text-align: center;}
.reports-container {background: white;margin: 2rem auto;padding: 1rem;border-radius: 8px;box-shadow: 0 0 10px rgba(0,0,0,0.1);width: 90%;max-width: 900px;}
table {width: 100%;border-collapse: collapse;margin-top: 1rem;}
th, td {border: 1px solid #ddd;padding: 8px;text-align: center;}
th {background-color: #012055;color: white;}
tr:nth-child(even) {background-color: #f9f9f9;}
.search-box {margin-bottom: 1rem;text-align: right;}
.search-box input {padding: 5px;width: 200px;border-radius: 4px;border: 1px solid #aaa;}
</style>
</head>
<body>
<header>
  <div class="navbar">
    <a href="admin_dashboard.php">Users</a>
    <a href="admin_reports.php">Reports</a>
  </div>
  <form action="logout.php" method="post" style="margin:0;">
    <button class="logout-btn" type="submit">Logout</button>
  </form>
</header>

<h1>User Management</h1>
<div class="reports-container">
<?php if(isset($_GET['action']) && ($_GET['action']=='add' || $_GET['action']=='edit')): ?>
<h2><?= $editUser ? 'Edit User' : 'Add New User' ?></h2>
<form method="POST">
  <input type="text" name="fullname" placeholder="Full Name" value="<?= $editUser['fullname'] ?? '' ?>" required>
  <input type="number" name="age" placeholder="Age" value="<?= $editUser['age'] ?? '' ?>" required>
  <input type="date" name="birthday" value="<?= $editUser['birthday'] ?? '' ?>" required>
  <input type="text" name="address" placeholder="Address" value="<?= $editUser['address'] ?? '' ?>" required>
  <input type="text" name="validId" placeholder="Valid ID" value="<?= $editUser['validId'] ?? '' ?>" required>
  <input type="text" name="username" placeholder="Username" value="<?= $editUser['username'] ?? '' ?>" required>
  <input type="password" name="password" placeholder="<?= $editUser ? 'Leave blank to keep current password' : 'Password' ?>">
  <select name="role">
      <option value="user" <?= ($editUser['role']??'')=='user'?'selected':'' ?>>User</option>
      <option value="admin" <?= ($editUser['role']??'')=='admin'?'selected':'' ?>>Admin</option>
  </select>
  <button type="submit" name="submit"><?= $editUser ? 'Update User' : 'Add User' ?></button>
</form>
<hr>
<?php else: ?>
<a href="?action=add" style="background:#012055;color:white;padding:0.5rem 1rem;border-radius:5px;text-decoration:none;">Add New User</a>
<?php endif; ?>

<div class="search-box">
  <form method="GET" action="admin_dashboard.php">
    <input type="text" name="search" placeholder="Search user..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
  </form>
</div>

<table>
  <tr>
    <th>ID</th><th>Full Name</th><th>Age</th><th>Birthday</th><th>Address</th><th>Valid ID</th><th>Username</th><th>Role</th><th>Actions</th>
  </tr>
  <?php if($users && $users->num_rows > 0): ?>
    <?php while($row = $users->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['fullname']) ?></td>
      <td><?= $row['age'] ?></td>
      <td><?= $row['birthday'] ?></td>
      <td><?= htmlspecialchars($row['address']) ?></td>
      <td><?= htmlspecialchars($row['validId']) ?></td>
      <td><?= htmlspecialchars($row['username']) ?></td>
      <td><?= htmlspecialchars($row['role']) ?></td>
      <td>
        <a href="?action=edit&id=<?= $row['id'] ?>" style="color:#012055;">Edit</a> |
        <a href="?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')" style="color:red;">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr><td colspan="9">No users found.</td></tr>
  <?php endif; ?>
</table>
</div>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
