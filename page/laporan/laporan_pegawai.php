<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Data Pegawai</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Bagian</th>
              <th>Telepon</th>
              <th>Alamat</th>
            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = $koneksi->query("select * from pegawai");
            while ($data = $sql->fetch_assoc()) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nik'] ?></td>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['bagian'] ?></td>
                <td><?php echo $data['telepon'] ?></td>
                <td><?php echo $data['alamat'] ?></td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
        <a href="../page/laporan/expegawai.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>
        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>