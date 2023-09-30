<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/profile_pictures/';
$nama       = $_POST['nama'];
$nis        = $_POST['nis'];
$password   = $_POST['password'];
$jenkel     = $_POST['jeniskelamin'];
$tempat     = $_POST['tempat_lahir'];
$tanggal    = $_POST['tanggal_lahir'];
$agama      = $_POST['agama'];
$alamat     = $_POST['alamat'];
$telp       = $_POST['telepon'];
$angkatan   = $_POST['angkatan'];
$gambar     = $_FILES['foto']['name'];
$tmpgambar  = $_FILES['foto']['tmp_name'];
$gambarlama = $_POST['foto_lama'];

if ($password == null) {
    if ($gambar == null) {
        $query = mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', jenkel='$jenkel', tempat_lahir='$tempat', tanggal_lahir='$tanggal', agama='$agama', alamat='$alamat', telp='$telp', angkatan='$angkatan' WHERE nis='$nis'");
        echo "<script>
        window.location='../../../index.php?page=siswa&msg=Berhasil mengupdate data siswa';</script>";
    } else {
        $ekstensifile     = explode('.', $gambar);
        $ekstensifile    = strtolower(end($ekstensifile));
        if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
            echo "<script>
            window.location='../../../index.php?page=siswa&msg=Gagal mengupdate data siswa karena format gambar tidak sesuai';
                </script>";
        } else {
            $namaFileBaru  = uniqid() . '_' . $gambar;
            $pidah_folder = move_uploaded_file($tmpgambar, $fil_dir . $namaFileBaru);

            if ($pidah_folder) {
                $query = mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', jenkel='$jenkel', tempat_lahir='$tempat', tanggal_lahir='$tanggal', agama='$agama', alamat='$alamat', telp='$telp', angkatan='$angkatan', foto='$namaFileBaru' WHERE nis='$nis'");
                $file_path = $fil_dir . $gambarlama;
                @unlink($file_path);
                echo "<script>
                window.location='../../../index.php?page=siswa&msg=Berhasil mengupdate data siswa';</script>";
            } else {
                echo "<script>
                window.location='../../../index.php?page=siswa&msg=Gagal mengupdate data siswa';
            </script>";
            }
        }
    }
} else {
    if ($gambar == null) {
        $pass = md5($password);
        $query = mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', password='$pass', jenkel='$jenkel', tempat_lahir='$tempat', tanggal_lahir='$tanggal', agama='$agama', alamat='$alamat', telp='$telp', angkatan='$angkatan' WHERE nis='$nis'");
        echo "<script>
    window.location='../../../index.php?page=siswa&msg=Berhasil mengupdate data siswa';</script>";
    } else {
        $ekstensifile     = explode('.', $gambar);
        $ekstensifile    = strtolower(end($ekstensifile));
        if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
            echo "<script>
            window.location='../../../index.php?page=siswa&msg=Gagal mengupdate data siswa karena format gambar tidak sesuai';
                </script>";
        } else {
            $namaFileBaru  = uniqid() . '_' . $gambar;
            $pidah_folder = move_uploaded_file($tmpgambar, $fil_dir . $namaFileBaru);

            if ($pidah_folder) {
                $pass = md5($password);
                $query = mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', password='$pass', jenkel='$jenkel', tempat_lahir='$tempat', tanggal_lahir='$tanggal', agama='$agama', alamat='$alamat', telp='$telp', angkatan='$angkatan', foto='$namaFileBaru' WHERE nis='$nis'");
                $file_path = $fil_dir . $gambarlama;
                @unlink($file_path);
                echo "<script>
                window.location='../../../index.php?page=siswa&msg=Berhasil mengupdate data siswa';</script>";
            } else {
                echo "<script>
                window.location='../../../index.php?page=siswa&msg=Gagal mengupdate data siswa';
            </script>";
            }
        }
    }
}
