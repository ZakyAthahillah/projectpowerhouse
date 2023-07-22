<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Dokumen Tiket Muatan Batubara<a href="?page=dokmuatan" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">


                        <label for="Nomor">Nomor</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nomor" class="form-control" />
                            </div>
                        </div>
                        
                        <label for="Tanggal">Tanggal</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="tanggal" class="form-control" />
                            </div>
                        </div>
                        <label for="Shift">Shift</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="shift" id="" class="form-control">
                                    <option value="Day">Day</option>
                                    <option value="Night">Night</option>
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
                                    <option value="">----------SILAHKAN PILIH----------</option>
                                    <?php

                                    $sql = $koneksi->query("select * from dumptruck order by id_dumptruck");
                                    while ($data = $sql->fetch_assoc()) {
                                        echo "<option value='$data[id_dumptruck]'>$data[nama_dumptruck]</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <label for="">Time Departed</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="tdepart" class="form-control" />
                            </div>
                        </div>

                        <label for="">Loading Tool</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="ltool" class="form-control" />
                            </div>
                        </div>

                        <label for="seam">Seam</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="seam" id="seam" class="form-control">
                                    <option value="">-Pilih-</option>
                                    <option value="Blue Crush">Blue Crush</option>
                                    <option value="Yellow Crush">Yellow Crush</option>
                                    <option value="Green Crush">Green Crush</option>
                                </select>
                            </div>
                        </div>

                        <label for="">Time Arrived (WB)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="wb" class="form-control" />
                            </div>
                        </div>

                        <label for="">Time Arrived (Hopper)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="time" name="hopper" class="form-control" />
                            </div>
                        </div>

                        <label for="">Location (Loading)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="loading" class="form-control" />
                            </div>
                        </div>
                        <label for="">Location (Dumping)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="dumping" class="form-control" />
                            </div>
                        </div>

                        <label for="">Tonnes 1</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="tonnes1" class="form-control" />
                            </div>
                        </div>


                        <label for="">Tonnes 2</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="tonnes2" class="form-control" />
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

                        $sql = $koneksi->query("INSERT INTO dokmuatan (tanggal, shift, nomor, company, id_dumptruck, tdepart, ltool, seam, wb, hopper, loading, dumping, tonnes1, tonnes2) VALUES ('$tanggal', '$shift', '$no', '$company', '$id_dumptruck', '$tdepart', '$ltool', '$seam', '$wb', '$hopper', '$loading', '$dumping', '$tonnes1', '$tonnes2');");

                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Disimpan',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=barge';
								});
							</script>
							";
                        } else {
                            echo "
							<script>
								Swal.fire({
									title: 'ERROR!',
									text: 'Data Gagal Disimpan',
									icon: 'error',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=barge';
								});
							</script>
							";
                        }
                    }
                    ?>