<?php
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
include "../../fpdf/fpdf.php";
include "../../koneksi.php";


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
$pdf->Cell(190, 7, 'LAPORAN DATA PEGAWAI', 0, 1, 'C');
$pdf->Line(10,31,200,31);
$pdf->SetLineWidth(1);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(0);

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell(10, 7, '', 0, 1);


// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 6, 'NIK', 1, 0);
$pdf->Cell(35, 6, 'Nama', 1, 0);
$pdf->Cell(46, 6, 'Bagian', 1, 0);
$pdf->Cell(25, 6, 'Telepon', 1, 0);
$pdf->Cell(50, 6, 'Alamat', 1, 1);


$pdf->SetFont('Arial', '', 10);
//koneksi ke database
$tampil = mysqli_query($koneksi, "select * from pegawai");
while ($hasil = mysqli_fetch_assoc($tampil)) {
    $pdf->Cell(35, 6, $hasil['nik'], 1, 0);
    $pdf->Cell(35, 6, $hasil['nama'], 1, 0);
    $pdf->Cell(46, 6, $hasil['bagian'], 1, 0);
    $pdf->Cell(25, 6, $hasil['telepon'], 1, 0);
    $pdf->Cell(50, 6, $hasil['alamat'], 1, 1);
}

$pdf->Output('Riwayat Penerima Barang.pdf', 'I', 'True');
