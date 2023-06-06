<?php
// Mengimpor library FPDF
require('../../fpdf/fpdf.php');

// Membuat koneksi ke database
include '../../koneksibarang.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form
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
    $pdf->Cell(0, 10, 'Tanggal/Bulan/Tahun: ' . $bulan . '/' . $tahun, 0, 1);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nama', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Alamat', 1, 1, 'C');

    // Mengambil data dari database
    $query = "SELECT * FROM barang_masuk WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
    $result = mysqli_query($koneksi, $query);

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    while ($row = mysqli_fetch_array($result)) {
        $pdf->Cell(30, 10, $row['id'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row['nama_barang'], 1, 0);
        $pdf->Cell(50, 10, $row['tanggal'], 1, 1);
    }

    // Mengakhiri dokumen PDF
    $pdf->Output();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Berdasarkan Bulan dan Tahun</title>
</head>

<body>
    <div class="container">
    <h1>Laporan Berdasarkan Bulan dan Tahun</h1>
    <form method="POST" action=""> 
        <label>Bulan:</label>
        <select name="bulan">
            <?php
            $bulan_array = array(
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'J
                uli', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            );
            foreach ($bulan_array as $index => $bulan) {
                echo '<option value="' . ($index + 1) . '">' . $bulan . '</option>';
            }
            ?>
        </select>
        <label>Tahun:</label>
        <select name="tahun">
            <?php
            for ($i = 2021; $i <= 2023; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Tampilkan Laporan">
    </form>
    </div>

</body>

</html>