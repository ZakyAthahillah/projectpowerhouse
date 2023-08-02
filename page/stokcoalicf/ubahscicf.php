<?php
$id = $_GET['id_rcicf'];
$sql2 = $koneksi->query("select * from scicf where id_rcicf = '$id'");
$tampil = $sql2->fetch_assoc();
$warna = $tampil['warna'];

?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah RC ICF<a href="?page=stokcoalicf" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">


                <div class="body">

                    <form method="POST" enctype="multipart/form-data">

                        <label for="">Nama RC</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_rcicf" value="<?php echo $tampil['nama_rcicf']; ?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Warna</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="warna" id="select_warna" class="form-control">
                                    <option <?php if ($warna == 'KUNING') echo 'selected'; ?> value='KUNING'>KUNING</option>
                                    <option <?php if ($warna == 'HIJAU') echo 'selected'; ?> value='HIJAU'>HIJAU</option>
                                    <option <?php if ($warna == 'BIRU') echo 'selected'; ?> value='BIRU'>BIRU</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

                    </form>



                    <?php

                    if (isset($_POST['simpan'])) {

                        $nama_rcicf = $_POST['nama_rcicf'];
                        $warna = $_POST['warna'];
                        $sql = $koneksi->query("update scicf set nama_rcicf='$nama_rcicf', warna='$warna' where id_rcicf='$id'");

                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Diubah',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=stokcoalicf';
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
									window.location.href = '?page=stokcoalicf';
								});
							</script>
							";
                        }
                    }


                    ?>