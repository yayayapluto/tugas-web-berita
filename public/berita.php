<?php
require_once ("./controller/beritaController.php");
require_once ("./controller/komentarController.php");
$Berita = new BeritaController();
$Komentar = new KomentarController();

$berita = $Berita->tampilkan_berita($judul_berita);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News Detail - News Today</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />
</head>

<body class="bg-gray-100 text-gray-800">
  <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center sticky top-0 z-10">
    <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
    <div class="flex items-center space-x-4">
      <?php
      if (isset($_SESSION['data_pengguna'])) {
        echo "<a href='/web_berita/pengguna' class='text-blue-600 hover:text-blue-800'>Profil</a>";
      } else {
        echo "<a href='/web_berita/masuk' class='text-blue-600 hover:text-blue-800'>Masuk</a>";
        echo "<p>/</p>";
        echo "<a href='/web_berita/daftar' class='text-blue-600 hover:text-blue-800'>Daftar</a>";
      }
      ?>
    </div>
  </nav>

  <?php if ($Berita->tampilkan_berita($judul_berita) > 0): ?>
    <section class="flex flex-col items-center bg-gray-100 py-0 m-2 lg:m-4">
      <div class="bg-white rounded shadow px-8 py-8 w-full max-w-screen-lg">
        <h2 class="text-xl font-bold mb-4"><?= str_replace("-", " ", $berita['judul']) ?></h2>
        <p class="text-gray-700 mb-2">Oleh <?= $berita['penulis'] ?> - <?= $berita['waktu_dibuat'] ?></p>
        <img src="<?= (str_contains($berita['url_gambar'], "./media/") ? "." . $berita['url_gambar'] : $berita['url_gambar']) ?>" class="h-96 mx-auto aspect-video object-contain rounded-xl mb-4"
          alt="<?= "Gambar untuk judul: " . str_replace("-", " ", $berita['judul']) ?>">
        <p class="text-gray-700 text-base text-justify my-4"><?= $berita['deskripsi'] ?></p>
      </div>
    </section>
  <?php else: ?>
    <section class="flex flex-col items-center bg-gray-100 py-0 m-2 lg:m-4">
      <div class="bg-white rounded shadow px-8 py-8 w-full max-w-screen-lg">
        <h2 class="text-xl font-bold my-4">Tidak dapat menemukan berita dengan judul
          <b><?= str_replace("-", " ", $judul_berita) ?></b></h2>
      </div>
    </section>
  <?php endif ?>
  
  <?php if(isset($_SESSION['data_pengguna'])): ?>
    <section class="flex flex-col items-center bg-gray-100 py-0 m-2 lg:m-4">
    <div class="bg-white rounded shadow px-8 py-8 w-full max-w-screen-lg">
      <h3 class="text-lg font-bold mb-4">Buat komentar</h3>
      <form action="/web_berita/handler/tambah_komentar" method="POST" class="w-full">
        <input type="hidden" name="url_berita" value="<?= $judul_berita ?>">
        <input type="hidden" name="id_berita" value="<?= $berita['id'] ?>">
        <input type="hidden" name="id_pengguna" value="<?= $_SESSION['data_pengguna']['id'] ?>">
        <textarea name="komentar" rows="4" class="w-full p-2 border rounded mb-4" placeholder="Write your comment..."></textarea>
        <div class="flex justify-between items-center">
          <button type="submit" class="bg-blue-700 text-white rounded-full px-4 py-2 hover:bg-blue-800 focus:outline-none">Posting komentar</button>
        </div>
      </form>
    </div>
  </section>
  <?php endif ?>
  
  <section class="flex flex-col items-center bg-gray-100 py-0 m-2 lg:m-4">
    <div class="bg-white rounded shadow px-8 py-8 w-full max-w-screen-lg">
      <h3 class="text-lg font-bold mb-4">Komentar</h3>
      <div class="space-y-4">
        <!-- Placeholder for comments -->
         <?php if(count($komentar = $Komentar->tampilkan_semua_komentar_dengan_idBerita($berita['id'])) > 0): ?>
          <?php foreach($komentar = $Komentar->tampilkan_semua_komentar_dengan_idBerita($berita['id']) as $daftar_berita): ?>
            <div class="bg-gray-50 p-4 rounded shadow">
              <p class="text-gray-800 font-regular mb-1"><?= $daftar_berita['nama'] ?> - <span class="text-gray-300 text-sm"><?= $daftar_berita['created_at'] ?></span></p>
              <p class="text-gray-700"><?= $daftar_berita['isi'] ?></p>
            </div>
          <?php endforeach ?>
          <?php else: ?>
            <p class="text-gray-600">Belum ada komentar...</p>
        <?php endif ?>
        <!-- More comments can be added here -->
      </div>
    </div>
  </section>

  <div class="fixed bottom-8 right-8 flex justify-center">
    <a href="/web_berita" class="bg-blue-700 text-white rounded-full px-4 py-2 hover:bg-blue-800 focus:outline-none z-10">
      <p class="text-lg">Kembali ke beranda</p>
    </a>
  </div>
</body>

</html>
