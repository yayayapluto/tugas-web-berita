<?php 
class Koneksi {
    protected $pdo;

    private function koneksi(){
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=db_web_berita", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Tidak bisa melakukan koneksi dengan database: " . $e->getMessage());
        }
    }

    public function __construct() {
        $this->koneksi();
    }
}
?>