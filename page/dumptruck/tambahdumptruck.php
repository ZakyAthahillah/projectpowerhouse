<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Dump Truck<a href="?page=dumptruck" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">


                        <label for="">Nama Dump Truck</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_dumptruck" class="form-control" />
                            </div>
                        </div>

                        <label for="">Status</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="status" id="select_status" class="form-control">
                                    <option value='<span class="badge badge-success">Baik</span>'>Baik</option>
                                    <option value='<span class="badge badge-warning">Maintenance</span>'>Maintenance</option>
                                </select>
                            </div>
                        </div>



                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>




                    <?php

                    if (isset($_POST['simpan'])) {
                        $nama_dumptruck = $_POST['nama_dumptruck'];
                        $status = $_POST['status'];





                        $sql = $koneksi->query("insert into dumptruck (nama_dumptruck, status) values('$nama_dumptruck', '$status')");

                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Disimpan',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=dumptruck';
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
									window.location.href = '?page=dumptruck';
								});
							</script>
							";
						}
                    }


                    ?>