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
								<select name="jenis_barang" value="" class="form-control" />

								<?php
									$jenisselect = mysqli_query($koneksi, "select * from jenis_barang where id_jenis = $idjenis");
									while ($tampiljenis = mysqli_fetch_assoc($jenisselect)) {
										echo "<option value='$idjenis' selected>$tampiljenis[jenis_barang]</option>";
									}
								?>

								<?php

								$sql = $koneksi->query("select * from jenis_barang order by id_jenis");
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
								<select name="satuan" value="" class="form-control">
								<?php
									$satuanselect = mysqli_query($koneksi, "select * from satuan where id_satuan = $idsatuan");
									while ($tampilsatuan = mysqli_fetch_assoc($satuanselect)) {
										echo "<option value='$idsatuan' selected>$tampilsatuan[satuan]</option>";
									}
								?>
									<?php

									$sql = $koneksi->query("select * from satuan order by id_satuan");
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
									while ($tampillokasi = mysqli_fetch_assoc($lokasiselect)) {
										echo "<option value='$idlokasi' selected>$tampillokasi[lokasi]</option>";
									}
									?>
									<?php

									$sql = $koneksi->query("select * from lokasi order by id_lokasi");
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