<?php
$kode = $_GET['kode_sbp'];
$sql2 = $koneksi->query("select * from sbp where kode_sbp = '$kode'");
$tampil = $sql2->fetch_assoc();
$status = $tampil['status'];
$nama_sbp = $tampil['nama_sbp'];
?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Status SBP<a href="?page=sbp" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="body">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="">Nama</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_sbp" value="<?php echo $nama_sbp; ?>" class="form-control" />
                            </div>
                        </div>
                        <label for="">Status</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="status" id="select_status" class="form-control">
                                    <option <?php if ($status == 'Upload Baru') echo 'selected'; ?> value='Upload Baru'>Upload Baru</option>
                                    <option <?php if ($status == 'Sedang Dalam Proses') echo 'selected'; ?> value='Sedang Dalam Proses'>Sedang Dalam Proses</option>
                                    <option <?php if ($status == 'Selesai') echo 'selected'; ?> value='Selesai'>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </form>


                    <?php
                    if (isset($_POST['simpan'])) {
                        $nama_sbp = $_POST['nama_sbp'];
                        $status = $_POST['status'];
                        $sql = $koneksi->query("update sbp set nama_sbp='$nama_sbp', status='$status' where kode_sbp='$kode'");
                        if ($sql) {
                            echo "
							<script>
								Swal.fire({
									title: 'SUKSES!',
									text: 'Data Berhasil Diubah',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									window.location.href = '?page=sbp';
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
									window.location.href = '?page=sbp';
								});
							</script>
							";
                        }
                    }
                    ?>