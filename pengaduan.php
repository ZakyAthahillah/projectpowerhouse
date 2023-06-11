<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pengaduan</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary txt-center">Halaman Pengaduan User</h6>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">

                        <label for="">Tanggal</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="tanggal" class="form-control" />
                            </div>
                        </div>

                        <label for="">Nama</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama" class="form-control" />
                            </div>
                        </div>

                        <label for="">Posisi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="posisi" class="form-control" />
                            </div>
                        </div>

                        <label for="">Laporan</label>
                        <div class="form-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="laporan" rows="3" placeholder="Silahkan masukkan pengaduan disini"></textarea>
                        </div>

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>


</html>


<?php

if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $posisi = $_POST['posisi'];
    $laporan = $_POST['laporan'];

    $sql = mysqli_query($koneksi, "INSERT INTO pengaduan (tanggal, nama, posisi, laporan) VALUES('$tanggal', '$nama', '$posisi', '$laporan')");

    if ($sql) {
        echo '
        <div class="container"><span class="badge badge-success txt-center">Pengaduan berhasil dikirim ke admin</span></div>';
    } else {
        echo 'Gagal mengirim pengaduan';
    }
}



?>