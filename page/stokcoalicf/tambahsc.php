<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tambah RC<a href="?page=jenisbarang" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
                  
                  
                  <div class="body">
                  
                  <form method="POST" enctype="multipart/form-data">
                  

                  <label for="">RC</label>
                  <div class="form-group">
                     <div class="form-line">
                      <input type="text" name="nama_rcicf" class="form-control" />	 
                  </div>
                  </div>

                  <label for="">Stok</label>
                  <div class="form-group">
                     <div class="form-line">
                      <input type="text" name="stok" class="form-control" />	 
                  </div>
                  </div>
          
                  
              
                      <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                  
                  </form>
              
                  
                  
                  
                  <?php
                  
                  if (isset($_POST['simpan'])) {
                      $nama_rcicf= $_POST['nama_rcicf'];
                      $stok= $_POST['stok'];
                      
          
  
                      
                      $sql = $koneksi->query("insert into scicf (nama_rcicf, stok) values('$nama_rcicf', '$stok')");
                      
                      if ($sql) {
                          ?>
                          
                              <script type="text/javascript">
                              alert("Data Berhasil Disimpan");
                              window.location.href="?page=stokcoalicf";
                              </script>
                              
                              <?php
                      }
                      }
                  
                  
                  ?>
                              
                              
                              
                      
                      
                      
                      
                      
