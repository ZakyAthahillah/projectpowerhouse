

<?php
 $id = $_GET['id_satuan'];
 $sql2 = $koneksi->query("select * from satuan where id_satuan = '$id'");
 $tampil = $sql2->fetch_assoc();
 


 
 
 
 ?>
 
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah Satuan<a href="?page=satuan" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">

							<form method="POST" enctype="multipart/form-data">
							
							<label for="">Satuan Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="satuan" value="<?php echo $tampil['satuan']; ?>" class="form-control" />
	 
							</div>
                            </div>
							
						
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								
								$satuan= $_POST['satuan'];
								
								
								
								
								$sql = $koneksi->query("update satuan set satuan='$satuan' where id_satuan ='$id'"); 
								
								if ($sql) {
									?>
									
										<script type="text/javascript">
										alert("Data Berhasil Diubah");
										window.location.href="?page=satuanbarang";
										</script>
										
										<?php
								}
							
							}
							
							
							?>
										
										
										
								
								
								
								
								
