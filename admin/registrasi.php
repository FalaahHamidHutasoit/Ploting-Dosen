<?php
include '../config/koneksi.php'; 
$pesan = '';

if (isset($_POST['register'])) {
    $user_name = mysqli_real_escape_string($conn, strip_tags($_POST['user_name']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $level = "editor"; 
    $status = "aktif"; 

    $cek_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_name = '$user_name'");
    if (mysqli_num_rows($cek_user) > 0) {
        $pesan = '<div class="alert alert-warning shadow-sm">Username sudah terdaftar, gunakan nama lain.</div>';
    } else {
        $query = "INSERT INTO tb_user (user_name, password, level, status) 
                  VALUES ('$user_name', '$password', '$level', '$status')";
        
        if (mysqli_query($conn, $query)) {
            $pesan = '<div class="alert alert-success shadow-sm">Akun berhasil dibuat! Silakan <a href="login.php" class="alert-link">Login</a>.</div>';
        } else {
            $pesan = '<div class="alert alert-danger shadow-sm">Gagal mendaftar: ' . mysqli_error($conn) . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }
        .register-card { background: rgba(255, 255, 255, 0.95); border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2); padding: 40px; width: 100%; max-width: 420px; }
        .btn-register { background: #1e3c72; border: none; border-radius: 10px; padding: 12px; font-weight: 600; transition: 0.3s; }
        .btn-register:hover { background: #152e5a; transform: translateY(-2px); }
        .form-control { border-radius: 10px; padding: 12px 15px; background-color: #f8f9fa; }
    </style>
</head>
<body>

<div class="register-card">
    <div class="text-center mb-4">
        <h3 class="fw-bold" style="color: #1e3c72;">Daftar Akun</h3>
        <p class="text-muted small">Buat akun untuk mengelola portal berita</p>
    </div>

    <?php echo $pesan; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label fw-semibold small">Username</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="user_name" class="form-control border-start-0" placeholder="Username baru" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold small">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control border-start-0" placeholder="Password baru" required>
            </div>
        </div>
        <button type="submit" name="register" class="btn btn-primary w-100 btn-register mb-3 text-white">Buat Akun Sekarang</button>
        <div class="text-center">
            <small class="text-muted">Sudah punya akun? <a href="login.php" class="text-decoration-none fw-bold" style="color: #1e3c72;">Login di sini</a></small>
        </div>
    </form>
</div>

</body>
</html>