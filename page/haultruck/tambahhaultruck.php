<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Haul Truck<a href="?page=haultruck" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">


                        <label for="">Nama Haul Truck</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_haultruck" class="form-control" />
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
                        $nama_haultruck = $_POST['nama_haultruck'];
                        $status = $_POST['status'];





                        $sql = $koneksi->query("insert into haultruck (nama_haultruck, status) values('$nama_haultruck', '$status')");

                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Disimpan',
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
									text: 'Data Gagal Disimpan',
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