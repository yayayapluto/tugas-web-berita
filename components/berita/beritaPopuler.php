<section class="mb-8" id="popular-news">
    <h2 class="text-xl font-bold text-blue-600 mb-4">Berita Populer</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <?php if(count($Berita->tampilkan_berita_populer()) > 0): ?>
            <?php foreach($Berita->tampilkan_berita_populer() as $berita): ?>
                <div class="p-4 bg-white rounded shadow hover:shadow-md">
                    <img src="<?= $berita['url_gambar'] ?>"
                        class="w-full h-48 object-cover rounded-t-lg " alt="<?= "Gambar untuk judul: " . str_replace("-"," ",$berita['judul'])?>">
                    <div class="px-4 py-2">
                        <h3 class="text-lg font-bold mb-2 text-ellipsis text-nowrap overflow-hidden lg:w-full"><?= str_replace("-"," ",$berita['judul'])?></h3>
                        <p class="text-gray-700 mb-2 text-ellipsis text-nowrap overflow-hidden w-20  lg:w-72"><?= $berita['deskripsi'] ?></p>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Dibuat oleh <?= $berita['penulis'] ?> - <?= $berita['waktu_dibuat'] ?></p>
                            <a href="/web_berita/baca/<?= $berita['judul']?>" class="py-2 px-4 bg-blue-600 rounded-sm text-white hover:shadow-lg shadow-md">Read More</a>
                        </div>
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