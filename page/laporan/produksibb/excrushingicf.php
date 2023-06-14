<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Membuat objek PDF
    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Berdasarkan Bulan/Tahun', 0, 1, 'C');

    // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Bulan/Tahun: ' . $bulan . '/' . $tahun, 0, 1);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Start', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Finish', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Crushing To', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Catatan', 1, 1, 'C');

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from crushingicf inner join scicf on crushingicf.id_rcicf = scicf.id_rcicf where MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(35, 6, $hasil['tanggal'], 1, 0);
        $pdf->Cell(35, 6, $hasil['start'], 1, 0);
        $pdf->Cell(35, 6, $hasil['finish'], 1, 0);
        $pdf->Cell(35, 6, $hasil['nama_rcicf'], 1, 0);
        $pdf->Cell(35, 6, $hasil['jumlah'], 1, 0);
        $pdf->Cell(35, 6, $hasil['catatan'], 1, 1);
    }
    // Mengakhiri dokumen PDF
    $pdf->Output();
}

if (isset($_POST['submits'])) {
    // Mengambil nilai dari form

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Membuat objek PDF
    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Berdasarkan Bulan/Tahun', 0, 1, 'C');

    // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Bulan/Tahun: ' . $bulan . '/' . $tahun, 0, 1);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Start', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Finish', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Crushing To', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Catatan', 1, 1, 'C');

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from crushingicf inner join scicf on crushingicf.id_rcicf = scicf.id_rcicf");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(35, 6, $hasil['tanggal'], 1, 0);
        $pdf->Cell(35, 6, $hasil['start'], 1, 0);
        $pdf->Cell(35, 6, $hasil['finish'], 1, 0);
        $pdf->Cell(35, 6, $hasil['nama_rcicf'], 1, 0);
        $pdf->Cell(35, 6, $hasil['jumlah'], 1, 0);
        $pdf->Cell(35, 6, $hasil['catatan'], 1, 1);
    }
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
                <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN CRUSHING ICF BERDASARKAN BULAN DAN TAHUN<a href="../../../index/index_admin.php?page=laporan_crushingicf" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6></h6>
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
                        Atau klik tombol berikut  <input type="submit" name="submits" value="Semua Data" class="btn btn-info"> untuk menampilkan/print seluruh data.</a>
                    </div>
                </div>
            </div>
                <script src="../../../vendor/jquery/jquery.slim.min.js"></script>
                <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>