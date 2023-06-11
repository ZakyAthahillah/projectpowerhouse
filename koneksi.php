<?php
$databaseHost = "localhost";
$databaseName = "inventori";
$databaseUsername = "root";
$databasePassword = "";
$koneksi = mysqli_connect("$databaseHost", "$databaseUsername", "$databasePassword","$databaseName");


if (mysqli_connect_errno()) {
 echo "<h1>Koneksi database error : " . mysqli_connect_errno() . "</h1>";
}
