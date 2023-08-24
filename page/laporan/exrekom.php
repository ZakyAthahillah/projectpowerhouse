<?php
include '../../koneksi.php';
require '../../fpdf/fpdf.php';

// Membuat objek PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetTitle('Laporan Rekomendasi Barang');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(10);
$pdf->SetFillColor(0, 0, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(282, 7, 'LAPORAN REKOMENDASI BARANG', 1, 1, 'C', true);
$pdf->Ln(2);
$pdf->SetTextColor(0, 0, 0);

$imagePath = '../../img/BYAN.JK.png'; // Ganti dengan path gambar Anda
$x = 10; // Koordinat X untuk posisi gambar
$y = 3; // Koordinat Y untuk posisi gambar
$width = 20; // Lebar gambar
$height = 25; // Tinggi gambar akan disesuaikan secara proporsional
$pdf->Image($imagePath, $x, $y, $width, $height);

$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(27, 10, 'Kode Barang', 1, 0, 'C');
$pdf->Cell(115, 10, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(15, 10, 'Jumlah', 1, 0, 'C');
$pdf->Cell(10, 10, 'Min', 1, 0, 'C');
$pdf->Cell(10, 10, 'Max', 1, 0, 'C');
$pdf->Cell(105, 10, 'Rekomendasi', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$tampil = mysqli_query($koneksi, "SELECT * FROM gudang 
INNER JOIN lokasi ON gudang.id_lokasi = lokasi.id_lokasi
INNER JOIN satuan ON gudang.id_satuan = satuan.id_satuan
INNER JOIN jenis_barang ON gudang.id_jenis = jenis_barang.id_jenis");
while ($hasil = mysqli_fetch_assoc($tampil)) {
    if ($hasil['jumlah'] < $hasil['min'] || $hasil['jumlah'] > $hasil['max']) {
        $pdf->Cell(27, 6, $hasil['kode_barang'], 1, 0, 'C');
        $pdf->Cell(115, 6, $hasil['nama_barang'], 1, 0);
        $pdf->Cell(15, 6, $hasil['jumlah'], 1, 0, 'C');
        $pdf->Cell(10, 6, $hasil['min'], 1, 0, 'C'); 
        $pdf->Cell(10, 6, $hasil['max'], 1, 0, 'C'); 
      
        if ($hasil['jumlah'] < $hasil['min']) {
            $pdf->Cell(105, 6, 'Disarankan untuk segera melakukan pre-order barang', 1, 1);
        } else if ($hasil['jumlah'] > $hasil['max']) {
            $pdf->Cell(105, 6, 'Disarankan untuk tidak melakukan pre-order barang', 1, 1);
        } else {
            $pdf->Cell(105, 6, '', 1, 1); 
        }
    }
}

// Menambahkan tanda tangan
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Section Head', 0, 1, 'R');

// Mengakhiri dokumen PDF
$pdf->Output('Laporan Rekomendasi Barang.pdf', 'I');
?>