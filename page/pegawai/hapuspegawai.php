 <?php
 
 $id = $_GET['id_pegawai'];
 $sql = $koneksi->query("delete from pegawai where id_pegawai= '$id'");

 if ($sql) {

	echo "
<script>
	Swal.fire({
		title: 'SUKSES!',
		text: 'Data Berhasil Dihapus',
		icon: 'success',
		confirmButtonText: 'OK'
	}).then(() => {
		window.location.href = '?page=pegawai';
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
		window.location.href = '?page=pegawai';
	});
</script>
";
}
 
 ?>