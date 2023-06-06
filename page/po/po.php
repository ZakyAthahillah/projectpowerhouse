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
							<th>Pengaturan</th>

						</tr>
					</thead>


					<tbody>
						<?php

						$no = 1;
						$sql = $koneksi->query("select * from po
						inner join gudang on po.kode_barang = gudang.kode_barang");
						while ($data = $sql->fetch_assoc()) {

						?>

							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['kode_po'] ?></td>
								<td><?php echo $data['tanggal'] ?></td>
								<td><?php echo $data['kode_barang'] ?></td>
								<td><?php echo $data['nama_barang'] ?></td>
								<td><?php echo $data['jumlah'] ?></td>
								<td><?php echo $data['status'] ?></td>


								<td>
									<a href="?page=barangkeluar&aksi=batalbarangkeluar&id=<?php echo $data['id'] ?>" class="btn btn-danger btn-circle"><i class="fas fa-ban"></i></a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
				
				</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

