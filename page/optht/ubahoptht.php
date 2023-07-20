<?php
$id = $_GET['id_optht'];
$sql2 = $koneksi->query("select * from operatorht where id_optht = '$id'");
$tampil = $sql2->fetch_assoc();
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Operator Dump Truck<a href="?page=optht" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">


                        <label for="">Nama</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama" class="form-control" value="<?= $tampil['nama_optht']?>" />
                            </div>
                        </div>


                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>




                    <?php

                    if (isset($_POST['simpan'])) {

                        $nama_optht = $_POST['nama'];

                        $sql = $koneksi->query("update operatorht set nama_optht='$nama_optht' where id_optht='$id'");

                        if ($sql) {
                            echo "
                            <script>
                                Swal.fire({
                                    title: 'SUKSES!',
                                    text: 'Data Berhasil Diubah',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '?page=optht';
                                });
                            </script>
                            ";
                        } else {
                            echo "
                            <script>
                                Swal.fire({
                                    title: 'ERROR!',
                                    text: 'Data Gagal Diubah',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '?page=optht';
                                });
                            </script>
                            ";
                        }
                    }


                    ?>