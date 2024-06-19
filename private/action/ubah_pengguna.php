<?php 
session_start();

$nama = $_SESSION['data_pengguna']['nama'];
$email = $_SESSION['data_pengguna']['email'];
$nomor_telepon = $_SESSION['data_pengguna']['nomor_telepon'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Berita - Edit Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 max-h-screen">
  <div class="sticky top-0">
    <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-800">Web Berita</h1>
    </nav>
  
    <?php include("./components/banner.php") ?>
  </div>

  <div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-4 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-medium text-center">Edit Profil</h1>
      <form action="/web_berita/handler/edit_pengguna" method="post" class="flex flex-col space-y-4" enctype="multipart/form-data" >
        <div class="flex flex-col space-y-2">
          <label for="nama" class="text-sm font-medium">Nama</label>
          <input type="text" id="nama" name="nama" value="<?= $nama ?>" class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
        <div class="flex flex-col space-y-2">
          <label for="gambar" class="text-sm font-medium">Foto profil</label>
          <input type="file" name="gambar" id="gambar" class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" accept="image/*">
        </div>
        <div class="flex flex-col space-y-2">
          <label for="email" class="text-sm font-medium">Email</label>
          <input type="email" id="email" name="email" value="<?= $email ?>" class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
        <div class="flex flex-col space-y-2">
          <label for="nomor_telepon" class="text-sm font-medium">Nomor Telepon</label>
          <input type="tel" id="nomor_telepon" name="nomor_telepon" value="<?= $nomor_telepon ?>" class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
        <div class="flex justify-end space-x-4">
          <div class="flex justify-between space-x-3">
          <a href="/web_berita/pengguna"><button type="button" class="px-4 py-2 rounded-md bg-gray-500 text-white hover:bg-gray-700">Kembali</button></a>
          <button type="submit" class="px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-700">Simpan</button>
        </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
