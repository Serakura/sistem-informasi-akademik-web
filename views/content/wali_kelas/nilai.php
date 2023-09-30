<?php
$kode_kelas = $_GET['kode_kelas'];
$siswa = $_GET['id_siswa'];
$smst = $_GET['semester'];
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <a href="index.php?page=rekapnilai&kode_kelas=<?php echo $kode_kelas ?>" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahdatanilai" data-whatever="Nilai">Tambah Data Nilai</button>

</div>
<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Mata Pelajaran</th>
                <th scope="col">Semester</th>
                <th scope="col">Nilai Tugas</th>
                <th scope="col">Nilai UTS</th>
                <th scope="col">Nilai UAS</th>
                <th scope="col">Total Nilai</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT id_nilai,mata_pelajaran.nama_mapel,semester,nilai_tugas,nilai_uts,nilai_uas,total_nilai from nilai INNER JOIN siswa ON siswa.id_siswa = nilai.id_siswa INNER JOIN mata_pelajaran ON mata_pelajaran.id_mapel = nilai.id_mapel
            INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE kelas.kode_kelas= '$kode_kelas' AND siswa.id_siswa=$siswa AND semester='$smst'";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $d['nama_mapel']; ?></td>
                    <td><?php echo $d['semester']; ?></td>
                    <td><?php echo $d['nilai_tugas']; ?></td>
                    <td><?php echo $d['nilai_uts']; ?></td>
                    <td><?php echo $d['nilai_uas']; ?></td>
                    <td><?php echo $d['total_nilai']; ?></td>
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                        <a data-toggle="modal" data-target="#updatedatanilai<?php echo $d['id_nilai']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                        <a href="./content/wali_kelas/function/hapusnilai.php?id_nilai=<?php echo $d['id_nilai'] ?>&id_siswa=<?php echo $siswa ?>&kode_kelas=<?php echo $kode_kelas ?>&semester=<?php echo $smst ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatanilai<?php echo $d['id_nilai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Nilai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $nilai = $d['id_nilai'];
                            $query = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_nilai='$nilai'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/wali_kelas/function/updatenilai.php" method="POST">
                                        <?php
                                        if ($page = "nilai") {
                                            $kelas = $_GET['kode_kelas'];
                                            $siswa = $_GET['id_siswa'];
                                            $semester = $_GET['semester'];
                                        }
                                        ?>
                                        <div class="form-group mb-3">
                                            <label for="kelas" class="col-form-label">Mata Pelajaran:</label>
                                            <select id="kelas" class="form-control" name="mapel" required>
                                                <option value="" selected>Pilih Mata Pelajaran</option>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran WHERE kode_kelas='$kelas'");
                                                while ($wi = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $wi['id_mapel'] ?> " <?php if ($row['id_mapel'] == $wi['id_mapel']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $wi['nama_mapel'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="semester" class="col-form-label">Semester:</label>
                                            <input type="hidden" class="form-control" id="id_nilai" name="id_nilai" value="<?php echo $row['id_nilai'] ?>">
                                            <input type="hidden" class="form-control" id="kelas" name="kelas" value="<?php echo $kelas ?>">
                                            <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="<?php echo $siswa ?>">
                                            <input type="text" class="form-control" id="semester" name="semester" value="<?php echo $semester ?>" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tugas" class="col-form-label">Nilai Tugas:</label>
                                            <input type="number" class="form-control" id="tugas" name="tugas" value="<?php echo $row['nilai_tugas'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="uts" class="col-form-label">Nilai UTS:</label>
                                            <input type="number" class="form-control" id="uts" name="uts" value="<?php echo $row['nilai_uts'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="uas" class="col-form-label">Nilai UAS:</label>
                                            <input type="number" class="form-control" id="uas" name="uas" value="<?php echo $row['nilai_uas'] ?>" required>
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