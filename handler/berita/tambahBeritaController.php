<?php 
require_once("./controller/beritaController.php");
$Berita = new BeritaController();
session_start();

$judul = htmlspecialchars($_POST['judul']);
$deskripsi = htmlspecialchars($_POST['deskripsi']);
$penulis = $_SESSION['data_pengguna']['id'];

// Mengganti spasi menjadi -
$judul_berita = str_replace(" ", "-", $judul);

if ($Berita->tampilkan_jumlah_berita_berdasarkan_judul($judul_berita) > 0) {
    $_SESSION['error_msg'] = "Judul berita tidak tersedia";
    header("Location: /web_berita/pengguna/buatBerita");
    exit();
} 
else {
    $url_gambar = "";
    if(!empty($_POST['url_gambar'])) {
        $url_gambar = $_POST['url_gambar'];
    }
    elseif (!empty($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar = $_FILES['file_gambar']['name'];
        $target_dir = "./media/";

        // if(!is_dir($target_dir)) {
        //     mkdir($target_dir, 0777, true);
        // }

        $target_img = $target_dir . basename($gambar);
        
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $target_img)) {
            $url_gambar = $target_img;
        } else {
            $_SESSION['error_msg'] = "Gagal upload gambar: " . $_FILES['file_gambar']['error'];
            header("Location: /web_berita/pengguna/buatBerita");
            exit();
        }
    } 
    else {
        $_SESSION['error_msg'] = "Gambar tidak boleh kosong atau terjadi masalah saat upload";
        header("Location: /web_berita/pengguna/buatBerita");
        exit();
    }

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
}


?>
