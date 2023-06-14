<?php
include '../../koneksi.php';
require '../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(0, 10, 'Laporan Pre-Order', 0, 1, 'C');
            $this->Ln(5);

            $this->SetFont('Arial', 'B', 12);
            $this->Cell(30, 7, 'Kode Pre-Order', 1, 0, 'C');
            $this->Cell(30, 7, 'Tanggal', 1, 0, 'C');
            $this->Cell(30, 7, 'Kode Barang', 1, 0, 'C');
            $this->Cell(150, 7, 'Nama Barang', 1, 0, 'C');
            $this->Cell(20, 7, 'Jumlah', 1, 0, 'C');
            $this->Ln();
        }
    }

    if (isset($_POST['kode_po'])) {
        $kode_po = $_POST['kode_po'];

        $pdf = new PDF('L', 'mm', 'A4');
        $pdf->SetTitle('Laporan Pre-Order');

        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        // Mengambil data dari database berdasarkan kode_po yang dipilih
        $no = 1;
        $sql = $koneksi->query("SELECT po.kode_po, po.tanggal, po.status, GROUP_CONCAT(gudang.kode_barang SEPARATOR ', ') AS kode_barang_gabung, GROUP_CONCAT(gudang.nama_barang SEPARATOR ', ') AS nama_barang_gabung, GROUP_CONCAT(po.jumlah_po SEPARATOR ', ') AS jumlah_po_gabung
        FROM po
        INNER JOIN gudang ON po.kode_barang = gudang.kode_barang
        WHERE po.kode_po = '$kode_po'
        GROUP BY po.kode_po");
        while ($data = $sql->fetch_assoc()) {
            $kode_barang_gabung = explode(", ", $data['kode_barang_gabung']);
            $nama_barang_gabung = explode(", ", $data['nama_barang_gabung']);
            $jumlah_po_gabung = explode(", ", $data['jumlah_po_gabung']);
            // Mencari jumlah baris terbanyak dari grup concat
            $maxRows = max(count($kode_barang_gabung), count($nama_barang_gabung), count($jumlah_po_gabung));

            // Menyusun ulang data agar memiliki jumlah baris yang sama
            $kode_barang_gabung = array_pad($kode_barang_gabung, $maxRows, '');
            $nama_barang_gabung = array_pad($nama_barang_gabung, $maxRows, '');
            $jumlah_po_gabung = array_pad($jumlah_po_gabung, $maxRows, '');

            for ($i = 0; $i < $maxRows; $i++) {
                if ($i == 0) {
                    $pdf->Cell(30, 7, $data['kode_po'], 1, 0, 'C');
                    $pdf->Cell(30, 7, $data['tanggal'], 1, 0, 'C');
                } else {
                    $pdf->Cell(30, 7, '', 1, 0, 'C');
                    $pdf->Cell(30, 7, '', 1, 0, 'C');
                }

                $pdf->Cell(30, 7, $kode_barang_gabung[$i], 1, 0, 'C');
                $pdf->Cell(150, 7, $nama_barang_gabung[$i], 1, 0, 'L');
                $pdf->Cell(20, 7, $jumlah_po_gabung[$i], 1, 0, 'C');

                $pdf->Ln();
            }
        }

        $pdf->Output();
    }
}

if (isset($_POST['submits'])) {

    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(0, 10, 'Laporan Pre-Order', 0, 1, 'C');
            $this->Ln(5);

            $this->SetFont('Arial', 'B', 12);
            $this->Cell(30, 7, 'Kode Pre-Order', 1, 0, 'C');
            $this->Cell(30, 7, 'Tanggal', 1, 0, 'C');
            $this->Cell(30, 7, 'Kode Barang', 1, 0, 'C');
            $this->Cell(150, 7, 'Nama Barang', 1, 0, 'C');
            $this->Cell(20, 7, 'Jumlah', 1, 0, 'C');
            $this->Ln();
        }
    }


    $pdf = new PDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Pre-Order');

    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Mengambil data dari database
    $no = 1;
    $sql = $koneksi->query("SELECT po.kode_po, po.tanggal, po.status, GROUP_CONCAT(gudang.kode_barang SEPARATOR ', ') AS kode_barang_gabung, GROUP_CONCAT(gudang.nama_barang SEPARATOR ', ') AS nama_barang_gabung, GROUP_CONCAT(po.jumlah_po SEPARATOR ', ') AS jumlah_po_gabung
FROM po
INNER JOIN gudang ON po.kode_barang = gudang.kode_barang
GROUP BY po.kode_po");
    while ($data = $sql->fetch_assoc()) {
        $kode_barang_gabung = explode(", ", $data['kode_barang_gabung']);
        $nama_barang_gabung = explode(", ", $data['nama_barang_gabung']);
        $jumlah_po_gabung = explode(", ", $data['jumlah_po_gabung']);
        // Mencari jumlah baris terbanyak dari grup concat
        $maxRows = max(count($kode_barang_gabung), count($nama_barang_gabung), count($jumlah_po_gabung));

        // Menyusun ulang data agar memiliki jumlah baris yang sama
        $kode_barang_gabung = array_pad($kode_barang_gabung, $maxRows, '');
        $nama_barang_gabung = array_pad($nama_barang_gabung, $maxRows, '');
        $jumlah_po_gabung = array_pad($jumlah_po_gabung, $maxRows, '');

        for ($i = 0; $i < $maxRows; $i++) {
            if ($i == 0) {
                $pdf->Cell(30, 7, $data['kode_po'], 1, 0, 'C');
                $pdf->Cell(30, 7, $data['tanggal'], 1, 0, 'C');
            } else {
                $pdf->Cell(30, 7, '', 1, 0, 'C');
                $pdf->Cell(30, 7, '', 1, 0, 'C');
            }

            $pdf->Cell(30, 7, $kode_barang_gabung[$i], 1, 0, 'C');
            $pdf->Cell(150, 7, $nama_barang_gabung[$i], 1, 0, 'L');
            $pdf->Cell(20, 7, $jumlah_po_gabung[$i], 1, 0, 'C');


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
<link rel="stylesheet" href="../../css/bootstrap.min.css">

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand font-weight-bold" href="#">
            <img src="../../img/bayan.png" width="30" height="30" class="d-inline-block align-top" alt="">
            PT. WBM MEMBER OF BAYAN GROUP
        </a>
    </nav>
    <div class="container">
        <div class="form-group">
            <div class="form-line">
                <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN PRE - ORDER BERDASARKAN BULAN DAN TAHUN<a href="../../index/index_admin.php?page=laporan_po" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
                </h6>
            </div>
        </div>
        <form method="POST" action="">

            <label>Kode PO:</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="kode_po" name="kode_po" class="form-control">
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
            <script src="../../vendor/jquery/jquery.slim.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>