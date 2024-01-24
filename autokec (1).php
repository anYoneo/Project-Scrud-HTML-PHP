<?php
include "koneksi.php"; //Include file koneksi
$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

$sql="SELECT * FROM mst_kec WHERE kecamatan LIKE '%".$searchTerm."%' ORDER BY kecamatan ASC"; // query sql untuk menampilkan data mahasiswa dengan operator LIKE

$hasil=mysqli_query($conn,$sql); //Query dieksekusi

//Disajikan dengan menggunakan perulangan
while ($row = mysqli_fetch_array($hasil)) {
    $data[] = $row['kecamatan'];
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
?>