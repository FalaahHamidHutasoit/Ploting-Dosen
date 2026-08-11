<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header('Location: ../login.php');
    exit;
}

include '../../config/koneksi.php'; 
if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $id_kategori = $_POST['id_kategori'];
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $id_user = $_SESSION['id_user'];
    $tanggal = date('Y-m-d');
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_baru = "img_" . time() . "." . $ekstensi;

    if (move_uploaded_file($tmp_file, "../../assets/uploads/" . $nama_baru)) {
        $query = "INSERT INTO tb_berita (judul, id_kategori, isi, gambar, tanggal, id_user) 
                  VALUES ('$judul', '$id_kategori', '$isi', '$nama_baru', '$tanggal', '$id_user')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Berita Berhasil Disimpan!'); window.location='tampil.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita - Admin Panel</title>
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

        .file-upload-wrapper {
            position: relative; border: 2px dashed #e0e6ed; border-radius: 15px;
            padding: 30px; text-align: center; background: #f9fbff; cursor: pointer; transition: 0.3s;
        }
        .file-upload-wrapper:hover { border-color: var(--primary-navy); background: #f0f5ff; }

        .btn-save { 
            background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
            border: none; border-radius: 12px; padding: 12px 30px; font-weight: 700; color: white;
            box-shadow: 0 10px 20px rgba(30, 60, 114, 0.2); transition: 0.3s;
        }
        .btn-save:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(30, 60, 114, 0.3); color: white; }
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
            <h2 class="fw-bold m-0 text-dark">Tulis Berita Baru</h2>
            <p class="text-muted m-0">Bagikan informasi terbaru ke pembaca setia Anda</p>
        </div>
        <a href="tampil.php" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
            <i class="fas fa-arrow-left me-2"></i> Batal & Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul yang menarik..." required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Isi Berita Lengkap</label>
                        <textarea name="isi" class="form-control" rows="12" placeholder="Tuliskan isi berita Anda di sini..." required></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-4">
                        <label class="form-label">Pilih Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <?php 
                            $kat = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori ASC");
                            while($k = mysqli_fetch_array($kat)) {
                                echo "<option value='{$k['id_kategori']}'>{$k['kategori']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Gambar Utama</label>
                        <div class="file-upload-wrapper" onclick="document.getElementById('gambar').click()">
                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted small m-0">Klik untuk upload gambar atau tarik file ke sini</p>
                            <input type="file" name="gambar" id="gambar" class="d-none" required onchange="previewImg(event)">
                        </div>
                        <div id="preview-area" class="mt-3 text-center"></div>
                    </div>

                    <button type="submit" name="simpan" class="btn btn-save w-100 py-3">
                        <i class="fas fa-paper-plane me-2"></i> Terbitkan Berita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImg(event) {
        const preview = document.getElementById('preview-area');
        preview.innerHTML = '';
        const reader = new FileReader();
        reader.onload = function() {
            const img = document.createElement('img');
            img.src = reader.result;
            img.style.width = '100%';
            img.style.borderRadius = '15px';
            img.className = 'shadow-sm';
            preview.appendChild(img);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>