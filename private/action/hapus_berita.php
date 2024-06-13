<?php 
require_once("./controller/beritaController.php");
$Berita = new BeritaController();
$data_berita = $Berita->tampilkan_berita($judul_berita);

session_start();
if (!isset($_SESSION['data_pengguna'])) {
  $_SESSION['error_msg'] = "Tidak bisa mengakses halaman tersebut, Masuk terlebih dahulu";
  header("Location: /web_berita");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Hapus Berita - Web Berita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
  <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center sticky top-0">
    <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
    <div class="flex items-center space-x-4">
      <a href="/web_berita" class="text-blue-700 hover:text-blue-800">Beranda</a>
    </div>
  </nav>

  <section class="container mx-auto px-4 py-8 min-h-screen flex flex-col items-center">
    <div class="bg-white rounded shadow px-8 py-8 w-full md:w-1/2">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Hapus Berita</h2>
      <p class="text-gray-700 mb-6">Anda yakin ingin menghapus berita berikut?</p>
      <h3 class="text-lg font-semibold mb-2 text-gray-700"><?= str_replace("-", " ", $data_berita['judul']) ?></h3>
      <div class="flex justify-between items-center py-2 border-b border-gray-200">
        <div class="w-full">
          <p class="text-gray-700 text-ellipsis text-nowrap overflow-hidden w-2/3 lg:w-[90%] "><?= $data_berita['deskripsi'] ?></p>
        </div>
      </div>
      <div class="flex justify-end space-x-4 mt-4">
        <a href="/web_berita/pengguna" class="px-3 py-2 text-center text-gray-500 hover:text-gray-700 hover:bg-gray-200 rounded-md border border-gray-300">Batal</a>
        <a href="/web_berita/handler/hapus_berita/<?= $data_berita['id'] ?>/<?= $data_berita['judul'] ?>"><button type="button" class="px-3 py-2 text-center text-red-500 hover:text-red-600 rounded-md bg-red-100 hover:bg-red-200 border border-red-200 confirm-delete">Hapus</button></a>
      </div>
    </div>
  </section>
</body>

</html>
