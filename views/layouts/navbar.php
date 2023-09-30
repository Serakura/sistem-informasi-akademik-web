<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow ">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->

    <div class="d-flex flex-row bd-highlight mr-auto">
        <!-- <img src="../assets/logo_sekolah.png" alt="logo" width="30" class="my-auto"> -->
        <h5 class="fw-bolder my-auto text-secondary"><b><i>SD Negeri 2 Mendolo Lor</i></b></h5>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS)
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
        <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> -->



        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php
                    // global $koneksi;
                    $role = $_SESSION['role'];
                    $username = $_SESSION['username'];
                    $kolom = "";
                    switch ($role) {
                        case "admin":
                            $kolom = "username";
                            break;

                        case "wali_kelas":
                            $kolom = "nip";
                            break;

                        case "guru":
                            $kolom = "nip";
                            break;

                        case "siswa":
                            $kolom = "nis";
                            break;
                        default:
                    }
                    $query = mysqli_query($koneksi, "SELECT * FROM $role WHERE $kolom='$username'");
                    $result = mysqli_fetch_assoc($query);
                    echo $result['nama'];
                    ?>
                </span>
                <img class="img-profile rounded-circle" src="../public/admin/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php if ($role != 'admin') { ?>
                    <a class="dropdown-item disabled d-block d-md-none">
                        <?php
                        $id = $_SESSION['username'];
                        if ($role == 'wali_kelas') {
                            $query = mysqli_query($koneksi, "SELECT nip,nama,foto FROM wali_kelas WHERE nip='$id'");
                        } else if ($role == 'guru') {
                            $query = mysqli_query($koneksi, "SELECT nip,nama,foto FROM guru WHERE nip='$id'");
                        } else {
                            $query = mysqli_query($koneksi, "SELECT nis,nama,foto FROM siswa WHERE nis='$id'");
                        }
                        while ($rw = mysqli_fetch_array($query)) {
                        ?>
                            <img src="../upload_files/profile_pictures/<?php echo $rw['foto'] ?>" class="img-thumbnail profile" alt="">
                            <br>
                            <p class=" text-center h6 fw-bold text-capitalize mt-3" style="color: black;"><?php echo $rw['nama'] ?></p>
                            <p class=" text-center mt-1" style="color: black;"><?php if ($role == 'wali_kelas') {
                                                                                    echo $rw['nip'];
                                                                                } else {
                                                                                    echo $rw['nis'];
                                                                                } ?></p>
                        <?php

                        } ?>
                    </a>
                    <a class="dropdown-item" href="index.php?page=profile">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>