<script>
	function sum1() {
		var stok = document.getElementById('stokin').value;
		var jumlahmasuk = document.getElementById('mirror').value;
		var result = parseFloat(stok) + parseFloat(jumlahmasuk);
		if (!isNaN(result)) {
			document.getElementById('totalmasuk').value = result;
		}
	}


	function sum2() {
		var stok = document.getElementById('stokout').value;
		var jumlahkeluar = document.getElementById('og').value;
		var result = parseFloat(stok) - parseFloat(jumlahkeluar);
		if (!isNaN(result)) {
			document.getElementById('totalkeluar').value = result;
		}
	}
</script>



<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Data Transfer<a href="?page=transfer" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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
								<input type="time" name="start" class="form-control" id="start" required />
							</div>
						</div>

						<label for="">Transfer From (ROM ICF)</label>
						<div class="form-group">
							<div class="form-line">
								<select name="transferfrom" id="select_transfericf" class="form-control" required>
									<option value="">--------------- Pilih Barang ---------------</option>
									<?php

									$sql = $koneksi->query("select * from scicf order by id_rcicf");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_rcicf].$data[nama_rcicf]'>$data[nama_rcicf]</option>";
									}
									?>

								</select>
							</div>
						</div>

						<div class="tampung12"></div>


						<label for="">Transfer To (ROM Jetty)</label>
						<div class="form-group">
							<div class="form-line">
								<select name="transferto" id="select_transferjty" class="form-control" required>
									<option value="">--------------- Pilih Barang ---------------</option>
									<?php

									$sql = $koneksi->query("select * from scjty order by id_rcjty");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_rcjty].$data[nama_rcjty]'>$data[nama_rcjty]</option>";
									}
									?>

								</select>
							</div>
						</div>
						<div class="tampung11"></div>


						<label for="">Dump Truck</label>
						<div class="form-group">
							<div class="form-line">
								<select name="dumptruck" id="select_dumptruck" class="form-control" required>
									<option value="">----------SILAHKAN PILIH----------</option>
									<?php

									$sql = $koneksi->query("select * from dumptruck order by id_dumptruck");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_dumptruck]'>$data[nama_dumptruck]</option>";
									}
									?>

								</select>
							</div>
						</div>

						<label for="">Operator</label>
						<div class="form-group">
							<div class="form-line">
								<select name="optht" id="select_optht" class="form-control" required>
									<option value="">----------SILAHKAN PILIH----------</option>
									<?php

									$sql = $koneksi->query("select * from operatorht order by id_optht");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_optht]'>$data[nama_optht]</option>";
									}
									?>

								</select>
							</div>
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

					</form>

					<!-- <script>
						const ogInput = document.getElementById("og")
						const mirrorInput = document.getElementById("mirror")

						ogInput.addEventListener("input", () => {
							mirrorInput.value = ogInput.value
						})
					</script> -->

					<?php
					// Memulai transaksi
					$koneksi->begin_transaction();

					try {
						if (isset($_POST['simpan'])) {
							$tanggal = $_POST['tanggal'];

							$id_rcjty = $_POST['transferto'];
							$pecah_rcjty = explode(".", $id_rcjty);
							$id_rcjty = $pecah_rcjty[0];
							$nama_rcjty = $pecah_rcjty[1];

							$id_rcicf = $_POST['transferfrom'];
							$pecah_rcicf = explode(".", $id_rcicf);
							$id_rcicf = $pecah_rcicf[0];
							$nama_rcicf = $pecah_rcicf[1];

							$start = $_POST['start'];

							$id_dumptruck = $_POST['dumptruck'];
							$id_optht = $_POST['optht'];
							$catatan = "Dalam Proses";

							// Mengubah perintah INSERT menjadi objek prepared statement
							$stmt = $koneksi->prepare("INSERT INTO transfer(tanggal, start, id_rcjty, id_rcicf, id_dumptruck, id_optht, id_users, catatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

							// Mengikat parameter ke pernyataan persiapan
							$stmt->bind_param("ssssssss", $tanggal, $start, $id_rcjty, $id_rcicf, $id_dumptruck, $id_optht, $id_users, $catatan);

							// Menjalankan pernyataan persiapan
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
										window.location.href = '?page=transfer';
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
									text: 'Data Gagal Disimpan',
									icon: 'error',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=transfer';
								});
							</script>
						";
										}

							// Menutup transaksi dan koneksi ke database
							$koneksi->close();
							?>