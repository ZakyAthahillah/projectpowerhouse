<br>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
          </div> -->
  <center>
    <h1 class="text-primary">POWERHOUSE INVENTORY CONTROL</h1>
  </center>
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
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">

                  </div>
                  <div class="col">

                  </div>
                </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-black-300"></i>
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
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">

                  </div>
                  <div class="col">

                  </div>
                </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-archive fa-2x text-black-300"></i>
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

            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-window-close fa-2x text-black-300"></i>
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
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                <h4>Barang Masuk</h4>
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hbm; ?> RIWAYAT</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-left fa-2x text-black-3000"></i>
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
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                <h4>Barang Keluar</h4>
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hbk; ?> RIWAYAT</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-right fa-2x text-black-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



</div>