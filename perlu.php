<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode SBP</th>
      <th>Tanggal</th>
      <th>Start</th>
      <th>Finish</th>
      <th>Loading From</th>
      <th>Warna</th>
      <th>Loading To</th>
      <th>Belstscale</th>
      <th>Catatan</th>
      <th>Pengaturan</th>
    </tr>
  </thead>


  <tbody>
    <?php
    $no = 1;
    $sql = mysqli_query($koneksi, "SELECT loading.kode_sbp,
        GROUP_CONCAT(tanggal SEPARATOR ', ') AS tanggal_gabung,
        GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_gabung,
        GROUP_CONCAT(nama_barge SEPARATOR ', ') AS barge_gabung,
        GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
        GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
        GROUP_CONCAT(beltscale SEPARATOR ', ') AS beltscale_gabung,
        GROUP_CONCAT(warna SEPARATOR ', ') AS warna_gabung
        FROM loading
        INNER JOIN barge ON loading.id_barge = barge.id_barge
        INNER JOIN scjty ON loading.id_rcjty = scjty.id_rcjty
        GROUP BY kode_sbp order by tanggal desc");
    while ($data = mysqli_fetch_assoc($sql)) {
      $tanggal_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['tanggal_gabung']) . '</li>';
      $start_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['start_gabung']) . '</li></ul>';
      $finish_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['finish_gabung']) . '</li></ul>';
      $nama_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_gabung']) . '</li></ul>';
      $barge_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['barge_gabung']) . '</li></ul>';
      $beltscale_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['beltscale_gabung']) . '</li></ul>';
      $warna_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['warna_gabung']) . '</li></ul>';
    ?>

      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $data['kode_sbp'] ?></td>
        <td><?php echo $tanggal_gabung ?></td>
        <td><?php echo $start_gabung ?></td>
        <td><?php echo $finish_gabung ?></td>
        <td><?php echo $nama_gabung ?></td>
        <td><?php echo $warna_gabung ?></td>
        <td><?php echo $barge_gabung ?></td>
        <td><?php echo $beltscale_gabung ?></td>
        <td><?php echo $data['catatan'] ?></td>

        <td>
          <a href="?page=gudang&aksi=ubahgudang&kode_barang=<?php echo $data['kode_barang'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
          <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=gudang&aksi=hapusgudang&kode_barang=<?php echo $data['kode_barang'] ?>" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
        </td>
      </tr>
    <?php } ?>


  </tbody>
</table>



<?php
include '../../../koneksi.php';
require '../../../fpdf/fpdf.php';

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
  // Mengambil nilai dari form

  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];

  // Membuat objek PDF
  $pdf = new FPDF('L', 'mm', 'A4');
  $pdf->AddPage();

  // Menambahkan judul laporan
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(0, 10, 'LAPORAN TRANSFER COAL ICF TO JETTY', 0, 1, 'C');

  // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(0, 10, 'Bulan ' . $bulan . ', Tahun ' . $tahun, 0, 1, 'C');

  // Menambahkan header tabel
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Start', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Finish', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Crushing From (ICF)', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Crushing To (JETTY)', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Jumlah', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Catatan', 1, 1, 'C');

  // Menampilkan data dalam tabel
  $pdf->SetFont('Arial', '', 12);
  $tampil = mysqli_query($koneksi, "select * from transfer
    inner join scicf on transfer.id_rcicf = scicf.id_rcicf
    inner join scjty on transfer.id_rcjty = scjty.id_rcjty where MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
  while ($hasil = mysqli_fetch_assoc($tampil)) {
    $pdf->Cell(35, 6, $hasil['tanggal'], 1, 0);
    $pdf->Cell(35, 6, $hasil['start'], 1, 0);
    $pdf->Cell(35, 6, $hasil['finish'], 1, 0);
    $pdf->Cell(35, 6, $hasil['nama_rcicf'], 1, 0);
    $pdf->Cell(35, 6, $hasil['nama_rcjty'], 1, 0);
    $pdf->Cell(35, 6, $hasil['jumlah'], 1, 0);
    $pdf->Cell(35, 6, $hasil['catatan'], 1, 1);
  }
  // Mengakhiri dokumen PDF
  $pdf->Output();
}

