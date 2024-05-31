<?php 
require_once("./controller/beritaController.php");
$Berita = new BeritaController();

$berita = $Berita->tampilkan_berita($judul_berita);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News Detail - News Today</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
  <?php if ($Berita->tampilkan_berita($judul_berita) > 0): ?>
      <section class="flex flex-col justify-center items-center min-h-screen bg-gray-100 py-8">
        <div class="bg-white rounded shadow px-8 py-8 grid grid-cols-1 md:grid-cols-1 lg:w-3/4">
          <h2 class="text-xl font-bold mb-4"><?= str_replace("-"," ", $berita['judul']) ?></h2>
          <p class="text-gray-700 mb-2">Oleh <?= $berita['penulis'] ?> - <?= $berita['waktu_dibuat'] ?></p>
          <img src="<?= $berita['url_gambar'] ?>" class="h-96 mx-auto aspect-video object-contain rounded-lg mb-4" alt="<?= "Gambar untuk judul: " . str_replace("-"," ",$berita['judul'])?>">
          <p class="text-gray-700 text-base"><?= $berita['deskripsi'] ?></p>
        </div>
      </section>
      <?php else: ?>
        <section class="flex flex-col justify-center items-center min-h-screen bg-gray-100 py-8">
        <div class="bg-white rounded shadow px-8 py-8 grid grid-cols-1 md:grid-cols-1 lg:w-3/4">
          <h2 class="text-xl font-bold my-4">Tidak dapat menemukan berita dengan judul <b><?= str_replace("-"," ", $judul_berita) ?></b></h2>
        </div>
      </section>
  <?php endif ?>

  <div class="fixed bottom-20 right-20 flex justify-center">
    <a href="/web_berita" class="bg-blue-700 text-white rounded-full px-4 py-2 hover:bg-blue-800 focus:outline-none z-10">
      <p class="text-lg">Back to home</p>
    </a>
  </div>

</body>

</html>
