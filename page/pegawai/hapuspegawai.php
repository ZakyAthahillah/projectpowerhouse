 <?php
 
 $id = $_GET['id_pegawai'];
 $sql = $koneksi->query("delete from pegawai where id_pegawai= '$id'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=pegawai";
	</script>
	
 <?php
 
 }
 
 ?>