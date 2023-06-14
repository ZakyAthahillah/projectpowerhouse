  <script>
  	function sum() {
  		var stok = document.getElementById('stok').value;
  		var jumlahkeluar = document.getElementById('jumlahkeluar').value;
  		var result = parseInt(stok) - parseInt(jumlahkeluar);
  		if (!isNaN(result)) {
  			document.getElementById('total').value = result;
  		}
  	}
  </script>

  <?php

	$koneksi = new mysqli("localhost", "root", "", "inventori");
	$no = mysqli_query($koneksi, "select id_transaksi from barang_keluar order by id_transaksi desc");
	$idtran = mysqli_fetch_array($no);
	$kode = $idtran['id_transaksi'];


	$urut = substr($kode, 13, 5);
	$tambah = (int) $urut + 1;
	$hari = date("d");
	$bulan = date("m");
	$tahun = date("y");

	if (strlen($tambah) == 1) {
		$format = "WBM-BK-" . $hari . $bulan . $tahun . "0000" . $tambah;
	} else if (strlen($tambah) == 2) {
		$format = "WBM-BK-" . $hari . $bulan . $tahun . "000" . $tambah;
	} else if (strlen($tambah) == 3) {
		$format = "WBM-BK-" . $hari . $bulan . $tahun . "00" . $tambah;
	} else if (strlen($tambah) == 4) {
		$format = "WBM-BK-" . $hari . $bulan . $tahun . "0" . $tambah;
	} else {
		$format = "WBM-BK-" . $bulan . $tahun . $tambah;
	}


	$tanggal_keluar = date("Y-m-d");


	?>

  <div class="container-fluid">
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Keluar<a href="?page=barangkeluar" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">


  				<div class="body">

  					<form method="POST" enctype="multipart/form-data">

  						<label for="">Id Transaksi</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="id_transaksi" class="form-control" id="id_transaksi" value="<?php echo $format; ?>" readonly />
  							</div>
  						</div>



  						<label for="">Tanggal Keluar</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="date" name="tanggal_keluar" class="form-control" id="tanggal_keluar" value="<?php echo $tanggal_keluar; ?>" />
  							</div>
  						</div>


  						<label for="">Barang</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="barang" id="select_barang" class="form-control">
  									<option value="">--------------- Pilih Barang ---------------</option>
  									<?php

										$sql = $koneksi->query("select * from gudang order by kode_barang");
										while ($data = $sql->fetch_assoc()) {
											echo "<option value='$data[kode_barang].$data[nama_barang]'>$data[kode_barang] | $data[nama_barang]</option>";
										}
										?>

  								</select>
  							</div>
  						</div>

  						<div class="tampung"></div>

  						<label for="">Jumlah</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="jumlahkeluar" id="jumlahkeluar" onkeyup="sum()" class="form-control" />


  							</div>
  						</div>

  						<label for="total">Total Stok</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input readonly="readonly" name="total" id="total" type="number" class="form-control">


  							</div>
  						</div>

  						<div class="tampung1"></div>


  						<label for="">Penerima</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="penerima" id="select_pegawai" class="form-control">
  									<option value="">--------------- Pilih Penerima ---------------</option>
  									<?php

										$sql = $koneksi->query("select * from pegawai order by id_pegawai");
										while ($data = $sql->fetch_assoc()) {
											echo "<option value='$data[id_pegawai]'>$data[nama]</option>";
										}
										?>

  								</select>
  							</div>
  						</div>

  						<label for="">Catatan</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="catatan" class="form-control" />
  							</div>
  						</div>

  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

  					</form>



  					<?php

						if (isset($_POST['simpan'])) {
							$id_transaksi = $_POST['id_transaksi'];
							$tanggal = $_POST['tanggal_keluar'];

							$barang = $_POST['barang'];
							$pecah_barang = explode(".", $barang);
							$kode_barang = $pecah_barang[0];
							$nama_barang = $pecah_barang[1];



							$jumlah = $_POST['jumlahkeluar'];


							$penerima = $_POST['penerima'];

							$satuan = $_POST['satuan'];

							$catatan = $_POST['catatan'];

							$total = $_POST['total'];

							$sisa2 = $total;
							if ($sisa2 < 0) {
						?>

  							<script type="text/javascript">
  								alert("Stok Barang Habis, Transaksi Tidak Dapat Dilakukan");
  								window.location.href = "?page=barangkeluar&aksi=tambahbarangkeluar";
  							</script>

  					<?php
							} else {

								$sql = $koneksi->query("insert into barang_keluar (id_transaksi, tanggal, kode_barang, nama_barang, jumlah, satuan, id_pegawai, catatan, total) values('$id_transaksi','$tanggal','$kode_barang','$nama_barang','$jumlah','$satuan','$penerima','$catatan','$total')");
								// $sql2 = $koneksi-> query("update gudang set jumlah=(jumlah) where kode_barang='$kode_barang'");

								if ($sql) {
									echo "
									<script>
										Swal.fire({
											title: 'SUKSES!',
											text: 'Data Berhasil Dihapus',
											icon: 'success',
											confirmButtonText: 'OK'
										}).then(() => {
											window.location.href = '?page=barangkeluar';
										});
									</script>
									";
								}
							}
						}
						?>