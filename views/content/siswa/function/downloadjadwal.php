<?php
require '../../../../database/db.php';
require '../../../../assets/fpdf181/fpdf.php';
$kode_kelas = $_GET['kode_kelas'];
$Lapor = "SELECT mata_pelajaran.kode_mapel,nama_mapel,concat(jadwal_hari,', ',jadwal_mulai,' - ',jadwal_selesai),kelas.nama_kelas,kkm AS kelas from mata_pelajaran INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE kelas.kode_kelas='$kode_kelas'";
$Hasil = mysqli_query($koneksi, $Lapor);
$Data = array();
while ($row = mysqli_fetch_assoc($Hasil)) {
    array_push($Data, $row);
}
$q = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kode_kelas = '$kode_kelas'");
while ($rw = mysqli_fetch_row($q)) {
    $Judul = 'Jadwal Mata Pelajaran Kelas ' . $rw[1];
    $tgl =   date("d-m-Y");
}
$Header = array(
    array("label" => "Kode", "length" => 15, "align" => "L"),
    array("label" => "Mata Pelajaran", "length" => 70, "align" => "L"),
    array("label" => "Jadwal", "length" => 60, "align" => "L"),
    array("label" => "Kelas", "length" => 20, "align" => "L"),
    array("label" => "KKM", "length" => 15, "align" => "L")
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
