  <script>
  	function sum() {
  		var stok = document.getElementById('stok').value;
  		var jumlahmasuk = document.getElementById('jumlahmasuk').value;
  		var result = parseInt(stok) + parseInt(jumlahmasuk);
  		if (!isNaN(result)) {
  			document.getElementById('jumlah').value = result;
  		}
  	}
  </script>

  <?php

	// Menghasilkan ID transaksi baru
	function generateTransactionID()
	{
		$timestamp = time(); // Mendapatkan timestamp saat ini
		$random = mt_rand(1000, 9999); // Mendapatkan angka acak antara 1000 dan 9999
		$transactionID = "WBM-BM-" . $timestamp . "-" . $random; // Menggabungkan timestamp dan angka acak

		return $transactionID;
	}

	// Contoh penggunaan
	$format = generateTransactionID();




	$tanggal_masuk = date("Y-m-d");


	?>

  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Masuk<a href="?page=barangmasuk" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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



  						<label for="">Tanggal Masuk</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>" />
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
  								<input type="text" name="jumlahmasuk" id="jumlahmasuk" onkeyup="sum()" class="form-control" />


  							</div>
  						</div>

  						<label for="jumlah">Total Stok</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input readonly="readonly" name="jumlah" id="jumlah" type="number" class="form-control">


  							</div>
  						</div>

  						<div class="tampung1"></div>



  						<label for="">Supplier</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="pengirim" id="select_suplier" class="form-control" required />
  								<option value="">-- Pilih Supplier --</option>
  								<?php

									$sql = $koneksi->query("select * from tb_supplier order by id_supplier");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_supplier]'>$data[nama_supplier]</option>";
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
								$tanggal = $_POST['tanggal_masuk'];

								$barang = $_POST['barang'];
								$pecah_barang = explode(".", $barang);
								$kode_barang = $pecah_barang[0];
								$nama_barang = $pecah_barang[1];

								$jumlah = $_POST['jumlahmasuk'];

								$pengirim = $_POST['pengirim'];

								$satuan = $_POST['satuan'];
								$catatan = $_POST['catatan'];

								$sql = "INSERT INTO barang_masuk (id_transaksi, tanggal, kode_barang, nama_barang, jumlah, satuan, id_supplier, catatan, id_users) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
								$stmt = $koneksi->prepare($sql);
								$stmt->bind_param("sssssssss", $id_transaksi, $tanggal, $kode_barang, $nama_barang, $jumlah, $satuan, $pengirim, $catatan, $id_users);
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
										window.location.href = '?page=barangmasuk';
									});
								</script>
							";
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
									window.location.href = '?page=barangmasuk';
								});
							</script>
						";
						}

						// Menutup transaksi dan koneksi ke database
						$koneksi->close();
						?>