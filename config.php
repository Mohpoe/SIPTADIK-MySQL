<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbnm = "siptadik";
$conn = mysqli_connect($host, $user, $pass);
if ($conn) {
	$buka = mysqli_select_db($conn, $dbnm);
	if (!$buka) {
		// Database tidak dapat dibuka
		$buat = mysqli_query($conn, "CREATE DATABASE $dbnm");
		if (!$buat) {
			die ("Tidak dapat memuat dan membuat database!");
		}
	}
} else {
	die ("Server MySQL tidak terhubung");
}
?>