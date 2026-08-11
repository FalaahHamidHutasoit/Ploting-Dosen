<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../../config/koneksi.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_hapus = (int)$_GET['id'];
    
    $data_cek = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_berita WHERE id_kategori=$id_hapus"));

    if ($data_cek['total'] > 0) {
        header("Location: tampil.php?status=fail_used");
    } else {
        $query_hapus = "DELETE FROM tb_kategori WHERE id_kategori = $id_hapus";
        mysqli_query($conn, $query_hapus);
        header("Location: tampil.php?status=deleted");
    }
    exit;
}

$query = "SELECT k.id_kategori, k.kategori, COUNT(b.id_berita) AS total_berita 
          FROM tb_kategori k 
          LEFT JOIN tb_berita b ON k.id_kategori = b.id_kategori 
          GROUP BY k.id_kategori 
          ORDER BY k.kategori ASC";
$sql = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin Panel</title>
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

        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--light-bg); display: flex; min-height: 100vh; }

        .sidebar { width: var(--sidebar-width); background: linear-gradient(180deg, var(--primary-navy) 0%, var(--secondary-navy) 100%); color: white; position: fixed; height: 100vh; display: flex; flex-direction: column; }
        .sidebar-header { padding: 30px 25px; font-size: 1.25rem; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .nav-link { color: rgba(255,255,255,0.7); padding: 12px 25px; display: flex; align-items: center; text-decoration: none; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); border-left: 4px solid #fff; }
        .nav-link i { width: 25px; }

        .main-content { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); padding: 40px; }

        .category-card { 
            background: white; border-radius: 20px; border: none; 
            transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            height: 100%; position: relative; overflow: hidden;
        }
        .category-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.08); }
        
        .card-accent { position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: var(--primary-navy); }

        .cat-icon { 
            width: 50px; height: 50px; background: #eef4ff; color: var(--primary-navy);
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; margin-bottom: 20px;
        }

        .cat-name { font-weight: 700; color: #333; font-size: 1.15rem; margin-bottom: 5px; }
        .cat-count { font-size: 0.85rem; color: #888; font-weight: 600; }

        .action-area { margin-top: 25px; padding-top: 15px; border-top: 1px solid #f0f0f0; display: flex; justify-content: flex-end; }
        .btn-circle { width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: 8px; font-size: 0.85rem; border: none; transition: 0.3s; }
        
        .btn-edit { background: #fff8e6; color: #f59e0b; }
        .btn-edit:hover { background: #f59e0b; color: white; }
        .btn-delete { background: #fff0f0; color: #dc3545; }
        .btn-delete:hover { background: #dc3545; color: white; }

        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header"><i class="fas fa-newspaper me-2"></i> ADMIN PANEL</div>
    <div class="nav-menu mt-4">
        <a href="../index.php" class="nav-link"><i class="fas fa-th-large"></i> Dashboard</a>
        <a href="../berita/tampil.php" class="nav-link"><i class="fas fa-edit"></i> Kelola Berita</a>
        <a href="tampil.php" class="nav-link active"><i class="fas fa-tags"></i> Kelola Kategori</a>
        <a href="../user/tampil.php" class="nav-link"><i class="fas fa-users"></i> Kelola User</a>
    </div>
    <div class="mt-auto p-4 border-top border-secondary opacity-50">
        <a href="../logout.php" class="nav-link p-0 text-white"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <div>
            <h2 class="fw-bold m-0 text-dark">Kelola Kategori</h2>
            <p class="text-muted m-0 small">Manajemen pengelompokan berita Anda</p>
        </div>
        <a href="tambah.php" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Kategori
        </a>
    </div>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'deleted'): ?>
            <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">Kategori berhasil dihapus secara permanen.</div>
        <?php elseif ($_GET['status'] == 'fail_used'): ?>
            <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">Gagal! Kategori tidak bisa dihapus karena masih digunakan oleh beberapa berita.</div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="row g-4">
        <?php if(mysqli_num_rows($sql) > 0): ?>
            <?php while($row = mysqli_fetch_array($sql)): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card category-card p-4">
                    <div class="card-accent"></div>
                    <div class="cat-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="cat-name"><?= htmlspecialchars($row['kategori']) ?></div>
                    <div class="cat-count">
                        <i class="far fa-file-alt me-1"></i> <?= $row['total_berita'] ?> Berita Terkait
                    </div>
                    
                    <div class="action-area">
                        <a href="edit.php?id=<?= $row['id_kategori'] ?>" class="btn-circle btn-edit" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <button onclick="confirmDelete(<?= $row['id_kategori'] ?>)" class="btn-circle btn-delete" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-tags fa-4x text-light mb-3"></i>
                <p class="text-muted">Belum ada kategori yang tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.")) {
            window.location.href = 'tampil.php?aksi=hapus&id=' + id;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>