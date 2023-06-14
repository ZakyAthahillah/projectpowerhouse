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
								<input type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo $tanggal_masuk; ?>" />
							</div>
						</div>

						<label for="">Start</label>
						<div class="form-group">
							<div class="form-line">
								<input type="time" name="start" class="form-control" id="start" value="<?php echo $tanggal_masuk; ?>" />
							</div>
						</div>

						<label for="">Finish</label>
						<div class="form-group">
							<div class="form-line">
								<input type="time" name="finish" class="form-control" id="finish" value="<?php echo $tanggal_masuk; ?>" />
							</div>
						</div>

                        <label for="">Transfer From (ROM ICF)</label>
						<div class="form-group">
							<div class="form-line">
								<select name="transferfrom" id="select_transfericf" class="form-control">
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
								<select name="transferto" id="select_transferjty" class="form-control">
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

						<label for="">Jumlah Keluar RC ICF</label>
                        <div class="form-group">
							<div class="form-line">
								<input type="text" name="jumlahkeluar" id="og"  onkeyup="sum2()" class="form-control" />

							</div>
						</div>
						

						<label for="">Jumlah Masuk RC Jetty</label>
                        <div class="form-group">
							<div class="form-line">
								<input type="text" name="jumlahmasuk" id="mirror" onmousemove="sum1()" class="form-control" />

							</div>
						</div>
						

						<label for="totalkeluar">Total Stock RC ICF</label>
						<div class="form-group">
							<div class="form-line">
								<input readonly="readonly" name="totalkeluar" id="totalkeluar" type="number" class="form-control">
							</div>
						</div>

                        <label for="totalmasuk">Total Stock RC Jetty</label>
						<div class="form-group">
							<div class="form-line">
								<input readonly="readonly" name="totalmasuk" id="totalmasuk" type="number" class="form-control">
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
						$id_rcjty = $_POST['transferto'];
						$pecah_rcjty = explode(".", $id_rcjty);
						$id_rcjty = $pecah_rcjty[0];
						$nama_rcjty = $pecah_rcjty[1];

                        $id_rcicf = $_POST['transferfrom'];
                        $pecah_rcicf = explode(".", $id_rcicf);
						$id_rcicf = $pecah_rcicf[0];
						$nama_rcicf = $pecah_rcicf[1];

						$jumlahmasuk = $_POST['jumlahmasuk'];
						$jumlahkeluar = $_POST['jumlahkeluar'];

                        $totalmasuk = $_POST['totalmasuk'];
						$totalkeluar = $_POST['totalkeluar'];

						$start = $_POST['start'];

						$finish = $_POST['finish'];
						$catatan = $_POST['catatan'];

						$sql = $koneksi->query("insert into transfer(tanggal, start, finish, id_rcjty, id_rcicf, jumlah, catatan) values('$tanggal','$start','$finish','$id_rcjty', '$id_rcicf','$jumlahkeluar', '$catatan')");
						$sql2 = $koneksi->query("update scjty set stok='$totalmasuk' where id_rcjty='$id_rcjty'");
						$sql3 = $koneksi->query("update scicf set stok='$totalkeluar' where id_rcicf='$id_rcicf'");





						if ($sql) {
					?>
							<script type="text/javascript">
								alert("Simpan Data Berhasil");
								window.location.href = "?page=transfer";
							</script>
					<?php
						}
					}


					?>