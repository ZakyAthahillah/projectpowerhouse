 <?php
 
 $id = $_GET['id_supplier'];
 $sql = $koneksi->query("delete from tb_supplier where id_supplier = '$id'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=supplier";
	</script>
	
 <?php
 
 }
 
 ?>