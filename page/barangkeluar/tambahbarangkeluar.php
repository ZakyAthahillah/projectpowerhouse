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

	// Menghasilkan ID transaksi baru
	function generateTransactionID()
	{
		$timestamp = time(); // Mendapatkan timestamp saat ini
		$random = mt_rand(1000, 9999); // Mendapatkan angka acak antara 1000 dan 9999
		$transactionID = "WBM-BK-" . $timestamp . "-" . $random; // Menggabungkan timestamp dan angka acak

		return $transactionID;
	}

	// Contoh penggunaan
	$format = generateTransactionID();




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
  								<select name="barang" id="select_barang" class="form-control" required>
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
  								<select name="penerima" id="select_pegawai" class="form-control" required>
  									<option value="">--------------- Pilih Penerima ---------------</option>
  									<?php

										$sql = $koneksi->query("select * from pegawai order by id_pegawai");
										while ($data = $sql->fetch_assoc()) {
											echo "<option value='$data[id_pegawai]'>$data[nama_pegawai]</option>";
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
						// Memulai transaksi
						$koneksi->begin_transaction();

						try {
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
									echo "
									<script>
										Swal.fire({
											title: 'GAGAL!',
											text: 'Stok Tidak Mencukupi, Transaksi Gagal',
											icon: 'warning',
											confirmButtonText: 'OK'
										}).then(() => {
											window.location.href = '?page=barangkeluar&aksi=tambahbarangkeluar';
										});
									</script>
								";
								} else {
									$sql = "INSERT INTO barang_keluar (id_transaksi, tanggal, kode_barang, nama_barang, jumlah, satuan, id_pegawai, catatan, total, id_users) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
									$stmt = $koneksi->prepare($sql);
									$stmt->bind_param("ssssssssss", $id_transaksi, $tanggal, $kode_barang, $nama_barang, $jumlah, $satuan, $penerima, $catatan, $total, $id_users);
									$stmt->execute();

									// Menyimpan perubahan
									$koneksi->commit();

									echo "
									<script>
										Swal.fire({
											title: 'SUKSES!',
											text: 'Data Berhasil Disimpan',
											icon: 'success',
											confirmButtonText: 'OK'
										}).then(() => {
											window.location.href = '?page=barangkeluar';
										});
									</script>
								";
								}
							}
						} catch (Exception $e) {
							// Membatalkan transaksi jika terjadi kesalahan
							$koneksi->rollback();

							echo "
							<script>
								Swal.fire({
									title: 'ERROR!',
									text: 'Terjadi kesalahan saat menyimpan data',
									icon: 'error',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=barangkeluar';
								});
							</script>
						";
						}

						// Menutup transaksi dan koneksi ke database
						$koneksi->close();
						?>