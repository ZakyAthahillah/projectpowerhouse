<script>
	function sum() {
		var stok = document.getElementById('stok').value;
		var jumlahmasuk = document.getElementById('jumlahmasuk').value;
		var result = parseFloat(stok) + parseFloat(jumlahmasuk);
		if (!isNaN(result)) {
			document.getElementById('jumlah').value = result;
		}
	}
</script>


<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Data Crushing ICF<a href="?page=crushingicf" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">



						<label for="">Tanggal</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tanggal" class="form-control" id="tanggal"/>
							</div>
						</div>

						<label for="">Start</label>
						<div class="form-group">
							<div class="form-line">
								<input type="time" name="start" class="form-control" id="start"/>
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
								<select name="crushingto" id="select_crushingicf" class="form-control" required>
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

					if (isset($_POST['simpan'])) {
						$tanggal = $_POST['tanggal'];
						$id_rcicf = $_POST['crushingto'];
						$pecah_rc = explode(".", $id_rcicf);
						$id_rcicf = $pecah_rc[0];
						$nama_rc = $pecah_rc[1];
						$jumlahmasuk = $_POST['jumlahmasuk'];
						$jumlah = $_POST['jumlah'];

						$start = $_POST['start'];

						$finish = $_POST['finish'];
						$catatan = $_POST['catatan'];

						$sql = $koneksi->query("insert into crushingicf(tanggal, start, finish, id_rcicf, jumlah, catatan) values('$tanggal','$start','$finish','$id_rcicf','$jumlahmasuk', '$catatan')");
						$sql2 = $koneksi->query("update scicf set stok='$jumlah' where id_rcicf='$id_rcicf'");





						if ($sql) {
					?>
							<script type="text/javascript">
								alert("Simpan Data Berhasil");
								window.location.href = "?page=crushingicf";
							</script>
					<?php
						}
					}


					?>