<?php
 
 $id = $_GET['id_barge'];
 $sql = $koneksi->query("delete from barge where id_barge = '$id'");

 
 if ($sql) {

	echo "
<script>
	Swal.fire({
		title: 'SUKSES!',
		text: 'Data Berhasil Dihapus',
		icon: 'success',
		confirmButtonText: 'OK'
	}).then(() => {
		window.location.href = '?page=barge';
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
		window.location.href = '?page=barge';
	});
</script>
";
}
 
 ?>