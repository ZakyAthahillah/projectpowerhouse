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



<!-- Transfer -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Transfer Coal ICF To Jetty</h6>
    <br>
    <a href="?page=transfer&aksi=tambahtransfer" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Start</th>
            <th>Finish</th>
            <th>Transfer From (ICF)</th>
            <th>Transfer To (JETTY)</th>
            <th>Jumlah</th>
            <th>Haul Truck</th>
            <th>Penginput</th>
            <th>Catatan</th>
            <th>Pengaturan</th>

          </tr>
        </thead>


        <tbody>
          <?php

          $no = 1;
          $sql = mysqli_query($koneksi, "SELECT transfer.id_transfer, tanggal, 
            GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
            GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
            GROUP_CONCAT(nama_rcicf SEPARATOR ', ') AS nama_rcicf_gabung,
            GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_rcjty_gabung,
            GROUP_CONCAT(nama_haultruck SEPARATOR ', ') AS nama_haultruck_gabung,
            GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
            GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
            GROUP_CONCAT(nama SEPARATOR ', ') AS nama_gabung,
            GROUP_CONCAT(id_transfer SEPARATOR ', ') AS id_transfer_gabung
            FROM transfer
            INNER JOIN users ON transfer.id_users = users.id_users
            INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
            INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
            INNER JOIN haultruck ON transfer.id_haultruck = haultruck.id_haultruck
            WHERE catatan='Done'
            GROUP BY transfer.tanggal
            ORDER BY tanggal DESC");


          while ($data = mysqli_fetch_assoc($sql)) {
            $tanggal = $data['tanggal'];
            $start_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['start_gabung']) . '</li>';
            $finish_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['finish_gabung']) . '</li>';
            $nama_rcicf_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcicf_gabung']) . '</li>';
            $nama_rcjty_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcjty_gabung']) . '</li>';
            $nama_haultruck_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_haultruck_gabung']) . '</li>';
            $catatan_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['catatan_gabung']) . '</li>';
            $jumlah_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['jumlah_gabung']) . '</li>';
            $nama_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_gabung']) . '</li>';
            $id_transfer_gabung = $data['id_transfer_gabung'];
          ?>

            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $tanggal; ?></td>
              <td><?php echo $start_gabung; ?></td>
              <td><?php echo $finish_gabung; ?></td>
              <td><?php echo $nama_rcicf_gabung; ?></td>
              <td><?php echo $nama_rcjty_gabung; ?></td>
              <td><?php echo $jumlah_gabung; ?></td>
              <td><?php echo $nama_haultruck_gabung; ?></td>
              <td><?php echo $nama_gabung; ?></td>
              <td><?php echo $catatan_gabung; ?></td>
              <td>
                <div style="display: flex;">
                  <ul style="list-style-type: none; padding: 0; margin: 0 10px 0 0;">
                    <?php
                    $id_transfer_array = explode(", ", $id_transfer_gabung);
                    foreach ($id_transfer_array as $id_transfer) {
                      echo '<li><a href="?page=transfer&aksi=konfirmtransfer&id_transfer=' . $id_transfer . '"><i class="fas fa-check text-success"></i></a></li>';
                    }
                    ?>
                  </ul>
                  <ul style="list-style-type: none; padding: 0; margin: 0;">
                    <?php
                    $id_transfer_array = explode(", ", $id_transfer_gabung);
                    foreach ($id_transfer_array as $id_transfer) {
                      echo '<li><a href="?page=transfer&aksi=bataltransfer&id_transfer=' . $id_transfer . '"><i class="fas fa-trash text-danger"></i></a></li>';
                    }
                    ?>
                  </ul>
                </div>
              </td>
            </tr>
          <?php } ?>

        </tbody>
      </table>

      </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  function sum1() {
    var stok = document.getElementById('stokin').value;
    var jumlahmasuk = document.getElementById('mirror').value;
    var result = parseFloat(stok) + parseFloat(jumlahmasuk);
    if (!isNaN(result)) {
      document.getElementById('totalmasuk').value = result;
    }
  }


  function sum2() {
    var stok = document.getElementById('stokout').value;
    var jumlahkeluar = document.getElementById('og').value;
    var result = parseFloat(stok) - parseFloat(jumlahkeluar);
    if (!isNaN(result)) {
      document.getElementById('totalkeluar').value = result;
    }
  }
</script>



