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
				'".$_POST['kec']."',
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
	<center><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkWKVl3ygv2aonpvhvKwrsAp8qLpFrdjcw73ZHM8p0&s"height= "150" width= "150"/></center>
	<h2><center>Politeknik STMI Jakarta</h2></center>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSB Online</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>

	<!-- bagian box formulir -->
	<section class="box-formulir">
		
		<h2>Formulir Pendaftaran Mahasiswa Baru Politeknik STMI Jakarta</h2>

		<!-- bagian form -->
		<form action="" method="post">

			<div class="box">
				<table border="0" class="table-form">
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
				<table border="0" class="table-form">
					<tr>
						<td>Nama Lengkap</td>
						<td>:</td>
						<td>
							<input type="text" name="nm" class="input-control">
						</td>
					</tr>
					<tr>
						<td>kecamatan</td>
						<td>:</td>
						<td>
							<input type="text" name="kec" class="input-control">
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
							<input type="submit" name="submit" class="btn-daftar" value="Daftar Sekarang">
						</td>
					</tr>
				</table>
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

    <div id="copyright">
        <div class="wrapper">
            &copy; 2020. <b>RumahRafif.</b> All Rights Reserved.
        </div>
    </div>
    

</body>
</html>