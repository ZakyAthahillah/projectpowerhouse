<?php
$id_transfer = $_GET['id_transfer'];
$sql2 = $koneksi->query("select * from transfer
INNER JOIN operatorht ON transfer.id_optht = operatorht.id_optht
inner join scicf on transfer.id_rcicf = scicf.id_rcicf
inner join scjty on transfer.id_rcjty = scjty.id_rcjty
inner join haultruck on transfer.id_haultruck = haultruck.id_haultruck where id_transfer = '$id_transfer'");

$tampil = $sql2->fetch_assoc();

$level = $tampil['level'];

?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Transfer<a href="?page=transfer" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
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

                        <label for="">Transfer From (ROM ICF)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="transferfrom" id="select_transfericf" class="form-control" required>
                                    <?php
                                    echo "<option value='$tampil[id_rcicf].$tampil[nama_rcicf]'>$tampil[nama_rcicf]</option>";

                                    $sql = $koneksi->query("SELECT * FROM scicf ORDER BY id_rcicf");
                                    while ($data = $sql->fetch_assoc()) {
                                        // Cek apakah opsi merupakan opsi yang terpilih
                                        if ($data['id_rcicf'] !== $tampil['id_rcicf']) {
                                            echo "<option value='$data[id_rcicf].$data[nama_rcicf]'>$data[nama_rcicf]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>



                        <label for="">Transfer To (ROM Jetty)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="transferto" id="select_transferjty" class="form-control" required>
                                    <?php
                                    echo "<option value='$tampil[id_rcjty].$tampil[nama_rcjty]'>$tampil[nama_rcjty]</option>";

                                    $sql = $koneksi->query("SELECT * FROM scjty ORDER BY id_rcjty");
                                    while ($data = $sql->fetch_assoc()) {
                                        // Cek apakah opsi merupakan opsi yang terpilih
                                        if ($data['id_rcjty'] !== $tampil['id_rcjty']) {
                                            echo "<option value='$data[id_rcjty].$data[nama_rcjty]'>$data[nama_rcjty]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <label for="">Haul Truck</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="haultruck" id="select_haultruck" class="form-control" required>
                                    <?php
                                    echo "<option value='$tampil[id_haultruck]'>$tampil[nama_haultruck]</option>";

                                    $sql = $koneksi->query("SELECT * FROM haultruck ORDER BY id_haultruck");
                                    while ($data = $sql->fetch_assoc()) {
                                        // Cek apakah opsi merupakan opsi yang terpilih
                                        if ($data['id_haultruck'] !== $tampil['id_haultruck']) {
                                            echo "<option value='$data[id_haultruck]'>$data[nama_haultruck]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <label for="">Operator</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="optht" id="select_optht" class="form-control" required>
                                    <?php
                                    echo "<option value='$tampil[id_optht]'>$tampil[nama_optht]</option>";

                                    $sql = $koneksi->query("SELECT * FROM operatorht ORDER BY id_optht");
                                    while ($data = $sql->fetch_assoc()) {
                                        // Cek apakah opsi merupakan opsi yang terpilih
                                        if ($data['id_optht'] !== $tampil['id_optht']) {
                                            echo "<option value='$data[id_optht]'>$data[nama_optht]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengubah data?')">

                    </form>



                    <?php

                    if (isset($_POST['simpan'])) {
                        $tanggal = $_POST['tanggal'];
                        $start = $_POST['start'];

                        $id_rcjty = $_POST['transferto'];
                        $pecah_rcjty = explode(".", $id_rcjty);
                        $id_rcjty = $pecah_rcjty[0];
                        $nama_rcjty = $pecah_rcjty[1];

                        $id_rcicf = $_POST['transferfrom'];
                        $pecah_rcicf = explode(".", $id_rcicf);
                        $id_rcicf = $pecah_rcicf[0];
                        $nama_rcicf = $pecah_rcicf[1];

                        $id_optht = $_POST['optht'];
                        $id_haultruck = $_POST['haultruck'];

                        $koneksi->autocommit(false); // Mematikan autocommit

                        try {
                            // Memulai transaksi
                            $koneksi->begin_transaction();

                            // Lakukan perubahan pada database
                            $sql = "UPDATE transfer SET tanggal=?, start=?, id_rcjty=?, id_rcicf=?, id_haultruck=?, id_optht=? WHERE id_transfer=?";
                            $stmt = $koneksi->prepare($sql);
                            $stmt->bind_param("sssssss", $tanggal, $start, $id_rcjty, $id_rcicf, $id_haultruck, $id_optht, $id_transfer);
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
                                        window.location.href = '?page=transfer';
                                    });
                                </script>
                            ";
                            } else {
                                throw new Exception("Gagal mengubah data transfer"); // Lempar exception jika gagal
                            }
                        } catch (Exception $e) {
                            $koneksi->rollback(); // Rollback transaksi jika terjadi kesalahan
                            echo "
                            <script>
                                Swal.fire({
                                    title: 'ERROR!',
                                    text: 'Gagal mengubah data transfer',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '?page=transfer';
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