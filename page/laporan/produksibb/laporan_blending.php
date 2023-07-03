<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Data Blending</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Start</th>
              <th>Finish</th>
              <th>Plan</th>
              <th>Blue</th>
              <th>Yellow</th>
              <th>Green</th>
              <th>Catatan</th>

            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = mysqli_query($koneksi,"select * from blending
           ");
            while ($data = mysqli_fetch_assoc($sql)) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['tanggal'] ?></td>
                <td><?php echo $data['start'] ?></td>
                <td><?php echo $data['finish'] ?></td>
                <td><?php echo $data['plan'] ?></td>
                <td><?php echo $data['bcrush'] ?></td>
                <td><?php echo $data['ycrush'] ?></td>
                <td><?php echo $data['gcrush'] ?></td>
                <td><?php echo $data['catatan'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <a href="../page/laporan/produksibb/exblending.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>

        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>