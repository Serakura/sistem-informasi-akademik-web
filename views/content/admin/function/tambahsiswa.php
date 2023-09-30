<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/profile_pictures/';
$nama       = $_POST['nama'];
$nis        = $_POST['nis'];
$password   = md5($_POST['password']);
$jenkel     = $_POST['jeniskelamin'];
$tempat     = $_POST['tempat_lahir'];
$tanggal    = $_POST['tanggal_lahir'];
$agama      = $_POST['agama'];
$alamat     = $_POST['alamat'];
$telp       = $_POST['telepon'];
$angkatan   = $_POST['angkatan'];
$gambar     = $_FILES['foto']['name'];
$tmpgambar  = $_FILES['foto']['tmp_name'];

$cek_nis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");

if (mysqli_num_rows($cek_nis) > 0) {
?>
    <script>
        window.location = '../../../index.php?page=siswa&msg=Gagal menambahkan data siswa karena NIS sudah digunakan';
    </script>


<?php
} else {
    if ($gambar == null) {
        $query = mysqli_query($koneksi, "INSERT INTO siswa 
        (nama,nis,password,jenkel,agama,tempat_lahir,tanggal_lahir,alamat,telp,angkatan)
         VALUES 
         ('$nama','$nis','$password','$jenkel','$agama','$tempat','$tanggal','$alamat','$telp','$angkatan')");


        echo "
<script>
window.location='../../../index.php?page=siswa&msg=Berhasil menambahkan data siswa';
</script>
";
    } else {
        $ekstensifile     = explode('.', $gambar);
        $ekstensifile    = strtolower(end($ekstensifile));
        if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
            echo "<script>
            window.location='../../../index.php?page=siswa&msg=Gagal menambahkan data siswa karena format gambar tidak sesuai';
                </script>";
        } else {
            $namaFileBaru  = uniqid() . '_' . $gambar;
            $pidah_folder = move_uploaded_file($tmpgambar, $fil_dir . $namaFileBaru);

            if ($pidah_folder) {
                $query = mysqli_query($koneksi, "INSERT INTO siswa 
                (nama,nis,password,jenkel,agama,tempat_lahir,tanggal_lahir,alamat,telp,angkatan,foto)
                 VALUES 
                 ('$nama','$nis','$password','$jenkel','$agama','$tempat','$tanggal','$alamat','$telp','$angkatan','$namaFileBaru')");
                //     echo "<script>
                //     window.location='../../../index.php?page=siswa&msg=Berhasil menambahkan data siswa';
                // </script>";
            } else {
                echo "<script>
                window.location='../../../index.php?page=siswa&msg=Gagal menambahkan data siswa';
            </script>";
            }
        }
    }
}

?>