<?php
require_once ("./controller/beritaController.php");
require_once ("./controller/sukaController.php");
require_once ("./controller/komentarController.php");
session_start();
if (!isset($_SESSION['data_pengguna'])) {
  $_SESSION['error_msg'] = "Tidak bisa mengakses halaman tersebut, Masuk terlebih dahulu";
  header("Location: /web_berita");
  exit();
}

$pengguna = $_SESSION['data_pengguna'];

$Berita = new BeritaController();
$Komentar = new KomentarController();
$Suka = new SukaController();

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

<body class="bg-gray-100 text-gray-800 max-h-screen">
  <div class="sticky top-0">
    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
      <div class="flex items-center space-x-4">
        <a href="/web_berita" class="text-blue-700 hover:text-blue-800">Beranda</a>
      </div>
    </nav>

    <?php include ("./components/banner.php") ?>
  </div>

  <section class="container mx-auto px-4 py-8 min-h-screen flex flex-col items-center">

  <div class="bg-white rounded-lg shadow-md p-6 w-full md:w-1/2 mb-8">
  <div class="flex items-center space-x-4 mb-4">
    <img src="https://southernplasticsurgery.com.au/wp-content/uploads/2013/10/user-placeholder-220x220.png"
      class="rounded-full h-24 w-24" alt="Profile Picture">
    <div>
      <h2 class="text-2xl font-bold text-gray-800"><?= $pengguna['nama'] ?></h2>
      <p class="text-gray-600 text-sm"><?= $pengguna['email'] ?></p>
      <p class="text-gray-600 text-sm"><?= $pengguna['nomor_telepon'] ?></p>
    </div>
  </div>
  <div class="flex justify-end space-x-4">
    <a href="/web_berita/action/edit_pengguna"
      class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-lg shadow-md focus:outline-none">Ubah
      Profil</a>
    <a href="/web_berita/keluar"
      class="inline-block bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg shadow-md focus:outline-none">Keluar</a>
  </div>
</div>



    <a href="/web_berita/pengguna/buatBerita"
      class="w-1/2 h-12 p-3 text-center bg-blue-500 text-white rounded-xl shadow-md hover:bg-blue-600 focus:outline-none">Tulis
      berita baru</a>


    <div class="bg-white rounded shadow px-8 py-8 w-full mt-8 md:w-1/2">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Daftar berita yang kamu tulis</h2>
      <?php if ($daftar_berita > 0): ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
          <?php foreach ($daftar_berita as $berita): ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
              <img src="<?= $berita['gambar'] ?>" alt="" class="w-full h-48 object-cover">
              <div class="p-6">
                <h2 class="text-gray-800 hover:text-blue-700 font-bold text-xl mb-2">
                  <a href="/web_berita/baca/<?= $berita['judul'] ?>"
                    class="whitespace-nowrap overflow-hidden text-ellipsis block"><?= str_replace("-", " ", $berita['judul']) ?></a>

                </h2>
                <p class="text-gray-500 text-sm mb-4"><?= $berita['waktu_dibuat'] ?></p>
                <p class="text-gray-500 text-sm mb-4">
                  <?= "Jumlah suka: " . $Suka->tampilkan_jumlah_suka_dengan_beritaId($berita['id']) ?>
                </p>
                <p class="text-gray-500 text-sm mb-4">
                  <?= "Jumlah Komentar: " . $Komentar->tampilkan_jumlah_komentar_dengan_idBerita($berita['id']) ?>
                </p>
                <div class="flex space-x-2">
                  <a href="/web_berita/pengguna/ubahBerita/<?= $berita['judul'] ?>"
                    class="px-3 py-2 text-sm text-blue-700 hover:bg-blue-200 rounded-md border border-blue-700">Ubah</a>
                  <a href="/web_berita/pengguna/hapusBerita/<?= $berita['judul'] ?>"><button type="button"
                      class="px-3 py-2 text-sm text-red-500 hover:bg-red-200 rounded-md border border-red-500 confirm-delete">Hapus</button></a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      <?php else: ?>
        <div class="bg-white shadow-md rounded-lg p-6 text-center text-gray-500 text-sm">
          Belum ada berita yang kamu tulis
        </div>
      <?php endif ?>


    </div>

  </section>

</body>

</html>