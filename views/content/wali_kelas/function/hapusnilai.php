<?php
require '../../../../database/db.php';

$id = $_GET['id_nilai'];
$kode_kelas = $_GET['kode_kelas'];
$siswa = $_GET['id_siswa'];
$smst = $_GET['semester'];

$hapus = mysqli_query($koneksi, "DELETE FROM nilai WHERE id_nilai='$id'");
if ($hapus) {

?>

    <script>
        document.location = '../../../index.php?page=nilai&kode_kelas=<?php echo $kode_kelas ?>&id_siswa=<?php echo $siswa ?>&semester=<?php echo $smst ?>&msg=Berhasil menghapus data nilai';
    </script>
<?php
}

?>