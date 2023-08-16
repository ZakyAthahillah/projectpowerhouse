<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Laporan Rekomendasi Barang</h6>
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
            <th>Jumlah</th>
            <th>Jumlah Min</th>
            <th>Jumlah Max</th>
            <th>Satuan</th>
            <th>Lokasi</th>
            <th>Rekomendasi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = mysqli_query($koneksi, "select * from gudang 
            inner join lokasi on gudang.id_lokasi = lokasi.id_lokasi
            inner join satuan on gudang.id_satuan = satuan.id_satuan
            inner join jenis_barang on gudang.id_jenis = jenis_barang.id_jenis
            order by kode_barang");
          while ($data = mysqli_fetch_assoc($sql)) {
            $rekomendasi = "";
            if ($data['jumlah'] < $data['min']) {
              $rekomendasi = "Barang kurang, segera melakukan pre-order barang";
            } elseif ($data['jumlah'] > $data['max']) {
              $rekomendasi = "Barang berlebih, dilarang melakukan pre-order barang";
            }

            if ($data['jumlah'] >= $data['min'] && $data['jumlah'] <= $data['max']) {
              continue;
            }
          ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['kode_barang'] ?></td>
              <td><?php echo $data['nama_barang'] ?></td>
              <td><?php echo $data['jenis_barang'] ?></td>
              <td><?php echo $data['jumlah'] ?></td>
              <td><?php echo $data['min'] ?></td>
              <td><?php echo $data['max'] ?></td>
              <td><?php echo $data['satuan'] ?></td>
              <td><?php echo $data['lokasi'] ?></td>
              <td><?php echo $rekomendasi ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <a href="../page/laporan/exrekom.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>
    </div>
  </div>
</div>