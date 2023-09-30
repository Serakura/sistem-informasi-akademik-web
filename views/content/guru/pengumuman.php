<?php
if (!isset($_GET['id_pengumuman'])) {
?>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Pengumuman</h5>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE status='tampil' ORDER BY tanggal DESC");
                    while ($d = mysqli_fetch_array($query)) {
                    ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-3 d-flex align-items-center">
                                    <img src="../upload_files/pengumuman_pictures/<?php echo $d['gambar'] ?>" class="img-fluid" alt="gambar" style="width: 350px;height: 250px;object-fit: contain;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $d['judul'] ?></h4>
                                        <h6 class="card-title"><?php echo $d['subjudul'] ?></h6>
                                        <p class="card-text"><?php echo substr($d['keterangan'], 0, 350) . "...." ?></p>
                                        <a href="index.php?page=pengumuman&id_pengumuman=<?php echo $d['id_pengumuman'] ?>">Baca Selengkapnya</a>
                                        <p class="card-text"><small class="text-muted"><?php echo date_format(date_create($d['tanggal']), "d-m-Y") ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } else {
?>
    <div class="container-fluid p-1 mb-2">
        <a href="index.php?page=pengumuman" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Pengumuman</h5>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php
                    $id = $_GET['id_pengumuman'];
                    $query = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE id_pengumuman='$id'");
                    while ($d = mysqli_fetch_array($query)) {
                    ?>
                        <div class="d-flex  text-justify justify-content-center text-dark ">
                            <h3 class="fw-bold"><?php echo $d['judul'] ?></h3>
                        </div>
                        <div class="d-flex  text-justify justify-content-center text-dark">
                            <h5 class="card-title"><?php echo $d['subjudul'] ?></h5>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <img src="../upload_files/pengumuman_pictures/<?php echo $d['gambar'] ?>" class="img-fluid" alt="gambar" style="width: max;height: 350px;object-fit: contain;">
                        </div>

                        <div class="d-flex mx-5 mt-3 text-justify">
                            <textarea class="form-control" rows="50" style="border:none;outline:none;overflow:auto;resize:none;background-color:#FFF !important;" readonly><?php echo $d['keterangan'] ?></textarea>

                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>