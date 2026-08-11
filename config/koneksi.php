<?php
	$server = "localhost";
	$username = "root";
	$pass = "";
	$db = "db_berita";

	$conn = mysqli_connect($server,$username,$pass,$db);
	
	if($conn->connect_error){
		die ("Connection Failed!". $conn->connect_error);
	}
?>