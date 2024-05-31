<?php 
require_once("./controller/penggunaController.php");

class AuthController extends PenggunaController {
    private function hashPassword(string $password, string $salt = "web_berita_") {
        return password_hash($salt . $password, PASSWORD_BCRYPT);
    }
    
    public function daftar(string $nama, string $password, string $email, string $nomor_telepon) {
        $hashedPassword = $this->hashPassword($password);
        $result = $this->tambah_pengguna($nama, $hashedPassword, $email, $nomor_telepon);
        return $result;
    }
    
    public function masuk(string $nama, string $password) {
        $dataPengguna = $this->tampilkan_pengguna($nama);
    
        if ($dataPengguna) {
            $hashedPassword = $dataPengguna['password'];
            $password = "web_berita_" . $password;
            $apakahPasswordValid = password_verify($password, $hashedPassword);
    
            if ($apakahPasswordValid) {
                return $dataPengguna;
            } else {
                return "Password salah";
            }
        } else {
            return "Pengguna tidak ditemukan";
        }
    }
}
?>