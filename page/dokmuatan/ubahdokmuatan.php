<?php
$id = $_GET['id_dokmuatan'];
$sql2 = $koneksi->query("select * from dokmuatan inner join dumptruck on dokmuatan.id_dumptruck = dumptruck.id_dumptruck where id_dokmuatan = '$id'");
$tampil = $sql2->fetch_assoc();
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Dokumen Tiket Muatan Batubara<a href="?page=dokmuatan" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">


                        <label for="Nomor">Nomor</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nomor" value="<?= $tampil['nomor']; ?>" class="form-control" />
                            </div>
                        </div>
                        
                        <label for="Tanggal">Tanggal</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="tanggal" value="<?= $tampil['tanggal']; ?>"  class="form-control" />
                            </div>
                        </div>


                        <label for="">Shift</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="shift" id="" class="form-control">
                                    <option <?php if ($tampil['shift'] == 'Day') echo 'selected'; ?> value='Day'>Day</option>
                                    <option <?php if ($tampil['shift'] == 'Night') echo 'selected'; ?> value='Night'>Night</option>
                                </select>
                            </div>
                        </div>

                        <label for="">Company</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="company" value="PT. KAI" placeholder="PT.KAI" class="form-control" readonly />
                            </div>
                        </div>

                        <label for="">Truck No.</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="dumptruck" id="select_dumptruck" class="form-control" required>
                                    <?php
                                    echo "<option value='$tampil[id_dumptruck]'>$tampil[nama_dumptruck]</option>";

                                    $sql = $koneksi->query("SELECT * FROM dumptruck ORDER BY id_dumptruck");
                                    while ($data = $sql->fetch_assoc()) {
                                        // Cek apakah opsi merupakan opsi yang terpilih
                                        if ($data['id_dumptruck'] !== $tampil['id_dumptruck']) {
                                            echo "<option value='$data[id_dumptruck]'>$data[nama_dumptruck]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <label for="">Time Departed</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="tdepart" value="<?= $tampil['tdepart']; ?>"  class="form-control" />
                            </div>
                        </div>

                        <label for="">Loading Tool</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="ltool" value="<?= $tampil['ltool']; ?>"  class="form-control" />
                            </div>
                        </div>

                        <label for="">Seam</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="seam" id="" class="form-control">
                                    <option <?php if ($tampil['seam'] == 'Blue Crush') echo 'selected'; ?> value='Blue Crush'>Blue Crush</option>
                                    <option <?php if ($tampil['seam'] == 'Yellow Crush') echo 'selected'; ?> value='Yellow Crush'>Yellow Crush</option>
                                    <option <?php if ($tampil['seam'] == 'Green Crush') echo 'selected'; ?> value='Green Crush'>Green Crush</option>
                                </select>
                            </div>
                        </div>

                        <label for="">Time Arrived (WB)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="wb" value="<?= $tampil['wb']; ?>"  class="form-control" />
                            </div>
                        </div>

                        <label for="">Time Arrived (Hopper)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="hopper" value="<?= $tampil['hopper']; ?>"  class="form-control" />
                            </div>
                        </div>

                        <label for="">Location (Loading)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="loading" value="<?= $tampil['loading']; ?>"  class="form-control" />
                            </div>
                        </div>
                        <label for="">Location (Dumping)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="dumping" value="<?= $tampil['dumping']; ?>"  class="form-control" />
                            </div>
                        </div>

                        <label for="">Tonnes 1</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="tonnes1" value="<?= $tampil['tonnes1']; ?>"  class="form-control" />
                            </div>
                        </div>


                        <label for="">Tonnes 2</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="tonnes2" value="<?= $tampil['tonnes2']; ?>"  class="form-control" />
                            </div>
                        </div>





                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>




                    <?php

                    if (isset($_POST['simpan'])) {
                        
                        $no = $_POST['nomor'];
                        $tanggal = $_POST['tanggal'];
                        $shift = $_POST['shift'];
                        $company = $_POST['company'];
                        $id_dumptruck = $_POST['dumptruck'];
                        $tdepart = $_POST['tdepart'];
                        $ltool = $_POST['ltool'];
                        $seam = $_POST['seam'];
                        $wb = $_POST['wb'];
                        $loading = $_POST['loading'];
                        $dumping = $_POST['dumping'];
                        $hopper = $_POST['hopper'];
                        $tonnes1 = $_POST['tonnes1'];
                        $tonnes2 = $_POST['tonnes2'];

                        $sql = $koneksi->query("UPDATE dokmuatan set tanggal = '$tanggal', shift = '$shift', nomor = '$no', company = '$company', id_dumptruck = '$id_dumptruck', tdepart = '$tdepart', ltool = '$ltool', seam = '$seam', wb = '$wb', hopper = '$hopper', loading = '$loading', dumping = '$dumping', tonnes1 ='$tonnes1' , tonnes2 = '$tonnes2' WHERE id_dokmuatan = '$id'");

                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Diubah',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=dokmuatan';
								});
							</script>
							";
                        } else {
                            echo "
							<script>
								Swal.fire({
									title: 'ERROR!',
									text: 'Data Gagal Diubah',
									icon: 'error',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=dokmuatan';
								});
							</script>
							";
                        }
                    }
                    ?>