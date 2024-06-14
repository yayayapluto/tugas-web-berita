<?php

require_once("./config/koneksi.php");

class BeritaController extends Koneksi {

    public function tampilkan_semua_berita() {
        $query = "SELECT * FROM berita";

        try {
            $stmt = $this->pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data berita dari database: " . $e->getMessage());
        }
    }

    public function tampilkan_berita_populer() {
        $query = "SELECT
        berita.judul,
        berita.url_gambar,
        berita.deskripsi,
        berita.created_at AS waktu_dibuat,
        berita.updated_at AS waktu_diperbarui,
        pengguna.nama AS penulis
        FROM berita
        JOIN pengguna ON berita.penulis = pengguna.id
        ORDER BY waktu_diperbarui";

        try {
            $stmt = $this->pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data berita dari database: " . $e->getMessage());
        }
    }

    public function tampilkan_berita_rekomendasi() {
        $query = "SELECT
        berita.judul,
        berita.url_gambar,
        berita.deskripsi,
        berita.created_at AS waktu_dibuat,
        berita.updated_at AS waktu_diperbarui,
        pengguna.nama AS penulis
        FROM berita
        JOIN pengguna ON berita.penulis = pengguna.id
        ORDER BY RAND()";

        try {
            $stmt = $this->pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data berita dari database: " . $e->getMessage());
        }
    }

    public function tampilkan_berita_terbaru() {
        $query = "SELECT
        berita.judul,
        berita.url_gambar,
        berita.deskripsi,
        berita.created_at AS waktu_dibuat,
        berita.updated_at AS waktu_diperbarui,
        pengguna.nama AS penulis
        FROM berita
        JOIN pengguna ON berita.penulis = pengguna.id
        ORDER BY waktu_dibuat";

        try {
            $stmt = $this->pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data berita dari database: " . $e->getMessage());
        }
    }

    public function tampilkan_berita(string $judul) {
        $query = "SELECT
        berita.id,
        berita.judul,
        pengguna.nama as penulis,
        berita.created_at AS waktu_dibuat,
        berita.url_gambar,
        berita.deskripsi
        FROM berita
        INNER JOIN pengguna ON berita.penulis = pengguna.id
        WHERE judul = :judul ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':judul', $judul);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data berita dengan judul '$judul': " . $e->getMessage());
        }
    }

    public function tampilkan_berita_berdasarkan_penulis(int $id) {
        $query = "SELECT
        berita.judul as judul,
        berita.created_at AS waktu_dibuat
        FROM berita
        WHERE berita.penulis = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data berita penulis" . $e->getMessage());
        }
    }

    private function beritaById(int $id) {
        $query = "SELECT * FROM berita WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            return $result;
        } catch (\PDOException $e) {
            die("Gagal mengambil data berita dengan ID '$id': " . $e->getMessage());
        }
    }

    public function tampilkan_jumlah_berita_berdasarkan_judul(string $judul) {
        $query = "SELECT COUNT(*) as jumlah FROM berita WHERE berita.judul = :judul";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':judul', $judul);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_COLUMN);
            if (!$result) {
                return null;
            }
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data berita penulis" . $e->getMessage());
        }
    }





    public function buat_berita(string $judul, string $url_gambar, string $deskripsi, string $penulis) {
        $query = "INSERT INTO berita (judul, url_gambar, deskripsi, penulis) VALUES (:judul, :url_gambar, :deskripsi, :penulis)";
        $url_gambar = $this->formatCover($url_gambar);
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':url_gambar', $url_gambar);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':penulis', $penulis);

        try {
            $stmt->execute();
            return "Berita dengan judul '$judul' berhasil dibuat";
        } catch (\PDOException $e) {
            die("Gagal membuat berita: " . $e->getMessage());
        }
    }

    public function ubah_berita(int $id, string $judul, string $url_gambar, string $deskripsi, string $penulis) {
        if (!$this->beritaById($id)) {
            return "Berita dengan ID $id tidak ditemukan";
        }

        $query = "UPDATE berita SET judul = :judul, url_gambar = :url_gambar, deskripsi = :deskripsi, penulis = :penulis WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':url_gambar', $url_gambar);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':penulis', $penulis);

        try {
            $stmt->execute();
            return "Berita dengan ID $id berhasil diubah";
        } catch (\PDOException $e) {
            die("Gagal mengubah berita: " . $e->getMessage());
        }
    }

    public function hapus_berita(int $id) {
        if (!$this->beritaById($id)) {
            return "Berita dengan ID $id tidak ditemukan";
        }

        $query = "DELETE FROM berita WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return "Berita dengan ID $id berhasil dihapus";
        } catch (\PDOException $e) {
            die("Gagal menghapus berita: " . $e->getMessage());
        }
    }

    private function formatCover($url) {
        $pattern = '/^(.*?\.(?:jpg|jpeg|png|gif|svg|webm)).*$/';
        $cover = preg_replace($pattern, '$1', $url);
        return $cover;
    }
}
