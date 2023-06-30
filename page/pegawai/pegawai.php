<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
      <br>
      <a href="?page=pegawai&aksi=tambahpegawai" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Bagian</th>
              <th>Foto</th>
              <th>Aksi</th>
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
                <td><img src="../img/<?php echo $data['foto'] ?>" width="50" height="50" alt=""> </td>

                <td>
                  <a href="?page=pegawai&aksi=ubahpegawai&id_pegawai=<?php echo $data['id_pegawai'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
                  <button onclick="confirmDelete('<?php echo $data['id_pegawai'] ?>')" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></button>
                  <a href="?page=laporan_pegawai&aksi=infopegawai&id_pegawai=<?php echo $data['id_pegawai'] ?>" class="btn btn-success btn-circle"><i class="fas fa-search"></i></a>
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
  function confirmDelete(idPegawai) {
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
        window.location.href = "?page=pegawai&aksi=hapuspegawai&id_pegawai=" + idPegawai;
      }
    });
  }
</script>