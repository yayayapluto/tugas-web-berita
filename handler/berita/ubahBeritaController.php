<?php 
require_once("./controller/beritaController.php");
$Berita = new BeritaController();
session_start();

$judul = $_POST['judul'];
$url_gambar = $_POST['url_gambar'];
$deskripsi = $_POST['deskripsi'];
$id_berita = $_POST['id'];
$penulis = $_SESSION['data_pengguna']['id'];

//mengganti spasi menjadi -
$judul = str_replace(" ", "-", $judul);

$hasil = $Berita->ubah_berita($id_berita,$judul,$url_gambar,$deskripsi,$penulis);

$judul = str_replace("-", " ", $judul);

if (!$hasil) {
    $_SESSION['error_msg'] = "Gagal mengubah berita, harap ulangi lagi";
    header("Location: /web_berita/pengguna/ubahvBerita");
    exit();
} else {
    $_SESSION['success_msg'] = "Berhasil mengubah berita dengan judul <b>$judul</b>";
    header("Location: /web_berita/pengguna");
    exit();
}
?>