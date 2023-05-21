<?php
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
include "../../fpdf/fpdf.php";
include "../../koneksibarang.php";


//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('l', 'mm', 'A5');
// membuat halaman baru
$pdf->AddPage();
// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->SetFont('Arial', 'B', 16);
// judul
$pdf->Cell(190, 7, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, 'LAPORAN DATA SUPPLIER', 0, 1, 'C');
$pdf->Line(10,31,200,31);
$pdf->SetLineWidth(1);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(0);

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 6, 'Kode Supplier', 1, 0);
$pdf->Cell(80, 6, 'Nama Supplier', 1, 0);
$pdf->Cell(50, 6, 'Alamat', 1, 0);
$pdf->Cell(30, 6, 'Telepon', 1, 1);


$pdf->SetFont('Arial', '', 10);
//koneksi ke database
$sql = $koneksi->query("select * from tb_supplier");
while ($data = $sql->fetch_assoc()) {
    $pdf->Cell(35, 6, $data['kode_supplier'], 1, 0);
    $pdf->Cell(80, 6, $data['nama_supplier'], 1, 0);
    $pdf->Cell(50, 6, $data['alamat'], 1, 0);
    $pdf->Cell(30, 6, $data['telepon'], 1, 1);
}

$pdf->Output();
