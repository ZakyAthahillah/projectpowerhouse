<?php
$id_users = $_GET['id_users'];
$sql2 = $koneksi->query("select * from users where id_users = '$id_users'");
$tampil = $sql2->fetch_assoc();
$level = $tampil['level'];
?>

<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah User<a href="?page=pengguna" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Nama</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama" value="<?php echo $tampil['nama']; ?>" class="form-control" />
							</div>
						</div>
						<label for="">Username</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="username" value="<?php echo $tampil['username']; ?>" class="form-control" />
							</div>
						</div>
						<label for="">Password</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="password" placeholder="<?php echo $tampil['password']; ?>" class="form-control" />
							</div>
						</div>
						<label for="">Level</label>
						<div class="form-group">
							<div class="form-line">
								<select name="level" class="form-control show-tick" required>
									<option disabled>- pilih kategori -</option>
									<option <?php if ($level == "admin") echo 'selected'; ?> value="admin">Admin</option>
									<option <?php if ($level == "pegawai") echo 'selected'; ?> value="pegawai">Pegawai</option>
									<option <?php if ($level == "warehouse") echo 'selected'; ?> value="warehouse">Warehouse</option>
								</select>
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
						$nama = $_POST['nama'];
						$username = $_POST['username'];
						$level = $_POST['level'];
						$foto = $_FILES['foto']['name'];
						$lokasi = $_FILES['foto']['tmp_name'];

						if (!empty($_POST['password'])) {
							$salt = "xgsuahkgfbioqy789p12640y98uio190836";
							$passwordsalt = $_POST['password'] . $salt;
							$password = md5($passwordsalt);
						} else {
							$password = $tampil['password'];
						}

						$koneksi->autocommit(FALSE); // Memulai transaksi

						if (!empty($lokasi)) {
							$upload = move_uploaded_file($lokasi, "../img/" . $foto);
							$sql = $koneksi->query("UPDATE users SET nama='$nama', username='$username', password='$password', level='$level', foto='$foto' WHERE id_users='$id_users'");
						} else {
							$sql = $koneksi->query("UPDATE users SET username='$username', password='$password', nama='$nama', level='$level' WHERE id_users='$id_users'");
						}

						if ($sql) {
							$koneksi->commit(); // Melakukan commit jika semua query berhasil dieksekusi

								echo "
								<script>
									Swal.fire({
										title: 'SUKSES!',
										text: 'Data Berhasil Diubah',
										icon: 'success',
										confirmButtonText: 'OK'
									}).then(() => {
										window.location.href = '?page=pengguna';
									});
								</script>
								";
						} else {
							$koneksi->rollback(); // Mengembalikan transaksi jika terjadi kesalahan
							echo "
								<script>
									Swal.fire({
										title: 'ERROR!',
										text: 'Data Gagal Diubah',
										icon: 'error',
										confirmButtonText: 'OK'
									}).then(() => {
										window.location.href = '?page=pengguna';
									});
								</script>
								";
						}
					}
					?>

				</div>
			</div>
		</div>
	</div>
</div>