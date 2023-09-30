<?php
require '../../../../database/db.php';

$id = $_GET['id_siswa'];
$kode = $_GET['kode_kelas'];

$query = mysqli_query($koneksi, "DELETE FROM data_kelas WHERE id_siswa=$id AND kode_kelas = '$kode'");

if ($query) {
    echo "<script>
    window.location='../../../index.php?page=siswakelas&kode_kelas=$kode&msg=Berhasil menghapus data siswa kelas';
 	</script>";
} else {
    echo "<script>
    window.location='../../../index.php?page=siswakelas&kode_kelas=$kode&msg=Gagal menghapus data siswa kelas';
 	</script>";
}
