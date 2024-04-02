<?php
session_start();
include "../db_conn.php";

$namaBarang = $_GET['nama_barang'];
$totalNominal = $_GET['total_nominal'];
$totalJumlah = $_GET['total_jumlah'];
// $namaBarang = "Ayam";
// $totalNominal = 500000;
// $totalJumlah = 10;

$sql = "SELECT * FROM tb_barang WHERE nama_barang = '$namaBarang'";

$result = $conn->query($sql);
$result = mysqli_fetch_assoc($result);

$kode_kartu = null;

if ($result !== null) {
    if ($namaBarang == "Uang") {
        if ($totalNominal >= $result['minimal_k'] && $totalNominal < $result['minimal_b']) {
            $kode_kartu = "K";
        } else if ($totalNominal >= $result['minimal_b']) {
            $kode_kartu = "B";
        } else {
            $kode_kartu = null;
        }
    } else {
        if ($totalJumlah >= $result['minimal_k'] && $totalJumlah < $result['minimal_b']) {
            $kode_kartu = "K";
        } else if ($totalJumlah >= $result['minimal_b']) {
            $kode_kartu = "B";
        } else {
            $kode_kartu = null;
        }
    }
} else {
    $kode_kartu = null;
}

echo $kode_kartu;

$conn->close();
