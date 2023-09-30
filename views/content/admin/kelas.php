<div class="container-fluid p-0">
    <button type="button" class="btn btn-primary ml-5 mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdatakelas" data-whatever="Kelas">Tambah Data Kelas</button>
</div>



<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Kode Kelas</th>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Tahun Ajaran</th>
                <th scope="col">Nama Wali Kelas</th>
                <th scope="col">Data Siswa Kelas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT *, wali_kelas.nama FROM kelas INNER JOIN wali_kelas ON wali_kelas.id_wali = kelas.id_wali GROUP BY kelas.kode_kelas ORDER BY nama_kelas ASC";
            $data_kelas = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_kelas)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $d['kode_kelas']; ?></td>
                    <td><?php echo $d['nama_kelas']; ?></td>
                    <td><?php echo $d['tahun_ajaran']; ?></td>
                    <td><?php echo $d['nama']; ?></td>
                    <td>
                        <a href="index.php?page=siswakelas&kode_kelas=<?php echo $d['kode_kelas'] ?>" class="btn btn-primary"><i class="fas fa-fw fa-eye mr-2"></i>Lihat Siswa Kelas</a>
                    </td>
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                        <a data-toggle="modal" data-target="#updatedatakelas<?php echo $d['kode_kelas']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                        <a href="./content/admin/function/hapuskelas.php?kode_kelas=<?php echo $d['kode_kelas'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatakelas<?php echo $d['kode_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $kode_kelas = $d['kode_kelas'];
                            $query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/admin/function/updatekelas.php" method="POST">
                                        <div class="form-group">
                                            <label for="kode" class="col-form-label">Kode Kelas:</label>
                                            <input type="text" class="form-control" id="kode" name="" value="<?php echo $row['kode_kelas']; ?>" disabled>
                                            <input type="hidden" class="form-control" id="kode" name="kode" value="<?php echo $row['kode_kelas']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama Kelas:</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama_kelas']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahunajaran" class="col-form-label">Tahun Ajaran:</label>
                                            <input type="text" class="form-control" id="tahunajaran" name="tahunajaran" value="<?php echo $row['tahun_ajaran']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kelas" class="col-form-label">Wali Kelas:</label>
                                            <select id="kelas" class="form-control" name="wali" value="<?php echo $row['id_wali']; ?>" required>
                                                <option value="" selected>Pilih Wali Kelas</option>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM wali_kelas");
                                                while ($wi = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $wi['id_wali'] ?> " <?php if ($row['id_wali'] == $wi['id_wali']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $wi['nama'] ?></option>
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