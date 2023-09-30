<div class="container-fluid p-1">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdataaksesabsensi" data-whatever="Siswa">Tambah Akses Absensi</button>
</div>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Guru</th>
                <th scope="col">Nama Mata Pelajaran</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT akses_absensi.*,mata_pelajaran.*,kelas.nama_kelas AS kelas ,guru.nama from akses_absensi INNER JOIN mata_pelajaran ON akses_absensi.id_mapel = mata_pelajaran.id_mapel
            INNER JOIN guru ON guru.id_guru = akses_absensi.id_guru INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['nama_mapel']; ?></td>
                    <td><?php echo $d['kelas']; ?></td>
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                        <a data-toggle="modal" data-target="#updatedataakses<?php echo $d['id_akses']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                        <a href="./content/admin/function/hapusakses.php?id_akses=<?php echo $d['id_akses'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedataakses<?php echo $d['id_akses'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Akses Absensi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $kd = $d['id_akses'];
                            $query = mysqli_query($koneksi, "SELECT * FROM akses_absensi WHERE id_akses='$kd'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/admin/function/updateakses.php" method="POST">
                                        <div class="form-group">
                                            <label for="guru" class="col-form-label">Guru:</label>
                                            <input type="text" value="<?= $kd ?>" name="id_akses" hidden>
                                            <select id="guru" class="form-control" name="guru" value="<?php echo $row['id_guru']; ?>" required>
                                                <option value="">Pilih Guru</option>
                                                <?php
                                                $guru = $row['id_guru'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM guru");
                                                while ($wi = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $wi['id_guru'] ?> " <?php if ($row['id_guru'] == $wi['id_guru']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $wi['nama'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="mapel" class="col-form-label">Mata Pelajaran:</label>
                                            <select id="mapel" class="form-control" name="mapel" value="<?php echo $row['id_mapel']; ?>" required>
                                                <option value="">Pilih Mata Pelajaran</option>
                                                <?php
                                                $mapel = $row['id_mapel'];
                                                $query = mysqli_query($koneksi, "SELECT mata_pelajaran.*,kelas.nama_kelas AS kelas from mata_pelajaran INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE id_mapel NOT IN (SELECT id_mapel FROM akses_absensi WHERE id_akses != '$kd')");
                                                while ($wi = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $wi['id_mapel'] ?> " <?php if ($row['id_mapel'] == $wi['id_mapel']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $wi['nama_mapel'] ?> - <?php echo $wi['kelas'] ?></option>
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