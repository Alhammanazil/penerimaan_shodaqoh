<?php
session_start();
include "../db_conn.php";
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx = $_POST['kodetrx'];
    $operator = $_POST['operator'];
    $tanggal = $_POST['tanggal'];
    $gelar1 = $_POST['gelar1'] ?? null;
    $nama = htmlspecialchars($_POST['nama']);
    $gelar2 = $_POST['gelar2'] ?? null;
    $alamat = $_POST['lengkap'];
    $telepon = $_POST['telepon'];
    $total_sumbangan = $_POST['sumbangan_barang'];
    $total_sumbangan_rp = extractNumber($_POST['sumbangan_uang']);
    $kode_kartu = $_POST['kode_kartu'];
    $ambil_kartu = htmlspecialchars($_POST['ambil_kartu']);

    //submit data ke database
    $input = "INSERT INTO `input` (`kodetrx`, `operator`, `tanggal`, `gelar1`, `nama`, `gelar2`, `alamat`, `telepon`, `total_sumbangan`, `total_sumbangan_rp`, `kode_kartu`, `ambil_kartu`) 
        VALUES ('$kodetrx',
                '$operator', 
                '$tanggal', 
                '$gelar1', 
                '$nama', 
                '$gelar2', 
                '$alamat', 
                '$telepon', 
                '$total_sumbangan', 
                '$total_sumbangan_rp', 
                '$kode_kartu', 
                '$ambil_kartu')";

    if (mysqli_query($conn, $input)) {
        $response = array('status' => 'success', 'message' => 'Data berhasil ditambahkan, silahkan masukkan detail sumbangan', 'kodetrx' => $kodetrx);
        echo json_encode($response);
        exit();
    } else {
        $response = array('status' => 'error', 'message' => 'Data gagal ditambahkan');
        echo json_encode($response);
        exit();
    }
}
