<br>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
          </div> -->
 
    <h1 class="text-primary text-center">POWERHOUSE APP</h1>
 
  <br></br>

  <!-- Content Row -->
  <?php
  $getu = mysqli_query($koneksi, "select * from users");
  $hgetu = mysqli_num_rows($getu)
  ?>
  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-bottom-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="?page=pengguna">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  <h4>Data User</h4>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hgetu; ?> USER</div>
                </div>
              </a>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <?php
    $getb = mysqli_query($koneksi, "select * from gudang");
    $hgetb = mysqli_num_rows($getb)
    ?>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-bottom-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="?page=gudang">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  <h4>Data Barang</h4>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hgetb; ?> BARANG</div>
                </div>
              </a>
            </div>
            <div class="col-auto">
              <i class="fas fa-archive fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-bottom-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="?page=oos">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  <h4>OUT OF STOCK</h4>
                  <?php
                  $get1 =  mysqli_query($koneksi, "select * from gudang where jumlah < 1");
                  $count = mysqli_num_rows($get1);
                  ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count; ?> BARANG</div>
                </div>
              </a>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-window-close fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">

    <?php
    $getbk = mysqli_query($koneksi, "SELECT * FROM barang_masuk");
    $hbm = mysqli_num_rows($getbk);
    ?>
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-bottom-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="?page=barangmasuk">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  <h4>Barang Masuk</h4>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hbm; ?> RIWAYAT</div>
              </a>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-left fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    $getbk = mysqli_query($koneksi, "SELECT * FROM barang_keluar");
    $hbk = mysqli_num_rows($getbk);
    ?>
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-bottom-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="?page=barangkeluar">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  <h4>Barang Keluar</h4>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hbk; ?> RIWAYAT</div>
              </a>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-right fa-2x primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-6 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Stockpile Jetty</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieChartjty"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Blue Crush
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Green Crush
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-warning"></i> Yellow Crush
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Stockpile ICF</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieCharticf"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Blue Crush
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Green Crush
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-warning"></i> Yellow Crush
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
$sqljty = "SELECT SUM(stok) AS total_stok, warna FROM scjty WHERE warna IN ('HIJAU', 'BIRU', 'KUNING') GROUP BY warna";
$resultjty = mysqli_query($koneksi, $sqljty);

// Inisialisasi variabel
$datajty = array();

// Loop untuk mengambil hasil query
while ($row = mysqli_fetch_assoc($resultjty)) {
  $datajty[$row['warna']] = $row['total_stok'];
}

// Konversi datajty menjadi array JavaScript
$hhjty = isset($datajty['HIJAU']) ? $datajty['HIJAU'] : 0;
$hbjty = isset($datajty['BIRU']) ? $datajty['BIRU'] : 0;
$hkjty = isset($datajty['KUNING']) ? $datajty['KUNING'] : 0;

?>

<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  var hh = <?php echo $hhjty; ?>;
  var hb = <?php echo $hbjty; ?>;
  var hk = <?php echo $hkjty; ?>;
  var ctx = document.getElementById("myPieChartjty");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Green", "Blue", "Yellow"],
      datasets: [{
        data: [hh, hb, hk],
        backgroundColor: ['#1cc88a', '#4e73df', '#ffff00'],
        hoverBackgroundColor: ['#1cc88a', '#4e73df', '#ffff00'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>



<?php
$sqlicf = "SELECT SUM(stok) AS total_stok, warna FROM scicf WHERE warna IN ('HIJAU', 'BIRU', 'KUNING') GROUP BY warna";
$resulticf = mysqli_query($koneksi, $sqlicf);

// Inisialisasi variabel
$dataicf = array();

// Loop untuk mengambil hasil query
while ($row = mysqli_fetch_assoc($resulticf)) {
  $dataicf[$row['warna']] = $row['total_stok'];
}

// Konversi dataicf menjadi array JavaScript
$hhicf = isset($dataicf['HIJAU']) ? $dataicf['HIJAU'] : 0;
$hbicf = isset($dataicf['BIRU']) ? $dataicf['BIRU'] : 0;
$hkicf = isset($dataicf['KUNING']) ? $dataicf['KUNING'] : 0;

?>

<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  var hh = <?php echo $hhicf; ?>;
  var hb = <?php echo $hbicf; ?>;
  var hk = <?php echo $hkicf; ?>;
  var ctx = document.getElementById("myPieCharticf");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Green", "Blue", "Yellow"],
      datasets: [{
        data: [hh, hb, hk],
        backgroundColor: ['#1cc88a', '#4e73df', '#ffff00'],
        hoverBackgroundColor: ['#1cc88a', '#4e73df', '#ffff00'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>