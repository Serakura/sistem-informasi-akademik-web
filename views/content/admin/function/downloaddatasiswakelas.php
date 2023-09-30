<?php
require '../../../../database/db.php';
require '../../../../assets/fpdf181/fpdf.php';
$kode_kelas = $_GET['kode_kelas'];
$Lapor = "SELECT nis,nama,jenkel,agama,concat(tempat_lahir,', ',date_format(tanggal_lahir,'%d-%m-%Y')) as tanggal_lahir,alamat,telp,angkatan from siswa INNER JOIN data_kelas ON data_kelas.id_siswa = siswa.id_siswa WHERE data_kelas.kode_kelas= '$kode_kelas'";
$Hasil = mysqli_query($koneksi, $Lapor);
$Data = array();
while ($row = mysqli_fetch_assoc($Hasil)) {
    array_push($Data, $row);
}
$q = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kode_kelas = '$kode_kelas'");
while ($rw = mysqli_fetch_row($q)) {
    $Judul = 'Data Siswa Kelas ' . $rw[1];
    $tgl =   date("d-m-Y");
}
$Header = array(
    array("label" => "NIS", "length" => 15, "align" => "L"),
    array("label" => "Nama", "length" => 60, "align" => "L"),
    array("label" => "Kelamin", "length" => 25, "align" => "L"),
    array("label" => "Agama", "length" => 25, "align" => "L"),
    array("label" => "TTLahir", "length" => 40, "align" => "L"),
    array("label" => "Alamat", "length" => 65, "align" => "L"),
    array("label" => "Telepon", "length" => 28, "align" => "L"),
    array("label" => "Angkatan", "length" => 20, "align" => "L")
);

$pdf = new FPDF();
$pdf->AddPage('l', 'A4', 'C');
$pdf->SetFont('arial', 'B', '15');
$pdf->Cell(0, 15, $Judul, '0', 1, 'C');
$pdf->SetFont('arial', 'i', '9');
$pdf->Cell(0, 10, $tgl, '0', 1, 'P');
$pdf->SetFont('arial', '', '12');
$pdf->SetFillColor(78, 115, 223);
$pdf->SetTextColor(255);
$pdf->setDrawColor(0, 0, 0);
foreach ($Header as $Kolom) {
    $pdf->Cell($Kolom['length'], 8, $Kolom['label'], 1, '0', $Kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFillColor(230, 234, 247);
$pdf->SettextColor(0);
$pdf->SetFont('arial', '', '10');
$fill = true;
foreach ($Data as $Baris) {
    $i = 0;
    foreach ($Baris as $Cell) {
        $pdf->Cell($Header[$i]['length'], 7, $Cell, 2, '0', $Kolom['align'], $fill);
        $i++;
    }
    $fill = !$fill;
    $pdf->Ln();
}
$pdf->Output('D', $Judul . '.pdf');
