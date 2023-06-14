<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Stock Coal Rom Jetty</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama RC</th>
              <th>Warna</th>
              <th>Stok</th>
            </tr>
          </thead>


          <tbody>
            <?php
            $no = 1;
            $sql = mysqli_query($koneksi,"select * from scjty");
            while ($data = mysqli_fetch_assoc($sql)) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_rcjty'] ?></td>
                <td><?php echo $data['warna'] ?></td>
                <td><?php echo $data['stok'] ?></td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
        <a href="../page/laporan/produksibb/exstockcoaljty.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>
        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>