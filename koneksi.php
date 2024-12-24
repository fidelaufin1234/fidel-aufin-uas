<?php
$host = "localhost"; // Nama host
$user = "root"; // Username database
$pass = ""; // Password database
$dbname = "penyewaan_kendaraan"; // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
