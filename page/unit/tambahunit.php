  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Unit</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">
							
							<form method="POST" enctype="multipart/form-data">
							

							<label for="">Kode Unit</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="kode_unit" class="form-control" />	 
							</div>
                            </div>
  
							<label for="">Nama Unit</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="nama_unit" class="form-control" />	 
							</div>
                            </div>
							
						
								<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
						
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								$kode_unit = $_POST['kode_unit'];
								$nama_unit= $_POST['nama_unit'];
								
								
					
			
								
								$sql = $koneksi->query("insert into unit (kode_unit,nama_unit) values('$kode_unit, $nama_unit')");
								
								if ($sql) {
									?>
									
										<script type="text/javascript">
										alert("Data Berhasil Disimpan");
										window.location.href="?page=unit";
										</script>
										
										<?php
								}
								}
							
							
							?>
										
										
										
								
								
								
								
								
