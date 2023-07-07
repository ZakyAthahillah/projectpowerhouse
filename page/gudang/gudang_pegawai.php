<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
    <br>
    <a href="?page=gudang&aksi=tambahgudang" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
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
            <th>Satuan</th>
            <th>Lokasi</th>
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

      </tbody>
      </table>
    </div>
  </div>
</div>


<script>
  function confirmDelete(kodeBarang) {
    Swal.fire({
      icon: 'warning',
      title: 'Konfirmasi',
      text: 'Apakah anda yakin akan menghapus data ini?',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      confirmButtonColor: '#d33',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "?page=gudang&aksi=hapusgudang&kode_barang=" + kodeBarang;
      }
    });
  }
</script>