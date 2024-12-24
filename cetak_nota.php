<?php
include 'koneksi.php'; // Menghubungkan ke database

// Ambil id_transaksi dari URL
$id_transaksi = $_GET['id'];

// Query untuk mengambil data transaksi berdasarkan id
$query = "SELECT * FROM transaksi_penyewaan
          JOIN pengguna ON transaksi_penyewaan.id_pengguna = pengguna.id_pengguna
          JOIN kendaraan ON transaksi_penyewaan.id_kendaraan = kendaraan.id_kendaraan
          WHERE transaksi_penyewaan.id_transaksi = '$id_transaksi'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Penyewaan Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .nota {
            margin-top: 20px;
        }
        .nota img {
            width: 200px;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container nota">
        <h2 class="text-center">Penyewaan Kendaraan Fidel</h2>
        
        <div class="row">
            <div class="col-md-4">
                <img src="uploads/<?= $row['gambar_kendaraan'] ?>" alt="Gambar Kendaraan" class="img-fluid">
            </div>
            <div class="col-md-8">
                <p><strong>Nama Penyewa:</strong> <?= $row['nama_pengguna'] ?></p>
                <p><strong>Nama Kendaraan:</strong> <?= $row['nama_kendaraan'] ?></p>
                <p><strong>Plat Nomor Kendaraan:</strong> <?= $row['plat_nomor'] ?></p> <!-- Plat Nomor -->
                <p><strong>Tanggal Sewa:</strong> <?= $row['tanggal_sewa'] ?></p>
                <p><strong>Tanggal Kembali:</strong> <?= $row['tanggal_kembali'] ?></p>
                <p><strong>Harga Total:</strong> Rp <?= number_format($row['harga_total'], 2, ',', '.') ?></p>
                <p><strong>Status:</strong> <?= $row['status_penyewaan'] ?></p>
            </div>
        </div>
        
        <p class="text-center mt-4">Terima kasih telah menggunakan layanan Penyewaan Kendaraan Fidel!</p>

        <div class="text-center mt-4">
            <button class="btn btn-secondary" onclick="window.print()">Cetak Nota</button>
        </div>
    </div>
</body>
</html>
