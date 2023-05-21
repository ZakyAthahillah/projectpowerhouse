<?php
$id = $_GET['id_supplier'];
$sql2 = $koneksi->query("select * from tb_supplier where id_supplier = '$id'");
$tampil = $sql2->fetch_assoc();
$nama = $tampil['nama_supplier'];
?>


<div class="card-header py-5">
  <h6 class="m-0 font-weight-bold text-primary text-center">Riwayat Pengirim Barang<a href="?page=laporan_pengirim" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
</div>
<div class="container">
  <div class="main-body">
    <div class="row gutters-sm">
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nama Supplier</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $tampil['nama_supplier']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Alamat</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $tampil['alamat']; ?>
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
      $pegawai = mysqli_query($koneksi, "select * from barang_masuk where id_supplier='$id'");
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
  <a href="../page/laporan/exriwayats.php?id_supplier=<?= $id ?>" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>
</div>



</div>