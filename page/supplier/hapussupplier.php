 <?php
 
 $id = $_GET['id_supplier'];
 $sql = $koneksi->query("delete from tb_supplier where id_supplier = '$id'");

 if ($sql) {

	echo "
<script>
	Swal.fire({
		title: 'SUKSES!',
		text: 'Data Berhasil Dihapus',
		icon: 'success',
		confirmButtonText: 'OK'
	}).then(() => {
		window.location.href = '?page=supplier';
	});
</script>
";
} else {
	echo "
<script>
	Swal.fire({
		title: 'ERROR!',s
		text: 'Data Gagal Dihapus',
		icon: 'error',
		confirmButtonText: 'OK'
	}).then(() => {
		window.location.href = '?page=supplier';
	});
</script>
";
}
 
 ?>