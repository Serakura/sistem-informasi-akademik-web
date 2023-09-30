<?php
$role = $_SESSION['role'];
if ($role == "wali_kelas") {
    $nip = $_SESSION['username'];
    $query = mysqli_query($koneksi, "SELECT * FROM wali_kelas WHERE nip='$nip'");
} else if ($role == "guru") {
    $nip = $_SESSION['username'];
    $query = mysqli_query($koneksi, "SELECT * FROM guru WHERE nip='$nip'");
} else {
    $nis = $_SESSION['username'];
    $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
}
while ($row = mysqli_fetch_array($query)) {
?>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="./content/all/function/updatedatadiri.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">NIP:</label>
                            <input type="text" class="form-control" id="" name="" value="<?php if ($role == "wali_kelas" || $role == "guru") {
                                                                                                echo $row['nip'];
                                                                                            } else {
                                                                                                echo $row['nis'];
                                                                                            } ?>" disabled>
                            <input type="hidden" class="form-control" id="" name="<?php if ($role == "wali_kelas" || $role == "guru") {
                                                                                        echo "nip";
                                                                                    } else {
                                                                                        echo "nis";
                                                                                    } ?>" value="<?php if ($role == "wali_kelas" || $role == "guru") {
                                                                                                        echo $row['nip'];
                                                                                                    } else {
                                                                                                        echo $row['nis'];
                                                                                                    } ?>">
                            <input type="hidden" id="role" class="form-control" name="role" value="<?php echo $role; ?>">
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                            <input type="text" id="jeniskelamin" class="form-control" name="jeniskelamin" value="<?php echo $row['jenkel']; ?>" disabled>

                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" value="<?php echo $row['telp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required><?php echo $row['alamat']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui Data Diri</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php } ?>