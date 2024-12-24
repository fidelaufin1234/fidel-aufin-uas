<?php
include 'koneksi.php'; // Menghubungkan ke database

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM pengguna WHERE id_pengguna='$id'";
    mysqli_query($conn, $query);
    header("Location: pengguna.php");
}

// Ambil Data Pengguna
$query = "SELECT * FROM pengguna";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Kelola Pengguna</h1>
        <a href="tambah_pengguna.php" class="btn btn-success mb-3">Tambah Pengguna</a>
        <a href="index.php" class="btn btn-success mb-3">Kembali</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nama_pengguna']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['password']}</td>
                            <td>{$row['level']}</td>
                            <td>
                                <a href='edit_pengguna.php?id={$row['id_pengguna']}' class='btn btn-warning'>Edit</a>
                                <a href='pengguna.php?hapus={$row['id_pengguna']}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                            </td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
