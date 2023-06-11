<?php
 include 'func.php';
 $kode = $_GET['kode_sbp'];
 $sql = koneksiDB()->query("delete from sbp where kode_sbp = '$kode'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=sbp";
	</script>
	
 <?php
 
 }
 
 ?>