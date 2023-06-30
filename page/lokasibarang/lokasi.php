<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lokasi Barang</h6>
      <br>
      <a href="?page=lokasibarang&aksi=tambahlokasi" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Lokasi Barang</th>
              <th>Pengaturan</th>
            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = $koneksi->query("select * from lokasi");
            while ($data = $sql->fetch_assoc()) {

            ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['lokasi'] ?></td>



                <td>
                  <a href="?page=lokasibarang&aksi=ubahlokasi&id_lokasi=<?php echo $data['id_lokasi'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
                  <button onclick="confirmDelete('<?php echo $data['id_lokasi'] ?>')" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></button>
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
  function confirmDelete(idLokasi) {
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
        window.location.href = "?page=lokasibarang&aksi=hapuslokasi&id_lokasi=" + idLokasi;
      }
    });
  }
</script>