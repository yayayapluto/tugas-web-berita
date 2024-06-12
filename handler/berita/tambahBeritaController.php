<?php 
require_once("./controller/beritaController.php");
$Berita = new BeritaController();
session_start();

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$penulis = $_SESSION['data_pengguna']['id'];

$url_gambar = "";
if (!empty($_POST['url_gambar'])) {
    $url_gambar = $_POST['url_gambar'];
} 
elseif (isset($_FILES['file_gambar']['name'])) {
    $gambar = $_FILES['file_gambar']['name'];
    $target_dir = "../uploads/";
    $target_img = $target_dir . basename($gambar);
    if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $target_img)) {
        $url_gambar = $target_img;
    } else {
        $_SESSION['error_msg'] = "Gagal upload gambar: " . $target_img;//$_FILES['file_gambar']['error'];
        header("Location: /web_berita/pengguna/buatBerita");
        exit();
    }
} 
else {
    $_SESSION['error_msg'] = "Gambar tidak boleh kosong";
    header("Location: /web_berita/pengguna/buatBerita");
    exit();
}

// Mengganti spasi menjadi -
$judul_berita = str_replace(" ", "-", $judul);

$hasil = $Berita->buat_berita($judul_berita, $url_gambar, $deskripsi, $penulis);

if (!$hasil) {
    $_SESSION['error_msg'] = "Gagal membuat berita, harap ulangi lagi";
    header("Location: /web_berita/pengguna/buatBerita");
    exit();
} else {
    $_SESSION['success_msg'] = "Berhasil menambahkan berita dengan judul <b>$judul</b>";
    header("Location: /web_berita/pengguna");
    exit();
}
?>
