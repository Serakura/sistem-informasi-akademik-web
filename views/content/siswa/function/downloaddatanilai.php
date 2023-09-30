<?php
require '../../../../database/db.php';
require '../../../../assets/fpdf181/fpdf.php';
$nis = $_GET['nis'];
$kode_kelas = $_GET['kode_kelas'];
$Lapor = "SELECT mata_pelajaran.nama_mapel,semester,nilai_tugas,nilai_uts,nilai_uas,total_nilai from nilai INNER JOIN siswa ON siswa.id_siswa = nilai.id_siswa INNER JOIN mata_pelajaran ON mata_pelajaran.id_mapel = nilai.id_mapel
INNER JOIN kelas ON kelas.kode_kelas = mata_pelajaran.kode_kelas WHERE kelas.kode_kelas= '$kode_kelas' AND siswa.nis=$nis ORDER BY semester ASC";
$Hasil = mysqli_query($koneksi, $Lapor);
$Data = array();
while ($row = mysqli_fetch_assoc($Hasil)) {
    array_push($Data, $row);
}
$q = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kode_kelas = '$kode_kelas'");
while ($rw = mysqli_fetch_row($q)) {
    $Judul = 'Nilai - Kelas ' . $rw[1];
    $tgl =  'Diunduh tanggal: ' . date("d-m-Y");
    $q = mysqli_query($koneksi, "SELECT nama FROM siswa WHERE nis = '$nis'");
    while ($rw = mysqli_fetch_row($q)) {
        $sub = $rw[0];
    }
}
$Header = array(
    array("label" => "Mata Pelajaran", "length" => 50, "align" => "L"),
    array("label" => "Semester", "length" => 30, "align" => "L"),
    array("label" => "Nilai Tugas", "length" => 25, "align" => "L"),
    array("label" => "Nilai UTS", "length" => 25, "align" => "L"),
    array("label" => "Nilai UAS", "length" => 25, "align" => "L"),
    array("label" => "Nilai Total", "length" => 25, "align" => "L")
);

$pdf = new FPDF();
$pdf->AddPage('p', 'A4', 'C');
$pdf->SetFont('arial', 'B', '15');
$pdf->Cell(0, 15, $Judul, '0', 1, 'C');
$pdf->SetFont('arial', 'i', '12');
$pdf->Cell(0, 15, $sub, '0', 1, 'C');
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
