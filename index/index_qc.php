<?php
require('../fpdf/fpdf.php');
include '../koneksi.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

session_start();
if (!isset($_SESSION['qc'])) {
  header("location:../login.php");
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

  <title>POWERHOUSE APP</title>

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  <!-- SWEET ALERT 2 -->
  <script src="../vendor/sweetalert2/sweetalert2.min.js"></script>

  <!-- LEAFLET JS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  
  <link rel="stylesheet" href="../vendor/sweetalert2/sweetalert2.min.css" id="theme-styles">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav  bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_qc.php">
        <div class="">
          <img src="../img/bayan.png" alt="" height="50px" width="50px" style="border-radius:15px;">
        </div>
        <div class="sidebar-brand-text mx-2"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <?php
      if ($_SESSION['qc']) {
        $user = $_SESSION['qc'];
      }
      $sql = $koneksi->query("select * from users where id_users='$user'");
      $data = $sql->fetch_assoc();
      $id_users = $data['id_users'];
      ?>

      <!--sidebar start-->
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="?page=home_qc">
          <i class="fas fa-fw fa-home"></i>
          <span>DASHBOARD</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <hr class="sidebar-divider d-none d-md-block">
      <div class="sidebar-heading text-light">
        PRODUKSI BATUBARA
      </div>


      <li class="nav-item active">
        <a class="nav-link" href="?page=stokcoaljty">
          <i class="fas fa-fw fa-industry"></i>
          <span>STOCK COAL JETTY</span>
        </a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="?page=stokcoalicf">
          <i class="fas fa-fw fa-industry"></i>
          <span>STOCK COAL ICF</span>
        </a>
      </li>


      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlending" aria-expanded="true" aria-controls="collapseBlending">
          <i class="fas fa-fw fa-folder"></i>
          <span>BLENDING</span>
        </a>
        <div id="collapseBlending" class="collapse" aria-labelledby="headingBlending" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header text-dark">Menu:</h6>
            <a class="collapse-item" href="?page=sbp">SBP</a>
            <a class="collapse-item" href="?page=blending">Data Blending</a>
          </div>
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="?page=loading">
          <i class="fas fa-fw fa-industry"></i>
          <span>LOADING</span>
        </a>
      </li>



      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLapPB" aria-expanded="true" aria-controls="collapseLapPB">
          <i class="fas fa-fw fa-folder"></i>
          <span>LAPORAN</span>
        </a>
        <div id="collapseLapPB" class="collapse" aria-labelledby="headingLapPB" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header text-dark">Menu:</h6>
            <a class="collapse-item" href="?page=laporan_stockcoaljty">Laporan Stock Coal Jetty</a>
            <a class="collapse-item" href="?page=laporan_stockcoalicf">Laporan Stock Coal ICF</a>
            <a class="collapse-item" href="?page=laporan_blending">Laporan Data Blending</a>
            <a class="collapse-item" href="?page=laporan_loading">Laporan Data Loading</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">

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
            <!-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-id-card"></i>
              </a>
            </li> -->

            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="?page=sbp" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" id="notification-counter">
              </a>
              <!-- Dropdown - Alerts -->
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-light small"><?php echo  $data['nama']; ?></span>
                <img class="img-profile rounded-circle" src="../img/<?php echo $data['foto'] ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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
            <?php include "../routes/routes_qc.php" ?>
          </section>


        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <!-- <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; 2022</span>
            </div>
          </div>
        </footer> -->
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
          <a class="btn btn-primary" href="../logout.php">Logout</a>
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

  <!-- COUNTER NOTIF SBP -->
  <script>
    $("#alertsDropdown").click(function() {
      window.location.href = "?page=sbp";
    });
  </script>

  <script>
    function fetchNotificationCount() {
      $.ajax({
        url: "../notification_count_handler.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
          var notificationCounterElement = $("#notification-counter");
          notificationCounterElement.text(data.count);
        },
        error: function() {
          console.log("Gagal mengambil data notifikasi.");
        }
      });
    }

    setInterval(fetchNotificationCount, 1000);
  </script>



  <!--SCRIPT GET BARANG-->
  <script>
    jQuery(document).ready(function($) {
      $('#select_barang').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: '../page/barangmasuk/get_barang.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>

  <!--SCRIPT GET RCJTY-->
  <script>
    jQuery(document).ready(function($) {
      $('#select_crushingjty,#select_transferjty,#select_loadingjty').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: '../page/crushingjty/get_rc.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>

  <!--SCRIPT GET RCICF-->
  <script>
    jQuery(document).ready(function($) {
      $('#select_crushingicf').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: '../page/crushingicf/get_rc.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>


  <!-- TRANSFER -->
  <script>
    jQuery(document).ready(function($) {
      $('#select_transferjty').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: '../page/transfer/get_rcjty.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung11').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>

  <script>
    jQuery(document).ready(function($) {
      $('#select_transfericf').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: '../page/transfer/get_rcicf.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung12').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>

  <!-- SCRIPT GET SATUAN  -->
  <script>
    jQuery(document).ready(function($) {
      $('#select_barang').change(function() { // Jika Select Box id  dipilih
        var tamp = $(this).val(); // Ciptakan variabel 
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: '../page/barangmasuk/get_satuan.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung1').html(data); // Berikan hasil ke id 
          }


        });
      });
    });
  </script>

  <!-- --------------------------------- -->

  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(function() {
        $('#Myform1').submit(function() {
          $.ajax({
            type: 'POST',
            url: '../page/laporan/export_laporan_barangmasuk_excel.php',
            data: $(this).serialize(),
            success: function(data) {
              $(".tampung1").html(data);
              $('.table').DataTable();

            }
          });

          return false;
          e.preventDefault();
        });
      });
    });
  </script>


  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(function() {
        $('#Myform2').submit(function() {
          $.ajax({
            type: 'POST',
            url: '../page/laporan/export_laporan_barangkeluar_excel.php',
            data: $(this).serialize(),
            success: function(data) {
              $(".tampung2").html(data);
              $('.table').DataTable();

            }
          });

          return false;
          e.preventDefault();
        });
      });
    });
  </script>



  <script src="../select2/js/select2.min.js"></script>

  <script>
    $("#select_pegawai,#select_barang,#select_suplier,#select_lokasi,#select_satuan,#select_jenis,#select_crushingjty,#select_crushingicf,#select_transfericf,#select_transferjty,#select_loadingjty,#select_bargejty,#item,#select_kodesbp,#select_dumptruck,#select_optht").select2({
      theme: 'bootstrap4',
      placeholder: "- Pilih -"
    });
  </script>

  <script>
    $(document).ready(function() {
      $('table.display').DataTable();
    });
  </script>


</body>

</html>