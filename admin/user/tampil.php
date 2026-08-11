<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../../config/koneksi.php'; 
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_user_hapus = (int)$_GET['id'];
    
    $data_cek = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_berita WHERE id_user=$id_user_hapus"));

    if ($data_cek['total'] > 0) {
        header("Location: tampil.php?status=fail_used");
    } else {
        $query_hapus = "DELETE FROM tb_user WHERE id_user = $id_user_hapus";
        mysqli_query($conn, $query_hapus);
        header("Location: tampil.php?status=deleted");
    }
    exit;
}

$query = "SELECT * FROM tb_user ORDER BY user_name ASC";
$sql = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Admin Panel</title>
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

        .user-card { 
            background: white; border-radius: 20px; border: none; 
            transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            text-align: center; padding: 30px 20px; height: 100%;
        }
        .user-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.08); }

        .avatar-circle {
            width: 80px; height: 80px; background: #f0f4ff; color: var(--primary-navy);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 2rem; margin: 0 auto 20px; border: 3px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .user-name { font-weight: 700; color: #333; font-size: 1.2rem; margin-bottom: 5px; }
        .badge-level { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; padding: 5px 12px; border-radius: 50px; margin-bottom: 15px; display: inline-block; }
        
        .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 5px; }
        .status-aktif { background-color: #198754; color: #198754; }
        .status-nonaktif { background-color: #dc3545; color: #dc3545; }

        .action-group { margin-top: 25px; display: flex; justify-content: center; gap: 10px; }
        .btn-action { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; transition: 0.3s; border: none; }
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
        <a href="../kategori/tampil.php" class="nav-link"><i class="fas fa-tags"></i> Kelola Kategori</a>
        <a href="tampil.php" class="nav-link active"><i class="fas fa-users"></i> Kelola User</a>
    </div>
    <div class="mt-auto p-4 border-top border-secondary opacity-50">
        <a href="../logout.php" class="nav-link p-0 text-white"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <div>
            <h2 class="fw-bold m-0 text-dark">Daftar User</h2>
            <p class="text-muted m-0 small">Manajemen hak akses Admin & Editor</p>
        </div>
        <a href="tambah.php" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
            <i class="fas fa-user-plus me-2"></i> Tambah User Baru
        </a>
    </div>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'deleted'): ?>
            <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">User telah berhasil dihapus dari sistem.</div>
        <?php elseif ($_GET['status'] == 'fail_used'): ?>
            <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">Gagal menghapus! User masih terdaftar sebagai penulis di beberapa berita.</div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="row g-4">
        <?php while($user = mysqli_fetch_array($sql)): ?>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="user-card shadow-sm">
                <div class="avatar-circle">
                    <i class="fas fa-user"></i>
                </div>
                
                <div class="user-name"><?= htmlspecialchars($user['user_name']) ?></div>
                
                <?php 
                    $lvl_class = ($user['level'] == 'admin') ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary';
                ?>
                <span class="badge-level <?= $lvl_class ?>"><?= $user['level'] ?></span>
                
                <div class="small fw-semibold mt-1">
                    <span class="status-dot <?= ($user['status'] == 'aktif') ? 'status-aktif' : 'status-nonaktif' ?>"></span>
                    <span class="<?= ($user['status'] == 'aktif') ? 'text-success' : 'text-danger' ?>">
                        <?= ucfirst($user['status']) ?>
                    </span>
                </div>

                <div class="action-group">
                    <a href="edit.php?id=<?= $user['id_user'] ?>" class="btn-action btn-edit" title="Edit Profil">
                        <i class="fas fa-user-edit"></i>
                    </a>
                    <button onclick="confirmDelete(<?= $user['id_user'] ?>)" class="btn-action btn-delete" title="Hapus User">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Yakin ingin menghapus user ini? User tidak dapat dihapus jika masih terhubung dengan berita.")) {
            window.location.href = 'tampil.php?aksi=hapus&id=' + id;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>