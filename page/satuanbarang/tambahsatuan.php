  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Satuan Barang<a href="?page=satuanbarang" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">


  				<div class="body">

  					<form method="POST" enctype="multipart/form-data">


  						<label for="">Satuan Barang</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="satuan" class="form-control" />
  							</div>
  						</div>



  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

  					</form>




  					<?php

						if (isset($_POST['simpan'])) {
							$satuan = $_POST['satuan'];





							$sql = $koneksi->query("insert into satuan (satuan) values('$satuan')");

							if ($sql) {
								echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Disimpan',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=satuanbarang';
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
									window.location.href = '?page=satuanbarang';
								});
							</script>
							";
							}
						}


						?>