<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tambah Data Transfer<a href="?page=transfer" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">


        <div class="body">

          <form method="POST" enctype="multipart/form-data">



            <label for="">Tanggal</label>
            <div class="form-group">
              <div class="form-line">
                <input type="date" name="tanggal" class="form-control" id="tanggal" />
              </div>
            </div>

            <label for="">Start</label>
            <div class="form-group">
              <div class="form-line">
                <input type="time" name="start" class="form-control" id="start" />
              </div>
            </div>

            <label for="">Finish</label>
            <div class="form-group">
              <div class="form-line">
                <input type="time" name="finish" class="form-control" id="finish" />
              </div>
            </div>

            <label for="">Transfer From (ROM ICF)</label>
            <div class="form-group">
              <div class="form-line">
                <select name="transferfrom" id="select_transfericf" class="form-control" required>
                  <option value="">--------------- Pilih Barang ---------------</option>
                  <?php

                  $sql = $koneksi->query("select * from scicf order by id_rcicf");
                  while ($data = $sql->fetch_assoc()) {
                    echo "<option value='$data[id_rcicf].$data[nama_rcicf]'>$data[nama_rcicf]</option>";
                  }
                  ?>

                </select>
              </div>
            </div>

            <div class="tampung12"></div>


            <label for="">Transfer To (ROM Jetty)</label>
            <div class="form-group">
              <div class="form-line">
                <select name="transferto" id="select_transferjty" class="form-control" required>
                  <option value="">--------------- Pilih Barang ---------------</option>
                  <?php

                  $sql = $koneksi->query("select * from scjty order by id_rcjty");
                  while ($data = $sql->fetch_assoc()) {
                    echo "<option value='$data[id_rcjty].$data[nama_rcjty]'>$data[nama_rcjty]</option>";
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="tampung11"></div>

            <label for="">Jumlah Keluar RC ICF</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" name="jumlahkeluar" id="og" onkeyup="sum2()" class="form-control" />

              </div>
            </div>


            <label for="">Jumlah Masuk RC Jetty</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" name="jumlahmasuk" id="mirror" onmousemove="sum1()" class="form-control" />

              </div>
            </div>


            <label for="totalkeluar">Total Stock RC ICF</label>
            <div class="form-group">
              <div class="form-line">
                <input readonly="readonly" name="totalkeluar" id="totalkeluar" type="number" class="form-control">
              </div>
            </div>

            <label for="totalmasuk">Total Stock RC Jetty</label>
            <div class="form-group">
              <div class="form-line">
                <input readonly="readonly" name="totalmasuk" id="totalmasuk" type="number" class="form-control">
              </div>
            </div>

            <div class="tampung1"></div>


            <label for="">Haul Truck</label>
            <div class="form-group">
              <div class="form-line">
                <select name="haultruck" id="select_haultruck" class="form-control" required>
                  <option value="">----------SILAHKAN PILIH----------</option>
                  <?php

                  $sql = $koneksi->query("select * from haultruck order by id_haultruck");
                  while ($data = $sql->fetch_assoc()) {
                    echo "<option value='$data[id_haultruck]'>$data[nama_haultruck]</option>";
                  }
                  ?>

                </select>
              </div>
            </div>

            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

          </form>



          <?php

          if (isset($_POST['simpan'])) {
            $tanggal = $_POST['tanggal'];
            $id_rcjty = $_POST['transferto'];
            $pecah_rcjty = explode(".", $id_rcjty);
            $id_rcjty = $pecah_rcjty[0];
            $nama_rcjty = $pecah_rcjty[1];

            $id_rcicf = $_POST['transferfrom'];
            $pecah_rcicf = explode(".", $id_rcicf);
            $id_rcicf = $pecah_rcicf[0];
            $nama_rcicf = $pecah_rcicf[1];

            $jumlahmasuk = $_POST['jumlahmasuk'];
            $jumlahkeluar = $_POST['jumlahkeluar'];

            $totalmasuk = $_POST['totalmasuk'];
            $totalkeluar = $_POST['totalkeluar'];

            $start = $_POST['start'];

            $finish = $_POST['finish'];
            $id_haultruck = $_POST['haultruck'];
            $catatan = "Dalam Proses";

            $sql = $koneksi->query("insert into transfer(tanggal, start, finish, id_rcjty, id_rcicf, jumlah, id_haultruck, id_users, catatan) values('$tanggal','$start','$finish','$id_rcjty', '$id_rcicf','$jumlahkeluar', '$id_haultruck', '$id_users', '$catatan')");
            $sql2 = $koneksi->query("update scjty set stok='$totalmasuk' where id_rcjty='$id_rcjty'");
            $sql3 = $koneksi->query("update scicf set stok='$totalkeluar' where id_rcicf='$id_rcicf'");





            if ($sql) {
              echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Disimpan',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=transfer';
								});
							</script>
							";
            } else {
              echo "
							<script>
								Swal.fire({
									title: 'ERROR!',
									text: 'Data Gagal Disimpan',
									icon: 'error',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=transfer';
								});
							</script>
							";
            }
          }


          ?>

          <?
          if (isset($_POST['simpan'])) {
            $tanggal = $_POST['tanggal'];

            $id_rcjty = $_POST['transferto'];
            $pecah_rcjty = explode(".", $id_rcjty);
            $id_rcjty = $pecah_rcjty[0];
            $nama_rcjty = $pecah_rcjty[1];

            $id_rcicf = $_POST['transferfrom'];
            $pecah_rcicf = explode(".", $id_rcicf);
            $id_rcicf = $pecah_rcicf[0];
            $nama_rcicf = $pecah_rcicf[1];

            $jumlahmasuk = $_POST['jumlahmasuk'];
            $jumlahkeluar = $_POST['jumlahkeluar'];

            $totalmasuk = $_POST['totalmasuk'];
            $totalkeluar = $_POST['totalkeluar'];

            $start = $_POST['start'];

            $id_haultruck = $_POST['haultruck'];
            $id_optht = $_POST['optht'];
            $catatan = "Dalam Proses";

            $sql = $koneksi->query("insert into transfer(tanggal, start, id_rcjty, id_rcicf, jumlah, id_haultruck, id_optht, id_users, catatan) values('$tanggal','$start', '$id_rcjty', '$id_rcicf','$jumlahkeluar', '$id_haultruck', '$id_optht', '$id_users', '$catatan')");


            if ($sql) {
              echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Disimpan',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=transfer';
								});
							</script>
							";
            } else {
              echo "
							<script>
								Swal.fire({
									title: 'ERROR!',
									text: 'Data Gagal Disimpan',
									icon: 'error',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=transfer';
								});
							</script>
							";
            }
          }


          ?>


          <?php
          // Mendapatkan tahun awal dan tahun akhir dari tabel loading
          $sqlMinMaxYear = "SELECT MIN(YEAR(tanggal)) AS min_year, MAX(YEAR(tanggal)) AS max_year FROM loading AND transfer";
          $resultMinMaxYear = $koneksi->query($sqlMinMaxYear);
          if ($resultMinMaxYear->num_rows > 0) {
            $rowMinMaxYear = $resultMinMaxYear->fetch_assoc();
            $minYear = $rowMinMaxYear['min_year'];
            $maxYear = $rowMinMaxYear['max_year'];
          } else {
            $minYear = date('Y'); // Tahun saat ini jika tidak ada data
            $maxYear = date('Y');
          }

          // Menangani pengecekan dan pengolahan saat form select dikirimkan
          if (isset($_POST['submit'])) {
            $selectedMinYear = $_POST['min_year'];
            $selectedMaxYear = $_POST['max_year'];
          } else {
            $selectedMinYear = $minYear;
            $selectedMaxYear = $maxYear;
          }

          $data_loading = array();
          $labels_loading = array();
          $sql_loading = "SELECT MONTH(tanggal) AS bulan, YEAR(tanggal) AS tahun, SUM(beltscale) AS total_jumlah FROM loading WHERE YEAR(tanggal) BETWEEN $selectedMinYear AND $selectedMaxYear GROUP BY bulan, tahun ORDER BY tahun, bulan";
          $result = $koneksi->query($sql_loading);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $bulan = date("M", mktime(0, 0, 0, $row['bulan'], 1));
              $tahun = $row['tahun'];
              $labels_loading[$tahun][] = $bulan; // Menyimpan bulan dalam array berdasarkan tahun
              $data_loading[$tahun . ' ' . $bulan] = $row['total_jumlah'];
            }
          }

          // Mengurutkan tahun secara descending
          ksort($labels_loading);

          // Menggabungkan tahun dan bulan untuk label
          $sortedLabels = array();
          foreach ($labels_loading as $tahun => $bulanArr) {
            foreach ($bulanArr as $bulan) {
              $sortedLabels[] = $bulan . ' ' . $tahun;
            }
          }

          // Konversi data dan labels menjadi format yang sesuai untuk JavaScript
          $data_js = "[" . implode(", ", $data_loading) . "]";
          $labels_loading_js = '["' . implode('", "', $sortedLabels) . '"]';
