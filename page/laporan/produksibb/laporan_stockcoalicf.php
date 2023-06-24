<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Laporan Stock Coal Rom ICF</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama RC</th>
            <th>Warna</th>
            <th>Keluar</th>
            <th>Masuk</th>
            <th>Stok</th>

          </tr>
        </thead>


        <tbody>
          <?php
          $no = 1;
          $sql = mysqli_query($koneksi, "select * from scicf");
          while ($data = mysqli_fetch_assoc($sql)) {

            $id = $data['id_rcicf'];
            $q = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM crushingicf WHERE id_rcicf = $id");
            $tamps = mysqli_fetch_assoc($q);
            $total = $tamps['jum'];

            $q2 = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM transfer WHERE id_rcicf = $id");
            $tamps2 = mysqli_fetch_assoc($q2);
            $total2 = $tamps2['jum'];

            $hasilmasuk = $total + 0;
            $hasilkeluar = $total2 + 0;

          ?>

            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['nama_rcicf'] ?></td>
              <td><?php echo $data['warna'] ?></td>
              <td><?php echo $hasilkeluar ?></td>
              <td><?php echo $hasilmasuk ?></td>
              <td><?php echo $data['stok'] ?></td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
      <a href="../page/laporan/produksibb/exstockcoalicf.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>
      </tbody>
      </table>
    </div>
  </div>
</div>

</div>