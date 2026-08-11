<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../../config/koneksi.php'; 
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_hapus = (int)$_GET['id'];
    $cek_gambar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM tb_berita WHERE id_berita=$id_hapus"));
    if ($cek_gambar['gambar'] && file_exists("../../../assets/uploads/" . $cek_gambar['gambar'])) {
        unlink("../../../assets/uploads/" . $cek_gambar['gambar']);
    }

    $query_hapus = "DELETE FROM tb_berita WHERE id_berita = $id_hapus";
    if (mysqli_query($conn, $query_hapus)) {
        header("Location: tampil.php?status=deleted");
    }
    exit;
}
$query = "SELECT b.*, k.kategori, u.user_name 
          FROM tb_berita b 
          JOIN tb_kategori k ON b.id_kategori = k.id_kategori
          JOIN tb_user u ON b.id_user = u.id_user
          ORDER BY b.tanggal DESC";
$sql = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Admin Panel</title>
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

        .sidebar { width: var(--sidebar-width); height: 100vh; background: linear-gradient(180deg, var(--primary-navy) 0%, var(--secondary-navy) 100%); color: white; position: fixed; display: flex; flex-direction: column; }
        .sidebar-header { padding: 30px 25px; font-size: 1.25rem; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .nav-link { color: rgba(255,255,255,0.7); padding: 12px 25px; display: flex; align-items: center; text-decoration: none; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); border-left: 4px solid #fff; }
        .nav-link i { width: 25px; }

        .main-content { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); padding: 40px; }

        .news-item { 
            background: white; border-radius: 20px; padding: 20px; margin-bottom: 20px; 
            display: flex; align-items: center; box-shadow: 0 5px 15px rgba(0,0,0,0.02);
            transition: 0.3s; border: 1px solid transparent;
        }
        .news-item:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.06); border-color: #e0eaff; }

        .news-img { width: 100px; height: 100px; border-radius: 15px; object-fit: cover; margin-right: 25px; }
        .news-info { flex-grow: 1; }
        .news-title { font-weight: 700; color: #333; font-size: 1.1rem; margin-bottom: 5px; text-decoration: none; display: block; }
        .news-meta { font-size: 0.85rem; color: #888; }
        .badge-kategori { background: #e7f0ff; color: #0d6efd; padding: 5px 12px; border-radius: 50px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; }
        
        .action-btns .btn { width: 40px; height: 40px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-left: 8px; transition: 0.3s; }
        .btn-edit { background: #fff8e6; color: #f59e0b; border: none; }
        .btn-edit:hover { background: #f59e0b; color: white; }
        .btn-delete { background: #fff0f0; color: #dc3545; border: none; }
        .btn-delete:hover { background: #dc3545; color: white; }

        .top-action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header"><i class="fas fa-newspaper me-2"></i> ADMIN PANEL</div>
    <div class="nav-menu mt-4">
        <a href="../index.php" class="nav-link"><i class="fas fa-th-large"></i> Dashboard</a>
        <a href="tampil.php" class="nav-link active"><i class="fas fa-edit"></i> Kelola Berita</a>
        <a href="../kategori/tampil.php" class="nav-link"><i class="fas fa-tags"></i> Kelola Kategori</a>
        <a href="../user/tampil.php" class="nav-link"><i class="fas fa-users"></i> Kelola User</a>
    </div>
    <div class="mt-auto p-4"><a href="../logout.php" class="nav-link p-0 text-white"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
</div>

<div class="main-content">
    <div class="top-action-bar">
        <div>
            <h2 class="fw-bold m-0">Kelola Berita</h2>
            <p class="text-muted m-0">Total berita diterbitkan: <b><?= mysqli_num_rows($sql) ?></b></p>
        </div>
        <a href="tambah.php" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Berita Baru
        </a>
    </div>

    <?php if(isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">Berita berhasil dihapus secara permanen.</div>
    <?php endif; ?>

    <div class="news-container">
        <?php if(mysqli_num_rows($sql) > 0): ?>
            <?php while($row = mysqli_fetch_array($sql)): ?>
            <div class="news-item">
                <img src="../../assets/uploads/<?= $row['gambar'] ?>" class="news-img" alt="Thumbnail">
                
                <div class="news-info">
                    <span class="badge-kategori mb-2 d-inline-block"><?= $row['kategori'] ?></span>
                    <a href="#" class="news-title"><?= htmlspecialchars($row['judul']) ?></a>
                    <div class="news-meta">
                        <span class="me-3"><i class="far fa-user me-1"></i> <?= $row['user_name'] ?></span>
                        <span><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($row['tanggal'])) ?></span>
                    </div>
                </div>

                <div class="action-btns">
                    <a href="edit.php?id=<?= $row['id_berita'] ?>" class="btn btn-edit" title="Edit Berita">
                        <i class="fas fa-pen"></i>
                    </a>
                    <button onclick="confirmDelete(<?= $row['id_berita'] ?>)" class="btn btn-delete" title="Hapus Berita">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x text-light mb-3"></i>
                <p class="text-muted">Belum ada berita yang dibuat.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus berita ini secara permanen?")) {
            window.location.href = 'tampil.php?aksi=hapus&id=' + id;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>