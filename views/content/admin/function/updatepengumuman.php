<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/pengumuman_pictures/';
$id         = $_POST['id'];
$judul      = $_POST['judul'];
$subjudul   = $_POST['subjudul'];
$tanggal    = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$status     = $_POST['status'];
$gambar     = $_FILES['gambar']['name'];
$tmpgambar  = $_FILES['gambar']['tmp_name'];
$gambarlama = $_POST['gambar_lama'];

if ($gambar == null) {
    @$query = mysqli_query($koneksi, "UPDATE pengumuman SET judul='$judul',subjudul='$subjudul',tanggal='$tanggal',keterangan='$keterangan',status='$status' WHERE id_pengumuman='$id'");
    echo "<script>
    window.location='../../../index.php?page=pengumuman&msg=Berhasil mengupdate data pengumuman';</script>";
} else {
    $ekstensifile     = explode('.', $gambar);
    $ekstensifile    = strtolower(end($ekstensifile));
    if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
        echo "<script>
            window.location='../../../index.php?page=pengumuman&msg=Gagal mengupdate data pengumuman karena format gambar tidak sesuai';
                </script>";
    } else {
        $namaFileBaru  = uniqid() . '_' . $gambar;
        $pidah_folder = move_uploaded_file($tmpgambar, $fil_dir . $namaFileBaru);

        if ($pidah_folder) {
            $query = mysqli_query($koneksi, "UPDATE pengumuman SET judul='$judul',subjudul='$subjudul',tanggal='$tanggal',keterangan='$keterangan',status='$status', gambar='$namaFileBaru' WHERE id_pengumuman='$id'");
            $file_path = $fil_dir . $gambarlama;
            @unlink($file_path);
            echo "<script>
                window.location='../../../index.php?page=pengumuman&msg=Berhasil mengupdate data pengumuman';</script>";
        } else {
            echo "<script>
                window.location='../../../index.php?page=pengumuman&msg=Gagal mengupdate data pengumuman';
            </script>";
        }
    }
}
