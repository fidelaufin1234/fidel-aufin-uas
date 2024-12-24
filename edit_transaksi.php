<?php
include 'koneksi.php';

// Ambil data transaksi berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM transaksi_penyewaan WHERE id_transaksi = $id";
    $result = mysqli_query($conn, $query);
    $transaksi = mysqli_fetch_assoc($result);
}

// Proses update transaksi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pengguna = $_POST['id_pengguna'];
    $id_kendaraan = $_POST['id_kendaraan'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $harga_total = $_POST['harga_total'];
    $status_penyewaan = $_POST['status_penyewaan'];

    $query = "UPDATE transaksi_penyewaan SET id_pengguna = '$id_pengguna', id_kendaraan = '$id_kendaraan', 
              tanggal_sewa = '$tanggal_sewa', tanggal_kembali = '$tanggal_kembali', harga_total = '$harga_total', 
              status_penyewaan = '$status_penyewaan' WHERE id_transaksi = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "Transaksi berhasil diperbarui!";
        header("Location: transaksi_penyewaan.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi Penyewaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Transaksi Penyewaan</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="id_pengguna" class="form-label">Pengguna</label>
                <select class="form-select" id="id_pengguna" name="id_pengguna" required>
                    <!-- Menampilkan daftar pengguna -->
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM pengguna");
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['id_pengguna'] == $transaksi['id_pengguna']) ? 'selected' : '';
                        echo "<option value='{$row['id_pengguna']}' $selected>{$row['nama_pengguna']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_kendaraan" class="form-label">Kendaraan</label>
                <select class="form-select" id="id_kendaraan" name="id_kendaraan" required>
                    <!-- Menampilkan daftar kendaraan -->
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM kendaraan");
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['id_kendaraan'] == $transaksi['id_kendaraan']) ? 'selected' : '';
                        echo "<option value='{$row['id_kendaraan']}' $selected>{$row['nama_kendaraan']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" value="<?= $transaksi['tanggal_sewa'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="<?= $transaksi['tanggal_kembali'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_total" class="form-label">Harga Total</label>
                <input type="number" step="0.01" class="form-control" id="harga_total" name="harga_total" value="<?= $transaksi['harga_total'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="status_penyewaan" class="form-label">Status Penyewaan</label>
                <select class="form-select" id="status_penyewaan" name="status_penyewaan" required>
                    <option value="Sewa" <?= $transaksi['status_penyewaan'] == 'Sewa' ? 'selected' : '' ?>>Sewa</option>
                    <option value="Kembali" <?= $transaksi['status_penyewaan'] == 'Kembali' ? 'selected' : '' ?>>Kembali</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Transaksi</button>
            <a href="transaksi_penyewaan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
