<?php 
require_once("./controller/penggunaController.php");
$Pengguna = new PenggunaController();

session_start();

$id = $_SESSION['data_pengguna']['id'];
$nama = htmlspecialchars($_POST['nama']);
$email = htmlspecialchars($_POST['email']);
$nomor_telepon = htmlspecialchars($_POST['nomor_telepon']);

$gambar = $_FILES['gambar']['name'];
$target_dir = "./media/";
$target_img = $target_dir . basename($gambar);

if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_img)) {
    $_SESSION['error_msg'] = "Gagal menambahkan foto profil";
    header("Location: /web_berita/action/edit_pengguna");
    exit();
}

if($Pengguna->ubah_pengguna($id, $target_img, $nama, $email, $nomor_telepon)) {
    $_SESSION['success_msg'] = "Berhasil mengubah data profil";
    $_SESSION['data_pengguna']['foto_profil'] = $target_img;
    header("Location: /web_berita/pengguna");
    exit();
} else {
    $_SESSION['error_msg'] = "Gagal mengubah data profil";
    header("Location: /web_berita/action/edit_pengguna");
    exit();
}
?>