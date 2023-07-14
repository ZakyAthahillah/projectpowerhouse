 <!-- Begin Page Content -->
 <div class="container-fluid">

 	<!-- DataTales Example -->
 	<div class="card shadow mb-4">
 		<div class="card-header py-3">
 			<h6 class="m-0 font-weight-bold text-primary">Barang Masuk</h6>
 			<br>
 			<a href="?page=barangmasuk&aksi=tambahbarangmasuk" class="btn btn-primary"><i class="fas fa-plus-circle"> Tambah</i></a>
 		</div>
 		<div class="card-body">
 			<div class="table-responsive">
 				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
 					<thead>
 						<tr>
 							<th>No</th>
 							<th>Id Transaksi</th>
 							<th>Tanggal Masuk</th>
 							<th>Kode Barang</th>
 							<th>Nama Barang</th>
 							<th>Pengirim</th>
 							<th>Jumlah Masuk</th>
 							<th>Satuan Barang</th>
 							<th>Catatan</th>
							<th>Penginput</th>
 							<th>Pengaturan</th>
 						</tr>
 					</thead>


 					<tbody>
 						<?php

							$no = 1;
							$sql = $koneksi->query("select * from barang_masuk 
							INNER JOIN users ON barang_masuk.id_users = users.id_users
							inner join tb_supplier on barang_masuk.id_supplier = tb_supplier.id_supplier order by tanggal desc");
							while ($data = $sql->fetch_assoc()) {

							?>

 							<tr>
 								<td><?php echo $no++; ?></td>
 								<td><?php echo $data['id_transaksi'] ?></td>
 								<td><?php echo $data['tanggal'] ?></td>
 								<td><?php echo $data['kode_barang'] ?></td>
 								<td><?php echo $data['nama_barang'] ?></td>
 								<td><?php echo $data['nama_supplier'] ?></td>
 								<td><?php echo $data['jumlah'] ?></td>
 								<td><?php echo $data['satuan'] ?></td>
 								<td><?php echo $data['catatan'] ?></td>
 								<td><?php echo $data['nama'] ?></td>
								



 								<td>
 									<a href="?page=barangmasuk&aksi=batalbarangmasuk&id=<?php echo $data['id'] ?>" class="btn btn-danger btn-circle"><i class="fas fa-ban"></i></a>
 								</td>
 							</tr>
 						<?php } ?>

 					</tbody>
 				</table>
 				<br>

 				</tbody>
 				</table>
 			</div>
 		</div>
 	</div>

 </div>