```sql
SELECT
berita.judul,
berita.url_gambar,
berita.deskripsi,
berita.created_at AS waktu_dibuat,
pengguna.nama AS penulis
FROM berita
JOIN pengguna ON berita.penulis = pengguna.id
```
