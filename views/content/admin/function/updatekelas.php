<?php
require '../../../../database/db.php';

$kode       = $_POST['kode'];
$nama       = $_POST['nama'];
$tahun      = $_POST['tahunajaran'];
$id_wali       = $_POST['wali'];



$query = mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama',tahun_ajaran='$tahun',id_wali='$id_wali' WHERE kode_kelas='$kode'");


if ($query) {
    echo "<script>
    alert('Data Berhasil diEdit');
    window.location='../../../index.php?page=kelas&msg=Berhasil mengupdate data kelas';</script>";
} else {
    return false;
}
