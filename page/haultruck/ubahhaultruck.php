<?php
$id = $_GET['id_haultruck'];
$sql2 = $koneksi->query("select * from haultruck where id_haultruck = '$id'");
$tampil = $sql2->fetch_assoc();
$status = $tampil['status'];






?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Haul Truck<a href="?page=haultruck" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">

                        <label for="">Nama haultruck</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_haultruck" value="<?php echo $tampil['nama_haultruck']; ?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Status</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="status" id="select_status" class="form-control">
                                    <option <?php if ($status == '<span class="badge badge-success">Baik</span>') echo 'selected'; ?> value='<span class="badge badge-success">Baik</span>'>Baik</option>
                                    <option <?php if ($status == '<span class="badge badge-warning">Maintenance</span>') echo 'selected'; ?> value='<span class="badge badge-warning">Maintenance</span>'>Maintenance</option>
                                </select>
                            </div>
                        </div>


                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>



                    <?php

                    if (isset($_POST['simpan'])) {

                        $nama_haultruck = $_POST['nama_haultruck'];
                        $status = $_POST['status'];




                        $sql = $koneksi->query("update haultruck set nama_haultruck='$nama_haultruck', status='$status' where id_haultruck='$id'");

                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Diubah',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=haultruck';
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
									window.location.href = '?page=haultruck';
								});
							</script>
							";
                        }
                    }


                    ?>