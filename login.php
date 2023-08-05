<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include 'koneksi.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>POWERHOUSE APP</title>
	<link rel="icon" href="img/BYAN.JK.png" type="image/x-icon">

	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<style>
		.container {
			margin-top: 200px;
		}
	</style>
	<style>
		body {
			background: url(img/bglogin4.jpg) no-repeat fixed;
			-webkit-background-size: 100% 100%;
			-moz-background-size: 100% 100%;
			-o-background-size: 100% 100%;
			background-size: 100% 100%;
		}

		.bg-login-image {
			background: url(img/coal3.jpg);
			background-position: center;
			background-size: cover;
		}

		.alert {
			margin-top: 150px;
		}
	</style>
</head>

<body>
	<!-- <nav class="navbar navbar-light">
		<h1 class="navbar-brand font-italic font-weight-bold text-light">
			<img src="img/BYAN.JK.png" width="30" height="30" class="d-inline-block align-top" alt="">
			INVENTORY CONTROL (POWERHOUSE)
		</h1>
	</nav> -->
	<div class="container">

		<div class="row justify-content-center">

			<div class="col-l-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">POWERHOUSE APP</h1>
									</div>
									<form class="user" method="post">
										<div class="form-group">
											<input type="text" name="username" class="form-control form-control-user" id="" aria-describedby="" placeholder="Enter Username Here" required autofocus>
										</div>
										<div class="form-group">
											<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required autofocus>
										</div>
										<div class="form-group">
											<select name="level" class="form-control" required autofocus>
												<option value="" selected disabled>Please Select</option>
												<!-- <option value="superadmin">Super Admin</option> -->
												<option value="admin">Admin</option>
												<option value="pegawai">Pegawai</option>
												<option value="warehouse">Warehouse</option>
												<option value="qc">Quality Control</option>
											</select>
										</div>
										<input type="submit" name="login" class="btn btn-primary btn-user btn-block" value="Masuk" />
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="js/demo/datatables-demo.js"></script>
</body>

</html>

<?php

session_start();
if (isset($_POST['login'])) {
	$username = mysqli_real_escape_string($koneksi, $_POST['username']);
	$salt = "xgsuahkgfbioqy789p12640y98uio190836";
	$passwordsalt = $_POST['password'] . $salt;
	$password = md5(mysqli_real_escape_string($koneksi, $passwordsalt));
	// $password = $_POST['password'];
	$level = $_POST['level'];
	$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE username='{$username}' AND password='{$password}' AND level='{$level}'");
	$ketemu = $sql->num_rows;
	$data = $sql->fetch_assoc();

	if ($ketemu >= 1) {
		session_start();

		if ($data['level'] == 'admin' && $level == 'admin') {
			$_SESSION['admin'] = $data['id_users'];

			header("location:index/index_admin.php");

		} elseif ($data['level'] == 'warehouse' && $level == 'warehouse') {
			$_SESSION['warehouse'] = $data['id_users'];

			header("location:index/index_warehouse.php");

		} elseif ($data['level'] == 'pegawai' && $level == 'pegawai') {
			$_SESSION['pegawai'] = $data['id_users'];

			header("location:index/index_pegawai.php");
		} elseif ($data['level'] == 'qc' && $level == 'qc') {
			$_SESSION['qc'] = $data['id_users'];

			header("location:index/index_qc.php");
		}
	} else {
		echo '<div class="container"> <center><div class="alert alert-warning alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Login Gagal !!! , Harap Periksa Kembali Username, Password, dan Level atau <a href="pengaduan.php">Beritahu Admin Disini</a>
	  </div><center></div>';
	}
}
?>