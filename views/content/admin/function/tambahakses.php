<?php
require '../../../../database/db.php';
$id_mapel = $_POST['mapel'];
$id_guru      = $_POST['guru'];

$cek_kelas = mysqli_query($koneksi, "SELECT * FROM akses_absensi WHERE id_mapel='$mapel'");

if (mysqli_num_rows($cek_kelas) > 0) {
?>
    <script>
        window.location = '../../../index.php?page=aksesabsensi&msg=Gagal menambahkan data akses absensi karena mata pelajaran sudah ada guru yang mengisi';
    </script>

<?php
} else {

    $query = mysqli_query($koneksi, "INSERT INTO akses_absensi 
						(id_mapel,id_guru)
 						VALUES 
 						('$id_mapel','$id_guru')");


    echo "<script>
    window.location='../../../index.php?page=aksesabsensi&msg=Berhasil menambahkan data akses absensi';
 	</script>";
}

?>