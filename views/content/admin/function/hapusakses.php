<?php
require '../../../../database/db.php';
$kode = $_GET['id_akses'];
$hapus = mysqli_query($koneksi, "DELETE FROM akses_absensi WHERE id_akses='$kode'");
if ($hapus) {
?>
    <script>
        document.location = '../../../?page=aksesabsensi&msg=Berhasil menghapus data akses absensi';
    </script>
<?php
}

?>