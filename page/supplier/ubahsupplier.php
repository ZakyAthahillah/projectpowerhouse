<?php
$id = $_GET['id_supplier'];
$sql2 = $koneksi->query("select * from tb_supplier where id_supplier = '$id'");
$tampil = $sql2->fetch_assoc();

?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah Supplier<a href="?page=supplier" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">

						<label for="">Kode Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_supplier" value="<?php echo $tampil['kode_supplier']; ?>" class="form-control" />

							</div>
						</div>

						<label for="">Nama Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_supplier" value="<?php echo $tampil['nama_supplier']; ?>" class="form-control" />

							</div>
						</div>

						<label for="">Alamat</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="alamat" value="<?php echo $tampil['alamat']; ?>" class="form-control" />

							</div>
						</div>

						<label for="">Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="telepon" value="<?php echo $tampil['telepon']; ?>" class="form-control" />

							</div>
						</div>






						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

					</form>



					<?php

					if (isset($_POST['simpan'])) {

						$kode_supplier = $_POST['kode_supplier'];
						$nama_supplier = $_POST['nama_supplier'];
						$alamat = $_POST['alamat'];
						$telepon = $_POST['telepon'];


						$sql = $koneksi->query("update tb_supplier set kode_supplier='$kode_supplier', nama_supplier='$nama_supplier', alamat='$alamat', telepon='$telepon' where id_supplier='$id'");

						if ($sql) {
							echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Diubah',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=supplier';
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
									window.location.href = '?page=supplier';
								});
							</script>
							";
						}
					}



					?>