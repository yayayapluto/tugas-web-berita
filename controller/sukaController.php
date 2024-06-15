<?php 
require_once("./config/koneksi.php");

class SukaController extends Koneksi {
    public function tampilkan_semua_suka() {
        $query = "SELECT * FROM suka";
        try {
            $stmt = $this->pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak bisa mendapatkan data dari tabel like" . $e->getMessage());
        }
    }
    public function tampilkan_semua_suka_dengan_penggunaId(int $id) {
        $query = "SELECT * FROM suka WHERE id_pengguna = :id";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak bisa mendapatkan data dari tabel like" . $e->getMessage());
        }
    }
    public function tampilkan_semua_suka_dengan_beritaId(int $id) {
        $query = "SELECT * FROM suka WHERE id_berita = :id";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak bisa mendapatkan data dari tabel like" . $e->getMessage());
        }
    }
    public function tampilkan_semua_suka_dengan_beritaId_dan_penggunaId(int $id_berita, int $id_pengguna) {
        $query = "SELECT * FROM suka WHERE id_berita = :id_berita AND id_pengguna = :id_pengguna";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id_berita", $id_berita);
            $stmt->bindParam(":id_pengguna", $id_pengguna);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak bisa mendapatkan data dari tabel like" . $e->getMessage());
        }
    }
    public function tampilkan_jumlah_suka_dengan_beritaId(int $id) {
        $query = "SELECT COUNT(*) FROM suka WHERE id_berita = :id";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_COLUMN);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak bisa mendapatkan data dari tabel like" . $e->getMessage());
        }
    }
    public function tambah_suka(int $id_pengguna, int $id_berita) {
        $query = "INSERT INTO suka(id_pengguna,id_berita) VALUES(:id_pengguna, :id_berita)";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id_pengguna", $id_pengguna);
            $stmt->bindParam(":id_berita", $id_berita);
            $stmt->execute();
            return "Berhasil menambahkan data suka";
        } catch (\PDOException $e) {
            die("Tidak bisa mendapatkan data dari tabel like" . $e->getMessage());
        }
    }
    public function hapus_suka(int $id_pengguna, int $id_berita) {
        $query = "DELETE FROM suka WHERE id_pengguna = :id_pengguna AND id_berita = :id_berita";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":id_pengguna", $id_pengguna);
            $stmt->bindParam(":id_berita", $id_berita);
            $stmt->execute();
            return "Berhasil menambahkan data suka";
        } catch (\PDOException $e) {
            die("Tidak bisa mendapatkan data dari tabel like" . $e->getMessage());
        }
    }


}
?>