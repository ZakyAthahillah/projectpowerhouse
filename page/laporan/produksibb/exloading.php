<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form

    $kode_sbp = $_POST['kode_sbp'];

    // Membuat objek PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'LAPORAN LOADING', 0, 1, 'C');

    // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Kode SBP: '.$kode_sbp , 0, 1, 'C');

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'Kode SBP', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Start', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Finish', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Loading From', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Warna', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Loading To', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Beltscale', 1, 1, 'C');

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from loading
    inner join barge on loading.id_barge = barge.id_barge
    inner join scjty on loading.id_rcjty = scjty.id_rcjty where kode_sbp='$kode_sbp' ");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(35, 6, $hasil['kode_sbp'], 1, 0);
        $pdf->Cell(35, 6, $hasil['tanggal'], 1, 0);
        $pdf->Cell(35, 6, $hasil['start'], 1, 0);
        $pdf->Cell(35, 6, $hasil['finish'], 1, 0);
        $pdf->Cell(35, 6, $hasil['nama_rcjty'], 1, 0);
        $pdf->Cell(35, 6, $hasil['warna'], 1, 0);
        $pdf->Cell(35, 6, $hasil['nama_barge'], 1, 0);
        $pdf->Cell(35, 6, $hasil['beltscale'], 1, 1);
    }
    // Mengakhiri dokumen PDF
    $pdf->Output();
}

if (isset($_POST['submits'])) {
    // Mengambil nilai dari form

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Membuat objek PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'LAPORAN LOADING', 0, 1, 'C');

    // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih


    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'Kode SBP', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Start', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Finish', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Loading From', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Warna', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Loading To', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Beltscale', 1, 1, 'C');

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from loading
    inner join barge on loading.id_barge = barge.id_barge
    inner join scjty on loading.id_rcjty = scjty.id_rcjty");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(35, 6, $hasil['kode_sbp'], 1, 0);
        $pdf->Cell(35, 6, $hasil['tanggal'], 1, 0);
        $pdf->Cell(35, 6, $hasil['start'], 1, 0);
        $pdf->Cell(35, 6, $hasil['finish'], 1, 0);
        $pdf->Cell(35, 6, $hasil['nama_rcjty'], 1, 0);
        $pdf->Cell(35, 6, $hasil['warna'], 1, 0);
        $pdf->Cell(35, 6, $hasil['nama_barge'], 1, 0);
        $pdf->Cell(35, 6, $hasil['beltscale'], 1, 1);
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
                <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN LOADING BERDASARKAN BULAN DAN TAHUN<a href="../../../index/index_admin.php?page=laporan_loading" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
                </h6>
            </div>
        </div>
        <form method="POST" action="">
            <label>Kode SBP</label>
            <div class="form-group">
                <div class="form-line">
                   <input type="text" class="form-control" name="kode_sbp">
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