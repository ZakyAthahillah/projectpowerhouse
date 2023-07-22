<?php
 
 $id = $_GET['id_rcicf'];
 $sql = $koneksi->query("delete from scicf where id_rcicf = '$id'");

 
 if ($sql) {

	echo "
<script>
	Swal.fire({
		title: 'SUKSES!',
		text: 'Data Berhasil Dihapus',
		icon: 'success',
		confirmButtonText: 'OK'
	}).then(() => {
		window.location.href = '?page=stokcoalicf';
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
		window.location.href = '?page=stokcoalicf';
	});
</script>
";
}
 
 ?>