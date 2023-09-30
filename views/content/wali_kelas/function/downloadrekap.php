<?php
require '../../../../database/db.php';
require '../../../../assets/fpdf181/fpdf.php';
$tugas = $_GET['id_tugas'];
$Lapor = "SELECT siswa.nis,siswa.nama,total_nilai FROM nilai INNER JOIN siswa ON siswa.id_siswa=nilai.id_siswa WHERE id_tugas=$tugas";
$Hasil = mysqli_query($koneksi, $Lapor);
$Data = array();
while ($row = mysqli_fetch_assoc($Hasil)) {
    array_push($Data, $row);
}
$q = mysqli_query($koneksi, "SELECT judul_tugas,tgl_upload FROM tugas  WHERE id_tugas = $tugas");
while ($rw = mysqli_fetch_row($q)) {
    $Judul = 'Rekap Nilai ' . $rw[0];
    $tgl = "Tugas dibuat tanggal : " . date("d-m-Y", strtotime($row[1]));
}
$Header = array(
    array("label" => "Nomor Induk Siswa", "length" => 50, "align" => "L"),
    array("label" => "Nama Siswa", "length" => 70, "align" => "L"),
    array("label" => "Nilai", "length" => 50, "align" => "L"),
);

$pdf = new FPDF();
$pdf->AddPage('P', 'A4', 'C');
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
