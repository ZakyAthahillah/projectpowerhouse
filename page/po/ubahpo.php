<?php
$id = $_GET['kode_po'];
$sql2 = $koneksi->query("select * from po where kode_po = '$id'");
$tampil = $sql2->fetch_assoc();
$status = $tampil['status'];






?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Pre - Order<a href="?page=po" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">

                        <label for="">Status</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="status" id="select_status" class="form-control">
                                    <option <?php if ($status == 'P-O akan diproses oleh warehouse') echo 'selected'; ?> value='P-O akan diproses oleh warehouse>'>P-O akan diproses oleh warehouse</option>
                                    <option <?php if ($status == 'P-O telah di proses oleh warehouse') echo 'selected'; ?> value='P-O telah di proses oleh warehouse'>P-O telah di proses oleh warehouse</option>
                                </select>
                            </div>
                        </div>


                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>



                    <?php

                    if (isset($_POST['simpan'])) {

                        $status = $_POST['status'];




                        $sql = $koneksi->query("update po set status='$status' where kode_po='$id'");

                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Diubah',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=po';
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
									window.location.href = '?page=po';
								});
							</script>
							";
						}
                    }


                    ?>