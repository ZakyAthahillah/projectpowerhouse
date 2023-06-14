<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Data Loading</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode SBP</th>
              <th>Tanggal</th>
              <th>Start</th>
              <th>Finish</th>
              <th>Loading From</th>
              <th>Warna</th>
              <th>Loading To</th>
              <th>Belstscale</th>
              <th>Catatan</th>
            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = mysqli_query($koneksi,"select * from loading
            inner join barge on loading.id_barge = barge.id_barge
            inner join scjty on loading.id_rcjty = scjty.id_rcjty
           ");
            while ($data = mysqli_fetch_assoc($sql)) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['kode_sbp'] ?></td>
                <td><?php echo $data['tanggal'] ?></td>
                <td><?php echo $data['start'] ?></td>
                <td><?php echo $data['finish'] ?></td>
                <td><?php echo $data['nama_rcjty'] ?></td>
                <td><?php echo $data['warna'] ?></td>
                <td><?php echo $data['nama_barge'] ?></td>
                <td><?php echo $data['beltscale'] ?></td>
                <td><?php echo $data['catatan'] ?></td>


              
              </tr>
            <?php } ?>

          </tbody>
        </table>
        <a href="../page/laporan/produksibb/exloading.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>

        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>