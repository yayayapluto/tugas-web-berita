<?php 
session_start();

$nama = $_SESSION['data_pengguna']['nama'];
$email = $_SESSION['data_pengguna']['email'];
$nomor_telepon = $_SESSION['data_pengguna']['nomor_telepon'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <input type="text" name="nama" id="" value="<?= $nama ?>">
        <input type="email" name="email" id="" value="<?= $email ?>" >
        <input type="tel" name="nomor_telepon" id="" value="<?= $nomor_telepon ?>" >
    </form>
</body>
</html>