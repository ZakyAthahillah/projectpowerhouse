<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Crushing ICF</h6>
      <br>
      <a href="?page=crushingicf&aksi=tambahcrushing" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
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
            <th>Crushing To</th>
            <th>Warna</th>
            <th>Jumlah</th>
            <th>Catatan</th>
            <th>Pengaturan</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $no = 1;
          $sql = mysqli_query($koneksi, "SELECT tanggal, GROUP_CONCAT(`start` SEPARATOR ', ') AS `start_concat`, 
            GROUP_CONCAT(`finish` SEPARATOR ', ') AS `finish_concat`, 
            GROUP_CONCAT(nama_rcicf SEPARATOR ', ') AS nama_rcicf_concat, 
            GROUP_CONCAT(warna SEPARATOR ', ') AS warna_concat, 
            GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_concat, 
            GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_concat,
            GROUP_CONCAT(id_crushing SEPARATOR ', ') AS id_crushing_concat
            FROM crushingicf
            INNER JOIN scicf ON crushingicf.id_rcicf = scicf.id_rcicf 
            GROUP BY tanggal
            ORDER BY tanggal DESC");

          while ($data = mysqli_fetch_assoc($sql)) {
            $start_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['start_concat']) . '</li></ul>';
            $finish_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['finish_concat']) . '</li></ul>';
            $nama_rcicf_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcicf_concat']) . '</li></ul>';
            $jumlah_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['jumlah_concat']) . '</li></ul>';
            $warna_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['warna_concat']) . '</li></ul>';
            $catatan_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['catatan_concat']) . '</li></ul>';
            $id_crushing_gabung = $data['id_crushing_concat'];
          ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['tanggal'] ?></td>
              <td><?php echo $start_gabung ?></td>
              <td><?php echo $finish_gabung ?></td>
              <td><?php echo $nama_rcicf_gabung ?></td>
              <td><?php echo $warna_gabung?></td>
              <td><?php echo $jumlah_gabung ?></td>
              <td><?php echo $catatan_gabung ?></td>

              <td>
                <ul style="list-style-type: none; padding: 0; margin: 0;">
                  <?php
                  $id_crushing_array = explode(", ", $id_crushing_gabung);
                  foreach ($id_crushing_array as $id_crushing) {
                    echo '<li><a href="?page=crushingicf&aksi=batalcrushingicf&id_crushing=' . $id_crushing . '" class="btn btn-sm btn-danger btn-circle"><i class="fas fa-ban"></i></a></li>';
                  }
                  ?>
                </ul>
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