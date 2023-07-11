<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Blending</h6>
      <br>
      <a href="?page=blending&aksi=tambahblending" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode SBP</th>
              <th>Tanggal</th>
              <th>Start</th>
              <th>Finish</th>
              <th>Plan</th>
              <th>Blue</th>
              <th>Yellow</th>
              <th>Green</th>
              <th>Catatan</th>
              <th>Pengaturan</th>
            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = mysqli_query($koneksi,"select * from blending
            INNER JOIN sbp on blending.kode_sbp = sbp.kode_sbp order by tanggal desc");
            while ($data = mysqli_fetch_assoc($sql)) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['kode_sbp'] ?></td>
                <td><?php echo $data['tanggal'] ?></td>
                <td><?php echo $data['start'] ?></td>
                <td><?php echo $data['finish'] ?></td>
                <td><?php echo $data['plan'] ?></td>
                <td><?php echo $data['bcrush'] ?></td>
                <td><?php echo $data['ycrush'] ?></td>
                <td><?php echo $data['gcrush'] ?></td>
                <td><?php echo $data['catatan'] ?></td>


                <td>
                  <a href="?page=blending&aksi=ubahblending&id_blending=<?php echo $data['id_blending'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
                  <button onclick="confirmDelete('<?php echo $data['id_blending'] ?>')" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></button>
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

<script>
  function confirmDelete(idBlending) {
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
        window.location.href = "?page=blending&aksi=hapusblending&id_blending=" + idBlending;
      }
    });
  }
</script>