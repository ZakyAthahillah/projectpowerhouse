<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('REKAPITULASI DOKUMEN TIKET MUATAN BATUBARA BULAN '.$bulan. ' Tahun '.$tahun);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'REKAPITULASI DOKUMEN TIKET MUATAN BATUBARA', 1, 1, 'C', true);
    $pdf->Ln(2);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Bulan / Tahun : ' . 'Bulan ' . $bulan . ' Tahun ' . $tahun, 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(20, 10, 'Tanggal', 1, 0, 'C'); // Sel Company
    $pdf->Cell(20, 10, 'Nomor', 1, 0, 'C'); // Sel Company
    $pdf->Cell(12, 10, 'Shift', 1, 0, 'C'); // Sel Company
    $pdf->Cell(15, 10, 'Company', 1, 0, 'C'); // Sel Company
    $pdf->Cell(20, 10, 'Truck No.', 1, 0, 'C'); // Sel Haul Truck
    $pdf->Cell(25, 10, 'Time Departed', 1, 0, 'C'); // Sel Time Departed
    $pdf->Cell(20, 10, 'Loading Tool', 1, 0, 'C'); // Sel Loading Tool
    $pdf->Cell(20, 10, 'Seam', 1, 0, 'C'); // Sel Seam
    $pdf->Cell(40, 5, 'Time Arrived', 1, 0, 'C'); // Kolom Time Arrived
    $pdf->Cell(40, 5, 'Location', 1, 0, 'C'); // Kolom Location
    $pdf->Cell(50, 5, 'Tonnes', 1, 0, 'C'); // Kolom Tonnes
    $pdf->Cell(0, 5, '', 0, 1, 'C'); // Kolom Tonnes

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(152, 5, '', 0, 0, 'C'); // Kolom 
    $pdf->Cell(20, 5, 'WB', 1, 0, 'C'); // Kolom WB
    $pdf->Cell(20, 5, 'Hopper', 1, 0, 'C'); // Kolom Hopper
    $pdf->Cell(20, 5, 'Loading', 1, 0, 'C'); // Kolom Loading
    $pdf->Cell(20, 5, 'Dumping', 1, 0, 'C'); // Kolom Dumping
    $pdf->Cell(25, 5, '1', 1, 0, 'C'); // Kolom 1
    $pdf->Cell(25, 5, '2', 1, 1, 'C'); // Kolom 2


    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 8);
    $tampil = mysqli_query($koneksi, "SELECT * FROM dokmuatan INNER JOIN dumptruck ON dokmuatan.id_dumptruck = dumptruck.id_dumptruck where MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(20, 7, $hasil['tanggal'], 1, 0, 'C'); // Sel Company (isi data)
        $pdf->Cell(20, 7, $hasil['nomor'], 1, 0, 'C'); // Sel Company (isi data)
        $pdf->Cell(12, 7, $hasil['shift'], 1, 0, 'C'); // Sel Company (isi data)
        $pdf->Cell(15, 7, $hasil['company'], 1, 0, 'C'); // Sel Company (isi data)
        $pdf->Cell(20, 7, $hasil['nama_dumptruck'], 1, 0, 'C'); // Sel (isi data)
        $pdf->Cell(25, 7, $hasil['tdepart'], 1, 0, 'C'); // Sel Time Departed (isi data)
        $pdf->Cell(20, 7, $hasil['ltool'], 1, 0, 'C'); // Sel Loading Tool (isi data)
        $pdf->Cell(20, 7, $hasil['seam'], 1, 0, 'C'); // Sel Seam (isi data)
        $pdf->Cell(20, 7, $hasil['wb'], 1, 0, 'C'); // Sel WB (isi data)
        $pdf->Cell(20, 7, $hasil['hopper'], 1, 0, 'C'); // Sel Hopper (isi data)
        $pdf->Cell(20, 7, $hasil['loading'], 1, 0, 'C'); // Sel Loading (isi data)
        $pdf->Cell(20, 7, $hasil['dumping'], 1, 0, 'C'); // Sel Dumping (isi data)
        $pdf->Cell(25, 7, $hasil['tonnes1'], 1, 0, 'C'); // Sel 1 (isi data)
        $pdf->Cell(25, 7, $hasil['tonnes2'], 1, 1, 'C'); // Sel 2 (isi data)
    }

    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Section Head', 0, 1, 'R');

    // Mengakhiri dokumen PDF
    $pdf->Output();
}

