<?php
$id = $_GET['id_pegawai'];
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
include "../../fpdf/fpdf.php";
include "../../koneksi.php";


//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(10);
$pdf->SetFillColor(0, 0, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(282, 7, 'LAPORAN RIWAYAT PENERIMA BARANG', 1, 1, 'C', true);
$pdf->Ln(2);
$pdf->SetTextColor(0, 0, 0);

$imagePath = '../../img/BYAN.JK.png'; // Ganti dengan path gambar Anda
$x = 10; // Koordinat X untuk posisi gambar
$y = 3; // Koordinat Y untuk posisi gambar
$width = 20; // Lebar gambar
$height = 25; // Tinggi gambar akan disesuaikan secara proporsional
$pdf->Image($imagePath, $x, $y, $width, $height);

$pdf->Ln(2);

$sql2 = $koneksi->query("select * from pegawai where id_pegawai = '$id'");
$tampil = $sql2->fetch_assoc();
$nama = $tampil['nama'];
$bagian = $tampil['bagian'];

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(35, 6, 'Nama : '. $nama, 0, 1);
$pdf->Cell(100, 6, 'Bagian : '. $bagian, 0, 1);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(35, 6, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(80, 6, 'KODE BARANG', 1, 0, 'C');
$pdf->Cell(140, 6, 'NAMA BARANG', 1, 0, 'C');
$pdf->Cell(25, 6, 'JUMLAH', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
//koneksi ke database
$tampil = mysqli_query($koneksi, "select * from barang_keluar where id_pegawai='$id'");
while ($hasil = mysqli_fetch_assoc($tampil)) {
       $pdf->Cell(35, 6, $hasil['tanggal'], 1, 0, 'C');
    $pdf->Cell(80, 6, $hasil['kode_barang'], 1, 0);
    $pdf->Cell(140, 6, $hasil['nama_barang'], 1, 0);
    $pdf->Cell(25, 6, $hasil['jumlah'], 1, 1, 'C');
}

$pdf->Ln(10);
$pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Supervisor', 0, 1, 'R');

$pdf->Output('Riwayat Penerima Barang.pdf', 'I', 'True');
?>