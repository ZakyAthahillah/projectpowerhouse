<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah SBP<a href="?page=sbp" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form action="../page/blending/uploadsbp.php" method="post" enctype="multipart/form-data">

						<label for="">Kode SBP</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode" value="" placeholder="" class="form-control">
							</div>
						</div>

						<label for="">Nama SBP</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama" value="" placeholder="" class="form-control">
							</div>
						</div>


						<label for="">Upload File <span class="text-danger">*</span></label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" name="berkas" accept="application/pdf" class="form-control" required>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Upload File</button>
					</form>
					<hr>
					<p><span class="text-danger">*</span>) <span class="text-danger">Pastikan nama file yang di input tidak pernah digunakan sebelumnya</span></p>
				</div>
			</div>
		</div>
	</div>
</div>
