 <?php

	$id_transaksi = $_GET['id_transaksi'];
	$sql = $koneksi->query("delete from barang_keluar where id_transaksi = '$id_transaksi'");

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

	?>