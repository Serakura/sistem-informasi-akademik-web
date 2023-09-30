<?php
require '../../../../database/db.php';
$id = $_GET['id_absensi'];
$kode_kelas = $_GET['kode_kelas'];
$id_akses = $_GET['id_akses'];
$hapus = mysqli_query($koneksi, "DELETE FROM absensi WHERE id_absensi='$id'");
if ($hapus) {
?>
    <script>
        document.location = '../../../?page=absensi&id_akses=<?= $id_akses ?>&kode_kelas=<?= $kode_kelas ?>&msg=Berhasil menghapus data absensi';
    </script>
<?php
}

?>