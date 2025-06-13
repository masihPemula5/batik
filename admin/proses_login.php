<?php
require_once '../config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: dashboard.php");
} else {
    echo "Login Gagal. Username atau Password salah.";
    echo "<br><a href='index.php'>Kembali ke Login</a>";
}
?>