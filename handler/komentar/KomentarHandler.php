<?php 
require_once("./controller/komentarController.php");
$Komentar = new KomentarController();

if (isset($_POST)) {
    $url_berita = $_POST['url_berita'];
    $komentar = $_POST['komentar'];
    $id_pengguna = $_POST['id_pengguna'];
    $id_berita = $_POST['id_berita'];
    $Komentar->tambah_komentar($id_pengguna, $id_berita, $komentar);
    header("Location: /web_berita/baca/$url_berita");
}
?>