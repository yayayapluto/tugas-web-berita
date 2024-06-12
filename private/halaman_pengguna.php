<?php 
session_start();
if (!isset($_SESSION['data_pengguna'])) {
  $_SESSION['error_msg'] = "Tidak bisa mengakses halaman tersebut, Masuk terlebih dahulu";
  header("Location: /web_berita");
  exit();
}

$pengguna = $_SESSION['data_pengguna'];
require_once("./controller/beritaController.php");
$Berita = new BeritaController();
$daftar_berita = $Berita->tampilkan_berita_berdasarkan_penulis($pengguna['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile - Web Berita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
  <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
    <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
    <div class="flex items-center space-x-4">
      <a href="/web_berita" class="text-blue-700 hover:text-blue-800">Beranda</a>
    </div>
  </nav>

  <?php include("./components/banner.php") ?>

  <section class="container mx-auto px-4 py-8 min-h-screen flex flex-col items-center">

    <div class="bg-white rounded shadow px-8 py-8 w-full md:w-1/2 mb-8">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Profil pengguna</h2>
      <ul class="list-disc list-inside space-y-2 p-2 mb-4">
        <li>Nama: <?= $pengguna['nama'] ?></li>
        <li>Email: <?= $pengguna['email'] ?></li>
        <li>No Telepon: <?= $pengguna['nomor_telepon'] ?>2</li>
      </ul>
      <a href="/web_berita/keluar" class="h-10 py-2 px-3 text-center bg-red-500 text-white rounded-xl shadow-md hover:bg-red-600 focus:outline-none">Keluar</a>
    </div>

    <a href="/web_berita/pengguna/buatBerita" class="w-1/2 h-12 p-3 text-center bg-blue-500 text-white rounded-xl shadow-md hover:bg-blue-600 focus:outline-none">Tulis berita baru</a>

    <div class="bg-white rounded shadow px-8 py-8 w-full mt-8 md:w-1/2">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Daftar berita yang kamu tulis</h2>
      <ul class="space-y-4">

        <?php if($daftar_berita > 0): ?>
          <?php foreach($daftar_berita as $berita): ?>
            <li class="flex justify-between items-center py-2 border-b border-gray-200">
              <a href="/web_berita/baca/<?= $berita['judul'] ?>" class="text-gray-700 hover:text-blue-700 font-bold text-ellipsis text-nowrap overflow-hidden w-20  lg:w-72"><?= str_replace("-"," ",$berita['judul']) ?></a>
              <span class="text-gray-500 text-sm"><?= $berita['waktu_dibuat'] ?></span>
              <div class="flex space-x-2">  
                <a href="/web_berita/pengguna/ubahBerita/<?= $berita['judul']?>" class="px-2 py-1 text-sm text-blue-700 hover:bg-blue-200 rounded-md border border-blue-700">Ubah</a>
                <a href="/web_berita/pengguna/hapusBerita/<?= $berita['judul'] ?>"><button type="button" class="px-2 py-1 text-sm text-red-500 hover:bg-red-200 rounded-md border border-red-500 confirm-delete">Hapus</button></a>
              </div>
            </li>
          <?php endforeach ?>
          <?php else: ?>
            <li class="flex justify-between items-center py-2 border-b border-gray-200">
              <span class="text-gray-500 text-sm">Belum ada berita yang kamu tulis</span>
            </li>
        <?php endif ?>

      </ul>
    </div>
  
  </section>

</body>

</html>
