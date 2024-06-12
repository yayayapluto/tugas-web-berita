<?php 
require_once("./config/koneksi.php");

class KomentarController extends koneksi {
    public function tampilkan_semua_komentar() {
        $query = "SELECT pengguna.nama, komentar.created_at, komentar.isi FROM komentar INNER JOIN pengguna ON komentar.id_pengguna = pengguna.id";
        try {
            $stmt = $this->pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak bisa mengambil data dari database" . $e->getMessage());
        }
    }

    public function tampilkan_semua_komentar_dengan_idBerita(int $id_berita) {
        $query = "SELECT pengguna.nama, komentar.created_at, komentar.isi FROM komentar INNER JOIN pengguna ON komentar.id_pengguna = pengguna.id WHERE  `id_berita` = :id_berita";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_berita', $id_berita, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak bisa mengambil data dari database" . $e->getMessage());
        }
    }

    public function tampilkan_semua_komentar_dengan_idPengguna(int $id_pengguna) {
        $query = "SELECT pengguna.nama, komentar.created_at, komentar.isi FROM komentar INNER JOIN pengguna ON komentar.id_pengguna = pengguna.id WHERE `id_pengguna` = :id_pengguna";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_pengguna', $id_pengguna, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak bisa mengambil data dari database" . $e->getMessage());
        }
    }

    public function tambah_komentar(int $id_pengguna, int $id_berita, string $isi) {
        $query = "INSERT INTO komentar(`id_pengguna`,`id_berita`,`isi`) VALUES (:id_pengguna,:id_berita,:isi)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_pengguna', $id_pengguna, PDO::PARAM_INT);
        $stmt->bindParam(':id_berita', $id_berita, PDO::PARAM_INT);
        $stmt->bindParam(':isi', $isi, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return "Komentar berhasil di tambahkan";
        } catch (\PDOException $e) {
            die("Tidak bisa menambah data ke database" . $e->getMessage());
        }
    }
}
?>