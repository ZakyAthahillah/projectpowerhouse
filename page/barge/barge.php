<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Barge</h6>
      <br>
      <a href="?page=barge&aksi=tambahbarge" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barge</th>
              <th>Status</th>
              <th>Pengaturan</th>

            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = $koneksi->query("select * from barge");
            while ($data = $sql->fetch_assoc()) {

            ?>
              
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_barge'] ?></td>
                <td><?php echo $data['status'] ?></td>



                <td>
                  <a href="?page=barge&aksi=ubahbarge&id_barge=<?php echo $data['id_barge'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
                  <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=barge&aksi=hapusbarge&id_barge=<?php echo $data['id_barge'] ?>" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
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