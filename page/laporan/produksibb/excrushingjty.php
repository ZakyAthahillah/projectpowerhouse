<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

if (isset($_POST['submit'])) {

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Crushing Jetty Bulan ' . $bulan . ' Tahun ' . $tahun);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 7, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 7, 'LAPORAN CRUSHING JETTY', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 7, 'Bulan ' . $bulan . ' Tahun ' . $tahun, 0, 1, 'C');
    $pdf->Line(10, 35, 290, 35);
    $pdf->SetLineWidth(1);
    $pdf->Line(10, 34, 290, 34);
    $pdf->SetLineWidth(0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 7, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Start', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Finish', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Crushing To', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Warna', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(55, 7, 'Catatan', 1, 0, 'C');
    $pdf->Ln();



    $pdf->SetFont('Arial', '', 12);

    // Mengambil data dari database berdasarkan kode_po yang dipilih
    $no = 1;
    $sql = $koneksi->query("SELECT tanggal, GROUP_CONCAT(`start` SEPARATOR ', ') AS `start_gabung`, 
    GROUP_CONCAT(`finish` SEPARATOR ', ') AS `finish_gabung`, 
    GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_rcjty_gabung, 
    GROUP_CONCAT(warna SEPARATOR ', ') AS warna_gabung, 
    GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung, 
    GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
    GROUP_CONCAT(id_crushing SEPARATOR ', ') AS id_crushing_gabung
    FROM crushingjty
    INNER JOIN scjty ON crushingjty.id_rcjty = scjty.id_rcjty
    WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' 
    GROUP BY tanggal");

    while ($data = $sql->fetch_assoc()) {
        $start_gabung = explode(", ", $data['start_gabung']);
        $finish_gabung = explode(", ", $data['finish_gabung']);
        $nama_rcjty_gabung = explode(", ", $data['nama_rcjty_gabung']);
        $warna_gabung = explode(", ", $data['warna_gabung']);
        $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
        $catatan_gabung = explode(", ", $data['catatan_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($start_gabung), count($finish_gabung), count($nama_rcjty_gabung), count($warna_gabung), count($jumlah_gabung), count($catatan_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama
        $start_gabung = array_pad($start_gabung, $maxRows, '');
        $finish_gabung = array_pad($finish_gabung, $maxRows, '');
        $nama_rcjty_gabung = array_pad($nama_rcjty_gabung, $maxRows, '');
        $warna_gabung = array_pad($warna_gabung, $maxRows, '');
        $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');
        $catatan_gabung = array_pad($catatan_gabung, $maxRows, '');


        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(35, 7, $data['tanggal'], 1, 0, 'C');
            } else {
                $pdf->Cell(35, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(35, 7, $start_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $finish_gabung[$i], 1, 0, 'C');
            $pdf->Cell(42, 7, $nama_rcjty_gabung[$i], 1, 0, 'C');
            $pdf->Cell(42, 7, $warna_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $jumlah_gabung[$i], 1, 0, 'C');
            $pdf->Cell(55, 7, $catatan_gabung[$i], 1, 0);

            $pdf->Ln();
        }
    }
    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Supervisor', 0, 1, 'R');

    $pdf->Output();
}

if (isset($_POST['submits'])) {
    // Mengambil nilai dari form

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Crushing Jetty');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 7, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 7, 'LAPORAN CRUSHING JETTY', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Line(10, 30, 290, 30);
    $pdf->SetLineWidth(1);
    $pdf->Line(10, 29, 290, 29);
    $pdf->SetLineWidth(0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 7, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Start', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Finish', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Crushing To', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Warna', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(55, 7, 'Catatan', 1, 0, 'C');
    $pdf->Ln();



    $pdf->SetFont('Arial', '', 12);

    // Mengambil data dari database berdasarkan kode_po yang dipilih
    $no = 1;
    $sql = $koneksi->query("SELECT tanggal, GROUP_CONCAT(`start` SEPARATOR ', ') AS `start_gabung`, 
    GROUP_CONCAT(`finish` SEPARATOR ', ') AS `finish_gabung`, 
    GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_rcjty_gabung, 
    GROUP_CONCAT(warna SEPARATOR ', ') AS warna_gabung, 
    GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung, 
    GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
    GROUP_CONCAT(id_crushing SEPARATOR ', ') AS id_crushing_gabung
    FROM crushingjty
    INNER JOIN scjty ON crushingjty.id_rcjty = scjty.id_rcjty 
    GROUP BY tanggal");

    while ($data = $sql->fetch_assoc()) {
        $start_gabung = explode(", ", $data['start_gabung']);
        $finish_gabung = explode(", ", $data['finish_gabung']);
        $nama_rcjty_gabung = explode(", ", $data['nama_rcjty_gabung']);
        $warna_gabung = explode(", ", $data['warna_gabung']);
        $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
        $catatan_gabung = explode(", ", $data['catatan_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($start_gabung), count($finish_gabung), count($nama_rcjty_gabung), count($warna_gabung), count($jumlah_gabung), count($catatan_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama
        $start_gabung = array_pad($start_gabung, $maxRows, '');
        $finish_gabung = array_pad($finish_gabung, $maxRows, '');
        $nama_rcjty_gabung = array_pad($nama_rcjty_gabung, $maxRows, '');
        $warna_gabung = array_pad($warna_gabung, $maxRows, '');
        $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');
        $catatan_gabung = array_pad($catatan_gabung, $maxRows, '');


        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(35, 7, $data['tanggal'], 1, 0, 'C');
            } else {
                $pdf->Cell(35, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(35, 7, $start_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $finish_gabung[$i], 1, 0, 'C');
            $pdf->Cell(42, 7, $nama_rcjty_gabung[$i], 1, 0, 'C');
            $pdf->Cell(42, 7, $warna_gabung[$i], 1, 0, 'C');
            $pdf->Cell(35, 7, $jumlah_gabung[$i], 1, 0, 'C');
            $pdf->Cell(55, 7, $catatan_gabung[$i], 1, 0);

            $pdf->Ln();
        }
    }
    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Supervisor', 0, 1, 'R');

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
                <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN CRUSHING JETTY BERDASARKAN BULAN DAN TAHUN<a href="../../../index/index_admin.php?page=laporan_crushingjty" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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