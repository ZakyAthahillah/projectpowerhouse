<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Penerima Barang</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Bagian</th>
              <th>Riwayat Pengambilan Barang</th>

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
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['bagian'] ?></td>
                <td>
                  <a href="?page=laporan_penerima&aksi=riwayatp&id_pegawai=<?php echo $data['id_pegawai'] ?>" class="btn btn-success btn-circle"><i class="fas fa-search"></i></a>
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