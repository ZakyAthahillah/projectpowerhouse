<?php
$id_crushing = $_GET['id_crushing'];
$sql2 = $koneksi->query("select * from crushingjty
inner join scjty on crushingjty.id_rcjty = scjty.id_rcjty where id_crushing = '$id_crushing'");
$tampil = $sql2->fetch_assoc();
$rcjty = $tampil['nama_rcjty'];
$start = $tampil['start'];
$finish = $tampil['finish'];
$warna = $tampil['warna'];
$tanggal = $tampil['tanggal'];
$jumlah = $tampil['jumlah'];
$catatan = $tampil['catatan'];
$id_rcjty = $tampil['id_rcjty'];

$level = $tampil['level'];


$sql3 =  $koneksi->query("SELECT * FROM scjty where id_rcjty = '$id_rcjty'");
$tampil2 = $sql3->fetch_assoc();
$jumlah2 = $tampil2['stok'];


$sql5 =  $koneksi->query("SELECT * FROM scjty WHERE nama_rcjty LIKE '%uncrushed%'");
$tampil3 = $sql5->fetch_assoc();
$jumlah3 = $tampil3['stok'];
$iduc = $tampil3['id_rcjty'];


$kurang = $jumlah2 - $jumlah;
$tambah = $jumlah3 + $jumlah;


?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rincian Pembatalan Crushing Jetty<a href="?page=crushingjty" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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


                        <label for="">Crushing To</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="crushingto" class="form-control" id="crushingto" value="<?php echo $rcjty; ?>" readonly />
                            </div>
                        </div>


                        <label for="">Jumlah</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="jumlahmasuk" id="jumlahmasuk" class=" form-control" value="<?php echo $jumlah; ?>" readonly />
                            </div>
                        </div>

                        <label for="">Catatan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="catatan" class="form-control" value="<?php echo $catatan; ?>" readonly />
                            </div>
                        </div>


                        <input type="submit" name="simpan" value="Batalkan" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan membatalkan riwayat ini? (jumlah stok akan berkurang)')">

                    </form>



                    <?php
                    // Memulai transaksi
                    $koneksi->begin_transaction();

                    try {
                        if (isset($_POST['simpan'])) {
                            $sql = "UPDATE scjty SET stok = ? WHERE id_rcjty = ?";
                            $stmt1 = $koneksi->prepare($sql);
                            $stmt1->bind_param("ss", $kurang, $id_rcjty);
                            $stmt1->execute();

                            $sql2 = "DELETE FROM crushingjty WHERE id_crushing = ?";
                            $stmt2 = $koneksi->prepare($sql2);
                            $stmt2->bind_param("s", $id_crushing);
                            $stmt2->execute();

                            $sql4 = "UPDATE scjty SET stok = ? WHERE id_rcjty = ?";
                            $stmt3 = $koneksi->prepare($sql4);
                            $stmt3->bind_param("ss", $tambah, $iduc);
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
                                    window.location.href = '?page=crushingjty';
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
                                window.location.href = '?page=crushingjty';
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