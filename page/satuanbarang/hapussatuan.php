 <?php
 
 $id = $_GET['id_satuan'];
 $sql = $koneksi->query("delete from satuan where id_satuan = '$id'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=satuanbarang";
	</script>
	
 <?php
 
 }
 
 ?>