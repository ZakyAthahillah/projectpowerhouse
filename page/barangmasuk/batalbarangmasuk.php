<?php
$id = $_GET['id'];
$sql2 = $koneksi->query("select * from barang_masuk inner join tb_supplier on barang_masuk.id_supplier = tb_supplier.id_supplier where id = '$id'");
$tampil = $sql2->fetch_assoc();
$barang = $tampil['nama_barang'];
$kode_bar = $tampil['kode_barang'];
$tanggal_masuk = $tampil['tanggal'];
$jumlah = $tampil['jumlah'];
$pengirim = $tampil['nama_supplier'];

$level = $tampil['level'];


$sql3 =  $koneksi->query("SELECT * FROM gudang where kode_barang = '$kode_bar'");
$tampil2 = $sql3->fetch_assoc();
$jumlah2 = $tampil2['jumlah'];

$tambah = $jumlah2 - $jumlah;


?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Rincian Pembatalan Barang Masuk<a href="?page=barangmasuk" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">

						<label for="tanggal_masuk">Tanggal Masuk</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>" readonly/>
							</div>
						</div>

						<label for="kode_barang">Kode Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input  name="kode_barang" id="kode_barang" type="text"  class="form-control" value="<?= $kode_bar ?>" readonly>
							</div>
						</div>

						<label for="barang">Nama Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input  name="barang" id="barang" type="text"  class="form-control" value="<?= $barang ?>" readonly>
							</div>
						</div>


						<label for="jumlahkeluar">Jumlah Masuk</label>
						<div class="form-group">
							<div class="form-line">
								<input  name="jumlahkeluar" id="jumlahkeluar" type="number"  class="form-control" value="<?= $jumlah ?>" readonly>
							</div>
						</div>

						<label for="pengirim">Pengirim</label>
						<div class="form-group">
							<div class="form-line">
								<input  name="pengirim" id="pengirim" type="text"  class="form-control" value="<?= $pengirim ?>" readonly>
							</div>
						</div>


						<input type="submit" name="simpan" value="Batalkan" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan membatalkan riwayat ini? (jumlah barang akan berkurang)')">

					</form>



					<?php

					if (isset($_POST['simpan'])) {

						if (isset($_POST['simpan'])) {

							$sql = $koneksi->query("UPDATE gudang SET jumlah='$tambah' WHERE kode_barang='$kode_bar'");

							$sql2 = $koneksi->query("delete from barang_masuk where id = '$id'");

							if ($sql) {
					?>

								<script type="text/javascript">
									alert("Riwayat Berhasil Dihapus");
									window.location.href = "?page=barangmasuk";
								</script>

					<?php
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
				</div>