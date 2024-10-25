<?php
error_reporting(1); // error ditampilkan

class Database {
    private $host="localhost";
    private $dbname="toko";
    private $user="root";
    private $password="";
    private $port="3306";
    private $conn;

    // function yang pertama kali di-load saat class dipanggil
    public function __construct() {
        // koneksi database
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->dbname.";charset=utf8", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "Koneksi gagal";
        }
    }

    public function tampil_data($id_pasien) {
        $query = $this->conn->prepare("select id_pasien,nama_pasien, no_hp, alamat, jenis_kelamin, rekam_medis from pasien where id_pasien=?");
        $query->execute(array($id_pasien));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        // mengembalikan data
        return $data;
        // membersihkan query dari memory
        $query->closeCursor();
        unset($id_pasien, $data);
    }

    public function tampil_semua_data() {
        $query = $this->conn->prepare("select id_pasien, nama_pasien, no_hp, alamat, jenis_kelamin, rekam_medis from pasien order by id_pasien");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tambah_data($data) {
        $query = $this->conn->prepare("insert ignore into pasien (id_pasien,nama_pasien, no_hp, alamat, jenis_kelamin, rekam_medis) values (?,?,?,?,?,?)");
        $query->execute(array($data['id_pasien'], $data['nama_pasien'], $data['no_hp'], $data['alamat'], $data['jenis_kelamin'], $data['rekam_medis']));
        $query->closeCursor();
        unset($data);
    }

    public function ubah_data($data) {
        $query = $this->conn->prepare("update pasien set nama_pasien=?, no_hp=?, alamat=?, jenis_kelamin=?, rekam_medis=? where id_pasien=?");
        $query->execute(array($data['nama_pasien'], $data['no_hp'], $data['alamat'], $data['jenis_kelamin'], $data['rekam_medis'], $data['id_pasien']));
        $query->closeCursor();
        unset($data);
    }

    public function hapus_data($id_pasien) {
        $query = $this->conn->prepare("delete from pasien where id_pasien=?");
        $query->execute(array($id_pasien));
        $query->closeCursor();
        unset($id_pasien);
    }
}
?>