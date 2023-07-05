<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Data Jalan HT Transfer Coal ICF To Jetty Bulan ' . $bulan . ' Tahun ' . $tahun);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'LAPORAN DATA JALAN HAUL TRUCK TRANSFER COAL ICF TO JETTY', 1, 1, 'C', true);
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

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 7, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Haultruck', 1, 0, 'C');
    $pdf->Cell(60, 7, 'Transfer From (ICF)', 1, 0, 'C');
    $pdf->Cell(60, 7, 'Transfer To (Jetty)', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Operator', 1, 0, 'C');
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
          GROUP_CONCAT(nama_optht SEPARATOR ', ') AS nama_optht_gabung,
          GROUP_CONCAT(id_transfer SEPARATOR ', ') AS id_transfer_gabung
          FROM transfer
          INNER JOIN operatorht ON transfer.id_optht = operatorht.id_optht
          INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
          INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
          INNER JOIN haultruck ON transfer.id_haultruck = haultruck.id_haultruck
          WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'
          GROUP BY transfer.tanggal");

    while ($data = $sql->fetch_assoc()) {
        $nama_rcicf_gabung = explode(", ", $data['nama_rcicf_gabung']);
        $nama_rcjty_gabung = explode(", ", $data['nama_rcjty_gabung']);
        $nama_haultruck_gabung = explode(", ", $data['nama_haultruck_gabung']);
        $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
        $nama_optht_gabung = explode(", ", $data['nama_optht_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($nama_rcicf_gabung), count($nama_rcjty_gabung), count($nama_haultruck_gabung), count($jumlah_gabung), count($nama_optht_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama

        $nama_rcicf_gabung = array_pad($nama_rcicf_gabung, $maxRows, '');
        $nama_rcjty_gabung = array_pad($nama_rcjty_gabung, $maxRows, '');
        $nama_haultruck_gabung = array_pad($nama_haultruck_gabung, $maxRows, '');
        $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');
        $nama_optht_gabung = array_pad($nama_optht_gabung, $maxRows, '');


        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(40, 7, $data['tanggal'], 1, 0, 'C');
            } else {
                $pdf->Cell(40, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(40, 7, $nama_haultruck_gabung[$i], 1, 0, 'C');
            $pdf->Cell(60, 7, $nama_rcicf_gabung[$i], 1, 0, 'C');
            $pdf->Cell(60, 7, $nama_rcjty_gabung[$i], 1, 0, 'C');
            $pdf->Cell(40, 7, $jumlah_gabung[$i], 1, 0, 'C');
            $pdf->Cell(40, 7, $nama_optht_gabung[$i], 1, 0, 'C');

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

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Data Jalan HT Transfer Coal ICF To Jetty');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'LAPORAN DATA JALAN HAUL TRUCK TRANSFER COAL ICF TO JETTY', 1, 1, 'C', true);
    $pdf->Ln(2);
    $pdf->SetTextColor(0, 0, 0);

    $imagePath = '../../../img/BYAN.JK.png'; // Ganti dengan path gambar Anda
    $x = 10; // Koordinat X untuk posisi gambar
    $y = 3; // Koordinat Y untuk posisi gambar
    $width = 20; // Lebar gambar
    $height = 25; // Tinggi gambar akan disesuaikan secara proporsional
    $pdf->Image($imagePath, $x, $y, $width, $height);

    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 7, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Haultruck', 1, 0, 'C');
    $pdf->Cell(60, 7, 'Transfer From (ICF)', 1, 0, 'C');
    $pdf->Cell(60, 7, 'Transfer To (Jetty)', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Operator', 1, 0, 'C');
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
          GROUP_CONCAT(nama_optht SEPARATOR ', ') AS nama_optht_gabung,
          GROUP_CONCAT(id_transfer SEPARATOR ', ') AS id_transfer_gabung
          FROM transfer
          INNER JOIN operatorht ON transfer.id_optht = operatorht.id_optht
          INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
          INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
          INNER JOIN haultruck ON transfer.id_haultruck = haultruck.id_haultruck
          GROUP BY transfer.tanggal");

    while ($data = $sql->fetch_assoc()) {
        $nama_rcicf_gabung = explode(", ", $data['nama_rcicf_gabung']);
        $nama_rcjty_gabung = explode(", ", $data['nama_rcjty_gabung']);
        $nama_haultruck_gabung = explode(", ", $data['nama_haultruck_gabung']);
        $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
        $nama_optht_gabung = explode(", ", $data['nama_optht_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($nama_rcicf_gabung), count($nama_rcjty_gabung), count($nama_haultruck_gabung), count($jumlah_gabung), count($nama_optht_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama

        $nama_rcicf_gabung = array_pad($nama_rcicf_gabung, $maxRows, '');
        $nama_rcjty_gabung = array_pad($nama_rcjty_gabung, $maxRows, '');
        $nama_haultruck_gabung = array_pad($nama_haultruck_gabung, $maxRows, '');
        $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');
        $nama_optht_gabung = array_pad($nama_optht_gabung, $maxRows, '');


        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(40, 7, $data['tanggal'], 1, 0, 'C');
            } else {
                $pdf->Cell(40, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(40, 7, $nama_haultruck_gabung[$i], 1, 0, 'C');
            $pdf->Cell(60, 7, $nama_rcicf_gabung[$i], 1, 0, 'C');
            $pdf->Cell(60, 7, $nama_rcjty_gabung[$i], 1, 0, 'C');
            $pdf->Cell(40, 7, $jumlah_gabung[$i], 1, 0, 'C');
            $pdf->Cell(40, 7, $nama_optht_gabung[$i], 1, 0, 'C');

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
                <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN DATA JALAN HAUL TRUCK TRANSFER COAL ICF TO JETTY BERDASARKAN BULAN DAN TAHUN<a href="../../../index/index_admin.php?page=laporan_transhaul" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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