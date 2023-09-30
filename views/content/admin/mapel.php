<div class="container-fluid p-1">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdatamapel" data-whatever="Siswa">Tambah Mata Pelajaran</button>
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
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT mata_pelajaran.*,kelas.nama_kelas AS kelas from mata_pelajaran INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas";

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
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                        <a data-toggle="modal" data-target="#updatedatamapel<?php echo $d['kode_mapel']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                        <a href="./content/admin/function/hapusmapel.php?kode_mapel=<?php echo $d['kode_mapel'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatamapel<?php echo $d['kode_mapel'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Mata Pelajaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $kd = $d['kode_mapel'];
                            $query = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran WHERE kode_mapel='$kd'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/admin/function/updatemapel.php" method="POST">
                                        <div class="form-group">
                                            <label for="kode" class="col-form-label">Kode Mata Pelajaran:</label>
                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['kode_mapel']; ?>" disabled>
                                            <input type="hidden" class="form-control" id="kode" name="kode" value="<?php echo $row['kode_mapel']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama Mata Pelajaran:</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama_mapel']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="hari" class="col-form-label">Hari:</label>
                                            <select id="hari" class="form-control" name="hari" required>
                                                <option value="" <?php if ($row['jadwal_hari'] == null) {
                                                                        echo "selected";
                                                                    } ?>>Pilih Hari</option>
                                                <option value="Senin" <?php if ($row['jadwal_hari'] == "Senin") {
                                                                            echo "selected";
                                                                        } ?>>Senin</option>
                                                <option value="Selasa" <?php if ($row['jadwal_hari'] == "Selasa") {
                                                                            echo "selected";
                                                                        } ?>>Selasa</option>
                                                <option value="Rabu" <?php if ($row['jadwal_hari'] == "Rabu") {
                                                                            echo "selected";
                                                                        } ?>>Rabu</option>
                                                <option value="Kamis" <?php if ($row['jadwal_hari'] == "Kamis") {
                                                                            echo "selected";
                                                                        } ?>>Kamis</option>
                                                <option value="Jum'at" <?php if ($row['jadwal_hari'] == "Jum'at") {
                                                                            echo "selected";
                                                                        } ?>>Jum'at</option>
                                                <option value="Sabtu" <?php if ($row['jadwal_hari'] == "Sabtu") {
                                                                            echo "selected";
                                                                        } ?>>Sabtu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="mulai" class="col-form-label">Waktu Mulai:</label>
                                            <input type="time" class="form-control" id="mulai" name="mulai" value="<?php echo date_format(date_create($row['jadwal_mulai']), "H:i") ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="selesai" class="col-form-label">Waktu Selesai:</label>
                                            <input type="time" class="form-control" id="selesai" name="selesai" value="<?php echo date_format(date_create($row['jadwal_selesai']), "H:i") ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kkm" class="col-form-label">KKM:</label>
                                            <input type="text" class="form-control" id="kkm" name="kkm" value="<?php echo $row['kkm'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas" class="col-form-label">Kelas:</label>
                                            <select id="kelas" class="form-control" name="kelas" value="<?php echo $row['kode_kelas']; ?>" required>
                                                <option value="">Pilih Kelas</option>
                                                <?php
                                                $kelas = $row['kode_kelas'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                                $ii = 1;
                                                while ($wi = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $wi['kode_kelas'] ?> " <?php if ($row['kode_kelas'] == $wi['kode_kelas']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo $wi['nama_kelas'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                                    </form>
                                <?php
                            }
                                ?>
                                </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </tbody>
    </table>

</div>