//-----------------------------------------------------------------------------------------
          $data_transfer = array();
          $labels_transfer = array();
          $sql_transfer = "SELECT MONTH(tanggal) AS bulan, YEAR(tanggal) AS tahun, SUM(beltscale) AS total_jumlah FROM loading WHERE YEAR(tanggal) BETWEEN $selectedMinYear AND $selectedMaxYear GROUP BY bulan, tahun ORDER BY tahun, bulan";
          $result = $koneksi->query($sql_transfer);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $bulan = date("M", mktime(0, 0, 0, $row['bulan'], 1));
              $tahun = $row['tahun'];
              $labels_transfer[$tahun][] = $bulan; // Menyimpan bulan dalam array berdasarkan tahun
              $data_transfer[$tahun . ' ' . $bulan] = $row['total_jumlah'];
            }
          }

          // Mengurutkan tahun secara descending
          ksort($labels_transfer);

          // Menggabungkan tahun dan bulan untuk label
          $sortedLabels = array();
          foreach ($labels_transfer as $tahun => $bulanArr) {
            foreach ($bulanArr as $bulan) {
              $sortedLabels[] = $bulan . ' ' . $tahun;
            }
          }

          // Konversi data dan labels menjadi format yang sesuai untuk JavaScript
          $data_transfer_js = "[" . implode(", ", $data_transfer) . "]";
          $labels_transfer_js = '["' . implode('", "', $sortedLabels) . '"]';
          ?>