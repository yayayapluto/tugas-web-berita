<?php 
require_once("./controller/authController.php");
$Auth = new AuthController();

$nama = htmlspecialchars($_POST['nama']);
$password = htmlspecialchars($_POST['password']);
$konfirmasi_password = htmlspecialchars($_POST['konfirmasi_password']);
$email = htmlspecialchars($_POST['email']);
$nomor_telepon = htmlspecialchars($_POST['nomor_telepon']);

session_start();

if ($konfirmasi_password != $password) {
    $_SESSION['error_msg'] =  "Konfirmasi password salah, pastikan password sama dengan yang anda ketik sebelumnya";
    header("Location: /web_berita/daftar");
    exit();
}

$result = $Auth->daftar($nama, $password, $email, $nomor_telepon);

if (!$result) {
    $_SESSION['error_msg'] = ($result ? "Gagal menambahkan pengguna" : "Nama <b>$nama</b> sudah terpakai, mohon pilih nama yang lain" );
    header("Location: /web_berita/daftar");
    exit();
} else {
    $_SESSION['success_msg'] = $result . ", Silahkan login";
    header("Location: /web_berita/masuk");
    exit();
}
?>