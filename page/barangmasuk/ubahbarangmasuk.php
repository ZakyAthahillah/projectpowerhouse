

<!-- CODING MASIH DALAM TAHAP PERBAIKAN -->


<script>
 function sum() {
	 var stok = document.getElementById('stok').value;
	 var jumlahmasuk = document.getElementById('jumlahmasuk').value;
	 var result = parseInt(stok) + parseInt(jumlahmasuk);
	 if (!isNaN(result)) {
		 document.getElementById('jumlah').value = result;
	 }
 }
 </script>

<?php
 $id = $_GET['id'];
 $sql2 = $koneksi->query("select * from barang_masuk  where id = '$id'");
 $tampil = $sql2->fetch_assoc();
 
 $level = $tampil['level'];

 
 
 
 ?>
 
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah Barang Masuk</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">

							<form method="POST" enctype="multipart/form-data">

							<label for="">Id Transaksi</label>
                            <div class="form-group">
                               <div class="form-line">
                                 <input type="text" name="id_transaksi" class="form-control" id="id_transaksi" value="<?php echo $tampil['id_transaksi']; ?>" readonly /> 
							</div>
                            </div>
							
							<label for="">Tanggal Masuk</label>
                            <div class="form-group">
                               <div class="form-line">
                                 <input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" value="<?php echo $tampil['tanggal']; ?>" />
							</div>
                            </div>
							
					
							<label for="">Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <select name="barang" id="cmb_barang" class="form-select">
								<option value="">--------------- Pilih Barang  ---------------</option>
								<?php
								
								$sql = $koneksi -> query("select * from gudang order by kode_barang");
								while ($data=$sql->fetch_assoc()) {
									echo "<option value='$data[kode_barang].$data[nama_barang]'>$data[kode_barang] | $data[nama_barang]</option>";
								}
								?>
								
								</select>
							</div>
                            </div>
							
							<div class="tampung"></div>
					
							<label for="">Jumlah</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="jumlahmasuk" id="jumlahmasuk" onkeyup="sum()" class="form-control"  value="<?php echo $tampil['jumlah']; ?>" />
                                     
									 
							</div>
                            </div>
							
							<label for="jumlah">Total Stok (Total Akan Muncul Setelah Mengubah Jumlah)</label>
                            <div class="form-group">
                               <div class="form-line">
                               <input readonly="readonly" name="jumlah" id="jumlah" type="number" class="form-control">
                                     
									 
							</div>
                            </div>
							
							<div class="tampung1"></div>
							
						
							
								<label for="">Supplier</label>
                            <div class="form-group">
                               <div class="form-line">
                                <select name="pengirim" class="form-control" />
								<option value="">-- Pilih Supplier  --</option>
								<?php
								
								$sql = $koneksi -> query("select * from tb_supplier order by nama_supplier");
								while ($data=$sql->fetch_assoc()) {
								echo "<option value='$data[nama_supplier]'>$data[nama_supplier]</option>";
								}
								?>
								
								</select>
                                     
									 
							</div>
                            </div>
						
						
							
						
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								
								if (isset($_POST['simpan'])) {
									$id_transaksi= $_POST['id_transaksi'];
									$tanggal= $_POST['tanggal_masuk'];
	
									$barang= $_POST['barang'];
									$pecah_barang = explode(".", $barang);
									$kode_barang = $pecah_barang[0];
									$nama_barang = $pecah_barang[1];
									
									
									
									$jumlah= $_POST['jumlahmasuk'];
	
									
									$pengirim= $_POST['pengirim'];
									$pecah_nama = explode($nama_supplier);
									$nama_supplier = $pecah_nama[0];
									
									$satuan = $_POST['satuan'];
								
								
								
								$sql = $koneksi->query("update barang_masuk set id_transaksi='$id_transaksi', tanggal='$tanggal', kode_barang='$kode_barang', nama_barang='$nama_barang', jumlah='$jumlah', satuan='$satuan', pengirim='$pengirim' where id='$id'"); 
								$sql2 = $koneksi-> query("update gudang set jumlah=(jumlah) where kode_barang='$kode_barang'");
								
								if ($sql) {
									?>
									
										<script type="text/javascript">
										alert("Data Berhasil Diubah");
										window.location.href="?page=barangmasuk";
										</script>
										
										<?php
								}
							
								}
								
							
							}
							?>
										
										
										
								
<script>
 function sum() {
	 var stok = document.getElementById('stok').value;
	 var jumlahmasuk = document.getElementById('jumlahmasuk').value;
	 var result = parseInt(stok) + parseInt(jumlahmasuk);
	 if (!isNaN(result)) {
		 document.getElementById('jumlah').value = result;
	 }
 }
 </script>			
								
								
								
