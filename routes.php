<?php

require_once __DIR__.'/router.php';

//Index
get('/web_berita','/public/index.php');

//Go to news detail by news title
get('/web_berita/baca/$judul_berita','/public/berita.php');


//Go to user page
get('/web_berita/pengguna','/private/halaman_pengguna.php');

//Go to form to create new news
get('/web_berita/pengguna/buatBerita','/private/action/buat_berita.php');

//Go to form to edit news
get('/web_berita/pengguna/ubahBerita/$judul_berita','/private/action/ubah_berita.php');

//Go to confirmation delete page
get('/web_berita/pengguna/hapusBerita/$judul_berita','/private/action/hapus_berita.php');


//Go to login page
get('/web_berita/masuk','/auth/masuk.php');

//Go to Register page
get('/web_berita/daftar','/auth/daftar.php');

//Go to logout page
get('/web_berita/keluar','/auth/keluar.php');

//Pengguna handler
get("/web_berita/action/edit_pengguna","/private/action/ubah_pengguna.php");

//Auth handler
post('/web_berita/handler/daftar', '/handler/pengguna/daftarHandler.php');
post('/web_berita/handler/masuk', '/handler/pengguna/masukHandler.php');
get('/web_berita/handler/keluar', '/handler/pengguna/keluarHandler.php');

//Berita Handler
post('/web_berita/handler/tambah_berita', '/handler/berita/tambahBeritaController.php');
post('/web_berita/handler/ubah_berita', '/handler/berita/ubahBeritaController.php');
get('/web_berita/handler/hapus_berita/$id_berita/$judul_berita', '/handler/berita/hapusBeritaController.php');

//Komentar Handler
post('/web_berita/handler/tambah_komentar', '/handler/komentar/KomentarHandler.php');

//Suka Handler
post('/web_berita/handler/tambah_suka', '/handler/suka/tambahSukaHandler.php');
post('/web_berita/handler/hapus_suka', '/handler/suka/hapusSukaHandler.php');

//404
get('/web_berita/404','/public/404.php');

any('/404','/public/404.php');
