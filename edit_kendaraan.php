<?php
include 'koneksi.php';

// Ambil data kendaraan berdasarkan ID
$id = $_GET['id'];
$query = "SELECT * FROM kendaraan WHERE id_kendaraan = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kendaraan = $_POST['nama_kendaraan'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $plat_nomor = $_POST['plat_nomor'];
    $harga_sewa = $_POST['harga_sewa'];

    // Cek jika ada file gambar baru yang diupload
    if (!empty($_FILES['gambar_kendaraan']['name'])) {
        $gambar_kendaraan = $_FILES['gambar_kendaraan']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar_kendaraan);

        // Hapus gambar lama
        if (file_exists("uploads/" . $row['gambar_kendaraan'])) {
            unlink("uploads/" . $row['gambar_kendaraan']);
        }

        // Upload gambar baru
        move_uploaded_file($_FILES['gambar_kendaraan']['tmp_name'], $target_file);
    } else {
        $gambar_kendaraan = $row['gambar_kendaraan']; // Tetap gunakan gambar lama
    }

    // Update data ke database
    $query = "UPDATE kendaraan 
              SET nama_kendaraan = '$nama_kendaraan', 
                  jenis_kendaraan = '$jenis_kendaraan', 
                  plat_nomor = '$plat_nomor', 
                  harga_sewa = '$harga_sewa', 
                  gambar_kendaraan = '$gambar_kendaraan' 
              WHERE id_kendaraan = $id";
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    header("Location: kendaraan.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Kendaraan</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_kendaraan" class="form-label">Nama Kendaraan</label>
                <input type="text" class="form-control" id="nama_kendaraan" name="nama_kendaraan" value="<?= $row['nama_kendaraan']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" value="<?= $row['jenis_kendaraan']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="plat_nomor" class="form-label">Plat Nomor</label>
                <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="<?= $row['plat_nomor']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa</label>
                <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" value="<?= $row['harga_sewa']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="gambar_kendaraan" class="form-label">Gambar Kendaraan</label>
                <input type="file" class="form-control" id="gambar_kendaraan" name="gambar_kendaraan">
                <p class="mt-2">Gambar Saat Ini:</p>
                <img src="uploads/<?= $row['gambar_kendaraan']; ?>" alt="<?= $row['nama_kendaraan']; ?>" width="150">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="kendaraan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
