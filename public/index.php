<?php 
session_start();
require_once('./controller/beritaController.php');
$Berita = new BeritaController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Berita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">
  <div class="sticky top-0">
    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
      <a class="text-xl font-bold text-gray-800" href="/web_berita">Web Berita</a>
      <div class="flex items-center space-x-4">
        <input id="searchQuery" type="text" class="border rounded-lg px-4 py-2" placeholder="Cari berita...">
        <button onclick="searchNews()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">Cari</button>
      </div>
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
  
    <?php include("./components/banner.php") ?>
  </div>

  <main class="container mx-auto px-4 py-8">
    <?php include("./components/berita/beritaPopuler.php") ?>
    <?php include("./components/berita/beritaRekomendasi.php") ?>
    <?php include("./components/berita/beritaTerbaru.php") ?>
  </main>
    <?php include("./components/footer.php") ?>
  
  <script>
    function searchNews() {
      const query = document.getElementById('searchQuery').value;
      if (query) {
        window.location.href = `/web_berita/baca/${query}`;
      }
    }
  </script>
</body>
</html>
