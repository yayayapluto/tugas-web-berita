<?php 
require_once("./controller/sukaController.php");

$Suka = new SukaController();

$id_pengguna = $_POST['id_pengguna'];
$id_berita = $_POST['id_berita'];
$url_berita = $_POST['url_berita'];

if(!$Suka->hapus_suka($id_pengguna, $id_berita)) {
    $_SESSION['error_msg'] = "Gagal melakukan aksi like";
}

header("Location: /web_berita/baca/$url_berita");
exit();
?>