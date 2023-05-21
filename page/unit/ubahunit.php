

<?php
 $id = $_GET['id'];
 $sql2 = $koneksi->query("select * from unit where id = '$id'");
 $tampil = $sql2->fetch_assoc();
 


 
 
 
 ?>
 
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah Unit</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">

							<form method="POST" enctype="multipart/form-data">

							<label for="">Kode Unit</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="kode_unit" value="<?php echo $tampil['kode_unit']; ?>" class="form-control" />
	 
							</div>
                            </div>
							
							<label for="">Unit</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="nama_unit" value="<?php echo $tampil['nama_unit']; ?>" class="form-control" />
	 
							</div>
                            </div>
							
						
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								

								$kode_unit= $_POST['kode_unit'];
								$nama_unit= $_POST['nama_unit'];
								
								
								
								
								$sql = $koneksi->query("update unit set kode_unit='$kode_unit', nama_unit='$nama_unit' where id='$id'"); 
								
								if ($sql) {
									?>
									
										<script type="text/javascript">
										alert("Data Berhasil Diubah");
										window.location.href="?page=unit";
										</script>
										
										<?php
								}
							
							}
							
							
							?>
										
										
										
								
								
								
								
								
