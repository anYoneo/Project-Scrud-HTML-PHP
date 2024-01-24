<!DOCTYPE html>
<html>
<head>

	<title>WEB PMB POLITEKNIK STMI JAKARTA</title>
	<!-- menghubungkan dengan file css -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- menghubungkan dengan file jquery -->
	<script type="text/javascript" src="jquery.js"></script>
</head>
<body>

<div class="content">
	<header>
		<center><img src="http://stmi.ac.id/img/logo2.png" ></center>
		<h1 class="judul">POLITEKNIK STMI JAKARTA</h1>
	</header>
 
	<div class="menu">
		<ul>
			<li><a href="index.php?page=home">HOME</a></li>
			<li><a href="index.php?page=registrasi">REGISTRASI</a></li>
			<li><a href="index.php?page=pendaftar">PENDAFTAR</a></li>
			<li><a href="index.php?page=tentang">TENTANG</a></li>
		
	</div>
<div class="halaman2">
<center><h2>TAMPILAN DATA PENDAFTAR</h2></center>
 
<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "pmb";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nama        = "";
$alamat       = "";
$jenis_kelamin     = "";
$agama   = "";
$nama_sekolah     = "";
$jurusan     = "";
$error      = "";
$sukses     = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from pendaftaran_pmb where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from pendaftaran_pmb where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama        = $r1['nama'];
    $alamat       = $r1['alamat'];
    $jenis_kelamin     = $r1['jenis_kelamin'];
    $agama   = $r1['agama'];
    $nama_sekolah   = $r1['nama_sekolah'];
    $jurusan   = $r1['jurusan'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $jenis_kelamin   = $_POST['jenis_kelamin'];
    $agama   = $_POST['agama'];
    $nama_sekolah   = $_POST['nama_sekolah'];
    $jurusan   = $_POST['jurusan'];

    if ($nama && $alamat && $jenis_kelamin && $agama && $nama_sekolah && $jurusan   ) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update pendaftaran_pmb set nama='$nama',alamat = '$alamat',jenis_kelamin ='$jenis_kelamin',agama='$agama',nama_sekolah='$nama_sekolah',jurusan='$jurusan' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } 
           
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
            Edit Data Mahasiswa
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=pendaftarrev.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=pendaftarrev.php");
                }
                ?>
                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                           <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki<br>
                            <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan<br>
                        </div>
                        <?php
                        if ($jenis_kelamin=='L')
                            {
                                echo "Laki-laki";
                            }else {
                                echo "";
                            }
                        ?>
                    </div>
                    <div class="mb-3 row">
                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agama" id="agama">
                                <option value="">- Pilih Agama -</option>
                                <option value="Islam" <?php if ($agama == "Islam") echo "selected" ?>>Islam</option>
                                <option value="Kristen" <?php if ($agama == "kristen") echo "selected" ?>>Kristen</option>
                                <option value="Hindu" <?php if ($agama == "Hindu") echo "selected" ?>>Hindu</option>
                                <option value="Budha" <?php if ($agama == "Budha") echo "selected" ?>>Budha</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_sekolah" class="col-sm-2 col-form-label">Nama Sekolah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_sekolah" name="nama sekolah" value="<?php echo $nama_sekolah ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">jurusan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo $jurusan ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">foto</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Nama Sekolah</th>
                            <th scope="col">jurusan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from pendaftaran_pmb order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nama       = $r2['nama'];
                            $alamat     = $r2['alamat'];
                            $jenis_kelamin     = $r2['jenis_kelamin'];
                            $agama   = $r2['agama'];
                            $nama_sekolah   = $r2['nama_sekolah'];
                            $jurusan   = $r2['jurusan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $foto ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $jenis_kelamin ?></td>
                                <td scope="row"><?php echo $agama ?></td>
                                <td scope="row"><?php echo $nama_sekolah ?></td>
                                <td scope="row"><?php echo $jurusan ?></td>
                                <td scope="row">
                                    <a href="pendaftarrev.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="pendaftarrev.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                    <a href="cetak.php?page=cetak&id=<?php echo $id?>"><button type="button" class="btn btn-secondary">Cetak</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<footer class="footer-distributed">

			<div class="footer-left">
          <img src="http://stmi.ac.id/img/logo2.png">
				<h3>POLITEKNIK STMI JAKARTA</h3>

				<p class="footer-links">
					|
					<a href="logout.php">LOGOUT</a>
					|
				</p>

				<p class="footer-company-name">© Reza Fahmi Alviandy</p>
			</div>

			<div class="footer-center">
				<div>
					<i class="fa fa-map-marker"></i>
					  <p><span>Jl. Letjen Suprapto No.26, RT.10/RW.5, Cemp.Putih.</span>
						 Kota Jakarta Pusat, 10510</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p> (021) 42801783</p>
				</div>
				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="http://www.stmi.ac.id/">humas@stmi.ac.id</a></p>
				</div>
			</div>
			<div class="footer-right">
				<p class="footer-company-about">
					<span>About the company</span>
					Kampus ini sangat enak sekali tau, tugasnya banyak, dosenya baik, nilainya oke, parkiranya lega banget loh, enak deh kuliah disini</p>
				<div class="footer-icons">
					<a href="https://instagram.com"><img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/Instagram.png" width="20px" border="3px"></a>
          			<a href="https://twitter.com"><img src="https://cdn-icons-png.flaticon.com/512/733/733635.png" width="20px" border="3px"></a>
          			<a href="https://drive.google.com"><img src="https://i.pinimg.com/originals/06/3a/69/063a6962c7a465522dbefd6f4a1710e7.png" width="20px" border="3px"></a>
         			<a href="https://youtube.com"><img src="https://i2.wp.com/hdclipartall.com/images/youtube-clipart-youtube-icon-free-download-at-1600x1600.png" width="20px" border="3px"></a>
          			<a href="https://facebook.com"><img src="https://geo.fisipol.ugm.ac.id/wp-content/uploads/sites/1389/2020/11/facebook-icon-monochrome-300x300.png" width="20px" border="3px"></a>
				</div>
			</div>
		</footer>
</body>
</html>