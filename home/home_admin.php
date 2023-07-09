<br>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
          </div> -->

  <h1 class="text-primary text-center">POWERHOUSE APP <?= $_SESSION['id_users']?></h1>

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
              <i class="fas fa-arrow-right fa-2x text-primary"></i>
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
          <h6 class="m-0 font-weight-bold text-primary"><a href="?page=stokcoaljty">Stock Coal Jetty</a></h6>
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
          <h6 class="m-0 font-weight-bold text-primary"><a href="?page=stokcoalicf">Stock Coal ICF</a></h6>
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

  <div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Coal <a href="?page=transfer">Transfer</a> and <a href="?page=loading">Loading</a> Chart Per Year</h6>
        </div>
        <div class="card-body">
          <div>
            <?php
            // Mendapatkan tahun awal dan tahun akhir dari tabel loading
            $sqlMinMaxYear = "SELECT MIN(YEAR(tanggal)) AS min_year, MAX(YEAR(tanggal)) AS max_year FROM loading";
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
            $result_loading = $koneksi->query($sql_loading);
            if ($result_loading->num_rows > 0) {
              while ($row = $result_loading->fetch_assoc()) {
                $bulan = date("M", mktime(0, 0, 0, $row['bulan'], 1));
                $tahun = $row['tahun'];
                $labels_loading[$tahun][] = $bulan; // Menyimpan bulan dalam array berdasarkan tahun
                $data_loading[$tahun . ' ' . $bulan] = $row['total_jumlah'];
              }
            }

            // Mendapatkan tahun awal dan tahun akhir dari tabel transfer
            $sqlMinMaxYearTransfer = "SELECT MIN(YEAR(tanggal)) AS min_year, MAX(YEAR(tanggal)) AS max_year FROM transfer";
            $resultMinMaxYearTransfer = $koneksi->query($sqlMinMaxYearTransfer);
            if ($resultMinMaxYearTransfer->num_rows > 0) {
              $rowMinMaxYearTransfer = $resultMinMaxYearTransfer->fetch_assoc();
              $minYearTransfer = $rowMinMaxYearTransfer['min_year'];
              $maxYearTransfer = $rowMinMaxYearTransfer['max_year'];
            } else {
              $minYearTransfer = date('Y'); // Tahun saat ini jika tidak ada data
              $maxYearTransfer = date('Y');
            }

            $data_transfer = array();
            $labels_transfer = array();
            $sql_transfer = "SELECT MONTH(tanggal) AS bulan, YEAR(tanggal) AS tahun, SUM(jumlah) AS total_jumlah FROM transfer WHERE YEAR(tanggal) BETWEEN $selectedMinYear AND $selectedMaxYear AND catatan = 'Selesai' GROUP BY bulan, tahun ORDER BY tahun, bulan";
            $result_transfer = $koneksi->query($sql_transfer);
            if ($result_transfer->num_rows > 0) {
              while ($row = $result_transfer->fetch_assoc()) {
                $bulan = date("M", mktime(0, 0, 0, $row['bulan'], 1));
                $tahun = $row['tahun'];
                $labels_transfer[$tahun][] = $bulan; // Menyimpan bulan dalam array berdasarkan tahun
                $data_transfer[$tahun . ' ' . $bulan] = $row['total_jumlah'];
              }
            }

            // Mengurutkan tahun secara descending untuk data loading
            ksort($labels_loading);

            // Menggabungkan tahun dan bulan untuk label loading
            $sortedLabelsLoading = array();
            foreach ($labels_loading as $tahun => $bulanArr) {
              foreach ($bulanArr as $bulan) {
                $sortedLabelsLoading[] = $bulan . ' ' . $tahun;
              }
            }

            // Konversi data dan labels loading menjadi format yang sesuai untuk JavaScript
            $data_loading_js = "[" . implode(", ", $data_loading) . "]";
            $labels_loading_js = '["' . implode('", "', $sortedLabelsLoading) . '"]';

            // Mengurutkan tahun secara descending untuk data transfer
            ksort($labels_transfer);

            // Menggabungkan tahun dan bulan untuk label transfer
            $sortedLabelsTransfer = array();
            foreach ($labels_transfer as $tahun => $bulanArr) {
              foreach ($bulanArr as $bulan) {
                $sortedLabelsTransfer[] = $bulan . ' ' . $tahun;
              }
            }

            // Konversi data dan labels transfer menjadi format yang sesuai untuk JavaScript
            $data_transfer_js = "[" . implode(", ", $data_transfer) . "]";
            $labels_transfer_js = '["' . implode('", "', $sortedLabelsTransfer) . '"]';
            ?>

            <!-- Tempatkan script PHP di atas form HTML -->
            <form method="POST" action="#transferloadingChart">
              <div class="form-group row">
                <label for="min_year" class="col-sm-2 col-form-label">Tahun Awal:</label>
                <div class="col-sm-4">
                  <select name="min_year" id="min_year" class="form-control">
                    <?php
                    for ($year = $minYear; $year <= $maxYear; $year++) {
                      $selected = ($year == $selectedMinYear) ? 'selected' : '';
                      echo "<option value=\"$year\" $selected>$year</option>";
                    }
                    ?>
                  </select>
                </div>
                <label for="max_year" class="col-sm-2 col-form-label">Tahun Akhir:</label>
                <div class="col-sm-4">
                  <select name="max_year" id="max_year" class="form-control">
                    <?php
                    for ($year = $minYear; $year <= $maxYear; $year++) {
                      $selected = ($year == $selectedMaxYear) ? 'selected' : '';
                      echo "<option value=\"$year\" $selected>$year</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                  <button type="submit" name="submit" class="btn btn-primary">Tampilkan</button>
                </div>
              </div>
            </form>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area">
              <canvas id="transferloadingChart"></canvas>
            </div>
          </div>
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


<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return:'1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }

  // Area Chart Example
  var ctx = document.getElementById("transferloadingChart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo $labels_loading_js; ?>, // Gunakan labels_loading_js sebagai nilai labels untuk data loading
      datasets: [{
          label: "Coal Loading",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: <?php echo $data_loading_js; ?>,
        },
        {
          label: "Coal Transfer ICF To Jetty",
          lineTension: 0.3,
          backgroundColor: "rgba(255, 99, 132, 0.05)", // Warna latar belakang
          borderColor: "rgba(255, 99, 132, 1)", // Warna garis
          pointRadius: 3,
          pointBackgroundColor: "rgba(255, 99, 132, 1)", // Warna titik
          pointBorderColor: "rgba(255, 99, 132, 1)", // Warna tepi titik
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(255, 99, 132, 1)", // Warna latar belakang titik saat dihover
          pointHoverBorderColor: "rgba(255, 99, 132, 1)", // Warna tepi titik saat dihover
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: <?php echo $data_transfer_js; ?>, // Gunakan data_transfer_js untuk data transfer
        }
      ],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 7
          }
        }],
        yAxes: [{
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return number_format(value);
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: true
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: true,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
          }
        }
      }
    }
  });
</script>