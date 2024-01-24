<?php
include 'koneksi.php';

$id_pendaftaran = $_POST['id_pendaftaran'];
$nm_peserta = $_POST['nm_peserta'];
$foto = $_POST['foto'];
$kecamatan = $_POST['kecamatan'];
$almt_peserta = $_POST['almt_peserta'];
$jk = $_POST['jk'];
$agama = $_POST['agama'];
$tmp_lahir = $_POST['tmp_lahir'];
$jurusan = $_POST['jurusan'];

$query = "UPDATE tb_pendaftaran SET nm_peserta='$nm_peserta', foto='$foto', kecamatan=$kecamatan, almt_peserta='$almt_peserta',jk='$jk',agama='$agama',tmp_lahir='$tmp_lahir',jurusan='$jurusan' WHERE id_pendaftaran='$id_pendaftaran'";
mysqli_query($conn, $query);

header("location:data-peserta.php");