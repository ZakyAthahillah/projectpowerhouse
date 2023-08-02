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
            <th>Jumlah</th>
            <th>Catatan</th>
          </tr>
          
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = mysqli_query($koneksi, "SELECT loading.kode_sbp,
        GROUP_CONCAT(tanggal SEPARATOR ', ') AS tanggal_gabung,
        GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_gabung,
        GROUP_CONCAT(nama_barge SEPARATOR ', ') AS barge_gabung,
        GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
        GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
        GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
        GROUP_CONCAT(warna SEPARATOR ', ') AS warna_gabung,
        GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
        GROUP_CONCAT(id_loading SEPARATOR ', ') AS id_loading_gabung
        FROM loading
        INNER JOIN barge ON loading.id_barge = barge.id_barge
        INNER JOIN scjty ON loading.id_rcjty = scjty.id_rcjty
        GROUP BY kode_sbp ORDER BY tanggal DESC");
          while ($data = mysqli_fetch_assoc($sql)) {
            $tanggal_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['tanggal_gabung']) . '</li>';
            $start_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['start_gabung']) . '</li></ul>';
            $finish_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['finish_gabung']) . '</li></ul>';
            $nama_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_gabung']) . '</li></ul>';
            $barge_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['barge_gabung']) . '</li></ul>';
            $jumlah_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['jumlah_gabung']) . '</li></ul>';
            $warna_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['warna_gabung']) . '</li></ul>';
            $catatan_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['catatan_gabung']) . '</li></ul>';
            $id_loading_gabung = $data['id_loading_gabung'];
          ?>

            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['kode_sbp'] ?></td>
              <td><?php echo $tanggal_gabung ?></td>
              <td><?php echo $start_gabung ?></td>
              <td><?php echo $finish_gabung ?></td>
              <td><?php echo $nama_gabung ?></td>
              <td><?php echo $warna_gabung ?></td>
              <td><?php echo $barge_gabung ?></td>
              <td><?php echo $jumlah_gabung ?></td>
              <td><?php echo $catatan_gabung ?></td>


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