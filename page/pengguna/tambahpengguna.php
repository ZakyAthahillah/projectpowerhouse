  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah User<a href="?page=pengguna" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">
							
							<form method="POST" enctype="multipart/form-data">					
							
							<label for="">Nama</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="nama" class="form-control" />	 
							</div>
                            </div>
							
					
								
								<label for="">Username</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="username" class="form-control" />
                          	 
								</div>
                            </div>
					
							<label for="">Password</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="password" name="password" class="form-control" />
                                     
									 
							</div>
                            </div>
							
							<label for="">Level</label>
							 <div class="form-group">
                               <div class="form-line">
                                    <select name="level" class="form-control show-tick">
                                        <option value="">-- Pilih Level --</option>
                                        <option value="admin">Admin</option>
                                        <option value="pegawai">Pegawai</option>
										<option value="warehouse">Warehouse</option>
										<option value="qc">Quality Control</option>
                     
                                    </select>
                            </div>
							</div>
							
							<label for="">Foto</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="file" name="foto" class="form-control" />
									 
							</div>
                            </div>
							
						
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								$nama= $_POST['nama'];
								
								$username= $_POST['username'];

								$salt = "xgsuahkgfbioqy789p12640y98uio190836";
								$passwordsalt = $_POST['password'].$salt;
								$password= md5($passwordsalt);


								$level= $_POST['level'];
								
								$foto= $_FILES['foto']['name'];
								$lokasi= $_FILES['foto']['tmp_name'];
								$upload= move_uploaded_file($lokasi, "../img/".$foto);
								
								if ($upload) {
								
								$sql = $koneksi->query("insert into users (nama, username, password, level, foto) values('$nama','$username','$password','$level','$foto')");
								
								if ($sql) {
									?>
									
										<script type="text/javascript">
										alert("Data Berhasil Disimpan");
										window.location.href="?page=pengguna";
										</script>
										
										<?php
								}
								}
							
							}
							?>
										
										
										
								
								
								
								
								
