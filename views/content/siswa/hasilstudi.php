<?php
$kode_kelas = $_GET['kode_kelas'];
$nis = $_SESSION['username'];
if (isset($_POST['submit'])) {
    $kd = $_POST['kelas'];
    echo "<script>
    window.location='./index.php?page=hasilstudi&kode_kelas=$kd';
</script>";
}
?>
<div class=" container-fluid d-sm-flex align-items-center justify-content-between mb-2">

    <a href="./content/siswa/function/downloaddatanilai.php?kode_kelas=<?php echo $kode_kelas ?>&nis=<?php echo $nis ?>" class="btn btn-primary "><i class="fas fa-fw fa-print"></i> Print Nilai</a>
    <div>

        <form action="" method="POST">
            <select name="kelas" id="kelas" style="padding: 0.375rem 0.75rem;">
                <?php

                $query =  mysqli_query($koneksi, "SELECT data_kelas.*,kelas.nama_kelas FROM data_kelas INNER JOIN kelas ON kelas.kode_kelas=data_kelas.kode_kelas 
                INNER JOIN siswa ON siswa.id_siswa=data_kelas.id_siswa WHERE siswa.nis='$nis' ");
                while ($d = mysqli_fetch_array($query)) {
                ?>
                    <option value="<?php echo $d['kode_kelas'] ?>" <?php if ($d['kode_kelas'] == $kode_kelas) {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $d['nama_kelas'] ?></option>
                <?php } ?>
            </select>
            <button type="submit" class="btn btn-primary" name="submit">Lihat</button>
        </form>
    </div>

</div>
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Nilai Semester</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT id_nilai,mata_pelajaran.nama_mapel,semester,nilai_tugas,nilai_uts,nilai_uas,total_nilai from nilai INNER JOIN siswa ON siswa.id_siswa = nilai.id_siswa INNER JOIN mata_pelajaran ON mata_pelajaran.id_mapel = nilai.id_mapel
            INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE kelas.kode_kelas= '$kode_kelas' AND siswa.nis=$nis ORDER BY semester ASC";

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

                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>