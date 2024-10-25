<?php
error_reporting(1); // error ditampilkan
header('Content-Type: text/xml; charset=UTF-8');

include "Database.php";
// buat objek baru dari class Database
$abc = new Database();

// function untuk menghapus selain huruf dan angka
function filter($data) {
    $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
    return $data;
    unset($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = file_get_contents("php://input");
    $data = xmlrpc_decode($input);

    $aksi = $data[0]['aksi'];
    $id_pasien = $data[0]['id_pasien'];
    $nama_pasien = $data[0]['nama_pasien'];
    $no_hp = $data[0]['no_hp'];
    $alamat = $data[0]['alamat']; 
    $jenis_kelamin = $data[0]['jenis_kelamin'];
    $rekam_medis = $data[0]['rekam_medis'];

    if ($aksi == 'tambah') {
        $data2 = array(
            'id_pasien' => $id_pasien,
            'nama_pasien' => $nama_pasien,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'rekam_medis' => $rekam_medis
        );
        $abc->tambah_data($data2);
    } elseif ($aksi == 'ubah') {
        $data2 = array(
            'id_pasien' => $id_pasien,
            'nama_pasien' => $nama_pasien,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'rekam_medis' => $rekam_medis
        );
        $abc->ubah_data($data2);
    } elseif ($aksi == 'hapus') {
        $abc->hapus_data($id_pasien);
    }

    // hapus variabel dari memory
    unset($input, $data, $data2, $id_pasien, $nama_pasien, $no_hp, $alamat, $jenis_kelamin, $rekam_medis, $aksi);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_pasien']))) {
        $id_pasien = filter($_GET['id_pasien']);
        $data = $abc->tampil_data($id_pasien);
        $xml = xmlrpc_encode($data);
        echo $xml;
    } else { // menampilkan semua data
        $data = $abc->tampil_semua_data();
        $xml = xmlrpc_encode($data);
        echo $xml;
    }

    unset($xml, $id_pasien, $data);
}
?>
