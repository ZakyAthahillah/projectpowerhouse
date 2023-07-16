<?php
$id = $_GET['id_rcjty'];
$sql2 = $koneksi->query("select * from scjty where id_rcjty = '$id'");
$tampil = $sql2->fetch_assoc();

?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah RC Jetty<a href="?page=stokcoaljty" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">

                        <label for="">Nama RC</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_rcjty" value="<?php echo $tampil['nama_rcjty']; ?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Warna</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="warna" value="<?php echo $tampil['warna']; ?>" class="form-control" />
                            </div>
                        </div>



                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>



                    <?php

                    if (isset($_POST['simpan'])) {

                        $nama_rcjty = $_POST['nama_rcjty'];
                        $warna = $_POST['warna'];




                        $sql = $koneksi->query("update scjty set nama_rcjty='$nama_rcjty', warna='$warna' where id_rcjty='$id'");

                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Diubah',
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
									text: 'Data Gagal Diubah',
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