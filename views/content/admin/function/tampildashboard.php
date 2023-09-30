<?php
require '../database/db.php';

$siswa = mysqli_query($koneksi, "SELECT id_siswa  FROM siswa");
$guru  = mysqli_query($koneksi, "SELECT id_wali FROM wali_kelas");
$kelas = mysqli_query($koneksi, "SELECT kode_kelas FROM kelas");
$pengajar = mysqli_query($koneksi, "SELECT id_guru FROM guru");
