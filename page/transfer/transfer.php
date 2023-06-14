<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Transfer Coal ICF To Jetty</h6>
      <br>
      <a href="?page=transfer&aksi=tambahtransfer" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
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
              <th>Transfer From (ICF)</th>
              <th>Transfer To (JETTY)</th>
              <th>Jumlah</th>
              <th>Haul Truck</th>
              <th>Catatan</th>
              <th>Pengaturan</th>

            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = mysqli_query($koneksi,"select * from transfer
            inner join scicf on transfer.id_rcicf = scicf.id_rcicf
            inner join scjty on transfer.id_rcjty = scjty.id_rcjty
            inner join haultruck on transfer.id_haultruck = haultruck.id_haultruck order by tanggal desc
           ");
            while ($data = mysqli_fetch_assoc($sql)) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['tanggal'] ?></td>
                <td><?php echo $data['start'] ?></td>
                <td><?php echo $data['finish'] ?></td>
                <td><?php echo $data['nama_rcicf'] ?></td>
                <td><?php echo $data['nama_rcjty'] ?></td>
                <td><?php echo $data['jumlah'] ?></td>
                <td><?php echo $data['nama_haultruck'] ?></td>
                <td><?php echo $data['catatan'] ?></td>


                <td>
                  <a href="?page=gudang&aksi=ubahgudang&kode_barang=<?php echo $data['kode_barang'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
                  <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=gudang&aksi=hapusgudang&kode_barang=<?php echo $data['kode_barang'] ?>" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
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