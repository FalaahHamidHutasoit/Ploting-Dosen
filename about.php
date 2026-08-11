<?php
session_start();
include 'config/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --primary-navy: #1e3c72;
            --accent-blue: #0d6efd;
            --soft-bg: #f8fbff;
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--soft-bg); color: #2d3436; }
        h1, h2, .navbar-brand { font-family: 'Playfair Display', serif; }

        .navbar { background-color: var(--primary-navy) !important; padding: 12px 0; }
        .category-bar { background: #fff; border-bottom: 1px solid #eee; padding: 12px 0; }
        .cat-link { display: inline-block; padding: 8px 20px; margin-right: 8px; border-radius: 50px; color: #555; text-decoration: none; font-size: 0.85rem; font-weight: 600; background: #f1f3f5; }

        .about-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white; padding: 100px 0 150px 0; border-radius: 0 0 50px 50px;
        }

        .profile-card {
            background: white; border: none; border-radius: 30px;
            margin-top: -100px; padding: 50px; box-shadow: 0 30px 60px rgba(0,0,0,0.08);
        }

        .creator-avatar {
            width: 120px; height: 120px; background: #f0f4ff; color: var(--primary-navy);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 3rem; margin: 0 auto 25px; border: 5px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        .tech-stack { display: flex; gap: 15px; justify-content: center; margin-top: 30px; }
        .tech-badge { background: #f1f3f5; padding: 10px 20px; border-radius: 12px; font-weight: 700; font-size: 0.8rem; color: #4b6584; }

        .btn-back {
            background: var(--primary-navy); color: white; border-radius: 50px;
            padding: 12px 35px; font-weight: 700; transition: 0.3s; border: none;
        }
        .btn-back:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(30, 60, 114, 0.2); color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-bolt me-2 text-warning"></i>PORTAL BERITA</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link px-3 active" href="about.php">About</a></li>
                <?php if(isset($_SESSION['admin_login'])): ?>
                    <li class="nav-item ms-lg-3"><a href="admin/logout.php" class="btn btn-danger btn-sm rounded-pill px-3">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3"><a href="admin/login.php" class="btn btn-outline-light btn-sm rounded-pill px-4">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="category-bar">
    <div class="container d-flex overflow-auto" style="scrollbar-width: none;">
        <a href="index.php" class="cat-link">Semua Berita</a>
        <?php 
        $kat_q = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori ASC"); 
        while($k = mysqli_fetch_array($kat_q)) {
            echo "<a href='kategori.php?id_kategori={$k['id_kategori']}' class='cat-link'>".htmlspecialchars($k['kategori'])."</a>";
        }
        ?>
    </div>
</div>

<header class="about-header text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Tentang Portal Berita</h1>
        <p class="lead opacity-75">Platform informasi modern yang dibangun dengan dedikasi penuh.</p>
    </div>
</header>

<div class="container mb-5">
    <div class="profile-card text-center mx-auto" style="max-width: 800px;">
        <div class="creator-avatar">
            <i class="fas fa-user-graduate"></i>
        </div>
        
        <h2 class="fw-bold text-dark mb-2">Project PHP Native</h2>
        <p class="text-muted mb-4">Website ini dikembangkan sebagai syarat kelulusan mata kuliah Pemrograman Web (PHP Native).</p>
        
        <div class="row text-start mb-5 g-4">
            <div class="col-md-6">
                <div class="p-4 rounded-4 bg-light h-100">
                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-id-card me-2"></i>Informasi Mahasiswa</h6>
                    <p class="m-0 small"><strong>Nama:</strong> Falaah Hamid Hutasoit</p>
                    <p class="m-0 small"><strong>Prodi:</strong> Manajemen Informatika</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 bg-light h-100">
                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-code me-2"></i>Tujuan Project</h6>
                    <p class="m-0 small">Membangun sistem portal berita yang fungsional, aman, dan memiliki pengalaman pengguna yang modern.</p>
                </div>
            </div>
        </div>
        <a href="index.php" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>

<footer class="py-5 text-center text-muted small">
    &copy; 2026 Portal Berita by Falaah
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>