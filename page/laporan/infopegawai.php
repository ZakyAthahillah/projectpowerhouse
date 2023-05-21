<?php
$id = $_GET['id_pegawai'];
$sql2 = $koneksi->query("select * from pegawai where id_pegawai = '$id'");
$tampil = $sql2->fetch_assoc();
$nama = $tampil['nama'];
?>

<div class="container">
    <br>
    <br>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Data Pegawai</h6>
        <br>
        <a href="?page=pegawai" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a>
    </div>
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
                                <h6 class="mb-0">NIK :</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $tampil['nik']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama :</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $tampil['nama']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Bagian :</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $tampil['bagian']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Telepon :</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $tampil['telepon']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat :</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $tampil['alamat']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-warning " href="?page=pegawai&aksi=ubahpegawai&id_pegawai=<?= $id ?>">Ubah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</div>