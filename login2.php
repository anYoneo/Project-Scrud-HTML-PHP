<?php 
	session_start();
	include 'koneksi.php';

	if(isset($_POST['login'])){

		// cek akun ada apa tidak
		$cek = mysqli_query($conn, "SELECT * FROM tb_admin
			WHERE username = '".htmlspecialchars($_POST['user'])."' AND password = '".MD5(htmlspecialchars($_POST['pass']))."' ");

		if(mysqli_num_rows($cek) > 0){
			$a = mysqli_fetch_object($cek);

			$_SESSION['stat_login'] = true;
			$_SESSION['id'] = $a->id_admin;
			$_SESSION['nama'] = $a->nm_admin;
			echo '<script>window.location="beranda2.php"</script>';
		}else{
			echo '<script>alert("Gagal, username atau password salah")</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<center><img src="https://3.bp.blogspot.com/-iQWhPZ4FkVQ/WJhtNVipKMI/AAAAAAAAArI/aBYFu6KV5LYiGuHEXydvjr0t18WZY9BAACLcB/s200/logo%2BSTMI.png" height = "250"></center>
	<title>PSB Online</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>

	<!-- bagian main login -->
	<section class="main-login">
		
		<div class="box-login">
			<h2>Login Peserta</h2>

			<!-- bagian form login -->
			<form action="" method="post">
				
				<div class="box">
					<table>
						<tr>
							<td>Username</td>
							<td>:</td>
							<td>
								<input type="text" name="user" class="input-control">
							</td>
						</tr>
						<tr>
							<td>Password</td>
							<td>:</td>
							<td>
								<input type="password" name="pass" class="input-control">
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								<input type="submit" name="login" value="Login" class="btn-login">
								<a href="http://localhost/PSB/registrasi.php"target="_blank" class="btn-cetak">registrasi</a>

							</td>
						</tr>
					</table>
				</div>

			</form>
		</div>

	</section>

</body>
</html>