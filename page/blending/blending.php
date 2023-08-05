<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Blending</h6>
    <br>
    <a href="?page=blending&aksi=tambahblending" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
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
            <th>Aksi</th>
          </tr>
        </thead>


        <tbody>
          <?php

          $no = 1;
          $sql = mysqli_query($koneksi, "SELECT blending.kode_sbp,
          GROUP_CONCAT(tanggal SEPARATOR ', ') AS tanggal_gabung,
          GROUP_CONCAT(plan SEPARATOR ', ') AS plan_gabung,
          GROUP_CONCAT(bcrush SEPARATOR ', ') AS bcrush_gabung,
          GROUP_CONCAT(ycrush SEPARATOR ', ') AS ycrush_gabung,
          GROUP_CONCAT(gcrush SEPARATOR ', ') AS gcrush_gabung,
          GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
          GROUP_CONCAT(id_blending SEPARATOR ', ') AS id_blending_gabung
          FROM blending
          INNER JOIN sbp ON blending.kode_sbp = sbp.kode_sbp 
          GROUP BY kode_sbp
          ORDER BY tanggal desc");
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
              <td>
                <div style="display: flex;">
                  <ul style="list-style-type: none; padding: 0; margin: 0 10px 0 0;">
                    <?php
                    $id_blending_array = explode(", ", $id_blending_gabung);
                    foreach ($id_blending_array as $id_blending) {
                      echo '<li><a href="?page=blending&aksi=ubahblending&id_blending=' . $id_blending . '"><i class="fas fa-wrench text-warning"></i></a></li>';
                    }
                    ?>
                  </ul>
                  <ul style="list-style-type: none; padding: 0; margin: 0 10px 0 0;">
                    <?php
                    $id_blending_array = explode(", ", $id_blending_gabung);
                    foreach ($id_blending_array as $id_blending) {
                      echo '<li><a href="?page=blending&aksi=kalkulatorfq&id_blending=' . $id_blending . '"><i class="fas fa-calculator text-dark"></i></a></li>';
                    }
                    ?>
                  </ul>
                  <ul style="list-style-type: none; padding: 0; margin: 0;">
                    <?php
                    $id_blending_array = explode(", ", $id_blending_gabung);
                    foreach ($id_blending_array as $id_blending) {
                      echo '<li><a onclick="confirmDelete(\'' . $data['id_blending'] . '\')"><i class="fas fa-trash text-danger"></i></a></li>';
                    }
                    ?>
                  </ul>
                </div>
              </td>
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

<script>
  function confirmDelete(idBlending) {
    Swal.fire({
      icon: 'warning',
      title: 'Konfirmasi',
      text: 'Apakah anda yakin akan menghapus data ini?',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      confirmButtonColor: '#d33',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "?page=blending&aksi=hapusblending&id_blending=" + idBlending;
      }
    });
  }
</script>