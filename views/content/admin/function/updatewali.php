<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/profile_pictures/';
$nama       = $_POST['nama'];
$nip        = $_POST['nip'];
$password   = $_POST['password'];
$jenkel     = $_POST['jeniskelamin'];
$tempat     = $_POST['tempat_lahir'];
$tanggal    = $_POST['tanggal_lahir'];
$agama      = $_POST['agama'];
$alamat     = $_POST['alamat'];
$telp       = $_POST['telepon'];
$gambar     = $_FILES['foto']['name'];
$tmpgambar  = $_FILES['foto']['tmp_name'];
$gambarlama = $_POST['foto_lama'];

if ($password == null) {
    if ($gambar == null) {
        $query = mysqli_query($koneksi, "UPDATE wali_kelas SET nama='$nama', jenkel='$jenkel', tempat_lahir='$tempat', tanggal_lahir='$tanggal', agama='$agama', alamat='$alamat', telp='$telp' WHERE nip='$nip'");
        echo "<script>
        window.location='../../../index.php?page=walikelas&msg=Berhasil mengupdate data wali kelas';</script>";
    } else {
        $ekstensifile     = explode('.', $gambar);
        $ekstensifile    = strtolower(end($ekstensifile));
        if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
            echo "<script>
            window.location='../../../index.php?page=walikelas&msg=Gagal mengupdate data wali kelas karena format gambar tidak sesuai';
                </script>";
        } else {
            $namaFileBaru  = uniqid() . '_' . $gambar;
            $pidah_folder = move_uploaded_file($tmpgambar, $fil_dir . $namaFileBaru);

            if ($pidah_folder) {
                $query = mysqli_query($koneksi, "UPDATE wali_kelas SET nama='$nama', jenkel='$jenkel', tempat_lahir='$tempat', tanggal_lahir='$tanggal', agama='$agama', alamat='$alamat', telp='$telp', foto='$namaFileBaru' WHERE nip='$nip'");
                $file_path = $fil_dir . $gambarlama;
                @unlink($file_path);
                echo "<script>
                window.location='../../../index.php?page=walikelas&msg=Berhasil mengupdate data wali kelas';</script>";
            } else {
                echo "<script>
                window.location='../../../index.php?page=walikelas&msg=Gagal mengupdate data wali kelas';
            </script>";
            }
        }
    }
} else {
    if ($gambar == null) {
        $pass = md5($password);
        $query = mysqli_query($koneksi, "UPDATE wali_kelas SET nama='$nama', password='$pass', jenkel='$jenkel', tempat_lahir='$tempat', tanggal_lahir='$tanggal', agama='$agama', alamat='$alamat', telp='$telp' WHERE nip='$nip'");
        echo "<script>
        window.location='../../../index.php?page=walikelas&msg=Berhasil mengupdate data wali kelas';</script>";
    } else {
        $ekstensifile     = explode('.', $gambar);
        $ekstensifile    = strtolower(end($ekstensifile));
        if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
            echo "<script>
                window.location='../../../index.php?page=walikelas&msg=Gagal mengupdate data wali kelas karena format gambar tidak sesuai';
                    </script>";
        } else {
            $namaFileBaru  = uniqid() . '_' . $gambar;
            $pidah_folder = move_uploaded_file($tmpgambar, $fil_dir . $namaFileBaru);

            if ($pidah_folder) {
                $pass = md5($password);
                $query = mysqli_query($koneksi, "UPDATE wali_kelas SET nama='$nama', password='$pass', jenkel='$jenkel', tempat_lahir='$tempat', tanggal_lahir='$tanggal', agama='$agama', alamat='$alamat', telp='$telp', foto='$namaFileBaru' WHERE nip='$nip'");
                $file_path = $fil_dir . $gambarlama;
                @unlink($file_path);
                echo "<script>
                    window.location='../../../index.php?page=walikelas&msg=Berhasil mengupdate data wali kelas';</script>";
            } else {
                echo "<script>
                    window.location='../../../index.php?page=walikelas&msg=Gagal mengupdate data wali kelas';
                </script>";
            }
        }
    }
}
