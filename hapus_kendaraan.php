<?php
include 'koneksi.php';

$id = $_GET['id'];

// Hapus file gambar
$result = mysqli_query($conn, "SELECT gambar_kendaraan FROM kendaraan WHERE id_kendaraan = $id");
$row = mysqli_fetch_assoc($result);
unlink("uploads/" . $row['gambar_kendaraan']);

// Hapus data kendaraan
mysqli_query($conn, "DELETE FROM kendaraan WHERE id_kendaraan = $id");
header("Location: kendaraan.php");
?>
