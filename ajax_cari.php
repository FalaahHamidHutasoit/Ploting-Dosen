<?php
include 'config/koneksi.php'; 

$keyword = mysqli_real_escape_string($conn, $_GET['keyword']);

$query = "SELECT b.*, k.kategori, u.user_name 
          FROM tb_berita b 
          JOIN tb_kategori k ON b.id_kategori = k.id_kategori
          JOIN tb_user u ON b.id_user = u.id_user
          WHERE b.judul LIKE '%$keyword%' 
          ORDER BY b.tanggal DESC";
$sql = mysqli_query($conn, $query);
?>

<h2 class="fw-bold mb-4 ps-2 border-start border-primary border-4">
    Hasil Pencarian: "<?= htmlspecialchars($keyword) ?>"
</h2>

<div class="row">
    <?php if(mysqli_num_rows($sql) > 0): ?>
        <?php while($row = mysqli_fetch_array($sql)): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <span class="badge-kat"><?= $row['kategori'] ?></span>
                <img src="assets/uploads/<?= $row['gambar'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><?= htmlspecialchars($row['judul']) ?></h5>
                    <div class="small text-muted mb-3">
                        <i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($row['tanggal'])) ?>
                    </div>
                    <a href="detail.php?id=<?= $row['id_berita'] ?>" class="btn btn-outline-primary btn-sm rounded-pill">Detail Berita &rarr;</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <i class="fas fa-search fa-3x text-light mb-3"></i>
            <p class="text-muted italic">Berita tidak ditemukan. Coba keyword lain, Brody!</p>
        </div>
    <?php endif; ?>
</div>