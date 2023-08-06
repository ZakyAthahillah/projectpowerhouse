<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Blending Bulan ' . $bulan . ' Tahun ' . $tahun);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'LAPORAN BLENDING', 1, 1, 'C', true);
    $pdf->Ln(2);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Bulan / Tahun : ' . 'Bulan ' . $bulan . ' Tahun ' . $tahun, 0, 1, 'L');

    $imagePath = '../../../img/BYAN.JK.png'; // Ganti dengan path gambar Anda
    $x = 10; // Koordinat X untuk posisi gambar
    $y = 3; // Koordinat Y untuk posisi gambar
    $width = 20; // Lebar gambar
    $height = 25; // Tinggi gambar akan disesuaikan secara proporsional
    $pdf->Image($imagePath, $x, $y, $width, $height);

    $pdf->Ln(2);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Kode SBP', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Plan', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Blue Crush', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Yellow Crush', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Green Crush', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Catatan', 1, 1, 'C');


    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from blending inner join sbp on blending.kode_sbp = sbp.kode_sbp where MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(40, 6, $hasil['kode_sbp'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['plan'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['bcrush'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['ycrush'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['gcrush'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['catatan'], 1, 1, 'C');
    }

    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Section Head', 0, 1, 'R');

    // Mengakhiri dokumen PDF
    $pdf->Output();
}

if (isset($_POST['submits'])) {
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Blending');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'LAPORAN BLENDING', 1, 1, 'C', true);
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
    $pdf->Cell(40, 10, 'Kode SBP', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Plan', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Blue Crush', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Yellow Crush', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Green Crush', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Catatan', 1, 1, 'C');


    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from blending inner join sbp on blending.kode_sbp = sbp.kode_sbp");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(40, 6, $hasil['kode_sbp'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['plan'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['bcrush'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['ycrush'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['gcrush'], 1, 0, 'C');
        $pdf->Cell(40, 6, $hasil['catatan'], 1, 1, 'C');
    }

    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Section Head', 0, 1, 'R');

    // Mengakhiri dokumen PDF
    $pdf->Output();
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan</title>
</head>
<link rel="stylesheet" href="../../../css/bootstrap.min.css">

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand font-weight-bold" href="#">
            <img src="../../../img/bayan.png" width="30" height="30" class="d-inline-block align-top" alt="">
            PT. WBM MEMBER OF BAYAN GROUP
        </a>
    </nav>
    <div class="container">
        <div class="form-group">
            <div class="form-line">
                <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN BLENDING BERDASARKAN BULAN DAN TAHUN</h6>
                </h6>
            </div>
        </div>
        <form method="POST" action="">
            <label>Bulan:</label>
            <div class="form-group">
                <div class="form-line">
                    <select name="bulan" class="form-control">
                        <?php
                        $bulan_array = array(
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        );
                        foreach ($bulan_array as $index => $bulan) {
                            echo '<option value="' . ($index + 1) . '">' . $bulan . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <label>Tahun:</label>
            <div class="form-group">
                <div class="form-line">
                    <select name="tahun" class="form-control">
                        <?php
                        for ($i = 2021; $i <= 2023; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <input type="submit" name="submit" value="Tampilkan Laporan" class="btn btn-primary">
            <br>
            <br>
            <div class="form-group">
                <div class="form-line">
                    <div class="alert alert-dark" role="alert">
                        Atau klik tombol berikut <input type="submit" name="submits" value="Semua Data" class="btn btn-info"> untuk menampilkan/print seluruh data.</a>
                    </div>
                </div>
            </div>
            <script src="../../../vendor/jquery/jquery.slim.min.js"></script>
            <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>