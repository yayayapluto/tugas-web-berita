<?php 
require_once("./controller/beritaController.php");
$Berita = new BeritaController();
session_start();

$hasil = $Berita->hapus_berita($id_berita);

$judul_berita = str_replace("-", " ", $judul_berita);

if (!$hasil) {
    $_SESSION['error_msg'] = "Gagal menghapus berita, harap ulangi lagi";
    header("Location: /web_berita/pengguna/hapusBerita");
    exit();
} else {
    $_SESSION['success_msg'] = "Berhasil menghapus berita dengan judul <b>$judul_berita</b>";
    header("Location: /web_berita/pengguna");
    exit();
}
?>