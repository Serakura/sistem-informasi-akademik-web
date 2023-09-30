<?php
if (@!$_GET['kode_kelas']) {
?>
    <div class="table-responsive border px-2 py-4">
        <table class="table table-bordered table-hover table-striped " id="data-table">
            <thead style="background-color: #4e73df;">
                <tr class="text-light">
                    <th scope="col">No</th>
                    <th scope="col">Kode Kelas</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Nama Wali Kelas</th>
                    <th scope="col">Data Siswa</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $nip = $_SESSION['username'];
                $query = "SELECT *, wali_kelas.nama FROM kelas INNER JOIN wali_kelas ON wali_kelas.id_wali = kelas.id_wali WHERE wali_kelas.nip='$nip' GROUP BY kelas.kode_kelas ORDER BY nama_kelas ASC";
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
                            <a href="index.php?page=rekapnilai&kode_kelas=<?php echo $d['kode_kelas'] ?>" class="btn btn-primary"><i class="fas fa-fw fa-eye mr-2"></i>Lihat Data Siswa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="container-fluid p-1 mb-2">
        <a href="index.php?page=rekapnilai" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="table-responsive border px-2 py-4">
        <table class="table table-bordered table-hover table-striped " id="data-table">
            <thead style="background-color: #4e73df;">
                <tr class="text-light">
                    <th scope="col">No</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nilai Semester Ganjil</th>
                    <th scope="col">Nilai Semester Genap</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $kode = $_GET['kode_kelas'];
                $query = "SELECT siswa.id_siswa,siswa.foto,siswa.nama,siswa.nis from siswa INNER JOIN data_kelas ON siswa.id_siswa = data_kelas.id_siswa INNER JOIN kelas ON data_kelas.kode_kelas = kelas.kode_kelas WHERE kelas.kode_kelas = '$kode'";

                $data_siswa = mysqli_query($koneksi, $query);
                $nomor = 1;
                while ($d = mysqli_fetch_array($data_siswa)) {
                ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><img src="../upload_files/profile_pictures/<?php echo $d['foto'] ?>" alt="profile" style="width: 100px; height:120px; object-fit:contain;"></td>
                        <td class="text-capitalize"><?php echo $d['nama']; ?></td>
                        <td><?php echo $d['nis']; ?></td>
                        <td>
                            <a href="index.php?page=nilai&kode_kelas=<?php echo $kode ?>&id_siswa=<?php echo $d['id_siswa'] ?>&semester=ganjil" class="btn btn-primary mb-2"><i class="fas fa-fw fa-eye mr-2"></i>Semester Ganjil</a>
                        </td>
                        <td>
                            <a href="index.php?page=nilai&kode_kelas=<?php echo $kode ?>&id_siswa=<?php echo $d['id_siswa'] ?>&semester=genap" class="btn btn-primary"><i class="fas fa-fw fa-eye mr-2"></i>Semester Genap</a>
                        </td>
                    </tr>
                    <!-- Update Data Guru -->

                <?php
                }
                ?>
            </tbody>
        </table>

    </div>

<?php } ?>