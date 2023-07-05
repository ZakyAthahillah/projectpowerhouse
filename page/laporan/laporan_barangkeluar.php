<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Keluar</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Id Transaksi</th>
              <th>Tanggal Keluar</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah Keluar</th>
              <th>Satuan</th>
              <th>Penerima</th>
              <th>Catatan</th>



            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = $koneksi->query("select * from barang_keluar
                  inner join pegawai on barang_keluar.id_pegawai = pegawai.id_pegawai");
            while ($data = $sql->fetch_assoc()) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['id_transaksi'] ?></td>
                <td><?php echo $data['tanggal'] ?></td>
                <td><?php echo $data['kode_barang'] ?></td>
                <td><?php echo $data['nama_barang'] ?></td>
                <td><?php echo $data['jumlah'] ?></td>
                <td><?php echo $data['satuan'] ?></td>
                <td><?php echo $data['nama_pegawai'] ?></td>
                <td><?php echo $data['catatan'] ?></td>

              </tr>
            <?php } ?>
          </tbody>
        </table>
        <a href="../page/laporan/exbarangkeluar.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>

        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>