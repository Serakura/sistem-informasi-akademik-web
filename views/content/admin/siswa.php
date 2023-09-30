<?php
if (@!$_GET['kode_kelas']) {
?>
    <div class="container-fluid p-1">
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdatasiswa" data-whatever="Siswa">Tambah Data Siswa</button>
    </div>
<?php } ?>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama</th>
                <th scope="col">NIS</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">TTL</th>
                <th scope="col">Agama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Telepon</th>
                <th scope="col">Angkatan</th>

                <th scope="col">Aksi</th>

            </tr>
        </thead>
        <tbody>
            <?php


            $query = "SELECT id_siswa,nama,nis,jenkel,agama,tempat_lahir,tanggal_lahir,alamat,telp,angkatan,foto from siswa";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {

            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><img src="../upload_files/profile_pictures/<?php echo $d['foto'] ?>" alt="profile" style="width: 100px; height:120px; object-fit:contain;"></td>
                    <td class="text-capitalize"><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['nis']; ?></td>
                    <td><?php echo $d['jenkel']; ?></td>
                    <td><?php echo $d['tempat_lahir'] . ", " . date_format(date_create($d['tanggal_lahir']), "d-m-Y"); ?></td>
                    <td><?php echo $d['agama']; ?></td>
                    <td class="text-capitalize"><?php echo $d['alamat']; ?></td>
                    <td><?php echo $d['telp']; ?></td>
                    <td><?php echo $d['angkatan']; ?></td>
                    <?php
                    if (@$_GET['kode_kelas']) {
                        $kode_kelas = $_GET['kode_kelas'];
                    ?>
                        <td><a class="btn btn-primary" href="./content/admin/function/tambahsiswakelas.php?id_siswa=<?php echo $d['id_siswa'] ?>&kode_kelas=<?php echo $kode_kelas ?>">Tambah Siswa Kelas</a></td>
                    <?php
                    } else {
                    ?>
                        <td>
                            <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                            <a data-toggle="modal" data-target="#updatedatasiswa<?php echo $d['nis']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                            <a href="./content/admin/function/hapussiswa.php?nis=<?php echo $d['nis'] ?>&foto=<?php echo $d['foto'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatasiswa<?php echo $d['nis'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $nis = $d['nis'];
                            $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/admin/function/updatesiswa.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama:</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nip" class="col-form-label">NIS:</label>
                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['nis']; ?>" disabled>
                                            <input type="hidden" class="form-control" id="nis" name="nis" value="<?php echo $row['nis']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-form-label">Password:</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                                            <select id="jeniskelamin" class="form-control" name="jeniskelamin" value="<?php echo $row['jenis_kelamin']; ?>" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" <?php if ($row['jenkel'] == "Laki-laki") {
                                                                                echo 'selected';
                                                                            } ?>>Laki-laki</option>
                                                <option value="Perempuan" <?php if ($row['jenkel'] == "Perempuan") {
                                                                                echo 'selected';
                                                                            } ?>>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama" class="col-form-label">Agama:</label>
                                            <select id="agama" class="form-control" name="agama" value="<?php echo $row['agama']; ?>" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" <?php if ($row['agama'] == "Islam") {
                                                                            echo 'selected';
                                                                        } ?>>Islam</option>
                                                <option value="Kristen" <?php if ($row['agama'] == "Kristen") {
                                                                            echo 'selected';
                                                                        } ?>>Kristen</option>
                                                <option value="Hindu" <?php if ($row['agama'] == "Hindu") {
                                                                            echo 'selected';
                                                                        } ?>>Hindu</option>
                                                <option value="Budha" <?php if ($row['agama'] == "Budha") {
                                                                            echo 'selected';
                                                                        } ?>>Budha</option>
                                                <option value="Katolik" <?php if ($row['agama'] == "Katolik") {
                                                                            echo 'selected';
                                                                        } ?>>Katolik</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir" class="col-form-label">Tempat Lahir:</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $row['tempat_lahir'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir:</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon" class="col-form-label">Telepon:</label>
                                            <input type="number" class="form-control" id="telepon" name="telepon" value="<?php echo $row['telp']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-form-label">Alamat:</label>
                                            <textarea class="form-control" id="alamat" name="alamat" required><?php echo $row['alamat']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="angkatan" class="col-form-label">Angkatan:</label>
                                            <input type="number" class="form-control" id="angkatan" name="angkatan" value="<?php echo $row['angkatan']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto" class="col-form-label">Foto:</label>
                                            <input type="text" class="form-control" id="foto_lama" name="foto_lama" value="<?php echo $row['foto']; ?>" hidden>
                                            <input type="file" class="form-control" id="foto" name="foto">
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