<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header('Location: login.php');
    exit;
}

include '../config/koneksi.php'; 
$total_berita = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_berita"))['total'];
$total_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_user"))['total'];
$total_kategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_kategori"))['total'];

$user_level = $_SESSION['level'] ?? 'N/A';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Portal Berita</title>
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

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
            color: white;
            position: fixed;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 30px 25px;
            font-size: 1.25rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-menu {
            padding: 20px 0;
            flex-grow: 1;
        }

        .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 25px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: 0.3s;
            border-left: 4px solid transparent;
        }

        .nav-link i { width: 25px; font-size: 1.1rem; }

        .nav-link:hover, .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left-color: #fff;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 40px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .welcome-text h2 { font-weight: 700; color: #333; margin: 0; }
        .welcome-text p { color: #888; margin: 0; }

        .stat-card {
            background: white;
            border: none;
            border-radius: 20px;
            padding: 25px;
            display: flex;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            transition: 0.3s;
        }

        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.08); }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
        }

        .icon-berita { background: #e7f0ff; color: #0d6efd; }
        .icon-kategori { background: #e6f9f0; color: #198754; }
        .icon-user { background: #fff0f0; color: #dc3545; }

        .stat-info h3 { font-weight: 700; margin: 0; font-size: 1.8rem; color: #333; }
        .stat-info p { margin: 0; color: #888; font-weight: 600; font-size: 0.9rem; }

        .level-badge {
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-newspaper me-2"></i> ADMIN PANEL
    </div>
    <div class="nav-menu">
        <a href="index.php" class="nav-link active">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="berita/tampil.php" class="nav-link">
            <i class="fas fa-edit"></i> Kelola Berita
        </a>
        <a href="kategori/tampil.php" class="nav-link">
            <i class="fas fa-tags"></i> Kelola Kategori
        </a>
        <a href="user/tampil.php" class="nav-link">
            <i class="fas fa-users"></i> Kelola User
        </a>
    </div>
    <div class="p-4 border-top border-secondary opacity-75">
        <a href="logout.php" class="nav-link p-0 text-white">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <div class="welcome-text">
            <h2>Dashboard Overview</h2>
            <p>Selamat datang kembali, <b><?= htmlspecialchars($_SESSION['user_name']) ?></b></p>
        </div>
        <div class="user-profile d-flex align-items-center">
            <span class="level-badge bg-primary text-white me-3"><?= htmlspecialchars($user_level) ?></span>
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                <i class="fas fa-user-shield text-primary"></i>
            </div>
        </div>
    </div>

    <div class="alert alert-white shadow-sm border-0 rounded-4 p-3 mb-5 d-flex align-items-center">
        <div class="bg-info-subtle text-info rounded-3 p-2 me-3">
            <i class="fas fa-info-circle"></i>
        </div>
        <div>
            Anda masuk dengan hak akses sebagai: <b><?= htmlspecialchars($user_level) ?></b>.
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-berita">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_berita ?></h3>
                    <p>Total Berita</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-kategori">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_kategori ?></h3>
                    <p>Kategori Aktif</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-user">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_user ?></h3>
                    <p>User Terdaftar</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>