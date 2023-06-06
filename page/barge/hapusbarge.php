<?php
 
 $id = $_GET['id_barge'];
 $sql = $koneksi->query("delete from barge where id_barge = '$id'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=barge";
	</script>
	
 <?php
 
 }
 
 ?>