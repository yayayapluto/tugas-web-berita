<?php 
require_once("./config/koneksi.php");

class PenggunaController extends Koneksi {

    public function tampilkan_semua_pengguna() {
        $query = "SELECT * FROM pengguna";
        try {
            $stmt = $this->pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data pengguna dari database: " . $e->getMessage());
        }
    }

    public function tampilkan_pengguna(string $nama) {
        $query = "SELECT * FROM pengguna WHERE nama = :nama";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nama', $nama);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            return $result;
        } catch (\PDOException $e) {
            die("Tidak dapat mengambil data pengguna dengan nama '$nama': " . $e->getMessage());
        }
    }

    public function tambah_pengguna(string $nama, string $password, string $email, string $nomor_telepon) {
        if ($this->apakahSudahAda($nama)) {
            return false;
        }

        $query = "INSERT INTO pengguna (nama, password, email, nomor_telepon) VALUES (:nama, :password, :email, :nomor_telepon)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nomor_telepon', $nomor_telepon);

        try {
            $stmt->execute();
            return "Pengguna dengan nama <b>$nama</b> berhasil ditambahkan";
        } catch (\PDOException $e) {
            die("Gagal menambahkan pengguna: " . $e->getMessage());
        }
    }

    public function ubah_pengguna(int $id,string $gambar, string $nama, string $email, string $nomor_telepon) {
        if (!$this->penggunaDenganId($id)) {
            return "Pengguna dengan ID $id tidak ditemukan";
        }

        if ($this->apakahSudahAda($nama) > 1) {
            return false;
        }

        $query = "UPDATE pengguna SET nama = :nama, email = :email, nomor_telepon = :nomor_telepon, foto_profil = :gambar WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':gambar', $gambar);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nomor_telepon', $nomor_telepon);

        try {
            $stmt->execute();
            return "Pengguna dengan ID $id berhasil diubah";
        } catch (\PDOException $e) {
            die("Gagal mengubah pengguna: " . $e->getMessage());
        }
    }

    public function hapus_pengguna(int $id) {
        if (!$this->penggunaDenganId($id)) {
            return "Pengguna dengan ID $id tidak ditemukan";
        }

        $query = "DELETE FROM pengguna WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return "Pengguna dengan ID $id berhasil dihapus";
        } catch (\PDOException $e) {
            die("Gagal menghapus pengguna: " . $e->getMessage());
        }
    }

    public function apakahSudahAda(string $nama) {
        $query = "SELECT COUNT(*) FROM pengguna WHERE nama = :nama";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nama', $nama);

        try {
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (\PDOException $e) {
            die("Gagal mengecek apakah nama '$nama' sudah ada: " . $e->getMessage());
        }
    }

    public function penggunaDenganId(int $id) {
        $query = "SELECT * FROM pengguna WHERE id = :id";
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
            die("Gagal mengambil data pengguna dengan ID '$id': " . $e->getMessage());
        }
    }
}
?>