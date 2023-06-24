<?php
include 'func.php';

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$status = "Upload Baru";
$namaFile = $_FILES['berkas']['name'];
$x = explode('.', $namaFile);
$ekstensiFile = strtolower(end($x));
$ukuranFile	= $_FILES['berkas']['size'];
$file_tmp = $_FILES['berkas']['tmp_name'];

// Lokasi Penempatan file
$dirUpload = "file/";
$linkBerkas = $dirUpload . $namaFile;

// Menyimpan file
$terupload = move_uploaded_file($file_tmp, $linkBerkas);

$dataArr = array(
	'kode_sbp' => $kode,
	'nama_sbp' => $nama,
	'title' => $namaFile,
	'size' => $ukuranFile,
	'ekstensi' => $ekstensiFile,
	'berkas' => $linkBerkas,
	'status' => $status,
);

if ($terupload && (insertData($dataArr) == 1)) {
?>

	<script type="text/javascript">
		alert("Data Berhasil Disimpan");
		window.location.href = "../../index/index_admin.php?page=sbp";
	</script>

<?php
} else {
?>

	<script type="text/javascript">
		alert("Data Gagal Disimpan");
		window.location.href = "../../index/index_admin.php?page=sbp&aksi=tambahsbp";
	</script>

<?php
}

?>