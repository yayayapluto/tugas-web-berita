<?php 
require_once("./controller/beritaController.php");
$Berita = new BeritaController();
session_start();

$judul = htmlspecialchars($_POST['judul']);
$deskripsi = htmlspecialchars($_POST['deskripsi']);
$id_berita = $_POST['id'];
$penulis = $_SESSION['data_pengguna']['id'];

//mengganti spasi menjadi -
$judul = str_replace(" ", "-", $judul);

if ($Berita->tampilkan_jumlah_berita_berdasarkan_judul($judul) > 1) {
    $_SESSION['error_msg'] = "Judul berita tidak tersedia";
    header("Location: /web_berita/pengguna/ubahBerita/" . $_POST['url_judul']);
    exit();
} else {
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
            header("Location: /web_berita/pengguna/ubahBerita/" . $_POST['url_judul']);
            exit();
        }
    } 
    else {
        $_SESSION['error_msg'] = "Gambar tidak boleh kosong atau terjadi masalah saat upload";
        header("Location: /web_berita/pengguna/ubahBerita/" . $_POST['url_judul']);
        exit();
    }

    $hasil = $Berita->ubah_berita($id_berita,$judul,$url_gambar,$deskripsi,$penulis);

    $judul = str_replace("-", " ", $judul);
    if (!$hasil) {
        $_SESSION['error_msg'] = "Gagal mengubah berita, harap ulangi lagi";
        header("Location: /web_berita/pengguna/ubahBerita/" . $_POST['url_judul']);
        exit();
    } else {
        $_SESSION['success_msg'] = "Berhasil mengubah berita dengan judul <b>$judul</b>";
        header("Location: /web_berita/pengguna");
        exit();
    }
}
?>