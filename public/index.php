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
  <title>News Today</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">
  <div class="sticky top-0">
    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
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
  
    <?php include("./components/banner.php") ?>
  </div>

  <main class="container mx-auto px-4 py-8">
    <?php include("./components/berita/beritaPopuler.php") ?>
    <?php include("./components/berita/beritaRekomendasi.php") ?>
    <?php include("./components/berita/beritaTerbaru.php") ?>
  </main>
    <?php include("./components/footer.php") ?>
</body>
</html>