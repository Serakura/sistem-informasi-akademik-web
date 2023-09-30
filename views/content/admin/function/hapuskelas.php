<?php
require '../../../../database/db.php';
$kode = $_GET['kode_kelas'];
$hapus = mysqli_query($koneksi, "DELETE FROM kelas WHERE kode_kelas='$kode'");
if ($hapus) {
?>
    <script>
        document.location = '../../../?page=kelas&msg=Berhasil menghapus data kelas';
    </script>
<?php
}

?>