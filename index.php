<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$koneksi = new mysqli("localhost", "root", "", "inventori");


header("location:login.php");


?>	