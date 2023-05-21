  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Out Of Stock</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                      </tr>
                  </thead>


                  <tbody>
                      <?php
                        $no = 1;
                        $ambildatastock = mysqli_query($koneksi, "select * from gudang where jumlah < 1");
                        while ($fetch = mysqli_fetch_array($ambildatastock)) {
                            $barang = $fetch['nama_barang'];
                            $kode_barang = $fetch['kode_barang'];

                        ?>
                          <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $kode_barang; ?></td>
                              <td><?php echo $barang; ?></td>
                          </tr>
                      <?php } ?>

                  </tbody>
              </table>
              </tbody>
              </table>
          </div>
      </div>
  </div>

  </div>