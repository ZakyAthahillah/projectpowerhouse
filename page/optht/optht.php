<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Operator Dump Truck</h6>
      <br>
      <a href="?page=optht&aksi=tambahoptht" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>


          <tbody>
            <?php

            $no = 1;
            $sql = $koneksi->query("select * from operatorht");
            while ($data = $sql->fetch_assoc()) {

            ?>
              
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_optht'] ?></td>



                <td>
                  <a href="?page=optht&aksi=ubahoptht&id_optht=<?php echo $data['id_optht'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
                  <button onclick="confirmDelete('<?php echo $data['id_optht'] ?>')" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></button>
                  <a href="?page=optht&aksi=viewoptht&id_optht=<?php echo $data['id_optht'] ?>" class="btn btn-primary btn-circle"><i class="fas fa-info"></i></a>
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
  function confirmDelete(idOptht) {
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
        window.location.href = "?page=optht&aksi=hapusoptht&id_optht=" + idOptht;
      }
    });
  }
</script>