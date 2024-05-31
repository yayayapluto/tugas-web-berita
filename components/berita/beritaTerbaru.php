<section id="recent-news">
      <h2 class="text-xl font-bold text-blue-600 mb-4">Berita Terbaru</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
        <?php if(count($Berita->tampilkan_berita_terbaru()) > 0): ?>
            <?php foreach($Berita->tampilkan_berita_terbaru() as $berita): ?>
              <div class="flex items-center p-4 bg-white rounded shadow hover:shadow-md">
                <img src="<?= $berita['url_gambar'] ?>" class="w-48 h-24 object-cover rounded-lg mr-4" alt="<?= "Gambar untuk judul: " . str_replace("-"," ",$berita['judul'])?>">
                <div class="flex-grow">
                  <h4 class="text-md font-bold mb-1 text-ellipsis text-nowrap overflow-hidden w-40 lg:w-96"><?= str_replace("-"," ",$berita['judul'])?></h4>
                  <p class="text-gray-700 text-sm mb-2 text-ellipsis text-nowrap overflow-hidden w-20  lg:w-64"><?= $berita['deskripsi'] ?></p>
                  <a href="/web_berita/baca/<?= $berita['judul']?>" class="py-1 px-3 bg-blue-600 rounded-sm text-white hover:shadow-lg shadow-md">Read More</a>
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