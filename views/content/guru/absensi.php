<?php
if (!empty($_GET['id_akses'])) {
    $akses = $_GET['id_akses'];
    $kode_kelas = $_GET['kode_kelas'];
?>
    <div class="container-fluid p-1 mb-2">
        <div class="d-flex justify-content-between">
            <a href="index.php?page=absensi" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
            <a href="./content/guru/function/tambahabsensi.php?id_akses=<?= $akses ?>&kode_kelas=<?= $kode_kelas ?>" class="btn btn-primary">Tambah Pertemuan</a>
        </div>

    </div>

    <div class="table-responsive border px-2 py-4">
        <table class="table table-bordered table-hover table-striped " id="data-table">
            <thead style="background-color: #4e73df;">
                <tr class="text-light">
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Pertemuan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM absensi WHERE id_akses = '$akses'";

                $data_siswa = mysqli_query($koneksi, $query);
                $nomor = 1;
                while ($d = mysqli_fetch_array($data_siswa)) {
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $d['tanggal']; ?></td>
                        <td>Pertemuan <?php echo $d['pertemuan']; ?></td>
                        <td><a href="./index.php?page=detailabsensi&id_absensi=<?= $d['id_absensi'] ?>&kode_kelas=<?= $kode_kelas ?>" class="btn btn-primary">Cek Absensi Siswa</a><a href="./content/guru/function/hapusabsensi.php?id_absensi=<?= $d['id_absensi'] ?>&id_akses=<?= $akses ?>&kode_kelas=<?= $kode_kelas ?>" class="btn btn-primary ml-2">Hapus</a></td>

                    </tr>
                    <!-- Update Data Guru -->

                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
<?php
} else {
?>

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
                $nip = $_SESSION['username'];
                $query = "SELECT mata_pelajaran.*, akses_absensi.id_guru, akses_absensi.id_akses, kelas.nama_kelas, kelas.kode_kelas FROM akses_absensi INNER JOIN mata_pelajaran ON mata_pelajaran.id_mapel = akses_absensi.id_mapel
            INNER JOIN guru ON guru.id_guru = akses_absensi.id_guru INNER JOIN kelas ON mata_pelajaran.kode_kelas = kelas.kode_kelas WHERE guru.nip = '$nip'";

                $data_akses = mysqli_query($koneksi, $query);
                $nomor = 1;
                while ($d = mysqli_fetch_array($data_akses)) {
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $d['nama_mapel']; ?></td>
                        <td><?php echo $d['jadwal_hari'] . ", " . date_format(date_create($d['jadwal_mulai']), "H:i") . " - " . date_format(date_create($d['jadwal_selesai']), "H:i"); ?></td>
                        <td><?php echo $d['nama_kelas']; ?></td>
                        <td><a href="./index.php?page=absensi&id_akses=<?= $d['id_akses'] ?>&kode_kelas=<?= $d['kode_kelas'] ?>" class="btn btn-primary">Lihat Absensi</a></td>

                    </tr>
                    <!-- Update Data Guru -->

                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
<?php } ?>