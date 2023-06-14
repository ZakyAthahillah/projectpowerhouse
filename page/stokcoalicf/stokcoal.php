<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Stock Coal Rom ICF</h6>
      <br>
      <a href="?page=stokcoalicf&aksi=tambahsc" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
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
              <th>Pengaturan</th>

            </tr>
          </thead>


          <tbody>
            <?php
            $no = 1;
            $sql = mysqli_query($koneksi,"select * from scicf");
            while ($data = mysqli_fetch_assoc($sql)) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_rcicf'] ?></td>
                <td><?php echo $data['warna'] ?></td>
                <td><?php echo $data['stok'] ?></td>
                <td>
                <a href="?page=stokcoalicf&aksi=viewscicf&id_rcicf=<?php echo $data['id_rcicf'] ?>" class="btn btn-success btn-circle"><i class="fas fa-search"></i></a>
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