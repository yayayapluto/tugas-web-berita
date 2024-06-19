<?php
require_once ("./controller/beritaController.php");
require_once ("./controller/komentarController.php");
require_once ("./controller/sukaController.php");
$Berita = new BeritaController();
$Komentar = new KomentarController();
$Suka = new SukaController();

$judul_berita = str_replace("%20","-", $judul_berita);

$berita = $Berita->tampilkan_berita($judul_berita);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Baca berita</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-800">
  <div class="sticky top-0">
    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
    <a class="text-xl font-bold text-gray-800" href="/web_berita">Web Berita</a>
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
    <?php include ("./components/banner.php") ?>
  </div>

  <?php if ($Berita->tampilkan_berita($judul_berita) > 0): ?>
    <section class="flex flex-col items-center bg-gray-100 py-0 m-2 lg:m-4">
      <div class="bg-white rounded shadow px-8 py-8 w-full max-w-screen-lg">
        <h2 class="text-xl font-bold mb-4"><?= str_replace("-", " ", $berita['judul']) ?></h2>
        <p class="text-gray-700 mb-2">Oleh <?= $berita['penulis'] ?> - <?= $berita['waktu_dibuat'] ?></p>
        <img
          src="<?= (str_contains($berita['url_gambar'], "./media/") ? "." . $berita['url_gambar'] : $berita['url_gambar']) ?>"
          class="h-96 mx-auto aspect-video object-contain rounded-xl mb-4"
          alt="<?= "Gambar untuk judul: " . str_replace("-", " ", $berita['judul']) ?>">
        <p class="text-gray-700 text-base text-justify my-4"><?= $berita['deskripsi'] ?></p>
        <div class="flex items-center space-x-2 mt-8">
          <?php if(isset($_SESSION['data_pengguna'])): ?>
            <?php if (!$Suka->tampilkan_semua_suka_dengan_beritaId_dan_penggunaId($berita['id'], $_SESSION['data_pengguna']['id'])): ?>
              <form action="/web_berita/handler/tambah_suka" method="post" class="inline-block">
                <input type="hidden" name="id_pengguna" value="<?= $_SESSION['data_pengguna']['id'] ?>">
                <input type="hidden" name="id_berita" value="<?= $berita['id'] ?>">
                <input type="hidden" name="url_berita" value="<?= $berita['judul'] ?>">
                <button type="submit"
                  class="bg-gray-200 w-12 h-12 rounded-full text-gray-500 text-2xl flex items-center justify-center focus:outline-none hover:bg-gray-300">
                  <i class="far fa-thumbs-up"></i>
                </button>
              </form>
            <?php else: ?>
              <form action="/web_berita/handler/hapus_suka" method="post" class="inline-block">
                <input type="hidden" name="id_pengguna" value="<?= $_SESSION['data_pengguna']['id'] ?>">
                <input type="hidden" name="id_berita" value="<?= $berita['id'] ?>">
                <input type="hidden" name="url_berita" value="<?= $berita['judul'] ?>">
                <button type="submit"
                  class="bg-blue-200 w-12 h-12 rounded-full text-blue-500 text-2xl flex items-center justify-center focus:outline-none hover:bg-blue-300">
                  <i class="fas fa-thumbs-up"></i>
                </button>
              </form>
            <?php endif ?>
          <?php endif ?>
          <p class="text-gray-600 text-md"><b><?= $Suka->tampilkan_jumlah_suka_dengan_beritaId($berita['id']) ?></b> orang menyukai berita ini</p>
        </div>

    </section>
    <?php if (isset($_SESSION['data_pengguna'])): ?>
      <section class="flex flex-col items-center bg-gray-100 py-0 m-2 lg:m-4">
        <div class="bg-white rounded shadow px-8 py-8 w-full max-w-screen-lg">
          <h3 class="text-lg font-bold mb-4">Buat komentar</h3>
          <form action="/web_berita/handler/tambah_komentar" method="POST" class="w-full">
            <input type="hidden" name="url_berita" value="<?= $judul_berita ?>">
            <input type="hidden" name="id_berita" value="<?= $berita['id'] ?>">
            <input type="hidden" name="id_pengguna" value="<?= $_SESSION['data_pengguna']['id'] ?>">
            <textarea name="komentar" rows="4" class="w-full p-2 border rounded mb-4"
              placeholder="Write your comment..."></textarea>
            <div class="flex justify-between items-center">
              <button type="submit"
                class="bg-blue-700 text-white rounded-full px-4 py-2 hover:bg-blue-800 focus:outline-none">Posting
                komentar</button>
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
          <?php if (count($komentar = $Komentar->tampilkan_semua_komentar_dengan_idBerita($berita['id'])) > 0): ?>
            <?php foreach ($komentar = $Komentar->tampilkan_semua_komentar_dengan_idBerita($berita['id']) as $daftar_berita): ?>
              <div class="bg-gray-50 p-4 rounded shadow">
                <p class="text-gray-800 font-regular mb-1"><?= $daftar_berita['nama'] ?> - <span
                    class="text-gray-300 text-sm"><?= $daftar_berita['created_at'] ?></span></p>
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
  <?php else: ?>
    <section class="flex flex-col items-center bg-gray-100 py-0 m-2 lg:m-4">
      <div class="bg-white rounded shadow px-8 py-8 w-full max-w-screen-lg">
        <h2 class="text-xl font-bold my-4">Tidak dapat menemukan berita dengan judul
          <b><?= str_replace("-", " ", $judul_berita) ?></b>
        </h2>
      </div>
    </section>
  <?php endif ?>

  <div class="fixed bottom-8 right-8 flex justify-center">
    <a href="/web_berita"
      class="bg-blue-700 text-white rounded-full px-4 py-2 hover:bg-blue-800 focus:outline-none z-10">
      <p class="text-lg">Kembali ke beranda</p>
    </a>
  </div>
</body>

</html>