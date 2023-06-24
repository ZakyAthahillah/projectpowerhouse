  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Lokasi Barang<a href="?page=lokasibarang" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">


  				<div class="body">

  					<form method="POST" enctype="multipart/form-data">


  						<label for="">Lokasi Barang</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="lokasi" class="form-control" />
  							</div>
  						</div>



  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

  					</form>




  					<?php

						if (isset($_POST['simpan'])) {
							$lokasi = $_POST['lokasi'];





							$sql = $koneksi->query("insert into lokasi (lokasi) values('$lokasi')");

							if ($sql) {
								echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Disimpan',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=lokasibarang';
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
									window.location.href = '?page=lokasibarang';
								});
							</script>
							";
							}
						}


						?>