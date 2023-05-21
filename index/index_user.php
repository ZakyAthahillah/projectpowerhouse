<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();



$koneksi = new mysqli("localhost", "root", "", "inventori");

if (empty($_SESSION['petugas'])) {

  header("location:login.php");
}





?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Inventaris Barang</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">


  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- select2 -->
  <link rel="stylesheet" href="../select2/css/dist/css/select2.min.css">
  <link rel="stylesheet" href="../select2/css/dist/css/select2-bootstrap4.min.css">

  <!-- CHART -->
  <script src="../vendor/chart.js/Chart.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index2.php">
        <div class="">
          <img src="../img/bayan.png" alt="" height="50px" width="50px" style="border-radius:15px;">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <?php
      if ($_SESSION['petugas']) {
        $user = $_SESSION['petugas'];
      }
      $sql = $koneksi->query("select * from users where id='$user'");
      $data = $sql->fetch_assoc();
      ?>



      <!--sidebar start-->

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="?page=home_user">
          <i class="fas fa-fw fa-home"></i>
          <span>DASHBOARD</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->

      <li class="nav-item active">
        <a class="nav-link" href="?page=gudang">
          <i class="fas fa-fw fa-window-close"></i>
          <span>DATA BARANG</span>
        </a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="?page=laporan_gudang">
          <i class="fas fa-fw fa-window-close"></i>
          <span>LAPORAN DATA BARANG</span>
        </a>
      </li>


      <!-- Heading -->



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-gray-900 topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-light small"><?php echo  $data['nama']; ?></span>
                <img class="img-profile rounded-circle" src="../img/<?php echo $data['foto'] ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a onclick="return confirm('Apakah anda yakin akan logout?')" class="dropdown-item logout" href="../logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>


        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <section class="content">

            <?php include "../routes/routes_user.php" ?>


          </section>


        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
       
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda Yakin?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik tombol "LOGOUT" di bawah jika anda yakin untuk logout!</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>


  <!--script for this page-->
  <script>
    jQuery(document).ready(function($) {
      $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'page/barangmasuk/get_barang.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>

  <script>
    jQuery(document).ready(function($) {
      $('#cmb_barang').change(function() { // Jika Select Box id  dipilih
        var tamp = $(this).val(); // Ciptakan variabel 
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'page/barangmasuk/get_satuan.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung1').html(data); // Berikan hasil ke id 
          }


        });
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="../select2/js/select2.min.js"></script>

  <script>
    $("#select_pegawai,#select_barang,#select_suplier,#select_lokasi,#select_satuan,#select_jenis").select2({
      theme: 'bootstrap4',
      placeholder: "- Pilih -"
    });
  </script>


</body>

</html>