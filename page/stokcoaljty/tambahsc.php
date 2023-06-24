<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah RC<a href="?page=stokcoaljty" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">


                        <label for="">RC</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_rcjty" class="form-control" />
                            </div>
                        </div>

                        <label for="">Warna</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="warna" class="form-control" />
                            </div>
                        </div>

                        <label for="">Stock</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="stok" class="form-control" />
                            </div>
                        </div>



                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>




                    <?php

                    if (isset($_POST['simpan'])) {
                        $nama_rcjty = $_POST['nama_rcjty'];
                        $warna = $_POST['warna'];
                        $stok = $_POST['stok'];



                        $sql = $koneksi->query("insert into scjty (nama_rcjty, warna, stok) values('$nama_rcjty', '$warna', '$stok')");

                        if ($sql) {
                            echo "
                        <script>
                            Swal.fire({
                                title: 'SUKSES!',
                                text: 'Data Berhasil Disimpan',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '?page=stokcoaljty';
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
                                window.location.href = '?page=stokcoaljty';
                            });
                        </script>
                        ";
                        }
                    }


                    ?>