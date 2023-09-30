<?php
require '../../../../database/db.php';
$kelas = $_POST['kelas'];
$mapel = $_POST['mapel'];
$siswa = $_POST['id_siswa'];
$semester = $_POST['semester'];
$tugas = $_POST['tugas'];
$uts = $_POST['uts'];
$uas = $_POST['uas'];

$cek = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_mapel='$mapel' AND id_siswa='$siswa' AND semester='$semester'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
    window.location='../../../index.php?page=nilai&kode_kelas=$kelas&id_siswa=$siswa&semester=$semester&msg=Gagal karena mata pelajaran sudah ada!';
</script>";
} else {
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


    $query = mysqli_query($koneksi, "INSERT INTO nilai 
(id_siswa,id_mapel,semester,nilai_tugas,nilai_uts,nilai_uas,total_nilai)
 VALUES 
 ('$siswa','$mapel','$semester','$tugas','$uts','$uas','$total')");
    if ($query) {
        echo "<script>
    window.location='../../../index.php?page=nilai&kode_kelas=$kelas&id_siswa=$siswa&semester=$semester&msg=Berhasil menambahkan nilai';
</script>";
    } else {
        echo "<script>
    window.location='../../../index.php?page=nilai&kode_kelas=$kelas&id_siswa=$siswa&semester=$semester&msg=Gagal menambahkan nilai';
</script>";
    }
}
