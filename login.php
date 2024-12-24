<?php
session_start();
include 'koneksi.php'; // Menghubungkan ke database

// Proses Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari pengguna berdasarkan username
    $query = "SELECT * FROM login WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika username ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Menyimpan data pengguna ke session
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];
            
            // Redirect berdasarkan level pengguna
            if ($user['level'] == 'admin') {
                header('Location: admin_dashboard.php');
            } else if ($user['level'] == 'operator') {
                header('Location: operator_dashboard.php');
            }
            exit();
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penyewaan Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="register.php">Belum punya akun? Daftar di sini</a>
        </div>
    </div>
</body>
</html>
