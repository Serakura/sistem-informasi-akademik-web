<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/pengumuman_pictures/';

$judul      = $_POST['judul'];
$subjudul   = $_POST['subjudul'];
$tanggal    = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$status     = $_POST['status'];
$gambar     = $_FILES['gambar']['name'];
$tmpgambar  = $_FILES['gambar']['tmp_name'];


if ($gambar == null) {
    $query = mysqli_query($koneksi, "INSERT INTO pengumuman 
        (judul,subjudul,tanggal,keterangan,status)
         VALUES 
         ('$judul','$subjudul','$tanggal','$keterangan','$status')");


    echo "
<script>
window.location='../../../index.php?page=pengumuman&msg=Berhasil menambahkan data pengumuman';
</script>
";
} else {
    $ekstensifile     = explode('.', $gambar);
    $ekstensifile    = strtolower(end($ekstensifile));
    if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
        echo "<script>
            window.location='../../../index.php?page=pengumuman&msg=Gagal menambahkan data pengumuman karena format gambar tidak sesuai';
                </script>";
    } else {
        $namaFileBaru  = uniqid() . '_' . $gambar;
        $pidah_folder = move_uploaded_file($tmpgambar, $fil_dir . $namaFileBaru);

        if ($pidah_folder) {
            $query = mysqli_query($koneksi, "INSERT INTO pengumuman 
                (judul,subjudul,tanggal,keterangan,status,gambar)
                 VALUES 
                 ('$judul','$subjudul','$tanggal','$keterangan','$status','$namaFileBaru')");
            echo "<script>
                window.location='../../../index.php?page=pengumuman&msg=Berhasil menambahkan data pengumuman';
            </script>";
        } else {
            echo "<script>
                window.location='../../../index.php?page=pengumuman&msg=Gagal menambahkan data pengumuman';
            </script>";
        }
    }
}
