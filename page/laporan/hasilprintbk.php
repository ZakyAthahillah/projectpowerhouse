<?php
include '../../koneksi.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form
    $tanggal = $_POST['tanggal'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Membuat objek PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Berdasarkan Tanggal/Bulan/Tahun', 0, 1, 'C');

    // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Tanggal/Bulan/Tahun: ' . $tanggal . '/' . $bulan . '/' . $tahun, 0, 1);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nama', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Alamat', 1, 1, 'C');

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from barang_masuk where MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(35, 6, $hasil['tanggal'], 1, 0);
        $pdf->Cell(135, 6, $hasil['nama_barang'], 1, 0);
        $pdf->Cell(25, 6, $hasil['jumlah'], 1, 1);
    }
    // Mengakhiri dokumen PDF
    $pdf->Output();
}
?>