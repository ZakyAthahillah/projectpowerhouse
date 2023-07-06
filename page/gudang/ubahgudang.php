<?php
$kode_barang = $_GET['kode_barang'];
$sql2 = $koneksi->query("select * from gudang where kode_barang = '$kode_barang'");
$tampil = $sql2->fetch_assoc();
$idlokasi = $tampil['id_lokasi'];
$idsatuan = $tampil['id_satuan'];
$idjenis = $tampil['id_jenis'];
$level = $tampil['level'];

?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah Data Barang<a href="?page=gudang" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">

						<label for="">Kode Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?php echo $tampil['kode_barang']; ?>" readonly />
							</div>
						</div>


						<label for="">Nama Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_barang" value="<?php echo $tampil['nama_barang']; ?>" class="form-control" />
							</div>
						</div>



						<label for="">Jenis Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="jenis_barang" class="form-control" id="select_jenis">

									<?php
									$jenisselect = mysqli_query($koneksi, "select * from jenis_barang where id_jenis = $idjenis");
									$selectedOption = "";

									while ($tampiljenis = mysqli_fetch_assoc($jenisselect)) {
										$selectedOption = $tampiljenis['id_jenis'];
										echo "<option value='$tampiljenis[id_jenis]' selected>$tampiljenis[jenis_barang]</option>";
									}

									$sql = $koneksi->query("select * from jenis_barang where id_jenis != $selectedOption order by id_jenis");

									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_jenis]'>$data[jenis_barang]</option>";
									}
									?>

								</select>
							</div>
						</div>






						<label for="">Satuan Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="satuan" class="form-control" id="select_satuan">
									<?php
									$satuanselect = mysqli_query($koneksi, "select * from satuan where id_satuan = $idsatuan");
									$selectedSatuan = "";

									while ($tampilsatuan = mysqli_fetch_assoc($satuanselect)) {
										$selectedSatuan = $tampilsatuan['id_satuan'];
										echo "<option value='$tampilsatuan[id_satuan]' selected>$tampilsatuan[satuan]</option>";
									}

									$sql = $koneksi->query("select * from satuan where id_satuan != $selectedSatuan order by id_satuan");

									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_satuan]'>$data[satuan]</option>";
									}
									?>
								</select>
							</div>
						</div>

						<label for="">Lokasi Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="lokasi" id="select_lokasi" class="form-control" value="">
									<?php
									$lokasiselect = mysqli_query($koneksi, "select * from lokasi where id_lokasi = $idlokasi");
									$selectedLokasi = "";

									while ($tampillokasi = mysqli_fetch_assoc($lokasiselect)) {
										$selectedLokasi = $tampillokasi['id_lokasi'];
										echo "<option value='$tampillokasi[id_lokasi]' selected>$tampillokasi[lokasi]</option>";
									}

									$sql = $koneksi->query("select * from lokasi where id_lokasi != $selectedLokasi order by id_lokasi");

									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_lokasi]'>$data[lokasi]</option>";
									}
									?>
								</select>
							</div>
						</div>



						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

					</form>



					<?php

					if (isset($_POST['simpan'])) {

						$kode_barang = $_POST['kode_barang'];
						$nama_barang = $_POST['nama_barang'];


						$jenis_barang = $_POST['jenis_barang'];



						$satuan = $_POST['satuan'];


						$lokasi = $_POST['lokasi'];



						$sql = $koneksi->query("update gudang set kode_barang='$kode_barang', nama_barang='$nama_barang', id_jenis='$jenis_barang', id_satuan='$satuan', id_lokasi='$lokasi' where kode_barang='$kode_barang'");

						if ($sql) {
							echo "
						<script>
							Swal.fire({
								title: 'SUKSES!',
								text: 'Data Berhasil Diubah',
								icon: 'success',
								confirmButtonText: 'OK'
							}).then(() => {
								window.location.href = '?page=gudang';
							});
						</script>
						";
						}
					}
					?>