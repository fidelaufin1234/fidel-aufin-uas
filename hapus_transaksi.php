<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM transaksi_penyewaan WHERE id_transaksi = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "Transaksi berhasil dihapus!";
        header("Location: transaksi_penyewaan.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
