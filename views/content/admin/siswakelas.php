<?php
$kode_kelas = $_GET['kode_kelas'];
?>
<div class="container-fluid p-1">
    <div class="d-flex justify-content-between">
        <a href="./content/admin/function/downloaddatasiswakelas.php?kode_kelas=<?php echo $kode_kelas ?>" type="button" class="btn btn-primary mb-2 mr-2 "><i class="fas fa-fw fa-print mr-2"></i>Download Data Siswa Kelas</a>
        <a href="index.php?page=siswa&kode_kelas=<?php echo $kode_kelas ?>" type="button" class="btn btn-primary mb-2" style="float:right;">Tambah Data Siswa Kelas</a>
    </div>

</div>

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
            $query = "SELECT siswa.id_siswa,nama,nis,jenkel,agama,tempat_lahir,tanggal_lahir,alamat,telp,angkatan,foto from siswa INNER JOIN data_kelas ON data_kelas.id_siswa = siswa.id_siswa WHERE data_kelas.kode_kelas= '$kode_kelas'";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><img src="../upload_files/profile_pictures/<?php echo $d['foto'] ?>" alt="profile" style="width: 100px; height:120px;"></td>
                    <td class="text-capitalize"><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['nis']; ?></td>
                    <td><?php echo $d['jenkel']; ?></td>
                    <td><?php echo $d['tempat_lahir'] . ", " . $d['tanggal_lahir']; ?></td>
                    <td><?php echo $d['agama']; ?></td>
                    <td class="text-capitalize"><?php echo $d['alamat']; ?></td>
                    <td><?php echo $d['telp']; ?></td>
                    <td><?php echo $d['angkatan']; ?></td>
                    <td>
                        <a href="./content/admin/function/hapussiswakelas.php?id_siswa=<?php echo $d['id_siswa'] ?>&kode_kelas=<?php echo $kode_kelas ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

</div>