 <?php

	$kode_barang = $_GET['kode_barang'];
	$sql = $koneksi->query("delete from gudang where kode_barang = '$kode_barang'");

	if ($sql) {

		echo "
	<script>
		Swal.fire({
			title: 'SUKSES!',
			text: 'Data Berhasil Dihapus',
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
			text: 'Data Gagal Dihapus',
			icon: 'error',
			confirmButtonText: 'OK'
		}).then(() => {
			window.location.href = '?page=gudang';
		});
	</script>
	";
	}

	?>