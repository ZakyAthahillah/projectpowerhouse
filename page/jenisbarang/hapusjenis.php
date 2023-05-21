<?php
 
 $id = $_GET['id_jenis'];
 $sql = $koneksi->query("delete from jenis_barang where id_jenis = '$id'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=jenisbarang";
	</script>
	
 <?php
 
 }
 
 ?>