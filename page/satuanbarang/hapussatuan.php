 <?php
 
 $id = $_GET['id_satuan'];
 $sql = $koneksi->query("delete from satuan where id_satuan = '$id'");

 if ($sql) {

	echo "
<script>
	Swal.fire({
		title: 'SUKSES!',
		text: 'Data Berhasil Dihapus',
		icon: 'success',
		confirmButtonText: 'OK'
	}).then(() => {
		window.location.href = '?page=satuanbarang';
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
		window.location.href = '?page=satuanbarang';
	});
</script>
";
}
 
 ?>