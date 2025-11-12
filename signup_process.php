<?php
include 'dbconnect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data safely
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $validId = mysqli_real_escape_string($conn, $_POST['validId']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // Hash password before storing for security
    $raw_password = $_POST['password'];
    $password = password_hash($raw_password, PASSWORD_DEFAULT);
    
    // Set default role for normal users
    $role = 'user';

    // Save to database
    $sql = "INSERT INTO users (fullname, age, birthday, address, validId, username, password, role)
            VALUES ('$fullname', '$age', '$birthday', '$address', '$validId', '$username', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to receipt page with form data
        // Do not store the actual password in session/receipt. Show a masked value instead.
        $_SESSION['receipt'] = [
            'fullname' => $fullname,
            'age' => $age,
            'birthday' => $birthday,
            'address' => $address,
            'validId' => $validId,
            'username' => $username,
            'password' => '********' // masked
        ];
        header("Location: receipt.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: signup.php");
    exit;
}
?>
