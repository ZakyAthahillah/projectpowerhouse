<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Crushing<a href="?page=crushing" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">



                        <label for="">Tanggal</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="tanggal" class="form-control" id="tanggal" value="" />
                            </div>
                        </div>

                        <label for="">Start</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="start" class="form-control" id="start" value=">" />
                            </div>
                        </div>

                        <label for="">Finish</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="finish" class="form-control" id="finish" value="" />
                            </div>
                        </div>

                        <label for="">Plan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="plan" id="plan" class="form-control" />

                            </div>
                        </div>

                        <label for="">Blue</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="blue" id="blue" class="form-control" />

                            </div>
                        </div>

                        <label for="">Yellow</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="yellow" id="yellow" class="form-control" />
                            </div>
                        </div>


                        <label for="">Green</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="green" class="form-control" />
                            </div>
                        </div>

                        <label for="">Catatan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="catatan" class="form-control" />
                            </div>
                        </div>

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>


                    <?php
                    if (isset($_POST['simpan'])) {
                        $tanggal = $_POST['tanggal'];
                        $start = $_POST['start'];
                        $finish = $_POST['finish'];
                        $plan = $_POST['plan'];
                        $blue = $_POST['blue'];
                        $yellow = $_POST['yellow'];
                        $green = $_POST['green'];
                        $catatan = $_POST['catatan'];

                        // Mengatur autocommit ke false
                        $koneksi->autocommit(FALSE);

                        try {
                            $sql = $koneksi->prepare("INSERT INTO blending (tanggal, start, finish, plan, bcrush, ycrush, gcrush, catatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                            $sql->bind_param("ssssssss", $tanggal, $start, $finish, $plan, $blue, $yellow, $green, $catatan);
                            $sql->execute();

                            // Commit transaksi jika semua query berhasil
                            $koneksi->commit();

                            echo "
                            <script>
                                Swal.fire({
                                    title: 'SUKSES!',
                                    text: 'Data Berhasil Disimpan',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '?page=blending';
                                });
                            </script>
                            ";
                        } catch (Exception $e) {
                            // Rollback transaksi jika terjadi kesalahan
                            $koneksi->rollback();

                            echo "
                            <script>
                                Swal.fire({
                                    title: 'ERROR!',
                                    text: 'Data Gagal Disimpan',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '?page=blending';
                                });
                            </script>
                            ";
                        }

                        // Mengembalikan autocommit ke true setelah transaksi selesai
                        $koneksi->autocommit(TRUE);
                    }
                    ?>