if (isset($_POST['submits'])) {
  // Mengambil nilai dari form

  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];

  // Membuat objek PDF
  $pdf = new FPDF('L', 'mm', 'A4');
  $pdf->AddPage();

  // Menambahkan judul laporan
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(0, 10, 'LAPORAN TRANSFER COAL ICF TO JETTY', 0, 1, 'C');

  // Menambahkan informasi tanggal atau bulan dan tahun yang dipilih


  // Menambahkan header tabel
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Start', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Finish', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Crushing From (ICF)', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Crushing To (JETTY)', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Jumlah', 1, 0, 'C');
  $pdf->Cell(35, 10, 'Catatan', 1, 1, 'C');

  // Menampilkan data dalam tabel
  $pdf->SetFont('Arial', '', 12);
  $tampil = mysqli_query($koneksi, "select * from transfer
    inner join scicf on transfer.id_rcicf = scicf.id_rcicf
    inner join scjty on transfer.id_rcjty = scjty.id_rcjty");
  while ($hasil = mysqli_fetch_assoc($tampil)) {
    $pdf->Cell(35, 6, $hasil['tanggal'], 1, 0);
    $pdf->Cell(35, 6, $hasil['start'], 1, 0);
    $pdf->Cell(35, 6, $hasil['finish'], 1, 0);
    $pdf->Cell(35, 6, $hasil['nama_rcicf'], 1, 0);
    $pdf->Cell(35, 6, $hasil['nama_rcjty'], 1, 0);
    $pdf->Cell(35, 6, $hasil['jumlah'], 1, 0);
    $pdf->Cell(35, 6, $hasil['catatan'], 1, 1);
  }
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
        <h6 class="m-0 font-weight-bold text-primary">PRINT LAPORAN TRANSFER COAL ICF TO JETTY BERDASARKAN BULAN DAN TAHUN<a href="../../../index/index_admin.php?page=laporan_crushingicf" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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
      $this->Cell(30, 7, 'Tanggal', 1, 0, 'C');
      $this->Cell(30, 7, 'Start', 1, 0, 'C');
      $this->Cell(15, 7, 'Finish', 1, 0, 'C');
      $this->Cell(20, 7, 'Jumlah', 1, 0, 'C');
      $this->Cell(20, 7, 'Jumlah', 1, 0, 'C');
      $this->Cell(20, 7, 'Jumlah', 1, 0, 'C');
      $this->Cell(20, 7, 'Jumlah', 1, 0, 'C');
      $this->Cell(20, 7, 'Jumlah', 1, 0, 'C');
      $this->Ln();
    }
  }

  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];
  $pdf = new PDF('L', 'mm', 'A4');
  $pdf->SetTitle('Laporan Pre-Order');

  $pdf->AddPage();
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
        GROUP BY transfer.tanggal where MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
  while ($data = $sql->fetch_assoc()) {
    $start_gabung = explode(", ", $data['start_gabung']);
    $finish_gabung = explode(", ", $data['finish_gabung']);
    $nama_rcicf_gabung = explode(", ", $data['nama_rcicf_gabung']);
    $nama_rcjty_gabung = explode(", ", $data['nama_rcjty_gabung']);
    $nama_haultruck_gabung = explode(", ", $data['nama_haultruck_gabung']);
    $catatan_gabung = explode(", ", $data['catatan_gabung']);
    $jumlah_gabung = explode(", ", $data['jumlah_gabung']);
    $id_transfer_gabung = explode(", ", $data['id_transfer_gabung']);
    // Mencari jumlah baris terbanyak dari grup concat
    $maxRows = max(count($start_gabung), count($finish_gabung), count($nama_rcicf_gabung), count($nama_rcicf_gabung), count($nama_rcjty_gabung), count($nama_haultruck_gabung), count($catatan_gabung), count($jumlah_gabung), count($id_transfer_gabung));

    // Menyusun ulang data agar memiliki jumlah baris yang sama
    $start_gabung = array_pad($start_gabung, $maxRows, '');
    $finish_gabung = array_pad($finish_gabung, $maxRows, '');
    $nama_rcicf_gabung = array_pad($nama_rcicf_gabung, $maxRows, '');
    $nama_rcjty_gabung = array_pad($nama_rcjty_gabung, $maxRows, '');
    $nama_haultruck_gabung = array_pad($nama_haultruck_gabung, $maxRows, '');
    $catatan_gabung = array_pad($catatan_gabung, $maxRows, '');
    $jumlah_gabung = array_pad($jumlah_gabung, $maxRows, '');
    $id_transfer_gabung = array_pad($id_transfer_gabung, $maxRows, '');

    for ($i = 0; $i < $maxRows; $i++) {
      if ($i == 0) {
        $pdf->Cell(30, 7, $data['tanggal'], 1, 0, 'C');
      } else {
        $pdf->Cell(30, 7, '', 1, 0, 'C');
        $pdf->Cell(30, 7, '', 1, 0, 'C');
      }

      $pdf->Cell(30, 7, $start_gabung[$i], 1, 0, 'C');
      $pdf->Cell(150, 7, $finish_gabung[$i], 1, 0, 'L');
      $pdf->Cell(20, 7, $nama_ricf_gabung[$i], 1, 0, 'C');
      $pdf->Cell(20, 7, $nama_rcjty_gabung[$i], 1, 0, 'C');
      $pdf->Cell(20, 7, $nama_haultruck_gabung[$i], 1, 0, 'C');
      $pdf->Cell(20, 7, $catatan_gabung[$i], 1, 0, 'C');
      $pdf->Cell(20, 7, $jumlah_gabung[$i], 1, 0, 'C');
      $pdf->Cell(20, 7, $id_transfer_gabung[$i], 1, 0, 'C');

      $pdf->Ln();
    }
  }

  $pdf->Output();
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