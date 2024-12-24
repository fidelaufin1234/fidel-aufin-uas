<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pengguna = $_POST['nama_pengguna'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $query = "INSERT INTO pengguna (nama_pengguna, username, password, level) VALUES ('$nama_pengguna', '$username', '$password', '$level')";
    mysqli_query($conn, $query);
    header("Location: pengguna.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Pengguna</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-control" id="level" name="level" required>
                    <option value="Admin">Admin</option>
                    <option value="Operator">Operator</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="pengguna.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
