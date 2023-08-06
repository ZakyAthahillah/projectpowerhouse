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
            <th>Kode SBP</th>
            <th>Tanggal</th>
            <th>Plan</th>
            <th>Blue Crush</th>
            <th>Yellow Crush</th>
            <th>Green Crush</th>
            <th>Catatan</th>
          </tr>
        </thead>


        <tbody>
          <?php

          $no = 1;
          $sql = mysqli_query($koneksi, "SELECT blending.id_blending, blending.kode_sbp,
          GROUP_CONCAT(tanggal SEPARATOR ', ') AS tanggal_gabung,
          GROUP_CONCAT(plan SEPARATOR ', ') AS plan_gabung,
          GROUP_CONCAT(bcrush SEPARATOR ', ') AS bcrush_gabung,
          GROUP_CONCAT(ycrush SEPARATOR ', ') AS ycrush_gabung,
          GROUP_CONCAT(gcrush SEPARATOR ', ') AS gcrush_gabung,
          GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
          GROUP_CONCAT(id_blending SEPARATOR ', ') AS id_blending_gabung
          FROM blending
          INNER JOIN sbp ON blending.kode_sbp = sbp.kode_sbp 
          GROUP BY blending.kode_sbp
          ORDER BY tanggal asc");
          while ($data = mysqli_fetch_assoc($sql)) {
            $tanggal_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['tanggal_gabung']) . '</li>';
            $plan_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['plan_gabung']) . '</li></ul>';
            $bcrush_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['bcrush_gabung']) . '</li></ul>';
            $ycrush_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['ycrush_gabung']) . '</li></ul>';
            $gcrush_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['gcrush_gabung']) . '</li></ul>';
            $catatan_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['catatan_gabung']) . '</li></ul>';
            $id_blending_gabung = $data['id_blending_gabung'];
          ?>

            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['kode_sbp'] ?></td>
              <td><?php echo $tanggal_gabung ?></td>
              <td><?php echo $plan_gabung ?></td>
              <td><?php echo $bcrush_gabung ?></td>
              <td><?php echo $ycrush_gabung ?></td>
              <td><?php echo $gcrush_gabung ?></td>
              <td><?php echo $catatan_gabung ?></td>
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