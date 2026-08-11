<?php
session_start();
include '../config/koneksi.php'; 
$pesan = '';

if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] === true) {
    if ($_SESSION['level'] == 'admin') {
        header('Location: index.php'); 
    } else {
        header('Location: ../index.php'); 
    }
    exit;
}

if (isset($_POST['login'])) {
    $user_name_input = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password_input = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "SELECT id_user, user_name, password, level, status 
              FROM tb_user 
              WHERE user_name = '$user_name_input' AND status = 'aktif'";
              
    $sql = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($sql);

    if ($user) { 
        if ($user['password'] === $password_input) { 
            $_SESSION['admin_login'] = true;
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['level'] = $user['level'];
 
            if ($user['level'] == 'admin') {             
                header('Location: index.php'); 
            } else {
                header('Location: ../index.php'); 
            }
            exit;

        } else {
            $pesan = '<div class="alert alert-danger shadow-sm border-0">Username atau password salah.</div>';
        }
    } else {
        $pesan = '<div class="alert alert-danger shadow-sm border-0">Username atau password salah.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .btn-login { background: #1e3c72; border: none; border-radius: 10px; padding: 12px; font-weight: 600; color: white; transition: 0.3s; }
        .btn-login:hover { background: #152e5a; transform: translateY(-2px); }
        .form-control { border-radius: 10px; padding: 12px 15px; background-color: #f8f9fa; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <h3 class="fw-bold" style="color: #1e3c72;">Masuk Akun</h3>
        <p class="text-muted small">Portal Berita </p>
    </div>

    <?php echo $pesan; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Username</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="user_name" class="form-control border-start-0" placeholder="Username" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-muted">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control border-start-0" placeholder="Password" required>
            </div>
        </div>

        <button type="submit" name="login" class="btn btn-primary w-100 btn-login mb-3">Login Sekarang</button>
        
        <div class="text-center">
            <small class="text-muted">Belum punya akun? <a href="registrasi.php" class="text-decoration-none fw-bold" style="color: #1e3c72;">Daftar</a></small><br>
            <a href="../index.php" class="text-muted text-decoration-none small mt-2 d-inline-block">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Berita
            </a>
        </div>
    </form>
</div>

</body>
</html>