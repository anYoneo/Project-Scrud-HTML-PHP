<?php
include "koneksi.php";
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT *FROM tb_pendaftaran WHERE id_pendaftaran = '" . $_GET['id'] . "' ");
$d = mysqli_fetch_array($data);

function active_radio_button($value, $input)
{
    $result = $value == $input ? 'checked' : '';
    return $result;
}

$agama = array('Islam', 'Kristen', 'Hindu', 'Buddha', 'Katolik', 'Khonghucu');
$jurusan = array('Administrasi Bisnis Otomotif', 'Sistem Informasi Industri Otomotif', 'Teknik Industri Otomotif', 'Teknologi Rekayasa Otomotif', 'Teknik Kimia Polimer');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PMB Politeknik STMI Jakarta</title>
    <meta content="Politeknik STMI Jakarta" name="Politeknik STMI Jakarta">
    <meta content="Politeknik STMI Jakarta" name="Politeknik STMI Jakarta">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;1,100;1,200;1,300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container">

            <!-- logo -->
            <div class="logo d-block d-lg-none">
                <a href="index.html"><img src="assets/img/stmi-header.png" alt="" class="img-fluid"></a>
            </div>
            <!-- navbar untara fix top -->
            <nav class="nav-menu d-none d-lg-block">
                <ul class="nav-inner">
                    <li class="nav-logo"><a href="beranda.php"><img src="assets/img/stmi-header.png" alt=""
                                class="img-fluid"></a></li>

                    <li><a href="registrasi.php">Registrasi</a></li>
                    <li><a href="pendaftar.php">Pendaftar</a></li>
                    <li><a href="tentang.php">Tentang</a></li>

                </ul>
            </nav><!-- .nav-menu -->
        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Registrasi Calon Mahasiswa Baru STMI</h2>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->
    </main>


    <form action="update.php" method="post">

        <div class="box">
            <input type="hidden" value="<?php echo $d['id_pendaftaran'] ?>" name="id_pendaftaran">

            <table border="0" class="table-form">
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nm_peserta" class="input-control" value="<?php echo $d['nm_peserta'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>foto</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="foto" class="input-control" value="<?php echo $d['foto'] ?>">
                    </td>
                </tr>
                <br>
                <tr>
                    <td>Almt_peserta</td>
                    <td>:</td>
                    <td>
                        <textarea class="input-control" name="almt_peserta"
                            value="<?php echo htmlspecialchars($d['almt_peserta']); ?>"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>kecamatan</td>
                    <td>:</td>
                    <td>
                        <textarea class="input-control" name="kec"
                            value="<?php echo htmlspecialchars($d['kec']); ?>"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        <input type="radio" name="jk" class="input-control" value="laki-laki"> Laki-laki
                        &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="jk" class="input-control" value="perempuan"> Perempuan
                    </td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>
                        <select class=" input-control" name="agama">
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
                    <td>Tempat Lahir</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="tmp_lahir" class="input-control"
                            value="<?php echo $d['tmp_lahir'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td>:</td>
                    <td>
                        <select class="input-control" name="jurusan">
                            <option value="">--Pilih--</option>
                            <option value="Administrasi Bisnis Otomotif">Administrasi Bisnis Otomotif</option>
                            <option value="Sistem Informasi Industri Otomotif">Sistem Informasi Industri Otomotif
                            </option>
                            <option value="Teknik Industri Otomotif">Teknik Industri Otomotif</option>
                            <option value="Teknologi Rekayasa Otomotif">Teknologi Rekayasa Otomotif</option>
                            <option value="Teknik Kimia Polimer">Teknik Kimia Polimer</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" class="btn-daftar" value="Ubah Data"
                            onclick="return confirm('Selamat Data Anda Sudah Dirubah')">
                    </td>
                </tr>
            </table>
        </div>

    </form>

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">

            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <a href="#header" class="scrollto footer-logo"><img src="../assets/img/stmi-header.png"
                                alt=""></a>
                        <h3>Politeknik STMI Jakarta</h3>
                        <p>Jl. Letjen Suprapto No.26, RT.10/RW.5, Cemp. Putih Tim., Kec. Cemp. Putih, Kota Jakarta Pusat
                        </p>
                    </div>
                </div>
                <div class="social-links">
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>

            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span>TEAM IGP</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by SIIO
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/jquery-sticky/jquery.sticky.js"></script>
    <script src="../assets/vendor/venobox/venobox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>