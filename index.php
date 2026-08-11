<?php
session_start(); 
include 'config/koneksi.php';
$sql_hero = mysqli_query($conn, "SELECT b.*, k.kategori, u.user_name 
                                 FROM tb_berita b 
                                 JOIN tb_kategori k ON b.id_kategori = k.id_kategori 
                                 JOIN tb_user u ON b.id_user = u.id_user 
                                 ORDER BY b.tanggal DESC LIMIT 1");
$hero = mysqli_fetch_assoc($sql_hero);
$exclude_id = $hero ? $hero['id_berita'] : 0;
$batas = 6;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$posisi = ($halaman - 1) * $batas;

$query_list = "SELECT b.*, k.kategori, u.user_name 
               FROM tb_berita b 
               JOIN tb_kategori k ON b.id_kategori = k.id_kategori 
               JOIN tb_user u ON b.id_user = u.id_user 
               WHERE b.id_berita != $exclude_id
               ORDER BY b.tanggal DESC 
               LIMIT $posisi, $batas";
$sql_list = mysqli_query($conn, $query_list);

$query_total = "SELECT COUNT(*) AS total FROM tb_berita WHERE id_berita != $exclude_id";
$data_total = mysqli_fetch_assoc(mysqli_query($conn, $query_total));
$total_halaman = ceil($data_total['total'] / $batas);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita Premium - UAS Manajemen Informatika</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root { --primary-navy: #1e3c72; --accent-blue: #0d6efd; --soft-bg: #f8fbff; --gold-accent: #f1c40f; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--soft-bg); color: #2d3436; }
        h1, h2, h4, .navbar-brand { font-family: 'Playfair Display', serif; }
        
        .navbar {
            background: rgba(30, 60, 114, 0.98) !important;
            backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 2px solid rgba(255, 215, 0, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand { font-weight: 800; font-size: 1.6rem; color: #fff !important; letter-spacing: 1px; }
        .navbar-brand i { color: var(--gold-accent); margin-right: 10px; }
        .nav-link { font-weight: 600; font-size: 0.95rem; color: rgba(255,255,255,0.85) !important; border-radius: 50px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: #fff !important; background: rgba(255,255,255,0.1); }
        .user-profile { background: rgba(255,255,255,0.1); padding: 5px 15px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.2); }
        .btn-logout-premium { background: linear-gradient(135deg, #e74c3c, #c0392b); border: none; font-weight: 700; padding: 6px 18px; border-radius: 50px; box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3); }
        .category-bar { background: #fff; padding: 15px 0; border-bottom: 1px solid #eee; box-shadow: 0 2px 15px rgba(0,0,0,0.03); }
        .cat-link { background: #f8f9fa; border: 1px solid #eee; color: #555; padding: 8px 22px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; margin-right: 10px; border-radius: 50px; text-decoration: none; transition: 0.3s; display: inline-block; }
        .cat-link:hover, .cat-link.active { background: var(--primary-navy); color: #fff; border-color: var(--primary-navy); box-shadow: 0 5px 15px rgba(30, 60, 114, 0.2); }

        .welcome-card { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 25px; border: none; color: white; }

        .search-container { position: relative; max-width: 650px; margin: 30px auto; }
        .search-box { border-radius: 50px; padding: 15px 50px; border: 1px solid #e0e6ed; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); }
        #btn-clear { position: absolute; top: 50%; left: 20px; transform: translateY(-50%); cursor: pointer; display: none; color: #b2bec3; z-index: 5; }
        .search-icon-right { position: absolute; top: 50%; right: 25px; transform: translateY(-50%); color: #b2bec3; }
        .hero-section { position: relative; height: 500px; border-radius: 35px; overflow: hidden; background: #000; box-shadow: 0 25px 50px rgba(0,0,0,0.15); }
        .hero-img { width: 100%; height: 100%; object-fit: cover; opacity: 0.75; }
        .hero-overlay { position: absolute; bottom: 0; left: 0; width: 100%; padding: 60px; background: linear-gradient(transparent, rgba(0,0,0,0.95)); color: white; }
        .news-card { background: #fff; border: none; border-radius: 24px; transition: 0.4s; overflow: hidden; height: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        .news-card:hover { transform: translateY(-12px); box-shadow: 0 20px 45px rgba(0,0,0,0.08); }
        .card-img-wrapper { position: relative; overflow: hidden; height: 220px; }
        .news-card img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .badge-premium { position: absolute; top: 20px; left: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(5px); color: var(--primary-navy); font-size: 0.7rem; font-weight: 800; padding: 6px 16px; border-radius: 50px; text-transform: uppercase; }

        .pagination .page-link { border-radius: 50% !important; margin: 0 5px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: var(--primary-navy); border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .pagination .page-item.active .page-link { background-color: var(--primary-navy); color: #fff; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-newspaper"></i>PORTAL<span style="color: var(--gold-accent);">BERITA</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3 active" href="index.php">HOME</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="about.php">ABOUT</a></li>
                <?php if(isset($_SESSION['admin_login'])): ?>
                    <li class="nav-item ms-lg-4">
                        <div class="user-profile d-flex align-items-center">
                            <span class="text-white-50 small me-3">Halo, <b class="text-white"><?= htmlspecialchars($_SESSION['user_name']) ?></b></span>
                            <a href="admin/logout.php" class="btn btn-logout-premium btn-sm text-white">LOGOUT</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-4">
                        <a href="admin/login.php" class="btn btn-outline-warning rounded-pill px-4 fw-bold btn-sm">LOGIN</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="category-bar">
    <div class="container d-flex overflow-auto" style="scrollbar-width: none;">
        <a href="index.php" class="cat-link active">SEMUA</a>
        <?php 
        $kat_q = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori ASC"); 
        while($k = mysqli_fetch_array($kat_q)) {
            echo "<a href='kategori.php?id_kategori={$k['id_kategori']}' class='cat-link'>".htmlspecialchars($k['kategori'])."</a>";
        }
        ?>
    </div>
</div>

<div class="container">
    <?php if(isset($_SESSION['admin_login'])): ?>
    <div id="welcome-area" class="mt-4">
        <div class="welcome-card card p-4 shadow-lg">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold m-0">Halo, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h4>
                    <p class="m-0 opacity-75 small">Berikut adalah kurasi berita pilihan untuk Anda hari ini.</p>
                </div>
                <?php if($_SESSION['level'] == 'admin'): ?>
                    <a href="admin/index.php" class="btn btn-light btn-sm rounded-pill px-4 fw-bold text-primary shadow-sm d-none d-md-block">Dashboard Admin</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="search-container">
        <i id="btn-clear" class="fas fa-times-circle"></i>
        <input type="text" id="keyword" class="form-control search-box" placeholder="Cari topik yang kamu suka..." autocomplete="off">
        <i class="fas fa-search search-icon-right"></i>
    </div>

    <div id="hot-news-area">
        <?php if($hero): ?>
        <div class="hero-section mb-5">
            <img src="assets/uploads/<?= $hero['gambar'] ?>" class="hero-img">
            <div class="hero-overlay">
                <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill shadow">HOT NEWS</span>
                <h1 class="display-4 fw-bold mb-2"><?= htmlspecialchars($hero['judul']) ?></h1>
                <p class="lead mb-4 opacity-75 small w-75"><?= substr(strip_tags($hero['isi']), 0, 160) ?>...</p>
                <a href="detail.php?id=<?= $hero['id_berita'] ?>" class="btn btn-light rounded-pill fw-bold px-5 py-3 shadow-lg">Baca Sekarang</a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div id="container-berita">
        <h2 class="fw-bold mb-4 ps-3 border-start border-primary border-5">Terbaru Untuk Anda</h2>
        <div class="row g-4">
            <?php while($berita = mysqli_fetch_array($sql_list)): ?>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card news-card">
                    <div class="card-img-wrapper">
                        <span class="badge-premium"><?= htmlspecialchars($berita['kategori']) ?></span>
                        <img src="assets/uploads/<?= $berita['gambar'] ?>" alt="News">
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <a href="detail.php?id=<?= $berita['id_berita'] ?>" class="h6 fw-bold text-dark text-decoration-none mb-3"><?= htmlspecialchars($berita['judul']) ?></a>
                        <div class="small text-muted mb-4"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($berita['tanggal'])) ?></div>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="detail.php?id=<?= $berita['id_berita'] ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3">Detail &rarr;</a>
                            <a href="download_zip.php?id=<?= $berita['id_berita'] ?>" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                <i class="fas fa-file-archive me-1"></i> ZIP
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div id="pagination-area" class="mt-5 pb-5">
        <nav>
            <ul class="pagination justify-content-center">
                <?php for($i=1; $i<=$total_halaman; $i++): ?>
                    <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
                        <a class="page-link shadow-sm" href="?halaman=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>

<footer class="bg-white border-top py-4 mt-5">
    <div class="container text-center">
        <p class="text-muted small mb-0">&copy; 2026 Portal Berita </p>
    </div>
</footer>

<script>
    const keyword = document.getElementById('keyword');
    const btnClear = document.getElementById('btn-clear');
    const containerBerita = document.getElementById('container-berita');
    const hotNewsArea = document.getElementById('hot-news-area');
    const paginationArea = document.getElementById('pagination-area');
    const welcomeArea = document.getElementById('welcome-area');

    function loadNews(val) {
        if (val.length > 0) {
            if(hotNewsArea) hotNewsArea.style.display = 'none';
            if(paginationArea) paginationArea.style.display = 'none';
            if(welcomeArea) welcomeArea.style.display = 'none';
        } else {
            if(hotNewsArea) hotNewsArea.style.display = 'block';
            if(paginationArea) paginationArea.style.display = 'block';
            if(welcomeArea) welcomeArea.style.display = 'block';
        }
        
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                containerBerita.innerHTML = xhr.responseText;
            }
        };
        xhr.open('GET', 'ajax_cari.php?keyword=' + val, true); //
        xhr.send();
    }

    keyword.addEventListener('keyup', function() {
        btnClear.style.display = (this.value.length > 0) ? 'block' : 'none';
        loadNews(this.value);
    });

    btnClear.addEventListener('click', function() {
        keyword.value = '';
        this.style.display = 'none';
        loadNews('');
        keyword.focus();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>