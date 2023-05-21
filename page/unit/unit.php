




 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Unit</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                                        <tr>
											<th>No</th>
											<th>Kode Unit</th>
											<th>Nama Unit</th>
											
											<th>Pengaturan</th>
                                         
                                        </tr>
										</thead>
										
               
                  <tbody>
                    <?php 
									
									$no = 1;
									$sql = $koneksi->query("select * from unit");
									while ($data = $sql->fetch_assoc()) {
										
									?>
									
                      <tr>
                      <td><?php echo $no++; ?></td>
											<td><?php echo $data['kode_unit'] ?></td>
											<td><?php echo $data['nama_unit'] ?></td>
											
                                         

											<td>
											<a href="?page=unit&aksi=ubahunit&id=<?php echo $data['id'] ?>" class="btn btn-warning btn-circle" ><i class="fas fa-wrench"></i></a>
											<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=unit&aksi=hapusunit&id=<?php echo $data['id'] ?>" class="btn btn-danger btn-circle" ><i class="fas fa-trash"></i></a>
											</td>
                                        </tr>
									<?php }?>

										   </tbody>
                       </table>
                       <a href="?page=satuanbarang&aksi=tambahsatuan" class="btn btn-success btn-circle" ><i class="fas fa-plus"></i></a>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>












