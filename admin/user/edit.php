<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../../config/koneksi.php'; 
if (!isset($_GET['id'])) {
    header('Location: tampil.php');
    exit;
}

$id = (int)$_GET['id'];
$query_data = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = $id");
$data = mysqli_fetch_assoc($query_data);

if (!$data) {
    header('Location: tampil.php');
    exit;
}

if (isset($_POST['update'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $level = $_POST['level'];
    $status = $_POST['status'];
    
    if (!empty($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $query_update = "UPDATE tb_user SET 
                         user_name = '$user_name', 
                         password = '$password', 
                         level = '$level', 
                         status = '$status' 
                         WHERE id_user = $id";
    } else {
        $query_update = "UPDATE tb_user SET 
                         user_name = '$user_name', 
                         level = '$level', 
                         status = '$status' 
                         WHERE id_user = $id";
    }

    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('Data User Berhasil Diperbarui!'); window.location='tampil.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-navy: #1e3c72;
            --secondary-navy: #2a5298;
            --light-bg: #f8fbff;
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--light-bg); display: flex; }

        .sidebar { width: var(--sidebar-width); height: 100vh; background: linear-gradient(180deg, var(--primary-navy) 0%, var(--secondary-navy) 100%); color: white; position: fixed; }
        .sidebar-header { padding: 30px 25px; font-size: 1.25rem; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .nav-link { color: rgba(255,255,255,0.7); padding: 12px 25px; display: flex; align-items: center; text-decoration: none; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); border-left: 4px solid #fff; }

        .main-content { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); padding: 40px; }

        .form-card { 
            background: white; border-radius: 25px; border: none; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.03); padding: 40px;
            max-width: 750px; margin: 0 auto;
        }
        
        .form-label { font-weight: 600; color: #444; font-size: 0.85rem; margin-bottom: 8px; }
        
        .input-group-text { background-color: #f9fbff; border-right: none; color: #aaa; border-radius: 12px 0 0 12px; }
        .form-control, .form-select { 
            border-radius: 0 12px 12px 0; padding: 12px 15px; border: 1px solid #e0e6ed; 
            background-color: #f9fbff; transition: 0.3s; font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus { 
            border-color: #f39c12; box-shadow: 0 0 0 4px rgba(243, 156, 18, 0.1); 
            background-color: #fff; outline: none;
        }

        .btn-update { 
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            border: none; border-radius: 12px; padding: 14px; font-weight: 700; color: white;
            box-shadow: 0 10px 20px rgba(243, 156, 18, 0.2); transition: 0.3s; width: 100%;
        }
        .btn-update:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(243, 156, 18, 0.3); color: white; }
        
        .user-icon-box {
            width: 70px; height: 70px; background: #fff8ee; color: #f39c12;
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; margin: 0 auto 30px; border: 2px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header"><i class="fas fa-newspaper me-2"></i> ADMIN PANEL</div>
    <div class="nav-menu mt-4">
        <a href="../index.php" class="nav-link"><i class="fas fa-th-large me-2"></i> Dashboard</a>
        <a href="../berita/tampil.php" class="nav-link"><i class="fas fa-edit me-2"></i> Kelola Berita</a>
        <a href="../kategori/tampil.php" class="nav-link"><i class="fas fa-tags me-2"></i> Kelola Kategori</a>
        <a href="tampil.php" class="nav-link active"><i class="fas fa-users me-2"></i> Kelola User</a>
    </div>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5" style="max-width: 750px; margin: 0 auto 40px auto;">
        <div>
            <h2 class="fw-bold m-0 text-dark">Edit Data User</h2>
            <p class="text-muted m-0 small">Perbarui profil dan hak akses user ID: <?= $id ?></p>
        </div>
        <a href="tampil.php" class="btn btn-outline-secondary rounded-pill px-3 btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="form-card">
        <div class="user-icon-box">
            <i class="fas fa-user-edit"></i>
        </div>

        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                        <input type="text" name="user_name" class="form-control" value="<?= htmlspecialchars($data['user_name']) ?>" required autofocus>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Password Baru</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Isi untuk mengganti password...">
                    </div>
                    <small class="text-muted d-block mt-2" style="font-size: 0.75rem;">* Kosongkan jika tidak ingin mengganti password</small>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Level Akses</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                        <select name="level" class="form-select" required>
                            <option value="admin" <?= ($data['level'] == 'admin') ? 'selected' : '' ?>>Administrator</option>
                            <option value="editor" <?= ($data['level'] == 'editor') ? 'selected' : '' ?>>Editor</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Status Akun</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                        <select name="status" class="form-select" required>
                            <option value="aktif" <?= ($data['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= ($data['status'] == 'nonaktif') ? 'selected' : '' ?>>Non-Aktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="my-4 opacity-25">

            <button type="submit" name="update" class="btn btn-update">
                <i class="fas fa-sync-alt me-2"></i> Perbarui Data User
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>