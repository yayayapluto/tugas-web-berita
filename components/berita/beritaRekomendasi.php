<section class="mb-8" id="recommended-news">
    <h2 class="text-xl font-bold text-blue-600 mb-4">Rekomendasi Berita</h2>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        
        <?php if(count($Berita->tampilkan_berita_rekomendasi()) > 0): ?>
            <?php foreach($Berita->tampilkan_berita_rekomendasi() as $berita): ?>
                <div class="p-4 bg-white rounded shadow hover:shadow-md">
                    <img src="<?= $berita['url_gambar'] ?>"
                        class="w-full h-36 object-cover rounded-lg mb-2" alt="<?= "Gambar untuk judul: " . str_replace("-"," ",$berita['judul'])?>">
                    <div class="px-4 py-2">
                        <h4 class="text-md font-bold mb-2 text-ellipsis text-nowrap overflow-hidden lg:w-full"><?= str_replace("-"," ",$berita['judul'])?></h4>
                        <p class="text-gray-700 text-sm mb-4 text-ellipsis text-nowrap overflow-hidden w-20  lg:w-72"><?= $berita['deskripsi']?></p>
                        <a href="/web_berita/baca/<?= $berita['judul']?>" class="py-2 px-3 bg-blue-600 rounded-sm text-white hover:shadow-lg shadow-md mt-2">Selengkapnya</a>
                    </div>
                </div>
            <?php endforeach ?>
            <?php else: ?>
                <div class="px-4 py-6 bg-white rounded shadow hover:shadow-md">
                    <h3 class="text-lg font-bold">Tidak ada data berita...</h3>
                </div>
        <?php endif ?>

    </div>
</section>