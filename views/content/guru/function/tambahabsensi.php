<?php
date_default_timezone_set("Asia/Jakarta");
require '../../../../database/db.php';
$akses = $_GET['id_akses'];
$kode_kelas = $_GET['kode_kelas'];
$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_akses='$akses'");
if (mysqli_num_rows($query) == 0) {
    $tanggal = date("Y-m-d");
    $pertemuan = "1";
    $query1 = mysqli_query($koneksi, "INSERT INTO absensi (id_akses,tanggal,pertemuan) 
values ('$akses','$tanggal','$pertemuan')");
    if ($query1) {
        $query2 = mysqli_query($koneksi, "SELECT * FROM absensi ORDER BY id_absensi DESC LIMIT 1");
        while ($d = mysqli_fetch_row($query2)) {
            $id_absensi = $d[0];
        }
        $query3 = mysqli_query($koneksi, "SELECT siswa.id_siswa FROM siswa INNER JOIN data_kelas ON siswa.id_siswa = data_kelas.id_siswa
        INNER JOIN kelas ON data_kelas.kode_kelas = kelas.kode_kelas WHERE kelas.kode_kelas = '$kode_kelas'");
        while ($rw = mysqli_fetch_array($query3)) {
            $id_siswa = $rw['id_siswa'];
            $query4 = mysqli_query($koneksi, "INSERT INTO detail_absensi (id_absensi,id_siswa,keterangan) 
            values ('$id_absensi','$id_siswa','Hadir')");
            if ($query4) {
                echo "<script>
    window.location='../../../index.php?page=absensi&id_akses=$akses&kode_kelas=$kode_kelas&msg=Berhasil menambahkan data absensi pertemuan $pertemuan';
     </script>";
            } else {
                echo "<script>
        window.location='../../../index.php?page=absensi&id_akses=$akses&kode_kelas=$kode_kelas&msg=Gagal menambahkan data absensi pertemuan';
     </script>";
            }
        }
    } else {
        echo "<script>
        window.location='../../../index.php?page=absensi&id_akses=$akses&kode_kelas=$kode_kelas&msg=Gagal menambahkan data absensi pertemuan';
     </script>";
    }
} else {
    $query5 = mysqli_query($koneksi, "SELECT pertemuan FROM absensi ORDER BY id_absensi DESC LIMIT 1");
    while ($d = mysqli_fetch_row($query5)) {
        $pertemuan = (int) $d[0];
    }
    $tanggal = date("Y-m-d");
    $pertemuan1 = $pertemuan + 1;
    $query1 = mysqli_query($koneksi, "INSERT INTO absensi (id_akses,tanggal,pertemuan) 
values ('$akses','$tanggal','$pertemuan1')");
    if ($query1) {
        $query2 = mysqli_query($koneksi, "SELECT * FROM absensi ORDER BY id_absensi DESC LIMIT 1");
        while ($d = mysqli_fetch_row($query2)) {
            $id_absensi = $d[0];
        }
        $query3 = mysqli_query($koneksi, "SELECT siswa.id_siswa FROM siswa INNER JOIN data_kelas ON siswa.id_siswa = data_kelas.id_siswa
            INNER JOIN kelas ON data_kelas.kode_kelas = kelas.kode_kelas WHERE kelas.kode_kelas = '$kode_kelas'");
        while ($rw = mysqli_fetch_array($query3)) {
            $id_siswa = $rw['id_siswa'];
            $query4 = mysqli_query($koneksi, "INSERT INTO detail_absensi (id_absensi,id_siswa,keterangan) 
            values ('$id_absensi','$id_siswa','Hadir')");
            if ($query4) {
                echo "<script>
    window.location='../../../index.php?page=absensi&id_akses=$akses&kode_kelas=$kode_kelas&msg=Berhasil menambahkan data absensi pertemuan $pertemuan';
     </script>";
            } else {
                echo "<script>
        window.location='../../../index.php?page=absensi&id_akses=$akses&kode_kelas=$kode_kelas&msg=Gagal menambahkan data absensi pertemuan';
     </script>";
            }
        }
    } else {
        echo "<script>
        window.location='../../../index.php?page=absensi&id_akses=$akses&kode_kelas=$kode_kelas&msg=Gagal menambahkan data absensi pertemuan';
     </script>";
    }
}
