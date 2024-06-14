<?php 
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
  <title>Web Berita - Create News</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const urlGambar = document.getElementById('url_gambar');
      const fileGambar = document.getElementById('file_gambar');

      urlGambar.addEventListener('input', function() {
        fileGambar.disabled = !!urlGambar.value.trim();
      });

      fileGambar.addEventListener('change', function() {
        urlGambar.disabled = fileGambar.files.length > 0;
      });
    });
  </script>
</head>

<body class="bg-gray-100 text-gray-800">
  <div class="sticky top-0">
    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
    </nav>
  
    <?php include('./components/banner.php') ?>
  </div>

  <section class="container mx-auto px-4 py-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Buat berita baru</h2>

    <form action="/web_berita/handler/tambah_berita" method="post" enctype="multipart/form-data">
    <div class="flex flex-col space-y-4 bg-white rounded shadow-md p-8">
      <div class="flex flex-col">
        <label for="judul" class="text-sm font-medium">Judul Berita</label>
        <input type="text" id="judul" name="judul" placeholder="..." class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
      </div>

      <div class="flex flex-col py-2">
        <strong class="text-sm font-medium">Gambar Berita</strong>
        <input type="text" name="url_gambar" id="url_gambar" placeholder="Contoh: https://example.com/image.jpg" class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
        <strong class="text-sm text-center font-medium my-2 lg:my-3">Atau</strong>
        <input type="file" name="file_gambar" id="file_gambar" class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" accept="image/*" required>
      </div>

      <div class="flex flex-col">
        <label for="deskripsi" class="text-sm font-medium ">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="15" placeholder="Tulis berita disini..." class="rounded-md border border-gray-300 px-3 py-2"></textarea>
      </div>

      <div class="flex justify-end space-x-4">
        <a href="/web_berita/pengguna"><button type="button" class="px-4 py-2 rounded-md bg-gray-500 text-white hover:bg-gray-700">Kembali</button></a>
        <button type="submit" class="px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-700">Selesai</button>
      </div>
    </div>
    </form>

  </section>
</body>
</html>
