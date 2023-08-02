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
            <th>Keluar</th>
            <th>Masuk</th>
            <th>Stok</th>
          </tr>
        </thead>


        <tbody>
          <?php
          $no = 1;
          $sql = mysqli_query($koneksi, "select * from scjty");
          while ($data = mysqli_fetch_assoc($sql)) {

            $id = $data['id_rcjty'];
            $q = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM crushingjty WHERE id_rcjty = $id");
            $tamps = mysqli_fetch_assoc($q);
            $total = $tamps['jum'];

            $q2 = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM transfer WHERE id_rcjty = $id");
            $tamps2 = mysqli_fetch_assoc($q2);
            $total2 = $tamps2['jum'];

            $q3 = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM loading WHERE id_rcjty = $id");
            $tamps = mysqli_fetch_assoc($q3);
            $total3 = $tamps['jum'];

            $hasilmasuk = $total + $total2 + 0;
            $hasilkeluar = $total3 + 0;

          ?>

            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['nama_rcjty'] ?></td>
              <td><?php echo $data['warna'] ?></td>
              <td><?php echo $hasilkeluar ?></td>
              <td><?php echo $hasilmasuk ?></td>
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