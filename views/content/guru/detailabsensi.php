<?php
$id_absensi = $_GET['id_absensi'];
$kode_kelas = $_GET['kode_kelas'];


?>
<div class="container-fluid p-1 mb-2">
    <div class="d-flex justify-content-between">
        <a href="./content/guru/function/downloadrekapabsensi.php?id_absensi=<?= $id_absensi ?>&nama_mapel=<?= $nama_mapel ?>&nama_kelas=<?= $nama_kelas ?>" class="btn btn-primary"><i class="fas fa-fw fa-file-pdf"></i> Download Rekap Absensi</a>
    </div>
</div>
<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Status</th>
                <th scope="col">Pertemuan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php


            $query = "SELECT siswa.nama, keterangan, id_detail, absensi.pertemuan FROM  detail_absensi INNER JOIN siswa ON detail_absensi.id_siswa = siswa.id_siswa
            INNER JOIN absensi ON absensi.id_absensi = detail_absensi.id_absensi WHERE absensi.id_absensi='$id_absensi'";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {

            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['keterangan']; ?></td>
                    <td>Pertemuan <?php echo $d['pertemuan']; ?></td>
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                        <a data-toggle="modal" data-target="#updatedatadetail<?php echo $d['id_detail']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                    </td>

                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatadetail<?php echo $d['id_detail'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Detail Absensi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $id = $d['id_detail'];
                            $query = mysqli_query($koneksi, "SELECT * FROM detail_absensi WHERE id_detail='$id'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/guru/function/updatedetail.php?id_detail=<?= $id ?>&kode_kelas=<?= $kode_kelas ?>&id_absensi=<?= $id_absensi ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" name="id_detail" value="<?= $id ?>" hidden>
                                            <input type="text" name="kode_kelas" value="<?= $kode_kelas ?>" hidden>
                                            <input type="text" name="id_absensi" value="<?= $id_absensi ?>" hidden>
                                            <label for="keterangan" class="col-form-label">Keterangan:</label>
                                            <select id="keterangan" class="form-control" name="keterangan" value="<?php echo $row['keterangan']; ?>" required>
                                                <option value="">Pilih Keterangan</option>
                                                <option value="Hadir" <?php if ($row['keterangan'] == "Hadir") {
                                                                            echo 'selected';
                                                                        } ?>>Hadir</option>
                                                <option value="Izin" <?php if ($row['keterangan'] == "Izin") {
                                                                            echo 'selected';
                                                                        } ?>>Izin</option>
                                                <option value="Sakit" <?php if ($row['keterangan'] == "Sakit") {
                                                                            echo 'selected';
                                                                        } ?>>Sakit</option>
                                                <option value="Alpha" <?php if ($row['keterangan'] == "Alpha") {
                                                                            echo 'selected';
                                                                        } ?>>Alpha</option>
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