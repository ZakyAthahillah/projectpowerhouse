  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah User<a href="?page=pengguna" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">


  				<div class="body">

  					<form method="POST" enctype="multipart/form-data">

  						<label for="">Nama</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="nama" class="form-control" />
  							</div>
  						</div>



  						<label for="">Username</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="username" class="form-control" />

  							</div>
  						</div>

  						<label for="">Password</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="password" name="password" class="form-control" />


  							</div>
  						</div>

  						<label for="">Level</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="level" class="form-control show-tick">
  									<option value="">-- Pilih Level --</option>
  									<option value="admin">Admin</option>
  									<option value="pegawai">Pegawai</option>
  									<option value="warehouse">Warehouse</option>
  									<option value="qc">Quality Control</option>

  								</select>
  							</div>
  						</div>

  						<label for="">Foto</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="file" name="foto" class="form-control" required />

  							</div>
  						</div>



  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

  					</form>


  					<?php

						if (isset($_POST['simpan'])) {
							$nama = $_POST['nama'];
							$username = $_POST['username'];
							$level = $_POST['level'];

							// Generate salted password hash
							$salt = "xgsuahkgfbioqy789p12640y98uio190836";
							$passwordsalt = $_POST['password'] . $salt;
							$password = md5($passwordsalt);

							$foto = $_FILES['foto']['name'];
							$lokasi = $_FILES['foto']['tmp_name'];

			
							
							if ($koneksi->connect_error) {
								die("Connection failed: " . $koneksi->connect_error);
							}

							
							$koneksi->autocommit(false);

							try {
								
								$upload = move_uploaded_file($lokasi, "../img/" . $foto);

								if ($upload) {
									
									$sql = "INSERT INTO users (nama, username, password, level, foto) VALUES (?, ?, ?, ?, ?)";
									$stmt = $koneksi->prepare($sql);
									$stmt->bind_param("sssss", $nama, $username, $password, $level, $foto);

									if ($stmt->execute()) {
										
										$koneksi->commit();
										echo "
										<script>
											Swal.fire({
												title: 'SUKSES!',
												text: 'Data Berhasil Disimpan',
												icon: 'success',
												confirmButtonText: 'OK'
											}).then(() => {
												window.location.href = '?page=pengguna';
											});
										</script>
										";
									} else {
										throw new Exception("Data Gagal Disimpan");
									}
								} else {
									throw new Exception("Gagal Mengunggah Gambar");
								}
							} catch (Exception $e) {
								
								$koneksi->rollback();
								echo "
									<script>
										Swal.fire({
											title: 'ERROR!',
											text: '" . $e->getMessage() . "',
											icon: 'error',
											confirmButtonText: 'OK'
										}).then(() => {
											window.location.href = '?page=pengguna';
										});
									</script>
									";
							} finally {
								
								$koneksi->autocommit(true);
								
								$koneksi->close();
							}
						}
						?>