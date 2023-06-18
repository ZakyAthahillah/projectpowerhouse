<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Crushing Jetty</h6>
      <br>
      <a href="?page=crushingjty&aksi=tambahcrushing" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
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
            $sql = mysqli_query($koneksi,"select * from crushingjty
            inner join scjty on crushingjty.id_rcjty = scjty.id_rcjty order by tanggal desc
           ");
            while ($data = mysqli_fetch_assoc($sql)) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['tanggal'] ?></td>
                <td><?php echo $data['start'] ?></td>
                <td><?php echo $data['finish'] ?></td>
                <td><?php echo $data['nama_rcjty'] ?></td>
                <td><?php echo $data['warna'] ?></td>
                <td><?php echo $data['jumlah'] ?></td>
                <td><?php echo $data['catatan'] ?></td>


                <td>
                  <a href="?page=crushingjty&aksi=batalcrushingjty&id_crushing=<?php echo $data['id_crushing'] ?>" class="btn btn-danger btn-circle"><i class="fas fa-ban"></i></a>
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