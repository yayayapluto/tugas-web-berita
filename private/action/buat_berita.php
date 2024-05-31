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

<body class="bg-gray-100 text-gray-800">
  <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
    <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
  </nav>

  <?php include('./components/banner.php') ?>

  <section class="container mx-auto px-4 py-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Buat berita baru</h2>

    <form action="/web_berita/handler/tambah_berita" method="post">
    <div class="flex flex-col space-y-4 bg-white rounded shadow-md p-8">
      <div class="flex flex-col">
        <label for="judul" class="text-sm font-medium">Judul Berita</label>
        <input type="text" id="judul" name="judul" placeholder="..." class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
      </div>

      <div class="flex flex-col">
        <label for="url_gambar" class="text-sm font-medium">Url Gambar</label>
        <input type="text" id="url_gambar" name="url_gambar" placeholder="Mohon gunakan format berikut: jpg, jpeg, png" class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
      </div>

      <div class="flex flex-col">
        <label for="deskripsi" class="text-sm font-medium">Deskripsi</label>
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
