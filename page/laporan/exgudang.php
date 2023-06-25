<?php
include '../../koneksi.php';
require '../../fpdf/fpdf.php';

// Membuat objek PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetTitle('Laporan Monitoring Barang');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(10);
$pdf->SetFillColor(0, 0, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(282, 7, 'LAPORAN MONITORING BARANG', 1, 1, 'C', true);
$pdf->Ln(2);
$pdf->SetTextColor(0, 0, 0);

$imagePath = '../../img/BYAN.JK.png'; // Ganti dengan path gambar Anda
$x = 10; // Koordinat X untuk posisi gambar
$y = 3; // Koordinat Y untuk posisi gambar
$width = 20; // Lebar gambar
$height = 25; // Tinggi gambar akan disesuaikan secara proporsional
$pdf->Image($imagePath, $x, $y, $width, $height);

$pdf->Ln(2);

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
