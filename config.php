<?php
// Mulai session
session_start();

// Konfigurasi Database
$db_host = 'localhost';
$db_user = 'root'; // Sesuaikan dengan username database Anda
$db_pass = '';     // Sesuaikan dengan password database Anda
$db_name = 'batik'; // Sesuaikan dengan nama database Anda

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// URL dasar untuk website
define('BASE_URL', 'http://localhost/toko_batik/');
?>