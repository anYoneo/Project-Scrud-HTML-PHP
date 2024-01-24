<?php 

	// membuat koneksi database
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db   = 'db_psb';

	$conn = mysqli_connect($host, $user, $pass, $db);

	if(!$conn){
		echo 'Error : '.mysqli_connect_error($conn);
	}

	function register($data){
		global $conn;

		$nm_admin = mysqli_real_escape_string($conn, $data["nm_admin"]);
		$username = strtolower(stripslashes($data["username"]));
		$password = md5(mysqli_real_escape_string($conn, $data["pass"]));
		$password2 = md5(mysqli_real_escape_string($conn, $data["re_pass"]));
		
		if ($password == $password2 && $password != null)
		if ($nm_admin != null)
		if ($username != null){
		

		mysqli_query($conn, "INSERT INTO tb_Admin VALUES('','$nm_admin','$username','$password')");
		mysqli_query($conn, "INSERT INTO mst_kec VALUES('','$kecamatan')");
	
	return mysqli_affected_rows($conn);
		}
	}
?>