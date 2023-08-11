<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pre-Order</h6>
			<br>
			<a href="?page=po&aksi=tambahpo" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Pre-Order</th>
							<th>Tanggal</th>
							<th>Kode Barang</th>
							<th>Nama Barang</th>
							<th>Jumlah</th>
							<th>Status</th>
							<th>Aksi</th>

						</tr>
					</thead>


					<tbody>
						<?php
						$no = 1;
						$sql = $koneksi->query("SELECT po.kode_po, po.tanggal, po.status, 
						GROUP_CONCAT(gudang.nama_barang SEPARATOR ', ') AS nama_gabung, 
						GROUP_CONCAT(po.kode_barang SEPARATOR ', ') AS kode_barang_gabung, 
						GROUP_CONCAT(po.jumlah_po SEPARATOR ', ') AS jumlah_po_gabung,
						GROUP_CONCAT(status SEPARATOR ', ') AS status_gabung,
						GROUP_CONCAT(po.id SEPARATOR ', ') AS id_po_gabung
						FROM po
						INNER JOIN gudang ON po.kode_barang = gudang.kode_barang
						GROUP BY po.kode_po order by tanggal desc");
						while ($data = $sql->fetch_assoc()) {
							$nama_gabung = '<li style="list-style-type: none;">' . str_replace(", ", "</li><li style='list-style-type: none;'>", $data['nama_gabung']) . '</li>';
							$kode_barang_gabung = '<li style="list-style-type: decimal;">' . str_replace(", ", "</li><li style='list-style-type: decimal;'>", $data['kode_barang_gabung']) . '</li>';
							$jumlah_po_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['jumlah_po_gabung']) . '</li>';
							$status_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['status_gabung']) . '</li>';
							$id_po_gabung = $data['id_po_gabung'];
						?>

							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['kode_po'] ?></td>
								<td><?php echo $data['tanggal'] ?></td>
								<td><?php echo $kode_barang_gabung ?></td>
								<td><?php echo $nama_gabung ?></td>
								<td><?php echo $jumlah_po_gabung ?></td>
								<td><?php echo $status_gabung ?></td>
								<td>
									<div style="display: flex;">
										<ul style="list-style-type: none; padding: 0; margin: 0 10px 0 0;">
											<?php
											$id_po_array = explode(", ", $id_po_gabung);
											foreach ($id_po_array as $id_po) {
												echo '<li><a href="?page=po&aksi=ubahpo&id=' . $id_po . '"><i class="fas fa-wrench text-warning"></i></a></li>';
											}
											?>
										</ul>
										<ul style="list-style-type: none; padding: 0; margin: 0;">
											<?php
											$id_po_array = explode(", ", $id_po_gabung);
											foreach ($id_po_array as $id_po) {
												echo '<li><a onclick="confirmDelete(\'' . $id_po . '\')"><i class="fas fa-trash text-danger"></i></a></li>';
											}
											?>
										</ul>
									</div>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	function confirmDelete(idPO) {
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
				window.location.href = "?page=po&aksi=hapuspo&id=" + idPO;
			}
		});
	}
</script>