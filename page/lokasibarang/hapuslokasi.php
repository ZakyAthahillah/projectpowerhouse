 <?php
 
 $id = $_GET['id_lokasi'];
 $sql = $koneksi->query("delete from lokasi where id_lokasi = '$id'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=lokasibarang";
	</script>
	
 <?php
 
 }
 
 ?>