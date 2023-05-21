<form method="post" action="">
    <label for="bulan">Pilih Bulan:</label>
    <select name="bulan">
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>

    <label for="tahun">Pilih Tahun:</label>
    <select name="tahun">
        <?php
        $start_year = date('Y') - 10;
        $end_year = date('Y') + 10;

        for ($i = $start_year; $i <= $end_year; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
        ?>
    </select>

    <input type="submit" name="submit" value="Tampilkan">
</form>

<?php


if (isset($_POST['submit'])) {
    //ambil data dari form
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    //query untuk mengambil data berdasarkan bulan dan tahun
    $query = "SELECT * FROM barang_keluar WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";

    //eksekusi query
    $result = mysqli_query($koneksi, $query);

    //cek apakah data ditemukan atau tidak
    if (mysqli_num_rows($result) > 0) {
        //tampilkan data dalam tabel
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nama</th><th>Tanggal</th></tr>";
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $data['kode_barang'] . "</td>";
            echo "<td>" . $data['nama_barang'] . "</td>";
            echo "<td>" . $data['tanggal'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Data tidak ditemukan";
    }
}
?>


<!-- manteb  -->

<?php
// Mengimpor library FPDF
require('../../fpdf/fpdf.php');

// Membuat koneksi ke database
include "../../koneksibarang.php";

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form
    $tanggal = $_POST['tanggal'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    // Membuat objek PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Menambahkan judul laporan
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Berdasarkan Tanggal/Bulan/Tahun', 0, 1, 'C');

    // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Tanggal/Bulan/Tahun: ' . $tanggal . '/' . $bulan . '/' . $tahun, 0, 1);

    // Menambahkan header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nama', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Alamat', 1, 1, 'C');

    // Mengambil data dari database
    $query = "SELECT * FROM barang_keluar WHERE DAY(tanggal) = '$tanggal' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
    $result = mysqli_query($koneksi, $query);

    // Menampilkan data dalam tabel
    $pdf->SetFont('Arial', '', 12);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(30, 10, $row['id'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row['nama_barang'], 1, 0);
        $pdf->Cell(50, 10, $row['tanggal'], 1, 1);
    }

    // Mengakhiri dokumen PDF
    $pdf->Output();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Berdasarkan Tanggal/Bulan/Tahun</title>
</head>

<body>
    <h1>Laporan Berdasarkan Tanggal/Bulan/Tahun</h1>
    <form method="POST" action="">
        <label>Tanggal:</label>
        <select name="tanggal">
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <label>Bulan:</label>
        <select name="bulan">
            <?php
            $bulan_array = array(
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'J
                uli', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            );
            foreach ($bulan_array as $index => $bulan) {
                echo '<option value="' . ($index + 1) . '">' . $bulan . '</option>';
            }
            ?>
        </select>
        <label>Tahun:</label>
        <select name="tahun">
            <?php
            for ($i = 2021; $i <= 2023; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Tampilkan Laporan">
    </form>

</body>

</html>

<!-- sum data -->
<?php
$sum = mysqli_query($koneksi, "SELECT sum(jumlah) AS total FROM gudang");
$thasil = mysqli_fetch_assoc($sum);

?>
<?= $thasil['total']; ?>




<!-- Shipment Blending Plant -->

<?php
require('fpdf/fpdf.php');

// mengambil data dari form
$customer_name = $_POST['customer_name'];
$customer_address = $_POST['customer_address'];
$invoice_date = $_POST['invoice_date'];
$invoice_number = $_POST['invoice_number'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

// membuat objek FPDF
$pdf = new FPDF();
$pdf->AddPage();

// menambahkan judul
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Invoice',0,1,'C');

// menambahkan data pelanggan
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,10,'Customer Name: ',0);
$pdf->Cell(0,10,$customer_name,0,1);

$pdf->Cell(30,10,'Customer Address: ',0);
$pdf->Cell(0,10,$customer_address,0,1);

// menambahkan data invoice
$pdf->Cell(30,10,'Invoice Number: ',0);
$pdf->Cell(0,10,$invoice_number,0,1);

$pdf->Cell(30,10,'Invoice Date: ',0);
$pdf->Cell(0,10,$invoice_date,0,1);

$pdf->Ln(10);

// membuat tabel untuk item
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,10,'Description',1);
$pdf->Cell(30,10,'Quantity',1);
$pdf->Cell(40,10,'Price',1);
$pdf->Cell(40,10,'Total',1);
$pdf->Ln();

$pdf->SetFont('Arial','',12);
$pdf->Cell(50,10,$description,1);
$pdf->Cell(30,10,$quantity,1);
$pdf->Cell(40,10,'Rp '.number_format($price),1);
$pdf->Cell(40,10,'Rp '.number_format($quantity*$price),1);

$pdf->Ln(20);

// menampilkan total
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Total: Rp '.number_format($quantity*$price),0,1,'R');

// menampilkan tombol cetak
$pdf->Output();
?>

<!-- kode untuk form HTML -->
<form action="create_invoice.php" method="post">
  <label>Customer Name:</label>
  <input type="text" name="customer_name"><br>

  <label>Customer Address:</label>
  <textarea name="customer_address"></textarea><br>

  <label>Invoice Date:</label>
  <input type="date" name="invoice_date"><br>

  <label>Invoice Number:</label>
  <input type="text" name="invoice_number"><br>

  <label>Description:</label>
  <input type="text" name="description"><br>

  <label>Quantity:</label>
  <input type="number" name="quantity"><br>

  <label>Price:</label>
  <input type="number" name="price"><br>

  <input type="submit" value="Create Invoice">
</form>

<?php 
if (isset($_POST['submit'])){
 
}
?>


<!-- PENJUMLAHAN -->
<?php
$coba = mysqli_query($koneksi,"SELECT SUM(stok) AS jum  FROM scjty");
$tamps = mysqli_fetch_assoc($coba);
$total = $tamps['jum'];

$coba2 = mysqli_query($koneksi,"SELECT SUM(stok) AS jum  FROM scicf");
$tamps2 = mysqli_fetch_assoc($coba2);
$total2 = $tamps2['jum'];

$hasil = $total + $total2;
?>