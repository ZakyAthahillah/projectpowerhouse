 <?php
 
 $id = $_GET['id_users'];
 $sql = $koneksi->query("delete from users where id_users = '$id'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=pengguna";
	</script>
	
 <?php
 
 }
 
 ?>