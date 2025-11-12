<?php
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // leave blank unless you set one
$dbname = "ballotbuzz_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>