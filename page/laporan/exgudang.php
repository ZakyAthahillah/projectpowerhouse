<?php
include '../../koneksi.php';
require '../../fpdf/fpdf.php';

// Membuat objek PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

// Menambahkan judul laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 7, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 7, 'LAPORAN MONITORING BARANG', 0, 1, 'C');
$pdf->Line(10,31,290,31);
$pdf->SetLineWidth(1);
$pdf->Line(10,30,290,30);
$pdf->SetLineWidth(0);
$pdf->Ln(15);

// Menambahkan header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Kode Barang', 1, 0, 'C');
$pdf->Cell(112, 10, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(42, 10, 'Jenis Barang', 1, 0, 'C');
$pdf->Cell(15, 10, 'Jumlah', 1, 0, 'C');
$pdf->Cell(20, 10, 'Satuan', 1, 0, 'C');
$pdf->Cell(63, 10, 'Lokasi', 1, 1, 'C');

// Menampilkan data dalam tabel
$pdf->SetFont('Arial', '', 12);
$tampil = mysqli_query($koneksi, "select * from gudang 
inner join lokasi on gudang.id_lokasi = lokasi.id_lokasi
inner join satuan on gudang.id_satuan = satuan.id_satuan
inner join jenis_barang on gudang.id_jenis = jenis_barang.id_jenis");
while ($hasil = mysqli_fetch_assoc($tampil)) {
    $pdf->Cell(30, 6, $hasil['kode_barang'], 1, 0, 'C');
    $pdf->Cell(112, 6, $hasil['nama_barang'], 1, 0);
    $pdf->Cell(42, 6, $hasil['jenis_barang'], 1, 0);
    $pdf->Cell(15, 6, $hasil['jumlah'], 1, 0, 'C');
    $pdf->Cell(20, 6, $hasil['satuan'], 1, 0, 'C');
    $pdf->Cell(63, 6, $hasil['lokasi'], 1, 1);
}

// Menambahkan tanda tangan
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Supervisor', 0, 1, 'R');

// Mengakhiri dokumen PDF
$pdf->Output('Laporan Monitoring Barang.pdf', 'I');
?>
