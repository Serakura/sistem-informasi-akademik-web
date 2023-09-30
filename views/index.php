<?php
session_start();
require '../database/db.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "dashboard";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'layouts/head.php';
    ?>

<body id="page-top">
    <?php if (isset($_GET['msg'])) { ?>
        <div aria-live="polite" aria-atomic="true" class="position-relative" data-autohide="false">
            <!-- Position it: -->
            <!-- - `.toast-container` for spacing between toasts -->
            <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
            <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
            <div class="toast-container position-absolute top-0 end-0 p-3" style="z-index: 10;">

                <!-- Then put toasts within -->
                <div id="toast-delayer" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" data-bs-delay="5000">
                    <div class="toast-header">
                        <strong class="me-auto">Bootstrap</strong>
                        <small class="text-muted">just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= ($_GET['msg']); ?>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'layouts/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'layouts/navbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h2 mb-0 text-dark text-capitalize font-weight-bold"><?php
                                                                                        if ($_SESSION['role'] != "admin") {
                                                                                            if ($page == "matapelajaran") {
                                                                                                $a = $_GET['kode_kelas'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_kelas FROM kelas WHERE kode_kelas = '$a'");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo "Mata Pelajaran - " . $rw[0];
                                                                                                }
                                                                                            } else if ($page == "mapel") {
                                                                                                echo "Mata Pelajaran";
                                                                                            } else if ($page == "detail") {
                                                                                                $a = $_GET['id_kelas'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_kelas FROM kelas WHERE id_kelas = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo "Data Siswa Kelas " . $rw[0];
                                                                                                }
                                                                                            } else if ($page == "absensi") {
                                                                                                if (!empty($_GET['id_akses'])) {
                                                                                                    $a = $_GET['kode_kelas'];
                                                                                                    $q = mysqli_query($koneksi, "SELECT mata_pelajaran.nama_mapel, kelas.nama_kelas FROM kelas 
                                                                                                    INNER JOIN mata_pelajaran ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE kelas.kode_kelas = '$a'");
                                                                                                    while ($rw = mysqli_fetch_row($q)) {
                                                                                                        echo "Absensi (" . $rw[0] . " - " . $rw[1] . ")";
                                                                                                    }
                                                                                                } else {
                                                                                                    echo $page;
                                                                                                }
                                                                                            } else if ($page == "detailabsensi") {
                                                                                                $a = $_GET['kode_kelas'];
                                                                                                $q = mysqli_query($koneksi, "SELECT mata_pelajaran.nama_mapel, kelas.nama_kelas FROM kelas 
                                                                                                    INNER JOIN mata_pelajaran ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE kelas.kode_kelas = '$a'");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo "Detail Absensi (" . $rw[0] . " - " . $rw[1] . ")";
                                                                                                    $nama_mapel = $rw[0];
                                                                                                    $nama_kelas = $rw[1];
                                                                                                }
                                                                                            } else if ($page == "buatmateri") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Buat Materi)";
                                                                                                }
                                                                                            } else if ($page == "editmateri") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Edit Materi)";
                                                                                                }
                                                                                            } else if ($page == "materi") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Isi Materi)";
                                                                                                }
                                                                                            } else if ($page == "buattugas") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Buat Tugas)";
                                                                                                }
                                                                                            } else if ($page == "buatsoal") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Buat Soal)";
                                                                                                }
                                                                                            } else if ($page == "pilgan") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Buat Soal Pilihan Ganda)";
                                                                                                }
                                                                                            } else if ($page == "editpilgan") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Edit Soal Pilihan Ganda)";
                                                                                                }
                                                                                            } else if ($page == "essay") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Buat Soal Essay)";
                                                                                                }
                                                                                            } else if ($page == "editessay") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Edit Soal Essay)";
                                                                                                }
                                                                                            } else if ($page == "edittugas") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Edit Tugas)";
                                                                                                }
                                                                                            } else if ($page == "pekerjaansiswa") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Pekerjaan Siswa)";
                                                                                                }
                                                                                            } else if ($page == "jawaban") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Jawaban Siswa)";
                                                                                                }
                                                                                            } else if ($page == "nilai") {
                                                                                                $a = $_GET['id_siswa'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama FROM siswa WHERE id_siswa = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  "Nilai - " . $rw[0];
                                                                                                }
                                                                                            } else if ($page == "rekapnilai") {
                                                                                                echo  "Rekap Nilai";
                                                                                            } else if ($page == "lembar_jawab") {
                                                                                                $a = $_GET['id_mapel'];
                                                                                                $q = mysqli_query($koneksi, "SELECT nama_mapel,kelas.nama_kelas FROM mata_pelajaran INNER JOIN kelas ON kelas.id_kelas = mata_pelajaran.id_kelas WHERE id_mapel = $a");
                                                                                                while ($rw = mysqli_fetch_row($q)) {
                                                                                                    echo  $rw[0] . " - $rw[1]" . " (Lembar Jawaban)";
                                                                                                }
                                                                                            } else {
                                                                                                echo $page;
                                                                                            }
                                                                                        } else {
                                                                                            if ($page == "aksesabsensi") {
                                                                                                echo  "Akses Absensi Siswa";
                                                                                            } else {
                                                                                                echo $page;
                                                                                            }
                                                                                        }

                                                                                        ?></h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- konten ditampilkan disini -->
                    <?php if ($page == 'profile') {
                        include "content/" . "all" . "/" . $page . ".php";
                    } else {
                        include "content/" . $_SESSION['role'] . "/" . $page . ".php";
                    } ?>
                    <!-- ini batas penutup konten -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SD Negeri 2 Mendolo Lor</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin mau keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan tombol "Logout" untuk keluar dari akunmu</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../function/funct_logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Guru -->
    <div class="modal fade" id="tambahdatawali" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Wali Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahwali.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">NIP:</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                            <select id="jeniskelamin" class="form-control" name="jeniskelamin" required>
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama" class="col-form-label">Agama:</label>
                            <select id="agama" class="form-control" name="agama" required>
                                <option value="" selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="katolik">Katolik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="col-form-label">Tempat Lahir:</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="col-form-label">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Guru -->
    <div class="modal fade" id="tambahdataguru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahguru.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">NIP:</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                            <select id="jeniskelamin" class="form-control" name="jeniskelamin" required>
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama" class="col-form-label">Agama:</label>
                            <select id="agama" class="form-control" name="agama" required>
                                <option value="" selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="katolik">Katolik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="col-form-label">Tempat Lahir:</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="col-form-label">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Kelas -->
    <div class="modal fade" id="tambahdatakelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahkelas.php" method="POST">
                        <div class="form-group">
                            <label for="kode" class="col-form-label">Kode Kelas:</label>
                            <input type="text" class="form-control" id="kode" name="kode" required>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama Kelas:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="tahunajaran" class="col-form-label">Tahun Ajaran:</label>
                            <input type="text" class="form-control" id="tahunajaran" name="tahunajaran" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas" class="col-form-label">Wali Kelas:</label>
                            <select id="kelas" class="form-control" name="wali" required>
                                <option value="" selected>Pilih Wali Kelas</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM wali_kelas");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_wali'] ?> "><?php echo $wi['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Siswa -->
    <div class="modal fade" id="tambahdatasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahsiswa.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">NIS:</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                            <select id="jeniskelamin" class="form-control" name="jeniskelamin" required>
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama" class="col-form-label">Agama:</label>
                            <select id="agama" class="form-control" name="agama" required>
                                <option value="" selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="katolik">Katolik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="col-form-label">Tempat Lahir:</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="angkatan" class="col-form-label">Angkatan:</label>
                            <input type="number" class="form-control" id="angkatan" name="angkatan" required>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="col-form-label">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Data Mata Pelajaran -->
    <div class="modal fade" id="tambahdatamapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahmapel.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Kode Mata Pelajaran:</label>
                            <input type="text" class="form-control" id="kode" name="kode" required>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">Nama Mata Pelajaran:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="hari" class="col-form-label">Hari:</label>
                            <select id="hari" class="form-control" name="hari" required>
                                <option value="" selected>Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mulai" class="col-form-label">Waktu Mulai:</label>
                            <input type="time" class="form-control" id="mulai" name="mulai" required>
                        </div>
                        <div class="form-group">
                            <label for="selesai" class="col-form-label">Waktu Selesai:</label>
                            <input type="time" class="form-control" id="selesai" name="selesai" required>
                        </div>
                        <div class="form-group">
                            <label for="kkm" class="col-form-label">KKM:</label>
                            <input type="text" class="form-control" id="kkm" name="kkm" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas" class="col-form-label">Kelas:</label>
                            <select id="kelas" class="form-control" name="kelas" required>
                                <option value="" selected>Pilih Kelas</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['kode_kelas'] ?> "><?php echo $wi['nama_kelas'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahdatapengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahpengumuman.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul" class="col-form-label">Judul:</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="subjudul" class="col-form-label">Sub Judul:</label>
                            <input type="text" class="form-control" id="subjudul" name="subjudul" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Keterangan:</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status:</label>
                            <select id="status" class="form-control" name="status" required>
                                <option value="" selected>Pilih Status</option>
                                <option value="draft">Draft</option>
                                <option value="tampil">Tampil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="col-form-label">Gambar:</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahdatanilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/wali_kelas/function/tambahnilai.php" method="POST">
                        <?php
                        if ($page = "nilai") {
                            $kelas = $_GET['kode_kelas'];
                            $siswa = $_GET['id_siswa'];
                            $semester = $_GET['semester'];
                        }
                        ?>
                        <div class="form-group mb-3">
                            <label for="kelas" class="col-form-label">Mata Pelajaran:</label>
                            <select id="kelas" class="form-control" name="mapel" required>
                                <option value="" selected>Pilih Mata Pelajaran</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran WHERE kode_kelas='$kelas'");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_mapel'] ?> "><?php echo $wi['nama_mapel'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester" class="col-form-label">Semester:</label>
                            <input type="hidden" class="form-control" id="kelas" name="kelas" value="<?php echo $kelas ?>">
                            <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="<?php echo $siswa ?>">
                            <input type="text" class="form-control" id="semester" name="semester" value="<?php echo $semester ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="tugas" class="col-form-label">Nilai Tugas:</label>
                            <input type="number" class="form-control" id="tugas" name="tugas" required>
                        </div>
                        <div class="form-group">
                            <label for="uts" class="col-form-label">Nilai UTS:</label>
                            <input type="number" class="form-control" id="uts" name="uts" required>
                        </div>
                        <div class="form-group">
                            <label for="uas" class="col-form-label">Nilai UAS:</label>
                            <input type="number" class="form-control" id="uas" name="uas" required>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahdataaksesabsensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Akses Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahakses.php" method="POST">
                        <div class="form-group">
                            <label for="guru" class="col-form-label">Guru:</label>
                            <select id="guru" class="form-control" name="guru" required>
                                <option value="">Pilih Guru</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM guru");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_guru'] ?>"><?php echo $wi['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mapel" class="col-form-label">Mata Pelajaran:</label>
                            <select id="mapel" class="form-control" name="mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT mata_pelajaran.*,kelas.nama_kelas AS kelas from mata_pelajaran INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE id_mapel NOT IN (SELECT id_mapel FROM akses_absensi)");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_mapel'] ?> "><?php echo $wi['nama_mapel'] ?> - <?php echo $wi['kelas'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'layouts/script.php' ?>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                select: false,
                search: {
                    caseInsensitive: false,
                    regex: true
                }
            });
        });
    </script>
    <script>
        var editor = CKEDITOR.replace('editor1', {
            extraPlugins: 'embed,autoembed,image2',
            height: 500,

            // Load the default contents.css file plus customizations for this sample.
            contentsCss: [
                'http://cdn.ckeditor.com/4.18.0/full-all/contents.css',
                'https://ckeditor.com/docs/ckeditor4/4.18.0/examples/assets/css/widgetstyles.css'
            ],
            // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            // image2_disableResizer: true,
            removeButtons: 'PasteFromWord'
        });
        CKFinder.setupCKEditor(editor);
        var editor1 = CKEDITOR.replace('editor2', {
            extraPlugins: 'embed,autoembed,image2',
            height: 200,

            // Load the default contents.css file plus customizations for this sample.
            contentsCss: [
                'http://cdn.ckeditor.com/4.18.0/full-all/contents.css',
                'https://ckeditor.com/docs/ckeditor4/4.18.0/examples/assets/css/widgetstyles.css'
            ],
            // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            // image2_disableResizer: true,
            removeButtons: 'PasteFromWord'
        });
        CKFinder.setupCKEditor(editor1);
    </script>
    <script>
        $('.toast').toast('show');
    </script>

</body>

</html>