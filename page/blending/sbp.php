<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Shipment Blending Plan (SBP)</h6>
			<br>
			<a href="?page=sbp&aksi=tambahsbp" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Nama</th>
							<th>Type</th>
							<th>Ukuran</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include 'func.php';
						$nomor_urut = 0;
						$result = selectAllData();
						$countData = mysqli_num_rows($result);
						while ($row = mysqli_fetch_assoc($result)) {
							$nomor_urut = $nomor_urut + 1;
						?>
							<tr>
								<td><?php echo $nomor_urut; ?></td>
								<td><?php echo $row['kode_sbp']; ?></td>
								<td><?php echo $row['nama_sbp']; ?></td>
								<td><?php echo strtoupper($row['ekstensi']) ?></td>
								<td><?php echo number_format($row['size'] / (1024 * 1024), 2) ?>MB</td>
								<td><?php echo $row['status']; ?></td>
								<td>
									<a href="../page/blending/bacasbp.php?url=<?php echo $row['berkas']; ?>" class="btn btn-success btn-circle"><i class="fa fa-eye"></i></a>
									<a href="?page=sbp&aksi=ubahsbp&kode_sbp=<?php echo $row['kode_sbp'] ?>" class="btn btn-warning btn-circle"><i class="fas fa-wrench"></i></a>
									<a href="../page/blending/downloadsbp.php?url=<?php echo $row['berkas']; ?>" class="btn btn-info btn-circle"><i class="fa fa-download"></i></a>
									<button onclick="confirmDelete('<?php echo $row['kode_sbp'] ?>')" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></button>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


</body>

</html>

<script>
  function confirmDelete(kodeSBP) {
    Swal.fire({
      icon: 'warning',
      title: 'Konfirmasi',
      text: 'Apakah anda yakin akan menghapus data ini?',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      confirmButtonColor: '#d33',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "?page=sbp&aksi=hapussbp&kode_sbp=" + kodeSBP;
      }
    });
  }
</script>