<?php 
	session_start();
	include 'koneksi.php';

	if(isset($_POST['register'])){

		if(register($_POST) > 0){
            echo"<script>
                alert('Register Berhasil !');
                document.location.href = 'register.php'
                </script>
                ";
        } else {
            echo"<script>
                alert('Register Gagal !');
                </script>
                ";
        }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PMB Online</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>

	<!-- bagian main login -->
	<section class="main-login">
		
		<div class="box-login">
			<h2>Registerasi akun</h2>

			<!-- bagian form login -->
			<form action="" method="post">
				
				<div class="box">
					<table>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>
								<input type="text" name="nm_admin" id="nm_admin"class="input-control">
							</td>
						</tr>
						<tr>
							<td>Username</td>
							<td>:</td>
							<td>
								<input type="text" name="username" id="username" class="input-control">
							</td>
						</tr>
						<tr>
							<td>Password</td>
							<td>:</td>
							<td>
								<input type="password" name="pass" id="pass" class="input-control">
							</td>
						</tr>
                        <tr>
							<td>Konfirmasi Password</td>
							<td>:</td>
							<td>
								<input type="password" name="re_pass" id="re_pass" class="input-control">
							</td>
						</tr>
                        <tr>
							<td></td>
							<td></td>
							<td>
								<input type="submit" name="register" value="Register" id="register" class="btn-login">							</td>
						</tr>
                        
					</table>
				</div>

			</form>
		</div>

	</section>

</body>
</html>