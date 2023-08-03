<script>
	function sum() {
		var stok = parseFloat(document.getElementById('stok').value);
		var jumlahmasuk = parseFloat(document.getElementById('jumlahmasuk').value);
		var result = stok + jumlahmasuk;

		if (!isNaN(result)) {
			document.getElementById('jumlah').value = (result % 1 === 0) ? result : result.toFixed(2);
		}
	}
</script>



<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Data Crushing Jetty<a href="?page=crushingjty" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">



						<label for="">Tanggal</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tanggal" class="form-control" id="tanggal" />
							</div>
						</div>

						<label for="">Start</label>
						<div class="form-group">
							<div class="form-line">
								<input type="time" name="start" class="form-control" id="start" />
							</div>
						</div>

						<label for="">Finish</label>
						<div class="form-group">
							<div class="form-line">
								<input type="time" name="finish" class="form-control" id="finish" />
							</div>
						</div>


						<label for="">Crushing To</label>
						<div class="form-group">
							<div class="form-line">
								<select name="crushingto" id="select_crushingjty" class="form-control" required>
									<option value="">--------------- Pilih Barang ---------------</option>
									<?php

									$sql = $koneksi->query("select * from scjty order by id_rcjty");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_rcjty].$data[nama_rcjty]'>$data[nama_rcjty] ($data[warna])</option>";
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
							$tanggal = $_POST['tanggal'];
							$id_rcjty = $_POST['crushingto'];
							$pecah_rc = explode(".", $id_rcjty);
							$id_rcjty = $pecah_rc[0];
							$nama_rc = $pecah_rc[1];
							$jumlahmasuk = $_POST['jumlahmasuk'];
							$jumlah = $_POST['jumlah'];

							$start = $_POST['start'];

							$finish = $_POST['finish'];
							$catatan = $_POST['catatan'];

							$sql = "INSERT INTO crushingjty (tanggal, start, finish, id_rcjty, jumlah, catatan, id_users) VALUES (?, ?, ?, ?, ?, ?, ?)";
							$stmt1 = $koneksi->prepare($sql);
							$stmt1->bind_param("sssssss", $tanggal, $start, $finish, $id_rcjty, $jumlahmasuk, $catatan, $id_users);
							$stmt1->execute();

							$sql2 = "UPDATE scjty SET stok = ? WHERE id_rcjty = ?";
							$stmt2 = $koneksi->prepare($sql2);
							$stmt2->bind_param("ss", $jumlah, $id_rcjty);
							$stmt2->execute();

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
									window.location.href = '?page=crushingjty';
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
								text: 'Terjadi kesalahan saat memproses data',
								icon: 'error',
								confirmButtonText: 'OK'
							}).then(() => {
								window.location.href = '?page=crushingjty';
							});
						</script>
					";
					}

					// Menutup transaksi dan koneksi ke database
					$koneksi->close();
					?>