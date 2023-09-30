<?php
require '../../../../database/db.php';
require '../../../../assets/fpdf181/fpdf.php';
$id_absensi = $_GET['id_absensi'];
$nama_mapel = $_GET['nama_mapel'];
$nama_kelas = $_GET['nama_kelas'];
$Lapor = "SELECT siswa.nama, keterangan, absensi.pertemuan FROM  detail_absensi INNER JOIN siswa ON detail_absensi.id_siswa = siswa.id_siswa
INNER JOIN absensi ON absensi.id_absensi = detail_absensi.id_absensi WHERE absensi.id_absensi='$id_absensi'";
$Hasil = mysqli_query($koneksi, $Lapor);
$Data = array();
while ($row = mysqli_fetch_assoc($Hasil)) {
    array_push($Data, $row);
}

$Judul = "Data Absensi (" . $nama_mapel . " - " . $nama_kelas . ")";
$tgl =   'Data tanggal: ' . date("d-m-Y");

$Header = array(
    array("label" => "Nama", "length" => 60, "align" => "L"),
    array("label" => "Keterangan", "length" => 25, "align" => "L"),
    array("label" => "Pertemuan", "length" => 25, "align" => "L")
);

$pdf = new FPDF();
$pdf->AddPage('p', 'A4', 'C');
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
