<?php
require '../../../../database/db.php';

$kode       = $_POST['id_akses'];
$mapel       = $_POST['mapel'];
$guru      = $_POST['guru'];



$query = mysqli_query($koneksi, "UPDATE akses_absensi SET id_mapel='$mapel',id_guru='$guru' WHERE id_akses='$kode'");


if ($query) {
    echo "<script>
    window.location='../../../index.php?page=aksesabsensi&msg=Berhasil mengupdate data akses absensi';</script>";
} else {
    return false;
}
