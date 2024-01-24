<?php 
	session_start();
	include 'koneksi.php';
	if($_SESSION['stat_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSB Online | Administrator</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>

	<header>
		<h1><a href="beranda.php">Halaman depan PSB</a></h1>
		<ul>
			<li><a href="http://127.0.0.1:5500/halamanawal.html">Beranda</a></li>
			<li><a href="index2.php">Pendaftaran</a></li>
			<li><a href="keluar.php">Keluar</a></li>
		</ul>
	</header>
	<section class="content">
		<h2>Beranda</h2>
		<div class="box">
			<h3><?php echo $_SESSION['nama'] ?>, Selamat Datang di PSB Politeknik STMI Jakarta Online.</h3>
		</div>
	</section>

</body>
</html>