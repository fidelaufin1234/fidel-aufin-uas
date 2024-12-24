<?php
include 'koneksi.php'; // Menghubungkan ke database

// Mengambil data penyewaan
$sql = "SELECT t.id_transaksi, p.nama_pengguna, k.nama_kendaraan, t.tanggal_sewa, t.tanggal_kembali, t.harga_total, t.status_penyewaan 
        FROM transaksi_penyewaan t
        JOIN pengguna p ON t.id_pengguna = p.id_pengguna
        JOIN kendaraan k ON t.id_kendaraan = k.id_kendaraan";
$result = mysqli_query($conn, $sql);

// Mengambil total harga untuk bulan ini
$currentMonth = date('m'); // Mengambil bulan saat ini
$currentYear = date('Y');  // Mengambil tahun saat ini
$totalHargaQuery = "SELECT SUM(t.harga_total) AS total_harga 
                    FROM transaksi_penyewaan t
                    WHERE MONTH(t.tanggal_sewa) = '$currentMonth' AND YEAR(t.tanggal_sewa) = '$currentYear'";
$totalHargaResult = mysqli_query($conn, $totalHargaQuery);
$totalHargaRow = mysqli_fetch_assoc($totalHargaResult);
$totalHarga = $totalHargaRow['total_harga'] ? $totalHargaRow['total_harga'] : 0; // Menangani nilai NULL jika tidak ada transaksi
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penyewaan Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        // Fungsi untuk mencetak halaman
        function printReport() {
            window.print();
        }

        // Fungsi untuk mengunduh laporan sebagai CSV
        function downloadCSV() {
            let csv = 'ID Transaksi,Nama Pengguna,Nama Kendaraan,Tanggal Sewa,Tanggal Kembali,Harga Total,Status Penyewaan\n';
            let rows = document.querySelectorAll('table tr');
            rows.forEach(row => {
                let cols = row.querySelectorAll('td, th');
                let rowData = [];
                cols.forEach(col => rowData.push(col.textContent));
                csv += rowData.join(',') + '\n';
            });

            let hiddenElement = document.createElement('a');
            hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
            hiddenElement.target = '_blank';
            hiddenElement.download = 'laporan_penyewaan.csv';
            hiddenElement.click();
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Laporan Penyewaan Kendaraan</h1>
        <div class="text-center mb-3">
            <button class="btn btn-success" onclick="printReport()">Cetak Laporan</button>
            <a href="index.php" class="btn btn-success">Kembali</a>
        </div>

        <!-- Menampilkan Total Harga untuk Bulan Ini -->
        <div class="alert alert-info text-center">
            <strong>Total Harga Penyewaan Bulan Ini:</strong> Rp <?= number_format($totalHarga, 2, ',', '.') ?>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Pengguna</th>
                    <th>Nama Kendaraan</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Harga Total</th>
                    <th>Status Penyewaan</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id_transaksi']; ?></td>
                    <td><?php echo $row['nama_pengguna']; ?></td>
                    <td><?php echo $row['nama_kendaraan']; ?></td>
                    <td><?php echo $row['tanggal_sewa']; ?></td>
                    <td><?php echo $row['tanggal_kembali']; ?></td>
                    <td><?php echo number_format($row['harga_total'], 2, ',', '.'); ?></td>
                    <td><?php echo $row['status_penyewaan']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>
