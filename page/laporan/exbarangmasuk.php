<!doctype html>
<html class="no-js" lang="en">

<?php
include '../../koneksibarang.php';
?>

<html>

<head>
    <title>Laporan Barang Masuk</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../dataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script src="../../printasset/popper.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../printasset/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../../printasset/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../printasset/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="../../vendor/datatables/jquery.dataTables.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-144808195-1');
    </script>

</head>

<body>
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Masuk<a href="http://localhost/projectpowerhouse/index/index_admin.php?page=laporan_barangmasuk" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
            </div>
        </div>
        <div class="data-tables datatable-dark">
            <table class="display" id="dataTable3" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Id Transaksi</th>
                        <th>Tanggal Masuk</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Pengirim</th>
                        <th>Jumlah Masuk</th>
                        <th>Satuan Barang</th>
                        <th>Catatan</th>
                        <!--<th>Opsi</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $no = 1;
                    $sql = $koneksi->query("select * from barang_masuk 
                    inner join tb_supplier on barang_masuk.id_supplier = tb_supplier.id_supplier");
                    while ($data = $sql->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id_transaksi'] ?></td>
 								<td><?php echo $data['tanggal'] ?></td>
 								<td><?php echo $data['kode_barang'] ?></td>
 								<td><?php echo $data['nama_barang'] ?></td>
 								<td><?php echo $data['nama_supplier'] ?></td>
 								<td><?php echo $data['jumlah'] ?></td>
 								<td><?php echo $data['satuan'] ?></td>
 								<td><?php echo $data['catatan'] ?></td>


                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                ]
            });
        });
    </script>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> -->

    <script src="../../printasset/jquery-3.5.1.js"></script>
    <script src="../../printasset/jquery.dataTables.min.js"></script>
    <script src="../../printasset/dataTables.buttons.min.js"></script>
    <script src="../../printasset/buttons.flash.min.js"></script>
    <script src="../../printasset/jszip.min.js"></script>
    <script src="../../printasset/pdfmake.min.js"></script>
    <script src="../../printasset/vfs_fonts.js"></script>
    <script src="../../printasset/buttons.html5.min.js"></script>
    <script src="../../printasset/buttons.print.min.js"></script>



</body>

</html>