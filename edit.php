<?php 

	// membuat koneksi database
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db   = 'db_psb';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update record
    $sql = "UPDATE tb_pendaftaran SET id_pendaftaran='value1', tgl_daftar   ='value2' WHERE id=1";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Record updated successfully";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
