<?php
include 'koneksi.php'; // Menghubungkan ke database

// Ambil semua data transaksi penyewaan
$query = "SELECT * FROM transaksi_penyewaan 
          JOIN pengguna ON transaksi_penyewaan.id_pengguna = pengguna.id_pengguna
          JOIN kendaraan ON transaksi_penyewaan.id_kendaraan = kendaraan.id_kendaraan";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi Penyewaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Transaksi Penyewaan</h1>
        <a href="tambah_transaksi.php" class="btn btn-primary mb-3">Tambah Transaksi</a>
        <a href="index.php" class="btn btn-primary mb-3">Kembali</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pengguna</th>
                    <th>Nama Kendaraan</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Harga Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id_transaksi'] ?></td>
                        <td><?= $row['nama_pengguna'] ?></td>
                        <td><?= $row['nama_kendaraan'] ?></td>
                        <td><?= $row['tanggal_sewa'] ?></td>
                        <td><?= $row['tanggal_kembali'] ?></td>
                        <td>Rp <?= number_format($row['harga_total'], 2, ',', '.') ?></td>
                        <td><?= $row['status_penyewaan'] ?></td>
                        <td>
                            <a href="edit_transaksi.php?id=<?= $row['id_transaksi'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_transaksi.php?id=<?= $row['id_transaksi'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</a>
                            <a href="cetak_nota.php?id=<?= $row['id_transaksi'] ?>" class="btn btn-success btn-sm">Cetak</a>
                            

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
