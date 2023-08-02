<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form

    $kode_sbp = $_POST['kode_sbp'];

    // Membuat objek PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Loading SBP  ' . $kode_sbp);
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'LAPORAN LOADING', 1, 1, 'C', true);
    $pdf->Ln(2);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Kode SBP : ' . $kode_sbp, 0, 1, 'L');

    $imagePath = '../../../img/BYAN.JK.png'; // Ganti dengan path gambar Anda
    $x = 10; // Koordinat X untuk posisi gambar
    $y = 3; // Koordinat Y untuk posisi gambar
    $width = 20; // Lebar gambar
    $height = 25; // Tinggi gambar akan disesuaikan secara proporsional
    $pdf->Image($imagePath, $x, $y, $width, $height);

    $pdf->Ln(2);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'Kode SBP', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Start', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Finish', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Loading From', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Warna', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Loading To', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Jumlah', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 12);
    $no = 1;
    $sql = $koneksi->query("SELECT loading.kode_sbp,
    GROUP_CONCAT(tanggal SEPARATOR ', ') AS tanggal_gabung,
    GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_gabung,
    GROUP_CONCAT(nama_barge SEPARATOR ', ') AS barge_gabung,
    GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
    GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
    GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
    GROUP_CONCAT(warna SEPARATOR ', ') AS warna_gabung,
    GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung
    FROM loading
    INNER JOIN barge ON loading.id_barge = barge.id_barge
    INNER JOIN scjty ON loading.id_rcjty = scjty.id_rcjty
    WHERE loading.kode_sbp = '$kode_sbp'
    GROUP BY loading.kode_sbp
    ");

    while ($data = $sql->fetch_assoc()) {
        $tanggal_gabung = explode(", ", $data['tanggal_gabung']);
        $nama_gabung = explode(", ", $data['nama_gabung']);
        $barge_gabung = explode(", ", $data['barge_gabung']);
        $start_gabung = explode(", ", $data['start_gabung']);
        $finish_gabung = explode(", ", $data['finish_gabung']);
        $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
        $warna_gabung = explode(", ", $data['warna_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($tanggal_gabung), count($nama_gabung), count($barge_gabung), count($start_gabung), count($finish_gabung), count($jumlah_gabung), count($warna_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama
        $tanggal_gabung = array_pad($tanggal_gabung, $maxRows, '');
        $nama_gabung = array_pad($nama_gabung, $maxRows, '');
        $barge_gabung = array_pad($barge_gabung, $maxRows, '');
        $start_gabung = array_pad($start_gabung, $maxRows, '');
        $finish_gabung = array_pad($finish_gabung, $maxRows, '');
        $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');
        $warna_gabung = array_pad($warna_gabung, $maxRows, '');


        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(35, 7, $data['kode_sbp'], 1, 0, 'C');
            } else {
                $pdf->Cell(35, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(35, 7, $tanggal_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $start_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $finish_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $nama_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $warna_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $barge_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $jumlah_gabung[$i], 1, 0, 'C');

            $pdf->Ln();
        }
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
    // Mengambil nilai dari form
    // Membuat objek PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Loading');
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'LAPORAN LOADING', 1, 1, 'C', true);
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
    $pdf->Cell(35, 10, 'Kode SBP', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Start', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Finish', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Loading From', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Warna', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Loading To', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Jumlah', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 12);
    $no = 1;
    $sql = $koneksi->query("SELECT loading.kode_sbp,
    GROUP_CONCAT(tanggal SEPARATOR ', ') AS tanggal_gabung,
    GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_gabung,
    GROUP_CONCAT(nama_barge SEPARATOR ', ') AS barge_gabung,
    GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
    GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
    GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
    GROUP_CONCAT(warna SEPARATOR ', ') AS warna_gabung,
    GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung
    FROM loading
    INNER JOIN barge ON loading.id_barge = barge.id_barge
    INNER JOIN scjty ON loading.id_rcjty = scjty.id_rcjty
    GROUP BY loading.kode_sbp
    ");

    while ($data = $sql->fetch_assoc()) {
        $tanggal_gabung = explode(", ", $data['tanggal_gabung']);
        $nama_gabung = explode(", ", $data['nama_gabung']);
        $barge_gabung = explode(", ", $data['barge_gabung']);
        $start_gabung = explode(", ", $data['start_gabung']);
        $finish_gabung = explode(", ", $data['finish_gabung']);
        $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
        $warna_gabung = explode(", ", $data['warna_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($tanggal_gabung), count($nama_gabung), count($barge_gabung), count($start_gabung), count($finish_gabung), count($jumlah_gabung), count($warna_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama
        $tanggal_gabung = array_pad($tanggal_gabung, $maxRows, '');
        $nama_gabung = array_pad($nama_gabung, $maxRows, '');
        $barge_gabung = array_pad($barge_gabung, $maxRows, '');
        $start_gabung = array_pad($start_gabung, $maxRows, '');
        $finish_gabung = array_pad($finish_gabung, $maxRows, '');
        $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');
        $warna_gabung = array_pad($warna_gabung, $maxRows, '');


        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(35, 7, $data['kode_sbp'], 1, 0, 'C');
            } else {
                $pdf->Cell(35, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(35, 7, $tanggal_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $start_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $finish_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $nama_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $warna_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $barge_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $jumlah_gabung[$i], 1, 0, 'C');

            $pdf->Ln();
        }
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
                <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN LOADING BERDASARKAN BULAN DAN TAHUN</h6>
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