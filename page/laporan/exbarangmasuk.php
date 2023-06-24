<?php
include '../../koneksi.php';
require '../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Membuat objek PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Barang Masuk Bulan ' .$bulan.' Tahun '.$tahun);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 7, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 7, 'LAPORAN BARANG MASUK', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Bulan ' . $bulan . ' Tahun ' . $tahun, 0, 1, 'C');
    $pdf->Line(10,35,290,35);
    $pdf->SetLineWidth(1);
    $pdf->Line(10,34,290,34);
    $pdf->SetLineWidth(0);
    $pdf->Ln(10);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 10, 'Id Transaksi', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(27, 10, 'Kode Barang', 1, 0, 'C');
    $pdf->Cell(115, 10, 'Nama Barang', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Pengirim', 1, 0, 'C');
    $pdf->Cell(15, 10, 'Jumlah', 1, 1, 'C');


    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from barang_masuk 
    inner join tb_supplier on barang_masuk.id_supplier = tb_supplier.id_supplier where MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(50, 6, $hasil['id_transaksi'], 1, 0);
        $pdf->Cell(25, 6, $hasil['tanggal'], 1, 0);
        $pdf->Cell(27, 6, $hasil['kode_barang'], 1, 0);
        $pdf->Cell(115, 6, $hasil['nama_barang'], 1, 0);
        $pdf->Cell(50, 6, $hasil['nama_supplier'], 1, 0);
        $pdf->Cell(15, 6, $hasil['jumlah'], 1, 1, 'C');
    }

    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Supervisor', 0, 1, 'R');


    // Mengakhiri dokumen PDF
    $pdf->Output('Laporan Barang Masuk Bulan '.$bulan.' Tahun '.$tahun.'.pdf', 'I');
}


if (isset($_POST['submits'])) {
    // Mengambil nilai dari form

    // Membuat objek PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('Laporan Barang Masuk');
    $pdf->AddPage();

    // Menambahkan judul laporan
   
    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 7, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 7, 'LAPORAN BARANG MASUK', 0, 1, 'C');
    $pdf->Line(10,31,290,31);
    $pdf->SetLineWidth(1);
    $pdf->Line(10,30,290,30);
    $pdf->SetLineWidth(0);
    $pdf->Ln(15);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 10, 'Id Transaksi', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(27, 10, 'Kode Barang', 1, 0, 'C');
    $pdf->Cell(115, 10, 'Nama Barang', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Pengirim', 1, 0, 'C');
    $pdf->Cell(15, 10, 'Jumlah', 1, 1, 'C');


    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    $tampil = mysqli_query($koneksi, "select * from barang_masuk 
    inner join tb_supplier on barang_masuk.id_supplier = tb_supplier.id_supplier");
    while ($hasil = mysqli_fetch_assoc($tampil)) {
        $pdf->Cell(50, 6, $hasil['id_transaksi'], 1, 0);
        $pdf->Cell(25, 6, $hasil['tanggal'], 1, 0);
        $pdf->Cell(27, 6, $hasil['kode_barang'], 1, 0);
        $pdf->Cell(115, 6, $hasil['nama_barang'], 1, 0);
        $pdf->Cell(50, 6, $hasil['nama_supplier'], 1, 0);
        $pdf->Cell(15, 6, $hasil['jumlah'], 1, 1, 'C');
    }

    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Supervisor', 0, 1, 'R');
    // Mengakhiri dokumen PDF
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
                <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN BARANG MASUK BERDASARKAN BULAN DAN TAHUN<a href="../../index/index_admin.php?page=laporan_barangmasuk" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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
            <script src="../../vendor/jquery/jquery.slim.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>