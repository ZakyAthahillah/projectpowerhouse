<?php
$id_crushing = $_GET['id_crushing'];
$sql2 = $koneksi->query("select * from crushingicf
inner join scicf on crushingicf.id_rcicf = scicf.id_rcicf where id_crushing = '$id_crushing'");
$tampil = $sql2->fetch_assoc();
$rcicf = $tampil['nama_rcicf'];
$start = $tampil['start'];
$finish = $tampil['finish'];
$warna = $tampil['warna'];
$tanggal = $tampil['tanggal'];
$jumlah = $tampil['jumlah'];
$catatan = $tampil['catatan'];
$id_rcicf = $tampil['id_rcicf'];

$level = $tampil['level'];


$sql3 =  $koneksi->query("SELECT * FROM scicf where id_rcicf = '$id_rcicf'");
$tampil2 = $sql3->fetch_assoc();
$jumlah2 = $tampil2['stok'];

$kurang = $jumlah2 - $jumlah;


?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rincian Crushing ICF<a href="?page=crushingicf" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">

                        <label for="">Tanggal</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo $tanggal; ?>" readonly />
                            </div>
                        </div>

                        <label for="">Start</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="start" class="form-control" id="start" value="<?php echo $start; ?>" readonly />
                            </div>
                        </div>

                        <label for="">Finish</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="finish" class="form-control" id="finish" value="<?php echo $finish; ?>" readonly/>
                            </div>
                        </div>


                        <label for="">Crushing To</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="crushingto" class="form-control" id="crushingto" value="<?php echo $rcicf; ?>" readonly/>
                            </div>
                        </div>


                        <label for="">Jumlah</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="jumlahmasuk" id="jumlahmasuk"  class=" form-control" value="<?php echo $jumlah; ?>" readonly/>
                            </div>
                        </div>

                        <label for="">Catatan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="catatan" class="form-control" value="<?php echo $catatan; ?>" readonly/>
                            </div>
                        </div>


                        <input type="submit" name="simpan" value="Batalkan" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan membatalkan riwayat ini? (jumlah stok akan berkurang)')">

                    </form>



                    <?php


                        if (isset($_POST['simpan'])) {

                            $sql = $koneksi->query("UPDATE scicf SET stok='$kurang' WHERE id_rcicf='$id_rcicf'");

                            $sql2 = $koneksi->query("delete from crushingicf where id_crushing = '$id_crushing'");

                            if ($sql) {
                                echo "
								<script>
									Swal.fire({
										title: 'SUKSES!',
										text: 'Data Berhasil Dibatalkan dan Dihapus',
										icon: 'success',
										confirmButtonText: 'OK'
									}).then(() => {
										window.location.href = '?page=crushingicf';
									});
								</script>
								";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>