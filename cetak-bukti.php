<?php 
	include 'koneksi.php';

	$peserta = mysqli_query($conn, "SELECT * FROM tb_pendaftaran
		WHERE id_pendaftaran = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($peserta);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSB Online</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
	<script>
		window.print();
	</script>
</head>
<body>

	<h2>Bukti Pendaftaran</h2>
	<table class="table-data" border="0">
	<form enctype="multipart/form-data" method="post" action="upload.php">
		<tr>
			<td>Kode Pendaftaran</td>
			<td>:</td>
			<td><?php echo $p->id_pendaftaran ?></td>
		</tr>
		<tr>
			<td>Tahun Ajaran</td>
			<td>:</td>
			<td><?php echo $p->th_ajaran ?></td>
		</tr>
		<tr>
			<td>Jurusan</td>
			<td>:</td>
			<td><?php echo $p->jurusan ?></td>
		</tr>
		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><?php echo $p->nm_peserta ?></td>
		</tr>
		<tr>
			<td>foto</td>
			<td>:</td>
			<td><img src="../assets/file/<?php echo $b['foto'] ; ?>" style="width: 50%;"></td>
		</tr>
		<tr>
			<td>kecamatan</td>
			<td>:</td>
			<td><?php echo $p->kecamatan ?></td>
		</tr>
		<tr>
			<td>Tempat, Tanggal Lahir</td>
			<td>:</td>
			<td><?php echo $p->tmp_lahir.', '.$p->tgl_lahir ?></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td><?php echo $p->jk ?></td>
		</tr>
		<tr>
			<td>Agama</td>
			<td>:</td>
			<td><?php echo $p->agama ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $p->almt_peserta ?></td>
		</tr>
	</table>
	<?php 
						include_once "koneksi.php" ;
						$data = mysqli_query($conn, "SELECT * FROM tb_pendaftaran order by foto DESC") ;
						while ($row = mysqli_fetch_array($data)) {
					?>

					<div class="col-md-12 row mb-5">
						<div class="col-md-3">
							<img src="file/<?php echo $row['foto'] ; ?>" style="width: 50%;">
					<?php } ?>

</body>
</html>