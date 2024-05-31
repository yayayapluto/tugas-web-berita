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
  <title>Konfirmasi Logout - Web Berita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
  <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
    <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
    <div class="flex items-center space-x-4">
      <a href="/web_berita" class="text-blue-700 hover:text-blue-800">Beranda</a>
    </div>
  </nav>

  <section class="container mx-auto px-4 py-8 min-h-screen flex flex-col items-center">
    <div class="bg-white rounded shadow px-8 py-8 w-full md:w-1/2">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Logout</h2>
      <p class="text-gray-700 mb-4">Anda yakin ingin keluar dari akun?</p>

      <div class="flex justify-end space-x-4 mt-4">
        <a href="/web_berita/pengguna" class="px-3 py-2 text-center text-gray-500 hover:text-gray-700 rounded-md border border-gray-300">Batal</a>
        <a href="/web_berita/handler/keluar" class="px-3 py-2 text-center text-red-500 hover:text-red-600 rounded-md bg-red-100 border border-red-200">Logout</a>
      </div>
    </div>
  </section>
</body>

</html>
