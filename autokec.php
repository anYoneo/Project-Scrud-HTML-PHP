<?php
include "koneksi.php";
$searchTerm = $_GET['term'];

$sql="SELECT * FROM mst_kec WHERE kecamatan LIKE '%".$searchTerm."%' ORDER BY kecamatan ASC";

$hasil=mysqli_query($koneksi,$sql);

while ($row = mysqli_fetch_array($hasil)) {
    $data[] = $row['kecamatan'].", ".$row['kota/kab'];
}

echo json_encode($data);
?>