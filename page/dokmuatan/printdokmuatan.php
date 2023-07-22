<?php
include '../../fpdf/fpdf.php';
include '../../koneksi.php';

    $id = $_GET['id_dokmuatan'];
    $dokmuatan = mysqli_query($koneksi,"SELECT * FROM dokmuatan INNER JOIN dumptruck ON dokmuatan.id_dumptruck = dumptruck.id_dumptruck WHERE id_dokmuatan = $id");
    $tampil = mysqli_fetch_assoc($dokmuatan);
    $no = $tampil['nomor'];
    $tanggal = $tampil['tanggal'];
    $shift = $tampil['shift'];
    $company = $tampil['company'];
    $nama_dumptruck = $tampil['nama_dumptruck'];
    $tdepart = $tampil['tdepart'];
    $ltool = $tampil['ltool'];
    $seam = $tampil['seam'];
    $wb = $tampil['wb'];
    $loading = $tampil['loading'];
    $dumping = $tampil['dumping'];
    $hopper = $tampil['hopper'];
    $tonnes1 = $tampil['tonnes1'];
    $tonnes2 = $tampil['tonnes2'];

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->SetTitle('DOKUMEN TIKET MUATAN BATUBARA NO.'.$no);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(138, 6, 'PT. KARUNIA ARMADA INDONESIA', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(82, 6, 'Wahana Mine Project', 0, 1, 'C');
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

    $pdf->Cell(0, 5, 'NO : '.$no, 0, 1 );
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 10, 'Company', 1, 0, 'C'); // Sel Company
    $pdf->Cell(25, 10, 'Truck No.', 1, 0, 'C'); // Sel Haul Truck
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
    $pdf->Cell(25, 7, $nama_dumptruck, 1, 0, 'C'); // Sel Haul Truck (isi data)
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
?>