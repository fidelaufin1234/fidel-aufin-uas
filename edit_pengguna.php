<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM pengguna WHERE id_pengguna = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pengguna = $_POST['nama_pengguna'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $query = "UPDATE pengguna SET nama_pengguna='$nama_pengguna', username='$username', password='$password', level='$level' WHERE id_pengguna='$id'";
    mysqli_query($conn, $query);
    header("Location: pengguna.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Pengguna</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?= $data['nama_pengguna']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $data['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= $data['password']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-control" id="level" name="level" required>
                    <option value="Admin" <?= $data['level'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="Operator" <?= $data['level'] == 'Operator' ? 'selected' : ''; ?>>Operator</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="pengguna.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
