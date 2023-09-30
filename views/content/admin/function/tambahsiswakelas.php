<?php
require '../../../../database/db.php';

$id = $_GET['id_siswa'];
$kode = $_GET['kode_kelas'];

$query = mysqli_query($koneksi, "SELECT * FROM data_kelas WHERE kode_kelas='$kode' AND id_siswa='$id'");
if (mysqli_num_rows($query) > 0) {
    echo "<script>
    window.location='../../../index.php?page=siswakelas&kode_kelas=$kode&msg=Gagal data sudah ada!';
 	</script>";
} else {
    $query = mysqli_query($koneksi, "INSERT INTO data_kelas (id_siswa,kode_kelas) 
values ('$id','$kode')");

    if ($query) {
        echo "<script>
    window.location='../../../index.php?page=siswakelas&kode_kelas=$kode&msg=Berhasil menambahkan data siswa kelas';
 	</script>";
    } else {
        echo "<script>
    window.location='../../../index.php?page=siswakelas&kode_kelas=$kode&msg=Gagal menambahkan data siswa kelas';
 	</script>";
    }
}
