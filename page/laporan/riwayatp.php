<?php
$id = $_GET['id_pegawai'];
$sql2 = $koneksi->query("select * from pegawai where id_pegawai = '$id'");
$tampil = $sql2->fetch_assoc();
$nama = $tampil['nama'];
?>

<div class="card-header py-5">
  <h6 class="m-0 font-weight-bold text-primary text-center">Riwayat Pengambilan Barang<a href="?page=laporan_penerima" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
</div>
<div class="container">
  <div class="main-body">
    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="../img/<?php echo $tampil['foto']; ?>" alt="Admin" class="rounded-circle" width="150">
              <div class="mt-3">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nama</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $tampil['nama_pegawai']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Bagian</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $tampil['bagian']; ?>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>


  <table class="table">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $pegawai = mysqli_query($koneksi, "select * from barang_keluar where id_pegawai='$id'");
      while ($hp = $pegawai->fetch_assoc()) {
      ?>
        <tr>
          <td><?php echo  $hp['tanggal']; ?></td>
          <td><?php echo  $hp['nama_barang']; ?></td>
          <td><?php echo  $hp['jumlah']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <a href="../page/laporan/exriwayatp.php?id_pegawai=<?= $id ?>" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>
</div>


</div>