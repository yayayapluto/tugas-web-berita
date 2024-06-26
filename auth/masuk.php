<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Berita - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
  <div class="sticky top-0">
    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
    </nav>
  
    <?php include("./components/banner.php") ?>
  </div>

  <div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-lg p-8 space-y-4 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-medium text-center">Masuk ke akun</h1>
      <form action="/web_berita/handler/masuk" method="post" class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
          <label for="nama" class="text-sm font-medium">Nama</label>
          <input type="text" id="nama" name="nama" placeholder="Ketik nama kamu disini..." class="rounded-md border border-gray-300 px-3 py-3 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
        </div>
        <div class="flex flex-col space-y-2">
          <label for="password" class="text-sm font-medium">Password</label>
          <input type="password" id="password" name="password" placeholder="Ketik password kamu disini..." class="rounded-md border border-gray-300 px-3 py-3 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
        </div>
        <div class="flex items-center justify-between space-x-4">
          <div class="flex justify-between space-x-3">
            <a href="/web_berita/daftar" class="text-sm text-gray-500 hover:text-blue-500">Belum punya akun?</a>
            <a href="/web_berita" class="text-sm text-gray-500 hover:text-blue-500">Kembali ke beranda?</a>
          </div>
          <button type="submit" class="px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-700">Masuk</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
