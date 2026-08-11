<?php
session_start();
include 'config/koneksi.php'; 

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$query = "SELECT b.*, k.kategori, u.user_name 
          FROM tb_berita b 
          JOIN tb_kategori k ON b.id_kategori = k.id_kategori 
          JOIN tb_user u ON b.id_user = u.id_user 
          WHERE b.id_berita = $id";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($sql);

if (!$data) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['judul']) ?> - Portal Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root { --primary-navy: #1e3c72; --accent-blue: #0d6efd; --soft-bg: #f8fbff; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--soft-bg); color: #2d3436; padding: 50px 0; }
        
        .article-container { max-width: 850px; background: #fff; border-radius: 30px; padding: 50px; box-shadow: 0 20px 60px rgba(0,0,0,0.05); margin: 0 auto; }
        .badge-category { background: var(--accent-blue); color: #fff; font-size: 0.75rem; font-weight: 700; padding: 8px 20px; border-radius: 50px; text-transform: uppercase; }
        .article-title { font-family: 'Playfair Display', serif; font-size: 2.8rem; font-weight: 700; margin-top: 20px; line-height: 1.2; }
        .meta-data { display: flex; align-items: center; gap: 20px; color: #a4b0be; margin: 25px 0; font-size: 0.9rem; }
        .main-img { width: 100%; border-radius: 20px; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .article-content { font-size: 1.15rem; line-height: 1.8; color: #4b6584; text-align: justify; }
        
        .btn-action { border-radius: 50px; padding: 12px 30px; font-weight: 700; transition: 0.3s; text-decoration: none; display: inline-flex; align-items: center; }
        .btn-back { border: 2px solid var(--accent-blue); color: var(--accent-blue); }
        .btn-back:hover { background: var(--accent-blue); color: #fff; }
        
        .btn-download { background-color: #27ae60; color: white; border: none; }
        .btn-download:hover { background-color: #219150; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(39, 174, 96, 0.2); color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="article-container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted small">Home</a></li>
                <li class="breadcrumb-item active small text-primary" aria-current="page"><?= htmlspecialchars($data['kategori']) ?></li>
            </ol>
        </nav>

        <span class="badge-category"><?= htmlspecialchars($data['kategori']) ?></span>
        <h1 class="article-title"><?= htmlspecialchars($data['judul']) ?></h1>

        <div class="meta-data">
            <span><i class="fas fa-user-circle me-1"></i> Oleh <b><?= htmlspecialchars($data['user_name']) ?></b></span>
            <span><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($data['tanggal'])) ?></span>
        </div>

        <?php if ($data['gambar']): ?>
            <img src="assets/uploads/<?= $data['gambar'] ?>" class="main-img" alt="News Image">
        <?php endif; ?>

        <div class="article-content mb-5">
            <?= nl2br($data['isi']) ?>
        </div>

        <hr class="my-5 opacity-25">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <a href="index.php" class="btn-action btn-back">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            
            <a href="download_zip.php?id=<?= $id ?>" class="btn-action btn-download">
                <i class="fas fa-file-archive me-2"></i> Download ZIP
            </a>
        </div>

        <div class="mt-5 pt-4 border-top text-center text-md-end">
            <span class="small text-muted me-3 fw-bold">BAGIKAN:</span>
            <a href="#" class="text-muted me-3"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-muted me-3"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-muted"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>