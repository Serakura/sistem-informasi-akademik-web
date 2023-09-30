<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-5" href="index.php?page=dashboard ">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <?php
            if ($_SESSION['role'] == 'admin') {
                echo "Sistem Informasi Akademik";
            } else if ($_SESSION['role'] == 'wali_kelas') {
                echo "Sistem Informasi Akademik";
            } else if ($_SESSION['role'] == 'guru') {
                echo "Sistem Informasi Akademik";
            } else if ($_SESSION['role'] == 'siswa') {
                echo "Sistem Informasi Akademik";
            }
            ?>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    if ($_SESSION['role'] == "admin") {
    ?>
        <!-- Nav Item - Dashboard -->


        <li class=" nav-item">
            <a class="nav-link" href="index.php?page=dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=siswa">
                <i class="fas fa-fw fa-user"></i>
                <span>Siswa</span></a>
        </li>


        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=walikelas">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Wali Kelas</span></a>
        </li>

        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=guru">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Guru</span></a>
        </li>

        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=kelas">
                <i class="fas fa-fw fa-home"></i>
                <span>Kelas</span></a>
        </li>
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Charts -->

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=mapel">
                <i class="fas fa-fw fa-book"></i>
                <span>Mata Pelajaran</span></a>
        </li>
        <hr class="sidebar-divider my-0">


        <li class="nav-item">
            <a class="nav-link" href="index.php?page=aksesabsensi">
                <i class="fas fa-fw fa-book"></i>
                <span>Akses Absensi</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Charts -->

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=pengumuman">
                <i class="fas fa-fw fa-bell"></i>
                <span>Pengumuman</span></a>
        </li>

    <?php
    }
    ?>




    <?php
    if ($_SESSION['role'] == "wali_kelas") {
    ?>
        <li class="nav-item px-3 d-none d-md-block">
            <?php
            $nip = $_SESSION['username'];
            $query = mysqli_query($koneksi, "SELECT nip,nama,foto FROM wali_kelas WHERE nip='$nip'");
            while ($rw = mysqli_fetch_array($query)) {
            ?>
                <img src="../upload_files/profile_pictures/<?php echo $rw['foto'] ?>" class="img-thumbnail profile" alt="">
                <br>
                <p class=" text-center h6 fw-bold text-capitalize mt-3" style="color: white;"><?php echo $rw['nama'] ?></p>
                <p class=" text-center mt-1" style="color: white;"><?php echo $rw['nip'] ?></p>
            <?php

            } ?>
        </li>
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=siswakelas">
                <i class="fas fa-fw fa-user"></i>
                <span>Siswa Kelas</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=mapel">
                <i class="fas fa-fw fa-book"></i>
                <span>Mata Pelajaran</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=rekapnilai">
                <i class="fas fa-fw fa-tag"></i>
                <span>Nilai</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=pengumuman">
                <i class="fas fa-fw fa-bell"></i>
                <span>Pengumuman</span></a>
        </li>
    <?php
    }
    ?>

    <?php
    if ($_SESSION['role'] == "guru") {
    ?>
        <li class="nav-item px-3 d-none d-md-block">
            <?php
            $nip = $_SESSION['username'];
            $query = mysqli_query($koneksi, "SELECT nip,nama,foto FROM guru WHERE nip='$nip'");
            while ($rw = mysqli_fetch_array($query)) {
            ?>
                <img src="../upload_files/profile_pictures/<?php echo $rw['foto'] ?>" class="img-thumbnail profile" alt="">
                <br>
                <p class=" text-center h6 fw-bold text-capitalize mt-3" style="color: white;"><?php echo $rw['nama'] ?></p>
                <p class=" text-center mt-1" style="color: white;"><?php echo $rw['nip'] ?></p>
            <?php

            } ?>
        </li>
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=absensi">
                <i class="fas fa-fw fa-user"></i>
                <span>Absensi</span></a>
        </li>


        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=pengumuman">
                <i class="fas fa-fw fa-book"></i>
                <span>Pengumuman</span></a>
        </li>
    <?php
    }
    ?>

    <!-- Ini sidebar siswa -->
    <?php
    if ($_SESSION['role'] == "siswa") {
    ?>
        <li class="nav-item px-3 d-none d-md-block">
            <?php
            $nis = $_SESSION['username'];
            $query = mysqli_query($koneksi, "SELECT nis,nama,foto FROM siswa WHERE nis='$nis'");
            while ($rw = mysqli_fetch_array($query)) {
            ?>
                <img src="../upload_files/profile_pictures/<?php echo $rw['foto'] ?>" class="img-thumbnail profile" alt="">
                <br>
                <p class=" text-center h6 fw-bold text-capitalize mt-3" style="color: white;"><?php echo $rw['nama'] ?></p>
                <p class=" text-center mt-1" style="color: white;"><?php echo $rw['nis'] ?></p>
            <?php

            } ?>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <?php
        $nis = $_SESSION['username'];
        $get_data = mysqli_query($koneksi, "SELECT data_kelas.* FROM data_kelas INNER JOIN siswa ON siswa.id_siswa = data_kelas.id_siswa WHERE siswa.nis='$nis' ORDER BY id_datakelas DESC LIMIT 1");
        while ($d = mysqli_fetch_row($get_data)) {
            $a = $d[1];
        }
        ?>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=hasilstudi&kode_kelas=<?php echo $a ?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Hasil Studi</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=jadwal&kode_kelas=<?php echo $a ?>">
                <i class="fas fa-fw fa-list"></i>
                <span>Jadwal</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=kehadiran&kode_kelas=<?php echo $a ?>">
                <i class="fas fa-fw fa-list"></i>
                <span>Kehadiran</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=pengumuman">
                <i class="fas fa-fw fa-bell"></i>
                <span>Pengumuman</span></a>
        </li>

    <?php
    }
    ?>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none ">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>