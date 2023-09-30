<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/profile_pictures/';
$nip = $_GET['nip'];
$gambarlama = $_GET['foto'];
$hapus = mysqli_query($koneksi, "DELETE FROM guru WHERE nip='$nip'");
if ($hapus) {
    $file_path = $fil_dir . $gambarlama;
    @unlink($file_path);
?>

    <script>
        document.location = '../../../?page=guru&msg=Berhasil menghapus data guru';
    </script>
<?php
}

?>