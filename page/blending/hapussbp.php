<?php
 include 'func.php';
 $kode = $_GET['kode_sbp'];
 $sql = koneksiDB()->query("delete from sbp where kode_sbp = '$kode'");

 if ($sql) {
 echo "
 <script>
	 Swal.fire({
		 title: 'SUKSES!',
		 text: 'Data Berhasil Dihapus',
		 icon: 'success',
		 confirmButtonText: 'OK'
	 }).then(() => {
		 window.location.href = '?page=sbp';
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
		 window.location.href = '?page=sbp';
	 });
 </script>
 ";
 }
