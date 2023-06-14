<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

    // Membuat objek PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Stock Coal ROM Jetty', 0, 1, 'C');

    // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih
    $pdf->SetFont('Arial', '', 12);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'Nama RC', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Warna', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Stock', 1, 1, 'C');

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from scjty");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(35, 6, $hasil['nama_rcjty'], 1, 0);
        $pdf->Cell(135, 6, $hasil['warna'], 1, 0);
        $pdf->Cell(25, 6, $hasil['stok'], 1, 1);
    }
    // Mengakhiri dokumen PDF
    $pdf->Output();
