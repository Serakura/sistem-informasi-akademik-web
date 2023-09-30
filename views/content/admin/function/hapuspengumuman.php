<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/pengumuman_pictures/';
$id = $_GET['id_pengumuman'];
$gambarlama = $_GET['gambar'];
$hapus = mysqli_query($koneksi, "DELETE FROM pengumuman WHERE id_pengumuman='$id'");
if ($hapus) {
    $file_path = $fil_dir . $gambarlama;
    @unlink($file_path);
?>

    <script>
        document.location = '../../../?page=pengumuman&msg=Berhasil menghapus data pengumuman';
    </script>
<?php
}

?>