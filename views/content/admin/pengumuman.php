<div class="container-fluid p-1">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdatapengumuman" data-whatever="Pengumuman">Tambah Pengumuman</button>
</div>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul</th>
                <th scope="col">Sub Judul</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * from pengumuman";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><img src="../upload_files/pengumuman_pictures/<?php echo $d['gambar'] ?>" alt="gambar" style="width: 200px; height:150px;object-fit:contain;"></td>
                    <td><?php echo $d['judul']; ?></td>
                    <td><?php echo $d['subjudul']; ?></td>
                    <td><?php echo $d['tanggal']; ?></td>
                    <td> <textarea class="text-justify form-control" cols="100" rows="8" readonly><?php echo $d['keterangan']; ?></textarea> </td>
                    <td><?php echo $d['status']; ?></td>
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                        <a data-toggle="modal" data-target="#updatedatapengumuman<?php echo $d['id_pengumuman']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                        <a href="./content/admin/function/hapuspengumuman.php?id_pengumuman=<?php echo $d['id_pengumuman'] ?>&gambar=<?php echo $d['gambar'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatapengumuman<?php echo $d['id_pengumuman'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Pengumuman</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $kd = $d['id_pengumuman'];
                            $query = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE id_pengumuman='$kd'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/admin/function/updatepengumuman.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="judul" class="col-form-label">Judul:</label>
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id_pengumuman']; ?>">
                                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row['judul']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subjudul" class="col-form-label">Sub Judul:</label>
                                            <input type="text" class="form-control" id="subjudul" name="subjudul" value="<?php echo $row['subjudul']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan" class="col-form-label">Keterangan:</label>
                                            <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"><?php echo $row['keterangan']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">Status:</label>
                                            <select id="status" class="form-control" name="status" value="<?php echo $row['status']; ?>" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="draft" <?php if ($row['status'] == "draft") {
                                                                            echo 'selected';
                                                                        } ?>>Draft</option>
                                                <option value="tampil" <?php if ($row['status'] == "tampil") {
                                                                            echo 'selected';
                                                                        } ?>>Tampil</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto" class="col-form-label">Gambar:</label>
                                            <input type="text" class="form-control" id="gambar_lama" name="gambar_lama" value="<?php echo $row['gambar']; ?>" hidden>
                                            <input type="file" class="form-control" id="gambar" name="gambar">
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