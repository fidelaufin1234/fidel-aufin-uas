<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'operator') {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Penyewaan Kendaraan Operator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Navbar Styling */
        .navbar {
            background-color: #001f3f; /* Warna biru tua */
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            transition: color 0.3s ease-in-out;
        }
        .nav-link:hover {
            color: #17a2b8 !important; /* Warna hover */
        }

        /* Animasi Klik */
        .nav-link:active {
            animation: clickEffect 0.3s ease;
        }

        @keyframes clickEffect {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(0.9);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-car"></i> Sistem Penyewaan Kendaraan Fidel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pengguna.php">
                            <i class="fas fa-user-cog"></i> Kelola Pengguna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kendaraan.php">
                            <i class="fas fa-car-side"></i> Kelola Kendaraan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="penyewaan.php">
                            <i class="fas fa-clipboard-list"></i> Kelola Penyewaan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">
                            <i class="fas fa-file-alt"></i> Lihat Laporan
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-5">
        <h1 class="text-center">Halo kamu sebagai operator ya</h1>
        <div class="text-center">
            <a href="pengguna.php" class="btn btn-primary m-2">Kelola Pengguna</a>
            <a href="kendaraan.php" class="btn btn-primary m-2">Kelola Kendaraan</a>
            <a href="transaksi_penyewaan.php" class="btn btn-primary m-2">Kelola Penyewaan</a>
            <a href="laporan.php" class="btn btn-primary m-2">Lihat Laporan</a>
            <a href="login.php" class="btn btn-primary m-2">Logout</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
