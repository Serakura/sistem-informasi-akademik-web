<?php
$kode_kelas = $_GET['kode_kelas'];
?>
<div class="d-sm-flex align-items-center justify-content-start mb-4">
    <div>
        <a href="index.php?page=siswakelas" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>

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
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

</div>