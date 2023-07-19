<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Membuat objek PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetTitle('Laporan Stock Coal ICF');
$pdf->AddPage();

// Menambahkan judul laporan
// Menambahkan judul laporan
$pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'LAPORAN STOCK COAL ICF', 1, 1, 'C', true);
    $pdf->Ln(2);
    $pdf->SetTextColor(0, 0, 0);

    $imagePath = '../../../img/BYAN.JK.png'; // Ganti dengan path gambar Anda
    $x = 10; // Koordinat X untuk posisi gambar
    $y = 3; // Koordinat Y untuk posisi gambar
    $width = 20; // Lebar gambar
    $height = 25; // Tinggi gambar akan disesuaikan secara proporsional
    $pdf->Image($imagePath, $x, $y, $width, $height);

    $pdf->Ln(2);

// Menambahkan header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(35, 6, 'Nama RC', 1, 0, 'C');
$pdf->Cell(35, 6, 'Warna', 1, 0, 'C');
$pdf->Cell(70, 6, 'Keluar', 1, 0, 'C');
$pdf->Cell(70, 6, 'Masuk', 1, 0, 'C');
$pdf->Cell(70, 6, 'Stock', 1, 1, 'C');

// Menampilkan data dalam tabel
$pdf->SetFont('Arial', '', 12);
$tampil = mysqli_query($koneksi, "select * from scicf");
while ($hasil = mysqli_fetch_assoc($tampil)) {
    $id = $hasil['id_rcicf'];
    $q = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM crushingicf WHERE id_rcicf = $id");
    $tamps = mysqli_fetch_assoc($q);
    $total = $tamps['jum'];

    $q2 = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM transfer WHERE id_rcicf = $id");
    $tamps2 = mysqli_fetch_assoc($q2);
    $total2 = $tamps2['jum'];

    $hasilmasuk = $total + 0;
    $hasilkeluar = $total2 + 0;

    $pdf->Cell(35, 6, $hasil['nama_rcicf'], 1, 0);
    $pdf->Cell(35, 6, $hasil['warna'], 1, 0);
    $pdf->Cell(70, 6, $hasilkeluar, 1, 0);
    $pdf->Cell(70, 6, $hasilmasuk, 1, 0);
    $pdf->Cell(70, 6, $hasil['stok'], 1, 1);
}

// Menambahkan tanda tangan
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Section Head', 0, 1, 'R');

// Mengakhiri dokumen PDF
$pdf->Output();
