<?php
error_reporting(1);
include 'RPCClient.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <a href="?page=home">Home</a> | <a href="?page=tambah">Tambah Data</a> | <a href="?page=daftar-data">Data Server</a>
    <br/><br/>

    <fieldset>
        <?php if ($_GET['page'] == 'tambah') { ?>
            <legend>Tambah Data</legend>
            <form name="form" method="POST" action="proses.php">
                <label>ID Pasien</label>
                <br>
                <input type="text" name="id_pasien">
                <br/><br/>
                <label>Nama Pasien</label>
                <br/>
                <input type="text" name="nama_pasien">
                <br/><br/>
                <label>No. Hp</label>
                <br/>
                <input type="text" name="no_hp">
                <br/><br/>
                <label>Alamat</label>
                <br/>
                <input type="text" name="alamat">
                <br/><br/>
                <label>Jenis Kelamin</label><br>
                <select name="jenis_kelamin">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select><br><br/>
                <label>No. Rekam Medis</label>
                <br/>
                <input type="text" name="rekam_medis">
                <br/><br/>
                <button type="submit" name="simpan">Simpan</button>
                <input type="hidden" name="aksi" value="tambah">
            </form>

        <?php } elseif ($_GET['page'] == 'ubah') { 
            $s = $abc->tampil_data($_GET['id_pasien']);
        ?>
            <legend>Ubah Data</legend>
            <form name="form" method="POST" action="proses.php">
                <label>ID Pasien</label>
                <br/>
                <input type="hidden" name="aksi" value="ubah">
                <input type="hidden" name="id_pasien" value="<?= $s['id_pasien'] ?>">
                <input type="text" value="<?= $s['id_pasien'] ?>" disabled>
                <br/>
                <label>Nama Pasien</label>
                <br/>
                <input type="text" name="nama_pasien" value="<?= $s['nama_pasien'] ?>">
                <br/><br/>
                <label>No. Hp</label>
                <br/>
                <input type="text" name="no_hp" value="<?= $s['no_hp'] ?>">
                <br/><br/>
                <label>Alamat</label>
                <br/>
                <input type="text" name="alamat" value="<?= $s['alamat'] ?>">
                <br/><br/>
                <select name="jenis_kelamin">
                    <option value="Laki-laki" <?php if ($sr['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($sr['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select><br>
                <label>No. Rekam Medis</label>
                <br/>
                <input type="text" name="rekam_medis" value="<?= $s['rekam_medis'] ?>">
                <br/><br/>
                <button type="submit" name="ubah">Ubah</button>
            </form>

        <?php 
            unset($s);
        } elseif ($_GET['page'] == 'daftar-data') { 
        ?>
            <legend>Daftar Data Server</legend>
            <table border="1" width="100%">
                <tr>
                    <th width="10%">No</th>
                    <th width="10%">ID Pasien</th>
                    <th width="40%">Nama Pasien</th>
                    <th width="30%">No. Hp</th>
                    <th width="40%">Alamat</th>
                    <th width="40%">Jenis Kelamin</th>
                    <th width="40%">No. Rekam Medis</th>
                    <th width="10%" colspan="2">Aksi</th>
                </tr>
                <?php
                $data_array = $abc->tampil_semua_data();
                $no = 1;
                foreach ($data_array as $r) { ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $r['id_pasien'] ?></td>
                        <td><?= $r['nama_pasien'] ?></td>
                        <td><?= $r['no_hp'] ?></td>
                        <td><?= $r['alamat'] ?></td>
                        <td><?= $r['jenis_kelamin'] ?></td>
                        <td><?= $r['rekam_medis'] ?></td>
                        <td><a href="?page=ubah&id_pasien=<?= $r['id_pasien'] ?>"><b>Ubah</b></a></td>
                        <td><a href="proses.php?aksi=hapus&id_pasien=<?= $r['id_pasien'] ?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')"><b>Hapus</b></a></td>
                    </tr>
                <?php $no++; } ?>
            </table>
        <?php 
            unset($data_array, $r, $no);
        } else { 
        ?>
            <legend>Aplikasi Sederhana</legend>
            <p>Aplikasi sederhana ini menggunakan RPC (Remote Procedure Call) dengan format data XML (Extensible Markup Language).</p>
        <?php } ?>
    </fieldset>
</body>
</html>