<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/profile_pictures/';
$nis = $_GET['nis'];
$gambarlama = $_GET['foto'];
$hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE nis='$nis'");
if ($hapus) {
    $file_path = $fil_dir . $gambarlama;
    @unlink($file_path);
?>

    <script>
        document.location = '../../../?page=siswa&msg=Berhasil menghapus data siswa';
    </script>
<?php
}

?>