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
$warna = $tampil['warna'];
$tanggal = $tampil['tanggal'];
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


?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rincian Konfirmasi Data Transfer<a href="?page=transfer" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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
                                <input type="time" name="finish" class="form-control" id="finish" required />
                            </div>
                        </div>

                        <label for="">Transfer From (ROM ICF)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="transferfrom" class="form-control" id="transferfrom" value="<?php echo $rcicf; ?>" readonly />
                            </div>
                        </div>

                        <label for="">Transfer To (ROM Jetty)</label>
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
                                <input type="text" name="jumlahtransfer" id="jumlahtransfer" class=" form-control" required />
                            </div>
                        </div>


                        <input type="submit" name="simpan" value="Konfirmasi" class="btn btn-success" onclick="return confirm('Apakah anda yakin mengkonfirmasi riwayat ini? (jumlah stok jetty akan bertambah dan stok icf akan berkurang)')">

                    </form>



                    <?php
                    // Memulai transaksi
                    $koneksi->begin_transaction();

                    try {
                        if (isset($_POST['simpan'])) {

                            $jumlah = $_POST['jumlahtransfer'];
                            $finish = $_POST['finish'];

                            $tambah = $jumlah3 + $jumlah;
                            $kurang = $jumlah2 - $jumlah;

                            $sql = "UPDATE scicf SET stok = ? WHERE id_rcicf = ?";
                            $stmt1 = $koneksi->prepare($sql);
                            $stmt1->bind_param("ss", $kurang, $id_rcicf);
                            $stmt1->execute();

                            $sql2 = "UPDATE scjty SET stok = ? WHERE id_rcjty = ?";
                            $stmt2 = $koneksi->prepare($sql2);
                            $stmt2->bind_param("ss", $tambah, $id_rcjty);
                            $stmt2->execute();

                            $sql3 = "UPDATE transfer SET jumlah = ? , finish = ?, catatan = 'Selesai' WHERE id_transfer = ?";
                            $stmt3 = $koneksi->prepare($sql3);
                            $stmt3->bind_param("sss", $jumlah, $finish, $id_transfer);
                            $stmt3->execute();

                            $sql4 = "UPDATE transfer SET id_users = ? WHERE id_transfer = ?";
                            $stmt4 = $koneksi->prepare($sql4);
                            $stmt4->bind_param("ss", $id_users, $id_transfer);
                            $stmt4->execute();

                            // Menyimpan perubahan
                            $koneksi->commit();

                            echo "
                            <script>
                                Swal.fire({
                                    title: 'SUKSES!',
                                    text: 'Data Berhasil Dikonfirmasi',
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
                                text: 'Terjadi kesalahan saat memproses data',
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