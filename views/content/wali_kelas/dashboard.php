<?php
include './content/admin/function/tampildashboard.php';
?>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h6>Jumlah Siswa</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($siswa) {
                                                                                $sis = mysqli_num_rows($siswa);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            <h6>Jumlah Wali Kelas</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($guru) {
                                                                                $sis = mysqli_num_rows($guru);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            <h6>Jumlah Kelas</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($kelas) {
                                                                                $sis = mysqli_num_rows($kelas);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-home fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            <h6>Jumlah Guru</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($pengajar) {
                                                                                $sis = mysqli_num_rows($pengajar);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-7 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Pengumuman</h5>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE status='tampil'");
                while ($d = mysqli_fetch_array($query)) {
                ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center">
                                <img src="../upload_files/pengumuman_pictures/<?php echo $d['gambar'] ?>" class="img-fluid" alt="gambar" style="width: 350px;height: 250px;object-fit: contain;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $d['judul'] ?></h4>
                                    <h6 class="card-title"><?php echo $d['subjudul'] ?></h6>
                                    <p class="card-text"><?php echo substr($d['keterangan'], 0, 150) . "...." ?></p>
                                    <a href="index.php?page=pengumuman">Baca Selengkapnya</a>
                                    <p class="card-text"><small class="text-muted"><?php echo date_format(date_create($d['tanggal']), "d-m-Y") ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Visi & Misi Sekolah</h5>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="container text-center px-5 py-2">
                    <h4 class="text text-center font-weight-bold text-primary mt-2">Visi</h4>
                    <p class="h5">Mewujudkan Generasi Islam Yang Unggul, Mandiri Dan Berbudaya.</p>
                    <h4 class="text text-center font-weight-bold text-primary mt-3">Misi</h4>
                    <p class="h5">1) Mendidik siswa beraqidah kuat, rajin beribadah, fasih membaca al-Qur’an, berakhlak mulia dan peduli sesama, dalam rangka mewujudkan misi dakwah Muhammadiyah.</p>
                    <p class="h5">2) Mendidik dan melatih siswa memiliki kompetensi dalam bidang ilmu pengetahuan teknologi dan seni/IPTEKS, bahasa dan Olahraga.</p>
                    <p class="h5">3) Mendidik dan melatih siswa mampu berfikir dan berkarya.</p>
                    <p class="h5 mb-2">4) Membiasakan siswa melaksanakan kebersihan, keindahan, kesehatan, kedisiplinan dan kejujuran.</p>
                </div>

            </div>
        </div>
    </div>
</div>