<?php
include 'koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM kendaraan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Kelola Kendaraan</h1>
        <a href="tambah_kendaraan.php" class="btn btn-success mb-3">Tambah Kendaraan</a>
        <a href="index.php" class="btn btn-success mb-3">Kembali</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kendaraan</th>
                    <th>Jenis Kendaraan</th>
                    <th>Plat Nomor</th>
                    <th>Harga Sewa</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_kendaraan']; ?></td>
                    <td><?= $row['jenis_kendaraan']; ?></td>
                    <td><?= $row['plat_nomor']; ?></td>
                    <td>Rp <?= number_format($row['harga_sewa'], 2, ',', '.'); ?></td>
                    <td><img src="uploads/<?= $row['gambar_kendaraan']; ?>" alt="<?= $row['nama_kendaraan']; ?>" width="100"></td>
                    <td>
                        <a href="edit_kendaraan.php?id=<?= $row['id_kendaraan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_kendaraan.php?id=<?= $row['id_kendaraan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
