<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();



$koneksi = new mysqli("localhost", "root", "", "inventori");

if (empty($_SESSION['superadmin'])) {

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

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- select2 -->
  <link rel="stylesheet" href="../select2/css/dist/css/select2.min.css">
  <link rel="stylesheet" href="../select2/css/dist/css/select2-bootstrap4.min.css">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index/index_superadmin.php">
        <div class="">
          <img src="../img/bayan.png" alt="" height="50px" width="50px" style="border-radius:15px;">
        </div>
        <div class="sidebar-brand-text mx-2"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <?php
      if ($_SESSION['superadmin']) {
        $user = $_SESSION['superadmin'];
      }
      $sql = $koneksi->query("select * from users where id='$user'");
      $data = $sql->fetch_assoc();
      ?>





      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="?page=home_superadmin">
          <i class="fas fa-fw fa-home"></i>
          <span>DASHBOARD</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Nav Item - Pages Collapse Menu -->


      <li class="nav-item active">
        <a class="nav-link" href="?page=pengguna">
          <i class="fas fa-fw fa-users"></i>
          <span>DATA USER</span></a>
      </li>


      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData" aria-expanded="true" aria-controls="collapseData">
          <i class="fas fa-fw fa-folder"></i>
          <span>DATA POWERHOUSE</span>
        </a>
        <div id="collapseData" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="?page=gudang">Data Barang</a>
            <a class="collapse-item" href="?page=jenisbarang">Jenis Barang</a>
            <a class="collapse-item" href="?page=satuanbarang">Satuan Barang</a>
            <a class="collapse-item" href="?page=supplier">Data Supplier</a>
            <a class="collapse-item" href="?page=lokasibarang">Lokasi Barang</a>
            <a class="collapse-item" href="?page=pegawai">Data Pegawai</a>
          </div>
        </div>
      </li>



      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>IN/OUT BARANG</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="?page=barangmasuk">Barang Masuk/Kembali</a>
            <a class="collapse-item" href="?page=barangkeluar">Barang Keluar</a>
            <a class="collapse-item" href="?page=pegawair">Laporan Penerima Barang</a>
          </div>
        </div>
      </li>


      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
          <i class="fas fa-fw fa-folder"></i>
          <span>LAPORAN</span>
        </a>
        <div id="collapseLaporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu :</h6>
            <a class="collapse-item" href="?page=laporan_gudang">Laporan Stok Gudang</a>
            <a class="collapse-item" href="?page=laporan_barangmasuk">Laporan Barang Masuk</a>
            <a class="collapse-item" href="?page=laporan_barangkeluar">Laporan Barang Keluar</a>
            <a class="collapse-item" href="?page=pegawair">Laporan Penerima Barang</a>
          </div>
        </div>
      </li>



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
                <span class="mr-2 d-none d-lg-inline text-light small "><?php echo  $data['nama']; ?></span>
                <img class="img-profile rounded-circle" src="../img/<?php echo $data['foto'] ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid ">

          <section class="content">
          <?php include "../routes/routes_superadmin.php"?>
          </section>


        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; 2022</span>
            </div>
          </div>
        </footer>
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

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

  <!--script for this page-->
  <script>
    jQuery(document).ready(function($) {
      $('#select_barang').change(function() { // Jika Select Box id provinsi dipilih
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
      $('#select_barang').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'page/barangmasuk/get_satuan.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung1').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>


  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(function() {
        $('#Myform1').submit(function() {
          $.ajax({
            type: 'POST',
            url: 'page/laporan/export_laporan_barangmasuk_excel.php',
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
            url: 'page/laporan/export_laporan_barangkeluar_excel.php',
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

  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(function() {
        $('#Myform2').submit(function() {
          $.ajax({
            type: 'POST',
            url: 'page/laporan/export_laporan_solarkeluar_excel.php',
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

  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(function() {
        $('#Myform2').submit(function() {
          $.ajax({
            type: 'POST',
            url: 'page/laporan/export_laporan_solarmasuk_excel.php',
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


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="../select2/js/select2.min.js"></script>

  <script>
    $("#select_pegawai,#select_barang,#select_suplier,#select_lokasi").select2({
      theme: 'bootstrap4',
      placeholder: "- Pilih -"
    });
  </script>





</body>

</html>