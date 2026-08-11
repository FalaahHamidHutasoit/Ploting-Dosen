<?php
session_start();
include 'config/koneksi.php'; 

if (!isset($_GET['id_kategori'])) {
    header("Location: index.php");
    exit;
}

$id_kategori = (int)$_GET['id_kategori'];
$res_kat = mysqli_query($conn, "SELECT kategori FROM tb_kategori WHERE id_kategori = $id_kategori");
$data_kat = mysqli_fetch_assoc($res_kat);

if (!$data_kat) {
    header("Location: index.php");
    exit;
}

$nama_kategori = $data_kat['kategori'];
$batas = 6;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$posisi = ($halaman - 1) * $batas;

$query = "SELECT b.id_berita, b.judul, b.isi, b.tanggal, b.gambar, k.kategori, u.user_name
          FROM tb_berita b 
          JOIN tb_kategori k ON b.id_kategori = k.id_kategori
          JOIN tb_user u ON b.id_user = u.id_user
          WHERE b.id_kategori = $id_kategori
          ORDER BY b.tanggal DESC 
          LIMIT $posisi, $batas";
$sql = mysqli_query($conn, $query);

$query_total = "SELECT COUNT(*) AS total FROM tb_berita WHERE id_kategori = $id_kategori";
$data_total = mysqli_fetch_assoc(mysqli_query($conn, $query_total));
$total_halaman = ceil($data_total['total'] / $batas);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori: <?= htmlspecialchars($nama_kategori) ?> - Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; color: #333; }
        h1, h2, .navbar-brand { font-family: 'Playfair Display', serif; }
        
        .navbar { background-color: #1e3c72 !important; padding: 12px 0; }
        .navbar-brand { font-weight: 700; color: #fff !important; }

        .category-header {
            background: #fff;
            padding: 40px 0;
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }
        .category-title { color: #1e3c72; font-weight: 700; position: relative; display: inline-block; }
        .category-title::after {
            content: ''; width: 60px; height: 4px; background: #0d6efd;
            position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%);
            border-radius: 2px;
        }
        .card { border: none; border-radius: 18px; transition: 0.3s; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .card-img-top { height: 210px; object-fit: cover; }
        .badge-kat { position: absolute; top: 15px; left: 15px; background: #0d6efd; color: #fff; font-size: 0.7rem; font-weight: 700; padding: 5px 12px; border-radius: 20px; }
        
        .btn-outline-primary { border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-newspaper me-2"></i>PORTAL BERITA</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3" href="index.php">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 active" href="#" data-bs-toggle="dropdown">Kategori</a>
                    <ul class="dropdown-menu shadow">
                        <?php 
                        $kat_q = mysqli_query($conn, "SELECT * FROM tb_kategori"); //
                        while($k = mysqli_fetch_array($kat_q)) {
                            echo "<li><a class='dropdown-item " . ($k['id_kategori'] == $id_kategori ? 'active' : '') . "' href='kategori.php?id_kategori={$k['id_kategori']}'>{$k['kategori']}</a></li>";
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link px-3" href="about.php">About</a></li>
                
                <?php if(isset($_SESSION['admin_login'])): ?>
                    <li class="nav-item ms-lg-3">
                        <span class="text-white-50 me-2 small">Halo, <b class="text-white"><?= $_SESSION['user_name'] ?></b></span>
                        <a href="admin/logout.php" class="btn btn-danger btn-sm rounded-pill px-3">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a href="admin/login.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Login Admin</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="category-header text-center">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted small">Home</a></li>
                <li class="breadcrumb-item active small text-primary" aria-current="page">Kategori Berita</li>
            </ol>
        </nav>
        <h1 class="category-title mb-0">Kategori: <?= htmlspecialchars($nama_kategori) ?></h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php if(mysqli_num_rows($sql) > 0): ?>
            <?php while($berita = mysqli_fetch_array($sql)) { 
                $potongan_isi = substr(strip_tags($berita['isi']), 0, 100) . '...';
            ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <span class="badge-kat"><?= htmlspecialchars($berita['kategori']) ?></span>
                    <?php if ($berita['gambar']): ?>
                        <img src="assets/uploads/<?= $berita['gambar'] ?>" class="card-img-top" alt="<?= htmlspecialchars($berita['judul']) ?>">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">
                            <a href="detail.php?id=<?= $berita['id_berita'] ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($berita['judul']) ?></a>
                        </h5>
                        <p class="small text-muted mb-3">
                            <i class="fas fa-user me-1"></i> <?= htmlspecialchars($berita['user_name']) ?> | 
                            <i class="fas fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($berita['tanggal'])) ?>
                        </p>
                        <p class="card-text text-muted flex-grow-1">
                            <?= $potongan_isi ?>
                        </p>
                        <a href="detail.php?id=<?= $berita['id_berita'] ?>" class="btn btn-outline-primary mt-3">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <div class="alert alert-info border-0 shadow-sm rounded-4 p-4">
                    <i class="fas fa-info-circle fa-2x mb-3 d-block text-primary"></i>
                    Belum ada berita dalam kategori <b><?= htmlspecialchars($nama_kategori) ?></b> saat ini.
                </div>
            </div>
        <?php endif; ?>
    </div>

    <nav class="mt-5 pb-5">
        <ul class="pagination justify-content-center">
            <?php for($i=1; $i<=$total_halaman; $i++): ?>
                <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
                    <a class="page-link shadow-sm mx-1 rounded-circle" href="?id_kategori=<?= $id_kategori ?>&halaman=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<footer class="bg-dark text-white py-4 text-center mt-5">
    <small>&copy; 2026 Portal Berita</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>