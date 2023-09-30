<?php

if (!empty($_GET['id_mapel'])) {
    $kode_kelas = $_GET['kode_kelas'];
    $mapel = $_GET['id_mapel'];
?>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive border px-2 py-4">
                    <table class="table table-bordered table-hover table-striped " id="data-table">
                        <thead style="background-color: #4e73df;">
                            <tr class="text-light">
                                <th scope="col">No</th>
                                <th scope="col">Pertemuan</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nis = $_SESSION['username'];
                            $query = "SELECT absensi.pertemuan, detail_absensi.keterangan FROM absensi INNER JOIN akses_absensi ON absensi.id_akses = akses_absensi.id_akses
                            INNER JOIN mata_pelajaran ON akses_absensi.id_mapel = mata_pelajaran.id_mapel INNER JOIN detail_absensi ON detail_absensi.id_absensi = absensi.id_absensi
                            INNER JOIN siswa ON siswa.id_siswa = detail_absensi.id_siswa WHERE siswa.nis = '$nis' AND mata_pelajaran.id_mapel='$mapel'";

                            $data_siswa = mysqli_query($koneksi, $query);
                            $nomor = 1;
                            while ($d = mysqli_fetch_array($data_siswa)) {
                            ?>
                                <tr>
                                    <td><?php echo $nomor++; ?></td>
                                    <td><?php echo $d['pertemuan']; ?></td>
                                    <td><?php echo $d['keterangan']; ?></td>

                                </tr>
                                <!-- Update Data Guru -->

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
<?php } else {
    $kode_kelas = $_GET['kode_kelas'];  ?>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive border px-2 py-4">
                    <table class="table table-bordered table-hover table-striped " id="data-table">
                        <thead style="background-color: #4e73df;">
                            <tr class="text-light">
                                <th scope="col">No</th>
                                <th scope="col">Nama Mata Pelajaran</th>
                                <th scope="col">Jadwal</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nis = $_SESSION['username'];
                            $query = "SELECT mata_pelajaran.*, kelas.nama_kelas, kelas.kode_kelas FROM akses_absensi INNER JOIN mata_pelajaran ON mata_pelajaran.id_mapel = akses_absensi.id_mapel
                        INNER JOIN kelas ON mata_pelajaran.kode_kelas = kelas.kode_kelas INNER JOIN data_kelas ON data_kelas.kode_kelas = kelas.kode_kelas
                        INNER JOIN siswa ON data_kelas.id_siswa = siswa.id_siswa 
                        WHERE siswa.nis = '$nis'";

                            $data_siswa = mysqli_query($koneksi, $query);
                            $nomor = 1;
                            while ($d = mysqli_fetch_array($data_siswa)) {
                            ?>
                                <tr>
                                    <td><?php echo $nomor++; ?></td>
                                    <td><?php echo $d['nama_mapel']; ?></td>
                                    <td><?php echo $d['jadwal_hari'] . ", " . date_format(date_create($d['jadwal_mulai']), "H:i") . " - " . date_format(date_create($d['jadwal_selesai']), "H:i"); ?></td>
                                    <td><?php echo $d['nama_kelas']; ?></td>
                                    <td><a href="./index.php?page=kehadiran&id_mapel=<?= $d['id_mapel'] ?>&kode_kelas=<?= $kode_kelas ?>" class="btn btn-primary">Lihat Kehadiran</a></td>

                                </tr>
                                <!-- Update Data Guru -->

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
<?php } ?>