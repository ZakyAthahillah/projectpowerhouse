<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Transfer Coal ICF To Jetty <span class="badge badge-danger badge-xl font-weight-bolder">DALAM PROSES</span></h6>
    <br>
    <a href="?page=transfer&aksi=tambahtransfer" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="" class="display table table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Start</th>
            <th>Transfer From (ICF)</th>
            <th>Transfer To (JETTY)</th>
            <th>Dump Truck</th>
            <th>Operator</th>
            <th>Status</th>
            <th>Penginput</th>
            <th>Aksi</th>

          </tr>
        </thead>


        <tbody>
          <?php

          $no = 1;
          $sql = mysqli_query($koneksi, "SELECT transfer.id_transfer, tanggal,
            GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
            GROUP_CONCAT(nama_rcicf SEPARATOR ', ') AS nama_rcicf_gabung,
            GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_rcjty_gabung,
            GROUP_CONCAT(nama_dumptruck SEPARATOR ', ') AS nama_dumptruck_gabung,
            GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
            GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
            GROUP_CONCAT(nama_optht SEPARATOR ', ') AS nama_optht_gabung,
            GROUP_CONCAT(nama SEPARATOR ', ') AS nama_gabung,
            GROUP_CONCAT(id_transfer SEPARATOR ', ') AS id_transfer_gabung
            FROM transfer
            INNER JOIN users ON transfer.id_users = users.id_users
            INNER JOIN operatorht ON transfer.id_optht = operatorht.id_optht
            INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
            INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
            INNER JOIN dumptruck ON transfer.id_dumptruck = dumptruck.id_dumptruck
            WHERE catatan='Dalam Proses'
            GROUP BY transfer.tanggal
            ORDER BY tanggal DESC");


          while ($data = mysqli_fetch_assoc($sql)) {
            $tanggal = $data['tanggal'];
            $start_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['start_gabung']) . '</li>';
            $nama_rcicf_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcicf_gabung']) . '</li>';
            $nama_rcjty_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcjty_gabung']) . '</li>';
            $nama_dumptruck_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_dumptruck_gabung']) . '</li>';
            $catatan_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['catatan_gabung']) . '</li>';
            $nama_optht_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_optht_gabung']) . '</li>';
            $nama_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_gabung']) . '</li>';
            $id_transfer_gabung = $data['id_transfer_gabung'];
          ?>

            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $tanggal; ?></td>
              <td><?php echo $start_gabung; ?></td>
              <td><?php echo $nama_rcicf_gabung; ?></td>
              <td><?php echo $nama_rcjty_gabung; ?></td>
              <td><?php echo $nama_dumptruck_gabung; ?></td>
              <td><?php echo $nama_optht_gabung; ?></td>
              <td><?php echo $catatan_gabung; ?></td>
              <td><?php echo $nama_gabung; ?></td>
              <td>
                <div style="display: flex;">
                  <ul style="list-style-type: none; padding: 0; margin: 0 10px 0 0;">
                    <?php
                    $id_transfer_array = explode(", ", $id_transfer_gabung);
                    foreach ($id_transfer_array as $id_transfer) {
                      echo '<li><a href="?page=transfer&aksi=konfirmtransfer&id_transfer=' . $id_transfer . '"><i class="fas fa-check text-success"></i></a></li>';
                    }
                    ?>
                  </ul>
                  <ul style="list-style-type: none; padding: 0; margin: 0 10px 0 0;">
                    <?php
                    $id_transfer_array = explode(", ", $id_transfer_gabung);
                    foreach ($id_transfer_array as $id_transfer) {
                      echo '<li><a href="?page=transfer&aksi=ubahtransfer&id_transfer=' . $id_transfer . '"><i class="fas fa-wrench text-warning"></i></a></li>';
                    }
                    ?>
                  </ul>
                  <ul style="list-style-type: none; padding: 0; margin: 0;">
                    <?php
                    $id_transfer_array = explode(", ", $id_transfer_gabung);
                    foreach ($id_transfer_array as $id_transfer) {
                      echo '<li><a onclick="confirmDelete(\'' . $data['id_transfer'] . '\')"><i class="fas fa-trash text-danger"></i></a></li>';
                    }
                    ?>
                  </ul>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<br>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Transfer Coal ICF To Jetty <span class="badge badge-xl badge-success font-weight-bolder">SELESAI</span></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="" class="display table table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Start</th>
            <th>Finish</th>
            <th>Transfer From (ICF)</th>
            <th>Transfer To (JETTY)</th>
            <th>Jumlah</th>
            <th>Dump Truck</th>
            <th>Operator</th>
            <th>Status</th>
            <th>Konfirmator</th>
            <th>Aksi</th>

          </tr>
        </thead>


        <tbody>
          <?php

          $no = 1;
          $sql = mysqli_query($koneksi, "SELECT transfer.id_transfer, tanggal, 
            GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
            GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
            GROUP_CONCAT(nama_rcicf SEPARATOR ', ') AS nama_rcicf_gabung,
            GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_rcjty_gabung,
            GROUP_CONCAT(nama_dumptruck SEPARATOR ', ') AS nama_dumptruck_gabung,
            GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
            GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
            GROUP_CONCAT(nama_optht SEPARATOR ', ') AS nama_optht_gabung,
            GROUP_CONCAT(nama SEPARATOR ', ') AS nama_gabung,
            GROUP_CONCAT(id_transfer SEPARATOR ', ') AS id_transfer_gabung
            FROM transfer
            INNER JOIN users ON transfer.id_users = users.id_users
            INNER JOIN operatorht ON transfer.id_optht = operatorht.id_optht
            INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
            INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
            INNER JOIN dumptruck ON transfer.id_dumptruck = dumptruck.id_dumptruck
            WHERE catatan='Selesai'
            GROUP BY transfer.tanggal
            ORDER BY tanggal DESC");


          while ($data = mysqli_fetch_assoc($sql)) {
            $tanggal = $data['tanggal'];
            $start_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['start_gabung']) . '</li>';
            $finish_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['finish_gabung']) . '</li>';
            $nama_rcicf_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcicf_gabung']) . '</li>';
            $nama_rcjty_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcjty_gabung']) . '</li>';
            $nama_dumptruck_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_dumptruck_gabung']) . '</li>';
            $catatan_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['catatan_gabung']) . '</li>';
            $nama_optht_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_optht_gabung']) . '</li>';
            $jumlah_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['jumlah_gabung']) . '</li>';
            $nama_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_gabung']) . '</li>';
            $id_transfer_gabung = $data['id_transfer_gabung'];
          ?>

            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $tanggal; ?></td>
              <td><?php echo $start_gabung; ?></td>
              <td><?php echo $finish_gabung; ?></td>
              <td><?php echo $nama_rcicf_gabung; ?></td>
              <td><?php echo $nama_rcjty_gabung; ?></td>
              <td><?php echo $jumlah_gabung; ?></td>
              <td><?php echo $nama_dumptruck_gabung; ?></td>
              <td><?php echo $nama_optht_gabung; ?></td>
              <td><?php echo $catatan_gabung; ?></td>
              <td><?php echo $nama_gabung; ?></td>
              <td>
                <ul style="list-style-type: none; padding: 0; margin: 0;">
                  <?php
                  $id_transfer_array = explode(", ", $id_transfer_gabung);
                  foreach ($id_transfer_array as $id_transfer) {
                    echo '<li><a href="?page=transfer&aksi=bataltransfer&id_transfer=' . $id_transfer . '"><i class="fas fa-ban text-danger"></i></a></li>';
                  }
                  ?>
                </ul>
              </td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  function confirmDelete(idTransfer) {
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
        window.location.href = "?page=transfer&aksi=hapustransfer&id_transfer=" + idTransfer;
      }
    });
  }
</script>