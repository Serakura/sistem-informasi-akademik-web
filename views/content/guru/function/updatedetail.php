<?php
require '../../../../database/db.php';

$id      = $_POST['id_detail'];
$keterangan = $_POST['keterangan'];
$kelas = $_POST['kode_kelas'];
$id_absensi = $_POST['id_absensi'];



$query = mysqli_query($koneksi, "UPDATE detail_absensi SET keterangan='$keterangan' WHERE id_detail='$id'");


if ($query) {
    echo "<script>
    window.location='../../../index.php?page=detailabsensi&id_absensi=$id_absensi&kode_kelas=$kelas&msg=Berhasil mengupdate data detail absensi';</script>";
} else {
    return false;
}
