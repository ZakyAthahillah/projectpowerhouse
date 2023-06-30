<?php




$no = mysqli_query($koneksi, "select kode_barang from gudang order by kode_barang desc");
$kdbarang = mysqli_fetch_array($no);
$kode = $kdbarang['kode_barang'];


$urut = substr($kode, 8, 3);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");

if (strlen($tambah) == 1) {
	$format = "BAR-" . $bulan . $tahun . "00" . $tambah;
} else if (strlen($tambah) == 2) {
	$format = "BAR-" . $bulan . $tahun . "0" . $tambah;
} else {
	$format = "BAR-" . $bulan . $tahun . $tambah;
}



$jumlah = 0;

?>





<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Data Barang<a href="?page=gudang" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">

						<label for="">Kode Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_barang" class="form-control" id="kode_barang" />
							</div>
						</div>



						<label for="">Nama Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_barang" class="form-control" />
							</div>
						</div>

						<label for="">Jenis Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="jenis_barang" class="form-control" id="select_jenis" required>
									<option value="">-- Pilih Jenis Barang --</option>
									<?php

									$sql = $koneksi->query("select * from jenis_barang order by id_jenis");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_jenis]'>$data[jenis_barang]</option>";
									}
									?>
								</select>


							</div>
						</div>


						<label for="">Jumlah</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="jumlah" class="form-control" id="jumlah" />


							</div>
						</div>


						<label for="">Satuan Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="satuan" class="form-control" id="select_satuan" required>
									<option value="">-- Pilih Satuan Barang --</option>
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
								<select name="lokasi" id="select_lokasi" class="form-control" required>
									<option value="">-- Pilih Lokasi Barang --</option>
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

						$jumlah = $_POST['jumlah'];


						try {
							$sql = $koneksi->query("INSERT INTO gudang (kode_barang, nama_barang, id_jenis, jumlah, id_satuan, id_lokasi) VALUES ('$kode_barang', '$nama_barang', '$jenis_barang', '$jumlah', '$satuan', '$lokasi')");

							if ($sql) {
								echo "
									<script>
										Swal.fire({
											title: 'SUKSES!',
											text: 'Data Berhasil Disimpan',
											icon: 'success',
											confirmButtonText: 'OK'
										}).then(() => {
											window.location.href = '?page=gudang';
										});
									</script>
								";
							} else {
								echo "
									<script>
										Swal.fire({
											title: 'ERROR!',
											text: 'Data Gagal Disimpans',
											icon: 'error',
											confirmButtonText: 'OK'
										}).then(() => {
											window.location.href = '?page=gudang&aksi=tambahgudang';
										});
									</script>
								";
							}
						} catch (mysqli_sql_exception $e) {
							// Menampilkan pesan kesalahan
							echo "
								<script>
									Swal.fire({
										title: 'ERROR!',
										text: 'Terjadi kesalahan dalam menyimpan data',
										icon: 'error',
										confirmButtonText: 'OK'
									}).then(() => {
										window.location.href = '?page=gudang&aksi=tambahgudang';
									});
								</script>
							";
						}
					}


					?>