

<?php
 $id = $_GET['id_lokasi'];
 $sql2 = $koneksi->query("select * from lokasi where id_lokasi = '$id'");
 $tampil = $sql2->fetch_assoc();
 


 
 
 
 ?>
 
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah Lokasi<a href="?page=lokasibarang" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">

							<form method="POST" enctype="multipart/form-data">
							
							<label for="">Lokasi Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="lokasi" value="<?php echo $tampil['lokasi']; ?>" class="form-control" />
	 
							</div>
                            </div>
							
						
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								
								$lokasi= $_POST['lokasi'];
								
								
								
								
								$sql = $koneksi->query("update lokasi set lokasi='$lokasi' where id_lokasi='$id'"); 
								
								if ($sql) {
									?>
									
										<script type="text/javascript">
										alert("Data Berhasil Diubah");
										window.location.href="?page=lokasibarang";
										</script>
										
										<?php
								}
							
							}
							
							
							?>
										
										
										
								
								
								
								
								
