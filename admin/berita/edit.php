<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../../config/koneksi.php'; //

if (!isset($_GET['id'])) {
    header('Location: tampil.php');
    exit;
}

$id = (int)$_GET['id'];
$query_data = mysqli_query($conn, "SELECT * FROM tb_berita WHERE id_berita = $id");
$data = mysqli_fetch_assoc($query_data);

if (!$data) {
    header('Location: tampil.php');
    exit;
}

if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $id_kategori = $_POST['id_kategori'];
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar_lama = $_POST['gambar_lama'];

    if ($_FILES['gambar']['name'] != "") {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = "img_" . time() . "." . $ekstensi;

        if (move_uploaded_file($tmp_file, "../../../assets/uploads/" . $nama_baru)) {
            if (file_exists("../../../assets/uploads/" . $gambar_lama)) {
                unlink("../../../assets/uploads/" . $gambar_lama);
            }
            $gambar_final = $nama_baru;
        }
    } else {
        $gambar_final = $gambar_lama;
    }

    $query_update = "UPDATE tb_berita SET 
                     judul = '$judul', 
                     id_kategori = '$id_kategori', 
                     isi = '$isi', 
                     gambar = '$gambar_final' 
                     WHERE id_berita = $id";

    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('Berita Berhasil Diperbarui!'); window.location='tampil.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Admin Panel</title>
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
        }
        
        .form-label { font-weight: 600; color: #444; font-size: 0.9rem; margin-bottom: 10px; }
        
        .form-control, .form-select { 
            border-radius: 12px; padding: 12px 15px; border: 1px solid #e0e6ed; 
            background-color: #f9fbff; transition: 0.3s; 
        }
        
        .form-control:focus, .form-select:focus { 
            border-color: var(--primary-navy); box-shadow: 0 0 0 4px rgba(30, 60, 114, 0.1); 
            background-color: #fff;
        }

        .preview-container {
            border: 2px dashed #e0e6ed; border-radius: 15px;
            padding: 15px; text-align: center; background: #f9fbff; margin-bottom: 20px;
        }
        .preview-img-box img { max-width: 100%; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

        .btn-update { 
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            border: none; border-radius: 12px; padding: 12px 30px; font-weight: 700; color: white;
            box-shadow: 0 10px 20px rgba(243, 156, 18, 0.2); transition: 0.3s;
        }
        .btn-update:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(243, 156, 18, 0.3); color: white; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header"><i class="fas fa-newspaper me-2"></i> ADMIN PANEL</div>
    <div class="nav-menu mt-4">
        <a href="../index.php" class="nav-link"><i class="fas fa-th-large me-2"></i> Dashboard</a>
        <a href="tampil.php" class="nav-link active"><i class="fas fa-edit me-2"></i> Kelola Berita</a>
        <a href="../kategori/tampil.php" class="nav-link"><i class="fas fa-tags me-2"></i> Kelola Kategori</a>
        <a href="../user/tampil.php" class="nav-link"><i class="fas fa-users me-2"></i> Kelola User</a>
    </div>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold m-0 text-dark">Edit Berita (ID: <?= $id ?>)</h2>
            <p class="text-muted m-0">Sesuaikan informasi atau perbarui gambar berita</p>
        </div>
        <a href="tampil.php" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
            <i class="fas fa-arrow-left me-2"></i> Batal & Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Isi Berita Lengkap</label>
                        <textarea name="isi" class="form-control" rows="15" required><?= htmlspecialchars($data['isi']) ?></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label">Update Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <?php 
                            $kat = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori ASC");
                            while($k = mysqli_fetch_array($kat)) {
                                $selected = ($k['id_kategori'] == $data['id_kategori']) ? 'selected' : '';
                                echo "<option value='{$k['id_kategori']}' $selected>{$k['kategori']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Gambar Berita</label>
                        <div class="preview-container">
                            <p class="small text-muted mb-2">Preview Gambar:</p>
                            <div id="preview-area" class="preview-img-box">
                                <?php if($data['gambar']): ?>
                                    <img src="../../../assets/uploads/<?= $data['gambar'] ?>" id="img-lama">
                                <?php else: ?>
                                    <i class="fas fa-image fa-3x text-light"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <input type="file" name="gambar" id="gambar-input" class="form-control" onchange="previewImg(event)">
                            <small class="text-muted d-block mt-2">Kosongkan jika tidak ingin mengganti gambar</small>
                        </div>
                    </div>

                    <button type="submit" name="update" class="btn btn-update w-100 py-3">
                        <i class="fas fa-sync-alt me-2"></i> Perbarui Berita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImg(event) {
        const preview = document.getElementById('preview-area');
        const reader = new FileReader();
        
        reader.onload = function() {
            preview.innerHTML = `<img src="${reader.result}" class="shadow-sm">`;
        }
        
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>