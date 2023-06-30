<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Stock Coal Rom Jetty</h6>
      <br>
      <a href="?page=stokcoaljty&aksi=tambahsc" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama RC</th>
              <th>Warna</th>
              <th>Stok</th>
              <th>Aksi</th>

            </tr>
          </thead>


          <tbody>
            <?php
            $no = 1;
            $sql = mysqli_query($koneksi,"select * from scjty");
            while ($data = mysqli_fetch_assoc($sql)) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_rcjty'] ?></td>
                <td><?php echo $data['warna'] ?></td>
                <td><?php echo $data['stok'] ?></td>


                <td>
                <a href="?page=stokcoaljty&aksi=ubahscjty&id_rcjty=<?php echo $data['id_rcjty'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
                <a href="?page=stokcoaljty&aksi=viewscjty&id_rcjty=<?php echo $data['id_rcjty'] ?>" class="btn btn-primary btn-circle"><i class="fas fa-info"></i></a>
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