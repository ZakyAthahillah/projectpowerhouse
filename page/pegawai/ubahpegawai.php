<?php
$id = $_GET['id_pegawai'];
$sql2 = $koneksi->query("select * from pegawai where id_pegawai = '$id'");
$tampil = $sql2->fetch_assoc();
$nama = $tampil['nama_pegawai'];
$bagian = $tampil['bagian'];
?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah Data Pegawai<a href="?page=pegawai" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">

						<label for="">NIK</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" maxlength="16" name="nik" value="<?php echo $tampil['nik']; ?>" class="form-control" />
							</div>
						</div>

						<label for="">Nama</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama" value="<?php echo $tampil['nama_pegawai']; ?>" class="form-control" />

							</div>
						</div>

						<label for="">Bagian</label>
						<div class="form-group">
							<div class="form-line">
								<select name="bagian" class="form-control show-tick">
									<option <?php if ($bagian == "Foreman Mechanical") echo 'selected'; ?> value="Foreman Mechanical">Foreman Mechanical</option>
									<option <?php if ($bagian == "Foreman Electrical") echo 'selected'; ?> value="Foreman Electrical">Foreman Electrical</option>
									<option <?php if ($bagian == "Helper Mechanical") echo 'selected'; ?> value="Helper Mechanical">Helper Mechanical</option>
									<option <?php if ($bagian == "Operator Control Room") echo 'selected'; ?> value="Operator Control Room">Operator Control Room</option>
									<option <?php if ($bagian == "Assistant Foreman Electrical") echo 'selected'; ?> value="Assistant Foreman Electrical">Assistant Foreman Electrical</option>
									<option <?php if ($bagian == "Foreman Control Room") echo 'selected'; ?> value="Foreman Control Room">Foreman Control Room</option>
								</select>
							</div>
						</div>

						<label for="">Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="telepon" value="<?php echo $tampil['telepon']; ?>" class="form-control" />
							</div>
						</div>

						<label for="">Alamat</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="alamat" value="<?php echo $tampil['alamat']; ?>" class="form-control" />
							</div>
						</div>




						<label for="">Foto</label>
						<div class="form-group">
							<div class="form-line">
								<img src="../img/<?php echo $tampil['foto']; ?> " width="50" height="50" alt="">

							</div>
						</div>


						<label for="">Ganti Foto</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" name="foto" class="form-control" />

							</div>
						</div>



						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

					</form>



					<?php

					if (isset($_POST['simpan'])) {

						$nik = $_POST['nik'];
						$nama = $_POST['nama'];
						$bagian = $_POST['bagian'];
						$telepon = $_POST['telepon'];
						$alamat = $_POST['alamat'];
						$foto = $_FILES['foto']['name'];
						$lokasi = $_FILES['foto']['tmp_name'];

						if (!empty($lokasi)) {
							$upload = move_uploaded_file($lokasi, "../img/" . $foto);



							$sql = $koneksi->query("update pegawai set nik='$nik', nama_pegawai='$nama', bagian='$bagian', telepon='$telepon', alamat='$alamat', foto='$foto' where id_pegawai='$id'");

							if ($sql) {
								echo "
								<script>
									Swal.fire({
										title: 'SUKSES!',
										text: 'Data Berhasil Diubah',
										icon: 'success',
										confirmButtonText: 'OK'
									}).then(() => {
										window.location.href = '?page=pegawai';
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
										window.location.href = '?page=pegawai';
									});
								</script>
								";
							}
						} else {

							$sql = $koneksi->query("update pegawai set nik='$nik', nama_pegawai='$nama', bagian='$bagian', telepon='$telepon', alamat='$alamat' where id_pegawai='$id'");

							if ($sql) {
								echo "
								<script>
									Swal.fire({
										title: 'SUKSES!',
										text: 'Data Berhasil Diubah',
										icon: 'success',
										confirmButtonText: 'OK'
									}).then(() => {
										window.location.href = '?page=pegawai';
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
										window.location.href = '?page=pegawai';
									});
								</script>
								";
							}
						}
					}
					?>