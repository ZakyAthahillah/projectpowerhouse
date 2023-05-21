  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Data Pegawai<a href="?page=pegawai" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">


  				<div class="body">

  					<label for="">NIK</label>
  					<div class="form-group">
  						<div class="form-line">
  							<input type="text" maxlength="16"  name="nik" class="form-control"  required/>
  						</div>
  					</div>

  					<form method="POST" enctype="multipart/form-data">
  						<label for="">Nama</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="nama" class="form-control" />
  							</div>
  						</div>

  						<label for="">Bagian</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="bagian" class="form-control show-tick">
  									<option value="">-- Pilih Bagian --</option>
  									<option value="Foreman Mechanical">Foreman Mechanical</option>
  									<option value="Foreman Electrical">Foreman Electrical</option>
  									<option value="Helper Mechanical">Helper Mechanical</option>
  									<option value="Operator Control Room">Operator Control Room</option>
  									<option value="Assistant Foreman Electrical">Assistant Foreman Electrical</option>
  									<option value="Foreman Mechanical">Foreman Control Room</option>
  								</select>
  							</div>
  						</div>

  						<label for="">Telepon</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="number" name="telepon" class="form-control" />
  							</div>
  						</div>

  						<label for="">Alamat</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="alamat" class="form-control" />
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
							$nik = $_POST['nik'];
							$bagian = $_POST['bagian'];
							$telepon = $_POST['telepon'];
							$alamat = $_POST['alamat'];

							$foto = $_FILES['foto']['name'];
							$lokasi = $_FILES['foto']['tmp_name'];
							$upload = move_uploaded_file($lokasi, "../img/" . $foto);

							if ($upload) {

								$sql = $koneksi->query("insert into pegawai (nik, nama, bagian, telepon, alamat, foto) values('$nik', '$nama', '$bagian', '$telepon', '$alamat', '$foto')");

								if ($sql) {
						?>

  								<script type="text/javascript">
  									alert("Data Berhasil Disimpan");
  									window.location.href = "?page=pegawai";
  								</script>

  					<?php
								}
							}
						}
						?>