<?php
require '../../../../database/db.php';

$kode       = $_POST['kode'];
$nama        = $_POST['nama'];
$hari        = $_POST['hari'];
$mulai        = $_POST['mulai'] . ':00';
$selesai        = $_POST['selesai'] . ':00';
$kelas      = $_POST['kelas'];
$kkm      = $_POST['kkm'];

$query = mysqli_query($koneksi, "UPDATE mata_pelajaran SET nama_mapel='$nama', jadwal_hari='$hari', jadwal_mulai='$mulai', jadwal_selesai='$selesai', kkm='$kkm', kode_kelas='$kelas' WHERE kode_mapel='$kode'");


if ($query) {
    echo "<script>
    window.location='../../../index.php?page=mapel&msg=Berhasil mengupdate data mata pelajaran';</script>";
} else {
    return false;
}
