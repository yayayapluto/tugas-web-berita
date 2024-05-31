```sql
SELECT
berita.judul,
berita.url_gambar,
berita.deskripsi,
berita.created_at AS waktu_dibuat,
berita.updated_at AS waktu_diperbarui,
pengguna.nama AS penulis
FROM berita
JOIN pengguna ON berita.penulis = pengguna.id
ORDER BY waktu_dibuat
```
