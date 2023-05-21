<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Data Barang</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jenis Barang</th>

              <th>Jumlah Barang</th>
              <th>Satuan</th>
              <th>Lokasi</th>


            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = $koneksi->query("select * from gudang 
            inner join lokasi on gudang.id_lokasi = lokasi.id_lokasi
            inner join satuan on gudang.id_satuan = satuan.id_satuan
            inner join jenis_barang on gudang.id_jenis = jenis_barang.id_jenis");
            while ($data = $sql->fetch_assoc()) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['kode_barang'] ?></td>
                <td><?php echo $data['nama_barang'] ?></td>
                <td><?php echo $data['jenis_barang'] ?></td>
                <td><?php echo $data['jumlah'] ?></td>
                <td><?php echo $data['satuan'] ?></td>
                <td><?php echo $data['lokasi'] ?></td>




              </tr>
            <?php } ?>

          </tbody>
        </table>
        <a href="../page/laporan/exgudang.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>

        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>