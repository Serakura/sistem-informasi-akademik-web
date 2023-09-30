<div class="container-fluid p-1 mb-2">
    <a href="index.php?page=mapel" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
</div>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Kode Mata Pelajaran</th>
                <th scope="col">Nama Mata Pelajaran</th>
                <th scope="col">Jadwal</th>
                <th scope="col">Kelas</th>
                <th scope="col">KKM</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $kode = $_GET['kode_kelas'];
            $query = "SELECT mata_pelajaran.*,kelas.nama_kelas AS kelas from mata_pelajaran INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE kelas.kode_kelas='$kode'";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $d['kode_mapel']; ?></td>
                    <td><?php echo $d['nama_mapel']; ?></td>
                    <td><?php echo $d['jadwal_hari'] . ", " . date_format(date_create($d['jadwal_mulai']), "H:i") . " - " . date_format(date_create($d['jadwal_selesai']), "H:i"); ?></td>
                    <td><?php echo $d['kelas']; ?></td>
                    <td><?php echo $d['kkm']; ?></td>

                </tr>
                <!-- Update Data Guru -->

            <?php
            }
            ?>
        </tbody>
    </table>

</div>