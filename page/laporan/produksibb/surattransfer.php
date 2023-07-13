<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {

    $no = $_POST['no'];
    $tanggal = $_POST['tanggal'];
    $shift = $_POST['shift'];
    $company = $_POST['company'];
    $haultruck = $_POST['haultruck'];
    $tdepart = $_POST['tdepart'];
    $ltool = $_POST['ltool'];
    $seam = $_POST['seam'];
    $wb = $_POST['wb'];
    $loading = $_POST['loading'];
    $dumping = $_POST['dumping'];
    $hopper = $_POST['hopper'];
    $tonnes1 = $_POST['tonnes1'];
    $tonnes2 = $_POST['tonnes2'];

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('DOKUMEN TIKET MUATAN BATUBARA NO.'.$no);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. WAHANA BARATAMA MINING', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(106, 6, 'Satui & Kintap, Kalimantan Selatan', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(10);
    $pdf->SetFillColor(0, 0, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(282, 7, 'DOKUMEN TIKET MUATAN BATUBARA', 1, 1, 'C', true);
    $pdf->Ln(5);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, 'Tanggal : '.$tanggal, 0, 1 );
    $pdf->Cell(0, 5, 'Shift : '.$shift, 0, 1 );
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 10, 'Company', 1, 0, 'C'); // Sel Company
    $pdf->Cell(25, 10, 'Haul Truck', 1, 0, 'C'); // Sel Haul Truck
    $pdf->Cell(25, 10, 'Time Departed', 1, 0, 'C'); // Sel Time Departed
    $pdf->Cell(25, 10, 'Loading Tool', 1, 0, 'C'); // Sel Loading Tool
    $pdf->Cell(25, 10, 'Seam', 1, 0, 'C'); // Sel Seam
    $pdf->Cell(50, 5, 'Time Arrived', 1, 0, 'C'); // Kolom Time Arrived
    $pdf->Cell(50, 5, 'Location', 1, 0, 'C'); // Kolom Location
    $pdf->Cell(50, 5, 'Tonnes', 1, 0, 'C'); // Kolom Tonnes
    $pdf->Cell(0, 5, '', 0, 1, 'C'); // Kolom Tonnes

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(125, 5, '', 0, 0, 'C'); // Kolom 
    $pdf->Cell(25, 5, 'WB', 1, 0, 'C'); // Kolom WB
    $pdf->Cell(25, 5, 'Hopper', 1, 0, 'C'); // Kolom Hopper
    $pdf->Cell(25, 5, 'Loading', 1, 0, 'C'); // Kolom Loading
    $pdf->Cell(25, 5, 'Dumping', 1, 0, 'C'); // Kolom Dumping
    $pdf->Cell(25, 5, '1', 1, 0, 'C'); // Kolom 1
    $pdf->Cell(25, 5, '2', 1, 1, 'C'); // Kolom 2

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25, 7, $company, 1, 0, 'C'); // Sel Company (isi data)
    $pdf->Cell(25, 7, $haultruck, 1, 0, 'C'); // Sel Haul Truck (isi data)
    $pdf->Cell(25, 7, $tdepart, 1, 0, 'C'); // Sel Time Departed (isi data)
    $pdf->Cell(25, 7, $ltool, 1, 0, 'C'); // Sel Loading Tool (isi data)
    $pdf->Cell(25, 7, $seam, 1, 0, 'C'); // Sel Seam (isi data)
    $pdf->Cell(25, 7, $wb, 1, 0, 'C'); // Sel WB (isi data)
    $pdf->Cell(25, 7, $hopper, 1, 0, 'C'); // Sel Hopper (isi data)
    $pdf->Cell(25, 7, $loading, 1, 0, 'C'); // Sel Loading (isi data)
    $pdf->Cell(25, 7, $dumping, 1, 0, 'C'); // Sel Dumping (isi data)
    $pdf->Cell(25, 7, $tonnes1, 1, 0, 'C'); // Sel 1 (isi data)
    $pdf->Cell(25, 7, $tonnes2, 1, 1, 'C'); // Sel 2 (isi data)

    $pdf->Ln();



    // Menambahkan tanda tangan
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Operator,', 0, 0, 'L');
    $pdf->Cell(0, 10, 'Weight Bridge,', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, '-------------------', 0, 0, 'L');
    $pdf->Cell(0, 10, '-------------------', 0, 1, 'R');

    $pdf->Output();
    exit; // Tambahkan perintah exit untuk menghentikan eksekusi script setelah menghasilkan file PDF
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
                <h6 class="m-0 font-weight-bold text-primary">PRINT DOKUMEN TIKET MUATAN BATUBARA</h6>
                </h6>
            </div>
        </div>
        <form method="POST" action="">


            <label>No</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="no" class="form-control">
                </div>
            </div>

            <label>Date</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="date" name="tanggal" class="form-control">
                </div>
            </div>

            <label>Shift</label>
            <div class="form-group">
                <div class="form-line">
                    <select name="shift" id="" class="form-control">
                        <option value="Day">Day</option>
                        <option value="Night">Night</option>
                    </select>
                </div>
            </div>

            <label>Company</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="company" class="form-control">
                </div>
            </div>

            <label for="">Haul Truck</label>
            <div class="form-group">
                <div class="form-line">
                   <input type="text" name="haultruck" id="" class="form-control">
                </div>
            </div>

            <label>Time Departed</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="time" name="tdepart" class="form-control">
                </div>
            </div>

            <label>Loading Tool</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="ltool" class="form-control">
                </div>
            </div>

            <label>Seam</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="seam" class="form-control">
                </div>
            </div>

            <h6 for="" class="text-center">Time Arrived</h6>
            <label>WB</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="time" name="wb" class="form-control">
                </div>
            </div>

            <label>Hopper</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="time" name="hopper" class="form-control">
                </div>
            </div>
            <hr>

            <h6 for="" class="text-center">Location</h6>
            <label>Loading</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="loading" class="form-control">
                </div>
            </div>
            <label>Dumping</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="dumping" class="form-control">
                </div>
            </div>
            <hr>
            

            <h6 for="" class="text-center">Tonnes</h6>
            <label>1</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="tonnes1" class="form-control">
                </div>
            </div>

            <label>2</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="tonnes2" class="form-control">
                </div>
            </div>

            <input type="submit" name="submit" value="Tampilkan Laporan" class="btn btn-primary">
            <script src="../../../vendor/jquery/jquery.slim.min.js"></script>
            <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        </form>
    </div>
</body>

</html>