if (isset($_POST['submits'])) {
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('REKAPITULASI DOKUMEN TIKET MUATAN BATUBARA');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'REKAPITULASI DOKUMEN TIKET MUATAN BATUBARA', 1, 1, 'C', true);
    $pdf->Ln(5);

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(20, 10, 'Tanggal', 1, 0, 'C'); // Sel Company
    $pdf->Cell(20, 10, 'Nomor', 1, 0, 'C'); // Sel Company
    $pdf->Cell(12, 10, 'Shift', 1, 0, 'C'); // Sel Company
    $pdf->Cell(15, 10, 'Company', 1, 0, 'C'); // Sel Company
    $pdf->Cell(20, 10, 'Truck No.', 1, 0, 'C'); // Sel Haul Truck
    $pdf->Cell(25, 10, 'Time Departed', 1, 0, 'C'); // Sel Time Departed
    $pdf->Cell(20, 10, 'Loading Tool', 1, 0, 'C'); // Sel Loading Tool
    $pdf->Cell(20, 10, 'Seam', 1, 0, 'C'); // Sel Seam
    $pdf->Cell(40, 5, 'Time Arrived', 1, 0, 'C'); // Kolom Time Arrived
    $pdf->Cell(40, 5, 'Location', 1, 0, 'C'); // Kolom Location
    $pdf->Cell(50, 5, 'Tonnes', 1, 0, 'C'); // Kolom Tonnes
    $pdf->Cell(0, 5, '', 0, 1, 'C'); // Kolom Tonnes

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(152, 5, '', 0, 0, 'C'); // Kolom 
    $pdf->Cell(20, 5, 'WB', 1, 0, 'C'); // Kolom WB
    $pdf->Cell(20, 5, 'Hopper', 1, 0, 'C'); // Kolom Hopper
    $pdf->Cell(20, 5, 'Loading', 1, 0, 'C'); // Kolom Loading
    $pdf->Cell(20, 5, 'Dumping', 1, 0, 'C'); // Kolom Dumping
    $pdf->Cell(25, 5, '1', 1, 0, 'C'); // Kolom 1
    $pdf->Cell(25, 5, '2', 1, 1, 'C'); // Kolom 2


    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 8);
    $tampil = mysqli_query($koneksi, "SELECT * FROM dokmuatan INNER JOIN dumptruck ON dokmuatan.id_dumptruck = dumptruck.id_dumptruck");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(20, 7, $hasil['tanggal'], 1, 0, 'C'); // Sel Company (isi data)
        $pdf->Cell(20, 7, $hasil['nomor'], 1, 0, 'C'); // Sel Company (isi data)
        $pdf->Cell(12, 7, $hasil['shift'], 1, 0, 'C'); // Sel Company (isi data)
        $pdf->Cell(15, 7, $hasil['company'], 1, 0, 'C'); // Sel Company (isi data)
        $pdf->Cell(20, 7, $hasil['nama_dumptruck'], 1, 0, 'C'); // Sel (isi data)
        $pdf->Cell(25, 7, $hasil['tdepart'], 1, 0, 'C'); // Sel Time Departed (isi data)
        $pdf->Cell(20, 7, $hasil['ltool'], 1, 0, 'C'); // Sel Loading Tool (isi data)
        $pdf->Cell(20, 7, $hasil['seam'], 1, 0, 'C'); // Sel Seam (isi data)
        $pdf->Cell(20, 7, $hasil['wb'], 1, 0, 'C'); // Sel WB (isi data)
        $pdf->Cell(20, 7, $hasil['hopper'], 1, 0, 'C'); // Sel Hopper (isi data)
        $pdf->Cell(20, 7, $hasil['loading'], 1, 0, 'C'); // Sel Loading (isi data)
        $pdf->Cell(20, 7, $hasil['dumping'], 1, 0, 'C'); // Sel Dumping (isi data)
        $pdf->Cell(25, 7, $hasil['tonnes1'], 1, 0, 'C'); // Sel 1 (isi data)
        $pdf->Cell(25, 7, $hasil['tonnes2'], 1, 1, 'C'); // Sel 2 (isi data)
    }

    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
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