<?php
$id = $_GET['id'];
$sql2 = $koneksi->query("select * from po INNER JOIN gudang ON po.kode_barang = gudang.kode_barang where po.id = '$id'");
$tampil = $sql2->fetch_assoc();
$status = $tampil['status'];
$jumlah = $tampil['jumlah_po'];
$kode_po = $tampil['kode_po'];






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

                        <label for="">Kode Pre - Order</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kodepo" class="form-control" value="<?php echo $kode_po; ?>" />
                            </div>
                        </div>

                        <label for="">Barang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="barang" id="select_barang" class="form-control" required>                          
                                    <?php
                                    echo "<option value='$tampil[kode_barang]'>$tampil[kode_barang] | $tampil[nama_barang]</option>";

                                    $sql = $koneksi->query("SELECT * FROM gudang ORDER BY kode_barang");
                                    while ($data = $sql->fetch_assoc()) {
                                        if ($data['kode_barang'] !== $tampil['kode_barang']) {
                                            echo "<option value='$data[kode_barang]'>$data[kode_barang] | $data[nama_barang]</option>";
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="tampung"></div>

                        <label for="">Jumlah</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="jumlah" class="form-control" value="<?php echo $jumlah; ?>" />
                            </div>
                        </div>


                        <label for="">Status</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="status" id="select_status" class="form-control">
                                    <option <?php if ($status == 'P-O akan diproses oleh warehouse') echo 'selected'; ?> value='P-O akan diproses oleh warehouse'>P-O akan diproses oleh warehouse</option>
                                    <option <?php if ($status == 'P-O telah di proses oleh warehouse') echo 'selected'; ?> value='P-O telah di proses oleh warehouse'>P-O telah di proses oleh warehouse</option>
                                    <option <?php if ($status == 'Barang telah sampai, silahkan hubungi warehouse') echo 'selected'; ?> value='Barang telah sampai silahkan hubungi warehouse'>Barang telah sampai silahkan hubungi warehouse</option>
                                </select>
                            </div>
                        </div>




                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>



                    <?php

                    if (isset($_POST['simpan'])) {

                        $status = $_POST['status'];
                        $jumlah = $_POST['jumlah'];
                        $kode_po = $_POST['kodepo'];
                        $kode_barang = $_POST['barang'];




                        $sql = $koneksi->query("update po set kode_po='$kode_po', kode_barang = '$kode_barang', status='$status', jumlah_po='$jumlah' where id='$id'");

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