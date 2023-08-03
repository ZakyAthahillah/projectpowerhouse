<?php
$id_transfer = $_GET['id_transfer'];
$sql2 = $koneksi->query("select * from transfer
inner join scicf on transfer.id_rcicf = scicf.id_rcicf
inner join scjty on transfer.id_rcjty = scjty.id_rcjty
INNER JOIN operatorht ON transfer.id_optht = operatorht.id_optht
inner join dumptruck on transfer.id_dumptruck = dumptruck.id_dumptruck where id_transfer = '$id_transfer'");

$tampil = $sql2->fetch_assoc();
$rcicf = $tampil['nama_rcicf'];
$rcjty = $tampil['nama_rcjty'];
$start = $tampil['start'];
$finish = $tampil['finish'];
$warna = $tampil['warna'];
$tanggal = $tampil['tanggal'];
$jumlah = $tampil['jumlah'];
$catatan = $tampil['catatan'];
$id_rcicf = $tampil['id_rcicf'];
$id_rcjty = $tampil['id_rcjty'];
$dumptruck = $tampil['nama_dumptruck'];
$nama_optht = $tampil['nama_optht'];

$level = $tampil['level'];


$sql3 =  $koneksi->query("SELECT * FROM scicf where id_rcicf = '$id_rcicf'");
$tampil2 = $sql3->fetch_assoc();
$jumlah2 = $tampil2['stok'];

$sql4 =  $koneksi->query("SELECT * FROM scjty where id_rcjty = '$id_rcjty'");
$tampil3 = $sql4->fetch_assoc();
$jumlah3 = $tampil3['stok'];

$kurang = $jumlah3 - $jumlah;
$tambah = $jumlah2 + $jumlah;


?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rincian Pembatalan Data Transfer<a href="?page=transfer" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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
                                <input type="time" name="finish" class="form-control" id="finish" value="<?php echo $finish; ?>" readonly />
                            </div>
                        </div>

                        <label for="">Transfer From (ICF)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="transferfrom" class="form-control" id="transferfrom" value="<?php echo $rcicf; ?>" readonly />
                            </div>
                        </div>

                        <label for="">Transfer To (Jetty)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="transferto" class="form-control" id="transferto" value="<?php echo $rcjty; ?>" readonly />
                            </div>
                        </div>
                        
                        <label for="">Dump Truck</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="dumptruck" id="dumptruck" class=" form-control" value="<?php echo $dumptruck; ?>" readonly />
                            </div>
                        </div>

                        <label for="">Operator</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="optht" id="optht" class=" form-control" value="<?php echo $nama_optht; ?>" readonly />
                            </div>
                        </div>


                        <label for="">Jumlah</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="jumlahtransfer" id="jumlahtransfer" class=" form-control" value="<?php echo $jumlah; ?>" readonly />
                            </div>
                        </div>


                        <input type="submit" name="simpan" value="Batalkan" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan membatalkan riwayat ini? (jumlah stok jetty akan berkurang dan stok icf akan bertambah)')">

                    </form>



                    <?php
                    // Memulai transaksi
                    $koneksi->begin_transaction();

                    try {
                        if (isset($_POST['simpan'])) {
                            $sql = "UPDATE scicf SET stok = ? WHERE id_rcicf = ?";
                            $stmt1 = $koneksi->prepare($sql);
                            $stmt1->bind_param("ss", $tambah, $id_rcicf);
                            $stmt1->execute();

                            $sql2 = "UPDATE scjty SET stok = ? WHERE id_rcjty = ?";
                            $stmt2 = $koneksi->prepare($sql2);
                            $stmt2->bind_param("ss", $kurang, $id_rcjty);
                            $stmt2->execute();

                            $sql3 = "DELETE FROM transfer WHERE id_transfer = ?";
                            $stmt3 = $koneksi->prepare($sql3);
                            $stmt3->bind_param("s", $id_transfer);
                            $stmt3->execute();

                            // Menyimpan perubahan
                            $koneksi->commit();

                            echo "
                            <script>
                                Swal.fire({
                                    title: 'SUKSES!',
                                    text: 'Data Berhasil Dibatalkan dan Dihapus',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '?page=transfer';
                                });
                            </script>
                        ";
                        }
                    } catch (Exception $e) {
                        // Membatalkan transaksi jika terjadi kesalahan
                        $koneksi->rollback();

                                        echo "
                        <script>
                            Swal.fire({
                                title: 'ERROR!',
                                text: 'Terjadi kesalahan saat membatalkan dan menghapus data',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '?page=transfer';
                            });
                        </script>
                    ";
                    }

                    // Menutup transaksi dan koneksi ke database
                    $koneksi->close();
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>