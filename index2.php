<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Politeknik STMI Jakarta.</title>
    <link rel="stylesheet" href="style.css">
    <?php 
	include 'koneksi.php';
	

	if(isset($_POST['submit'])){

		// ambil 1 id terbesar di kolom id_pendaftaran, lalu ambil 5 karakter aja dari sebelah kanan
		$getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_pendaftaran, 5)) AS id FROM tb_pendaftaran");
		$d = mysqli_fetch_object($getMaxId);
		$generateId = 'P'.date('Y').sprintf("%05s", $d->id + 1);

		// proses insert
		$insert = mysqli_query($conn, "INSERT INTO tb_pendaftaran VALUES (
			'".$generateId."',
			'".date('Y-m-d')."',
			'".$_POST['th_ajaran']."',
			'".$_POST['jurusan']."',
			'".$_POST['nm']."',
			'".$_POST['foto']."',
			'".$_POST['kecamatan']."',
			'".$_POST['tmp_lahir']."',
			'".$_POST['tgl_lahir']."',
			'".$_POST['jk']."',
			'".$_POST['agama']."',
			'".$_POST['alamat']."'
		)");

		if($insert){
			echo '<script>window.location="berhasil.php?id='.$generateId.'"</script>';
		}else{
			echo 'huft '.mysqli_error($conn);
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<center><img src="http://stmi.ac.id/img/logo2.png"height= "150"/></center>
	<h2><center>Politeknik STMI Jakarta</h2></center>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSB Online</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<>
<h3><center>Formulir Pendaftaran Mahasiswa Baru Politeknik STMI Jakarta</h3></center>
	<!-- bagian box formulir -->
	<section class="box-formulir">
		

		<!-- bagian form -->
		<form action=""method="post">
			<script>
				$(function() {
					$("#kecamatan").autocomplete({
						source: 'autokec.php'
					});
				});
			</script>
			<div class="box" height= "150">
				<table border="20" class="table-form"height= "150">
					<tr>
						<td>Tahun Ajaran</td>
						<td>:</td>
						<td>
							<input type="text" name="th_ajaran" class="input-control" value="2023/2024" readonly>
						</td>
					</tr>
					<tr>
						<td>Jurusan</td>
						<td>:</td>
						<td>
							<select class="input-control" name="jurusan">
								<option value="">--Pilih--</option>
								<option value="Sistem Informasi Industri Otomotif">Sistem Informasi Industri Otomotif</option>
								<option value="Administrasi Bisnis Otomotif">Administrasi Bisnis Otomotif</option>
								<option value="Teknik Rekayasa Otomotif">Teknik Rekayasa Otomotif</option>
								<option value="Teknik Kimia Polimer">Teknik Kimia Polimer</option>
							</select>
						</td>
					</tr>
				</table>
			</div>

			<h3>Data Diri Calon Mahasiswa</h3>
			<div class="box">
				<table border="20" class="table-form" width= 1000px">
					<tr>
						<td>Nama Lengkap</td>
						<td>:</td>
						<td>
							<input type="text" name="nm" class="input-control">
						</td>
					</tr>
					<tr>
					<tr>
						<td>foto</td>
						<td>:</td>
						<td>
						<form enctype="multipart/form-data" method="post" action="upload.php">
							<input type="file" name="foto" class="form-control" >
						</div>
						</td>
					</tr>
					<tr>
						<td>kecamatan</td>
						<td>:</td>
						<td>
							<input type="text" name="kecamatan" id="kecamatan" value="" class="input-control">
						</td>
					</tr>
					<tr>
						<td>Tempat Lahir</td>
						<td>:</td>
						<td>
							<input type="text" name="tmp_lahir" class="input-control">
						</td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>:</td>
						<td>
							<input type="date" name="tgl_lahir" class="input-control">
						</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td>
							<input type="radio" name="jk" class="input-control" value="Laki-laki"> Laki-laki &nbsp;&nbsp;&nbsp;
							<input type="radio" name="jk" class="input-control" value="Perempuan"> Perempuan
						</td>
					</tr>
					<tr>
						<td>Agama</td>
						<td>:</td>
						<td>
							<select class="input-control" name="agama">
								<option value="">--Pilih--</option>
								<option value="Islam">Islam</option>
								<option value="Kristen">Kristen</option>
								<option value="Hindu">Hindu</option>
								<option value="Buddha">Buddha</option>
								<option value="Katolik">Katolik</option>
								<option value="Khonghucu">Khonghucu</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Alamat Lengkap</td>
						<td>:</td>
						<td>
							<textarea class="input-control" name="alamat"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>
						<div class="mb-3 text-end">
							<button type="submit" class="btn btn-success">Kirim</button>
						</div>
							<input type="submit" name="submit" class="btn-daftar" value="Daftar Sekarang">
						</td>
					</tr>
				</table>
			</div>

		</form>
		</div>
					<form enctype="multipart/form-data" method="post" action="upload.php">
						<div class="mb-3">
						  <label class="form-label">Foto</label>
						  <input type="file" name="foto" class="form-control" >
						</div>

						<div class="mb-3 text-end">
							<button type="submit" class="btn btn-success">Kirim</button>
						</div>
					</form>
	</section>
	<div id="contact">
        <div class="wrapper">
            <div class="footer">
                <div class="footer-section">
                    <h3>Pendaftaran Politeknik STMI.</h3>
                    <p>Segera daftar disini dengan diskon up to 99%</p>
                </div>
                <div class="footer-section">
                    <h3>About</h3>
                    <p>
                        Sekolah Tinggi Manajemen Industri merupakan lembaga Pendidikan Tinggi / politeknik milik Pemerintah di bawah naungan Kementrian Perindustrian Republik Indonesia. Sejak awal berdirinya, STMI selalu bekerja sama dengan Institut Teknologi Bandung dalam mengembangkan kurikulum dan program studinya.</p>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p> 10, Jl. Letjen Suprapto No.26, RT.10/RW.5, Cemp. Putih Tim., Kec. Cemp. Putih, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta</p>
                    <p>Kode Pos: 10510</p>
                </div>
                <div class="footer-section">
                    <h3>Social</h3>
                    <p><b>YouTube: </b>Politeknik STMI Jakarta</p>
                </div>
            </div>
        </div>
    </div>
	<!DOCTYPE html>
<html>
<head>
	<title>Fitur Upload Foto dengan PHP & Mysql</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="col-md-12 row justify-content-center">
			<div class="col-md-8 mt-4">
				<div class="col-md-12 mt-4">
					<h2>Fitur Upload Foto dengan PHP & Mysql</h2>
					By : <a href="https://www.rullystudio.com">Rully Studio</a>
				</div>
				<div class="col-md-12 mt-4">
					<a href="form_upload.php" class="btn btn-success mb-4">Upload</a>
					<?php 
						include_once "koneksi.php" ;
						$data = mysqli_query($conn, "SELECT * FROM tb_pendaftaran order by foto DESC") ;
						while ($row = mysqli_fetch_array($data)) {
					?>

					<div class="col-md-12 row mb-5">
						<div class="col-md-3">
							<img src="file/<?php echo $row['foto'] ; ?>" style="width: 100%;">
						</div>
						<div class="col-md-9">
							<h2><?php echo $row['nama'] ; ?></h2>
							<a href="delete.php?id=<?php echo $row['id_siswa'] ; ?>" class="btn btn-danger mt-4">Delete</a>
						</div>
					</div>

					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2020. <b>RumahRafif.</b> All Rights Reserved.
        </div>
    </div>
	
    
</body>
</html>