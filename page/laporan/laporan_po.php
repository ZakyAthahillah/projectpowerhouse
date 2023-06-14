<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Pre - Order</h6>
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
                        </tr>
                    </thead>

                    <tbody>
                    <?php
						$no = 1;
						$sql = $koneksi->query("SELECT po.kode_po, po.tanggal, po.status, GROUP_CONCAT(gudang.nama_barang SEPARATOR ', ') AS nama_gabung, GROUP_CONCAT(po.kode_barang SEPARATOR ', ') AS kode_barang_gabung, GROUP_CONCAT(po.jumlah_po SEPARATOR ', ') AS jumlah_po_gabung
						FROM po
						INNER JOIN gudang ON po.kode_barang = gudang.kode_barang
						GROUP BY po.kode_po");
						while ($data = $sql->fetch_assoc()) {
							$nama_gabung = '<li style="list-style-type: none;">' . str_replace(", ", "</li><li style='list-style-type: none;'>", $data['nama_gabung']) . '</li>';
							$kode_barang_gabung = '<li style="list-style-type: decimal;">' . str_replace(", ", "</li><li style='list-style-type: decimal;'>", $data['kode_barang_gabung']) . '</li>';
							$jumlah_po_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['jumlah_po_gabung']) . '</li>';
						?>

							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['kode_po'] ?></td>
								<td><?php echo $data['tanggal'] ?></td>
								<td><?php echo $kode_barang_gabung ?></td>
								<td><?php echo $nama_gabung ?></td>
								<td><?php echo $jumlah_po_gabung ?></td>
								<td><?php echo $data['status'] ?></td>                         
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="../page/laporan/expo.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>
                </tbody>
                </table>

            </div>
        </div>
    </div>
</div>