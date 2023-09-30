<?php
require '../../../../database/db.php';

$roles = $_POST['role'];

if ($roles == "guru") {
    $nip        = $_POST['nip'];
    $alamat     = $_POST['alamat'];
    $telp       = $_POST['telepon'];
    $email      = $_POST['email'];


    $query = mysqli_query($koneksi, "UPDATE guru SET  alamat='$alamat', telp='$telp', email='$email' WHERE nip='$nip'");


    if ($query) {
        echo "<script>
        window.location='../../../index.php?page=profile&msg=Berhasil mengubah data diri';</script>";
    } else {
        return false;
    }
} else if ($roles == "siswa") {
    $nis        = $_POST['nis'];
    $alamat     = $_POST['alamat'];
    $telp       = $_POST['telepon'];
    $email      = $_POST['email'];


    $query = mysqli_query($koneksi, "UPDATE siswa SET  alamat='$alamat', telp='$telp', email='$email' WHERE nis='$nis'");


    if ($query) {
        echo "<script>
        window.location='../../../index.php?page=profile&msg=Berhasil mengubah data diri';</script>";
    } else {
        return false;
    }
}
