<?php 
require_once("./controller/authController.php");
$Auth = new AuthController();

$nama = htmlspecialchars($_POST['nama']);
$password = htmlspecialchars($_POST['password']);

$result = $Auth->masuk($nama, $password);

session_start();

if ($result === "Password salah" || $result === "Pengguna tidak ditemukan") {
    $_SESSION['error_msg'] =  $result;
    header("Location: /web_berita/masuk");
    exit();
} else {
    $_SESSION['data_pengguna'] =  $result;
    header("Location: /web_berita/pengguna");
    exit();
}
?>