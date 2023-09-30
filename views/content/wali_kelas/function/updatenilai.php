<?php
require '../../../../database/db.php';
$id     = $_POST['id_nilai'];
$kelas = $_POST['kelas'];
$mapel = $_POST['mapel'];
$siswa = $_POST['id_siswa'];
$semester = $_POST['semester'];
$tugas = $_POST['tugas'];
$uts = $_POST['uts'];
$uas = $_POST['uas'];


$bagi = 0;
if (isset($tugas)) {
    $bagi = $bagi + 1;
    if (isset($uts)) {
        $bagi = $bagi + 1;
        if (isset($uas)) {
            $bagi =  $bagi + 1;
        }
    }
}
$total = ($tugas + $uts + $uas) / $bagi;


$query = mysqli_query($koneksi, "UPDATE nilai SET id_siswa = '$siswa',id_mapel='$mapel',semester='$semester',nilai_tugas='$tugas',nilai_uts='$uts',nilai_uas='$uas',total_nilai='$total' WHERE id_nilai='$id' ");
if ($query) {
    echo "<script>
    window.location='../../../index.php?page=nilai&kode_kelas=$kelas&id_siswa=$siswa&semester=$semester&msg=Berhasil mengupdate nilai';
</script>";
} else {
    echo "<script>
    window.location='../../../index.php?page=nilai&kode_kelas=$kelas&id_siswa=$siswa&semester=$semester&msg=Gagal mengupdate nilai';
</script>";
}
