<?php
include '../../koneksibarang.php';

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

    // Mengambil data dari database
    $cek = "SELECT * FROM barang_keluar";
    $result = mysqli_query($koneksi, $cek);

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    while ($pr = mysqli_fetch_assoc($result)) {
        $pdf->Cell(30, 10, $pr['id_transaksi'], 1, 0, 'C');
        $pdf->Cell(60, 10, $pr['nama_barang'], 1, 0);
        $pdf->Cell(50, 10, $pr['tanggal'], 1, 1);
    }

    // Mengakhiri dokumen PDF
    $pdf->Output();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Berdasarkan Tanggal/Bulan/Tahun</title>
</head>

<body>
    <div class="container">
        <h1>Laporan Berdasarkan Tanggal/Bulan/Tahun</h1>
        <form method="POST" action="">
            <label>Tanggal:</label>
            <select name="tanggal">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select>
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