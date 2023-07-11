<?php
$id_blending = $_GET['id_blending'];
$sql2 = $koneksi->query("select * from blending where id_blending = '$id_blending'");

$tampil = $sql2->fetch_assoc();

$level = $tampil['level'];

?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Blending<a href="?page=blending" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">

                        <label for="">Tanggal</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo $tampil['tanggal']; ?>" />
                            </div>
                        </div>

                        <label for="">Start</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="start" class="form-control" id="start" value="<?php echo $tampil['start']; ?>" />
                            </div>
                        </div>

                        <label for="">Finish</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="finish" class="form-control" id="finish" value="<?php echo $tampil['finish']; ?>" />
                            </div>
                        </div>

                        <label for="">Plan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="plan" id="plan" class=" form-control" value="<?php echo $tampil['plan']; ?>" />
                            </div>
                        </div>

                        <label for="">Blue Crush</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="bcrush" id="bcrush" class=" form-control" value="<?php echo $tampil['bcrush']; ?>" />
                            </div>
                        </div>

                        <label for="">Yellow Crush</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="ycrush" id="ycrush" class=" form-control" value="<?php echo $tampil['ycrush']; ?>" />
                            </div>
                        </div>

                        <label for="">Green Crush</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="gcrush" id="gcrush" class=" form-control" value="<?php echo $tampil['gcrush']; ?>" />
                            </div>
                        </div>

                        <label for="">Catatan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="catatan" id="catatan" class=" form-control" value="<?php echo $tampil['catatan']; ?>" />
                            </div>
                        </div>

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengubah data?')">

                    </form>



                    <?php

                    if (isset($_POST['simpan'])) {
                        $tanggal = $_POST['tanggal'];
                        $start = $_POST['start'];
                        $finish = $_POST['finish'];
                        $plan = $_POST['plan'];
                        $ycrush = $_POST['ycrush'];
                        $bcrush = $_POST['bcrush'];
                        $gcrush = $_POST['gcrush'];
                        $catatan = $_POST['catatan'];


                        $koneksi->autocommit(false); // Mematikan autocommit

                        try {
                            // Memulai transaksi
                            $koneksi->begin_transaction();

                            // Lakukan perubahan pada database
                            $sql = "UPDATE blending SET tanggal=?, start=?, finish=?, plan=?, gcrush=?, bcrush=?, ycrush=?, catatan=? WHERE id_blending=?";
                            $stmt = $koneksi->prepare($sql);
                            $stmt->bind_param("sssssssss", $tanggal, $start, $finish, $plan, $gcrush, $bcrush, $ycrush, $catatan, $id_blending);
                            $stmt->execute();

                            if ($stmt->affected_rows > 0) {
                                $koneksi->commit(); // Commit transaksi jika sukses
                                echo "
                                <script>
                                    Swal.fire({
                                        title: 'SUKSES!',
                                        text: 'Data Berhasil Diubah',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        window.location.href = '?page=blending';
                                    });
                                </script>
                            ";
                            } else {
                                throw new Exception("Gagal mengubah data blending"); // Lempar exception jika gagal
                            }
                        } catch (Exception $e) {
                            $koneksi->rollback(); // Rollback transaksi jika terjadi kesalahan
                            echo "
                            <script>
                                Swal.fire({
                                    title: 'ERROR!',
                                    text: 'Gagal mengubah data blending',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '?page=blending';
                                });
                            </script>
                        ";
                        }

                        $koneksi->autocommit(true); // Menghidupkan autocommit kembali setelah transaksi selesai
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>