<?php
require '../../../../database/db.php';
$kode       = $_POST['kode'];
$nama       = $_POST['nama'];
$tahun      = $_POST['tahunajaran'];
$id_wali       = $_POST['wali'];

$cek_kelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kode_kelas='$kode'");

if (mysqli_num_rows($cek_kelas) > 0) {
?>
    <script>
        window.location = '../../../index.php?page=kelas&msg=Gagal menambahkan data kelas karena kode kelas sudah digunakan';
    </script>

<?php
} else {

    $query = mysqli_query($koneksi, "INSERT INTO kelas 
						(kode_kelas,nama_kelas,tahun_ajaran,id_wali)
 						VALUES 
 						('$kode','$nama','$tahun','$id_wali')");


    echo "<script>
    window.location='../../../index.php?page=kelas&msg=Berhasil menambahkan data kelas';
 	</script>";
}

?>