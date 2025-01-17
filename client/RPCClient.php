<?php
error_reporting(1); // error ditampilkan

class RPCClient {
    private $url;

    // function yang pertama kali di-load saat class dipanggil
    public function __construct($url) {
        $this->url = $url;
        unset($url);
    }

    // function untuk menghapus selain huruf dan angka
    public function filter($data) {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data;
        unset($data);
    }

    public function tampil_semua_data() {
        $context = stream_context_create(array('http' => array(
            'method' => "GET",
            'header' => "Content-Type: text/xml; charset=UTF-8"
        )));
        
        $response = file_get_contents($this->url, false, $context);
        $data = xmlrpc_decode($response);
        return $data;
        unset($context, $response, $data);
    }

    public function tampil_data($id_pasien) {
        $id_pasien = $this->filter($id_pasien);
        $context = stream_context_create(array('http' => array(
            'method' => "GET",
            'header' => "Content-Type: text/xml; charset=UTF-8"
        )));

        $response = file_get_contents($this->url . "?id_pasien=" . $id_pasien . "&aksi=tampil", false, $context);
        $data = xmlrpc_decode($response);
        return $data;
        unset($id_pasien, $context, $response, $data);
    }

    // function yang terakhir kali di-load saat class dipanggil
    public function __destruct() {
        unset($this->url);
    }
}

// url server
$url = 'http://192.168.56.2/rpc-xml-toko/server/server.php';

// buat objek baru dari class Client
$abc = new RPCClient($url);
?>