<?php
$id = $_GET['id'];
$sql2 = $koneksi->query("select * from barang_keluar inner join pegawai on barang_keluar.id_pegawai = pegawai.id_pegawai where id = '$id'");
$tampil = $sql2->fetch_assoc();
$barang = $tampil['nama_barang'];
$kode_bar = $tampil['kode_barang'];
$tanggal_keluar = $tampil['tanggal'];
$jumlah = $tampil['jumlah'];
$penerima = $tampil['nama'];

$level = $tampil['level'];


$sql3 =  $koneksi->query("SELECT * FROM gudang where kode_barang = '$kode_bar'");
$tampil2 = $sql3->fetch_assoc();
$jumlah2 = $tampil2['jumlah'];

$tambah = $jumlah + $jumlah2;


?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Rincian Pembatalan Barang Keluar<a href="?page=barangkeluar" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">

						<label for="tanggal_keluar">Tanggal Keluar</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tanggal_keluar" class="form-control" id="tanggal_keluar" value="<?php echo $tanggal_keluar; ?>" readonly/>
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


						<label for="jumlahkeluar">Jumlah Keluar</label>
						<div class="form-group">
							<div class="form-line">
								<input  name="jumlahkeluar" id="jumlahkeluar" type="number"  class="form-control" value="<?= $jumlah ?>" readonly>
							</div>
						</div>

						<label for="penerima">Penerima</label>
						<div class="form-group">
							<div class="form-line">
								<input  name="penerima" id="penerima" type="text"  class="form-control" value="<?= $penerima ?>" readonly>
							</div>
						</div>


						<input type="submit" name="simpan" value="Batalkan" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan membatalkan riwayat ini? (jumlah barang akan bertambah)')">

					</form>



					<?php

					if (isset($_POST['simpan'])) {

						if (isset($_POST['simpan'])) {

							$sql = $koneksi->query("UPDATE gudang SET jumlah='$tambah' WHERE kode_barang='$kode_bar'");

							$sql2 = $koneksi->query("delete from barang_keluar where id = '$id'");

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
				</div>
			</div>
		</div>
	</div>
</div>
				</div>