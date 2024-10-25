<?php
include 'RPCClient.php';

if ($_POST['aksi'] == 'tambah') { // tambah data
    $data = xmlrpc_encode_request("method", array(
        "aksi" => $_POST['aksi'],
        "id_pasien" => $_POST['id_pasien'],
        "nama_pasien" => $_POST['nama_pasien'],
        "no_hp" => $_POST['no_hp'],
        "alamat" => $_POST['alamat'],
        "jenis_kelamin" => $_POST['jenis_kelamin'],
        "rekam_medis" => $_POST['rekam_medis']
    ));

    $context = stream_context_create(array('http' => array(
        'method' => "POST",
        'header' => "Content-Type: text/xml; charset=UTF-8",
        'content' => $data
    )));

    $file = file_get_contents($url, false, $context);
    xmlrpc_decode($file);
    header('location:index.php?page=daftar-data'); // redirect ke halaman daftar data

    // hapus variable dari memory
    unset($data, $context, $url, $response);

} elseif ($_POST['aksi'] == 'ubah') { // ubah data
    $data = xmlrpc_encode_request("method", array(
        "aksi" => $_POST['aksi'],
        "id_pasien" => $_POST['id_pasien'],
        "nama_pasien" => $_POST['nama_pasien'],
        "no_hp" => $_POST['no_hp'],
        "alamat" => $_POST['alamat'],
        "jenis_kelamin" => $_POST['jenis_kelamin'],
        "rekam_medis" => $_POST['rekam_medis']
    ));

    $context = stream_context_create(array('http' => array(
        'method' => "POST",
        'header' => "Content-Type: text/xml; charset=UTF-8",
        'content' => $data
    )));

    $file = file_get_contents($url, false, $context);
    xmlrpc_decode($file);
    header('location:index.php?page=daftar-data'); // redirect ke halaman daftar data

    unset($data, $context, $url, $response);

} elseif ($_GET['aksi'] == 'hapus') { // hapus data
    $data = xmlrpc_encode_request("method", array(
        "aksi" => $_GET['aksi'],
        "id_pasien" => $_GET['id_pasien'],
        "no_hp" => $_GET['no_hp'],
        "alamat" => $_GET['alamat'],
        "jenis_kelamin" => $_GET['jenis_kelamin'],
        "rekam_medis" => $_GET['rekam_medis']
    ));

    $context = stream_context_create(array('http' => array(
        'method' => "POST",
        'header' => "Content-Type: text/xml; charset=UTF-8",
        'content' => $data
    )));

    $file = file_get_contents($url, false, $context);
    xmlrpc_decode($file);
    header('location:index.php?page=daftar-data'); // redirect ke halaman daftar data

    unset($data, $context, $url);
}
?>