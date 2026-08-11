<?php
include 'config/koneksi.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT b.*, k.kategori FROM tb_berita b 
              JOIN tb_kategori k ON b.id_kategori = k.id_kategori 
              WHERE id_berita = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $judul = $data['judul'];
        $isi = strip_tags($data['isi']);
        $nama_gambar = $data['gambar'];
        $kategori = $data['kategori'];
        $tanggal = $data['tanggal'];

        // Nama file ZIP
        $zipName = "Berita_" . str_replace(' ', '_', $judul) . ".zip";
        $zip = new ZipArchive;

        if ($zip->open($zipName, ZipArchive::CREATE) === TRUE) {
            
            $content = "JUDUL: $judul\n";
            $content .= "KATEGORI: $kategori\n";
            $content .= "TANGGAL: $tanggal\n";
            $content .= "---------------------------\n\n";
            $content .= $isi;
            $zip->addFromString('isi_berita.txt', $content);
            $path_gambar = "assets/uploads/" . $nama_gambar;
            if (!empty($nama_gambar) && file_exists($path_gambar)) {
                $zip->addFile($path_gambar, $nama_gambar);
            }

            $zip->close();

            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $zipName);
            header('Content-Length: ' . filesize($zipName));
            readfile($zipName);
            unlink($zipName);
            exit;
        }
    }
}
?>