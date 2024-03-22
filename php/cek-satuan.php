<?php
session_start();
include "../db_conn.php";

$namaBarang = $_GET['nama_barang'];
// $namaBarang = "Air Mineral";

$sql = "SELECT * FROM tb_barang WHERE nama_barang = '$namaBarang'";

$result = $conn->query($sql);
$result = mysqli_fetch_assoc($result);

echo $result['satuan'];


$conn->close();
