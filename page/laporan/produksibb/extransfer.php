<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Transfer Bulan ' . $bulan . ' Tahun ' . $tahun);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 7, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 7, 'LAPORAN TRANSFER', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 7, 'Bulan ' . $bulan . ' Tahun ' . $tahun, 0, 1, 'C');
    $pdf->Line(10, 35, 290, 35);
    $pdf->SetLineWidth(1);
    $pdf->Line(10, 34, 290, 34);
    $pdf->SetLineWidth(0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 7, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Start', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Finish', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Transfer From (ICF)', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Transfer To (Jetty)', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Haultruck', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(45, 7, 'Catatan', 1, 0, 'C');
    $pdf->Ln();



    $pdf->SetFont('Arial', '', 12);

    // Mengambil data dari database berdasarkan kode_po yang dipilih
    $no = 1;
    $sql = $koneksi->query("SELECT transfer.id_transfer, tanggal, 
        GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
        GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
        GROUP_CONCAT(nama_rcicf SEPARATOR ', ') AS nama_rcicf_gabung,
        GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_rcjty_gabung,
        GROUP_CONCAT(nama_haultruck SEPARATOR ', ') AS nama_haultruck_gabung,
        GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
        GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
        GROUP_CONCAT(id_transfer SEPARATOR ', ') AS id_transfer_gabung
        FROM transfer
        INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
        INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
        INNER JOIN haultruck ON transfer.id_haultruck = haultruck.id_haultruck
        WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'
        GROUP BY transfer.tanggal");

    while ($data = $sql->fetch_assoc()) {
        $start_gabung = explode(", ", $data['start_gabung']);
        $finish_gabung = explode(", ", $data['finish_gabung']);
        $nama_rcicf_gabung = explode(", ", $data['nama_rcicf_gabung']);
        $nama_rcjty_gabung = explode(", ", $data['nama_rcjty_gabung']);
        $nama_haultruck_gabung = explode(", ", $data['nama_haultruck_gabung']);
        $catatan_gabung = explode(", ", $data['catatan_gabung']);
        $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($start_gabung), count($finish_gabung), count($nama_rcicf_gabung), count($nama_rcjty_gabung), count($nama_haultruck_gabung), count($catatan_gabung), count($jumlah_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama
        $start_gabung = array_pad($start_gabung, $maxRows, '');
        $finish_gabung = array_pad($finish_gabung, $maxRows, '');
        $nama_rcicf_gabung = array_pad($nama_rcicf_gabung, $maxRows, '');
        $nama_rcjty_gabung = array_pad($nama_rcjty_gabung, $maxRows, '');
        $nama_haultruck_gabung = array_pad($nama_haultruck_gabung, $maxRows, '');
        $catatan_gabung = array_pad($catatan_gabung, $maxRows, '');
        $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');


        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(30, 7, $data['tanggal'], 1, 0, 'C');
            } else {
                $pdf->Cell(30, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(30, 7, $start_gabung[$i], 1, 0, 'C');
            $pdf->Cell(30, 7, $finish_gabung[$i], 1, 0, 'C');
            $pdf->Cell(42, 7, $nama_rcicf_gabung[$i], 1, 0, 'C');
            $pdf->Cell(42, 7, $nama_rcjty_gabung[$i], 1, 0, 'C');
            $pdf->Cell(30, 7, $nama_haultruck_gabung[$i], 1, 0, 'C');
            $pdf->Cell(30, 7, $jumlah_gabung[$i], 1, 0, 'C');
            $pdf->Cell(45, 7, $catatan_gabung[$i], 1, 0);

            $pdf->Ln();
        }
    }

    $pdf->Output();
}

if (isset($_POST['submits'])) {

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Transfer');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 7, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 7, 'LAPORAN TRANSFER', 0, 1, 'C');
    $pdf->Line(10, 30, 290, 30);
    $pdf->SetLineWidth(1);
    $pdf->Line(10, 29, 290, 29);
    $pdf->SetLineWidth(0);
    $pdf->Ln(12);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 7, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Start', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Finish', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Transfer From (ICF)', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Transfer To (Jetty)', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Haultruck', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(45, 7, 'Catatan', 1, 0, 'C');
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);

    // Mengambil data dari database berdasarkan kode_po yang dipilih
    $no = 1;
    $sql = $koneksi->query("SELECT transfer.id_transfer, tanggal, 
          GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
          GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
          GROUP_CONCAT(nama_rcicf SEPARATOR ', ') AS nama_rcicf_gabung,
          GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_rcjty_gabung,
          GROUP_CONCAT(nama_haultruck SEPARATOR ', ') AS nama_haultruck_gabung,
          GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
          GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
          GROUP_CONCAT(id_transfer SEPARATOR ', ') AS id_transfer_gabung
          FROM transfer
          INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
          INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
          INNER JOIN haultruck ON transfer.id_haultruck = haultruck.id_haultruck
          GROUP BY transfer.tanggal");

    while ($data = $sql->fetch_assoc()) {
        $start_gabung = explode(", ", $data['start_gabung']);
        $finish_gabung = explode(", ", $data['finish_gabung']);
        $nama_rcicf_gabung = explode(", ", $data['nama_rcicf_gabung']);
        $nama_rcjty_gabung = explode(", ", $data['nama_rcjty_gabung']);
        $nama_haultruck_gabung = explode(", ", $data['nama_haultruck_gabung']);
        $catatan_gabung = explode(", ", $data['catatan_gabung']);
        $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($start_gabung), count($finish_gabung), count($nama_rcicf_gabung), count($nama_rcicf_gabung), count($nama_rcjty_gabung), count($nama_haultruck_gabung), count($catatan_gabung), count($jumlah_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama
        $start_gabung = array_pad($start_gabung, $maxRows, '');
        $finish_gabung = array_pad($finish_gabung, $maxRows, '');
        $nama_rcicf_gabung = array_pad($nama_rcicf_gabung, $maxRows, '');
        $nama_rcjty_gabung = array_pad($nama_rcjty_gabung, $maxRows, '');
        $nama_haultruck_gabung = array_pad($nama_haultruck_gabung, $maxRows, '');
        $catatan_gabung = array_pad($catatan_gabung, $maxRows, '');
        $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');


        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(30, 7, $data['tanggal'], 1, 0, 'C');
            } else {
                $pdf->Cell(30, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(30, 7, $start_gabung[$i], 1, 0, 'C');
            $pdf->Cell(30, 7, $finish_gabung[$i], 1, 0, 'C');
            $pdf->Cell(42, 7, $nama_rcicf_gabung[$i], 1, 0, 'C');
            $pdf->Cell(42, 7, $nama_rcjty_gabung[$i], 1, 0, 'C');
            $pdf->Cell(30, 7, $nama_haultruck_gabung[$i], 1, 0, 'C');
            $pdf->Cell(30, 7, $jumlah_gabung[$i], 1, 0, 'C');
            $pdf->Cell(45, 7, $catatan_gabung[$i], 1, 0, 'C');

            $pdf->Ln();
        }
    }

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
                <h6 class="m-0 font-weight-bold text-primary">PRINT TRANSFER COAL ICF TO JETTY BERDASARKAN BULAN DAN TAHUN<a href="../../../index/index_admin.php?page=laporan_transfer" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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