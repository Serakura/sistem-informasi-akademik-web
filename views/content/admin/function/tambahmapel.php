<?php
require '../../../../database/db.php';

$kode       = $_POST['kode'];
$nama        = $_POST['nama'];
$hari        = $_POST['hari'];
$mulai        = $_POST['mulai'] . ':00';
$selesai        = $_POST['selesai'] . ':00';
$kelas      = $_POST['kelas'];
$kkm      = $_POST['kkm'];

$cek_mapel = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran WHERE kode_mapel='$kode'");

if (mysqli_num_rows($cek_mapel) > 0) {
?>
    <script>
        window.location = '../../../index.php?page=mapel&msg=Gagal menambahkan data mata pelajaran karena Kode Mata Pelajaran sudah digunakan';
    </script>


<?php
} else {

    $query = mysqli_query($koneksi, "INSERT INTO mata_pelajaran 
						(kode_mapel, nama_mapel, jadwal_hari, jadwal_mulai, jadwal_selesai, kkm, kode_kelas )
 						VALUES 
 						('$kode','$nama','$hari','$mulai','$selesai','$kkm','$kelas')");

    if ($query) {
        echo "
    <script>
    	window.location='../../../index.php?page=mapel&msg=Berhasil menambahkan data mata pelajaran';
    </script>
     ";
    } else {
        echo $kode . "<br>";
        echo $nama . "<br>";
        echo $hari . "<br>";
        echo $mulai . "<br>";
        echo $selesai . "<br>";
        echo $kkm . "<br>";
        echo $kelas . "<br>";
    }
}

?>