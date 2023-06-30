<?php
 
 $id = $_GET['id_jenis'];
 $sql = $koneksi->query("delete from jenis_barang where id_jenis = '$id'");

 if ($sql) {

	echo "
<script>
	Swal.fire({
		title: 'SUKSES!',
		text: 'Data Berhasil Dihapus',
		icon: 'success',
		confirmButtonText: 'OK'
	}).then(() => {
		window.location.href = '?page=jenisbarang';
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
		window.location.href = '?page=jenisbarang';
	});
</script>
";
}
 
 ?>