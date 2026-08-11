<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../../config/koneksi.php'; 

if (isset($_POST['simpan'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $level = $_POST['level'];
    $status = $_POST['status'];

    $query = "INSERT INTO tb_user (user_name, password, level, status) 
              VALUES ('$user_name', '$password', '$level', '$status')";
              
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('User Baru Berhasil Ditambahkan!'); window.location='tampil.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Admin Panel</title>
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
            max-width: 700px; margin: 0 auto;
        }
        
        .form-label { font-weight: 600; color: #444; font-size: 0.85rem; margin-bottom: 8px; }
        
        .input-group-text { background-color: #f9fbff; border-right: none; color: #888; border-radius: 12px 0 0 12px; }
        .form-control, .form-select { 
            border-radius: 0 12px 12px 0; padding: 12px 15px; border: 1px solid #e0e6ed; 
            background-color: #f9fbff; transition: 0.3s; font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus { 
            border-color: var(--primary-navy); box-shadow: 0 0 0 4px rgba(30, 60, 114, 0.1); 
            background-color: #fff; outline: none;
        }

        .btn-save { 
            background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
            border: none; border-radius: 12px; padding: 14px; font-weight: 700; color: white;
            box-shadow: 0 10px 20px rgba(30, 60, 114, 0.2); transition: 0.3s; width: 100%;
        }
        .btn-save:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(30, 60, 114, 0.3); color: white; }
        
        .user-icon-box {
            width: 70px; height: 70px; background: #f0f4ff; color: var(--primary-navy);
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
    <div class="d-flex justify-content-between align-items-center mb-5" style="max-width: 700px; margin: 0 auto 40px auto;">
        <div>
            <h2 class="fw-bold m-0 text-dark">Registrasi User</h2>
            <p class="text-muted m-0 small">Tambahkan hak akses admin atau editor baru</p>
        </div>
        <a href="tampil.php" class="btn btn-outline-secondary rounded-pill px-3 btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="form-card">
        <div class="user-icon-box">
            <i class="fas fa-user-plus"></i>
        </div>

        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                        <input type="text" name="user_name" class="form-control" placeholder="Masukkan username..." required autofocus>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Buat password aman..." required>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Level Akses</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                        <select name="level" class="form-select" required>
                            <option value="" disabled selected>Pilih Level...</option>
                            <option value="admin">Administrator</option>
                            <option value="editor">Editor</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Status Akun</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                        <select name="status" class="form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="my-4 opacity-25">

            <button type="submit" name="simpan" class="btn btn-save">
                <i class="fas fa-save me-2"></i> Daftarkan User Sekarang
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>