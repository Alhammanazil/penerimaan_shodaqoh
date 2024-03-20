<?php
session_start();
include "../db_conn.php";

$namaHewan = $_GET['namaHewan'];

$sql = "SELECT * FROM input_detail WHERE nama_barang = '$namaHewan' ORDER BY urut_hewan DESC LIMIT 1";

$result = $conn->query($sql);
$result = mysqli_fetch_assoc($result);

if ($result == null) {
    echo 0;
} else {
    echo $result['urut_hewan'];
}

$conn->close();
