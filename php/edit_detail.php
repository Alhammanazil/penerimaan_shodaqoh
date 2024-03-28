<?php
session_start();
include "../db_conn.php";
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx_detail = $_POST['kodetrx_detail'];
    $kodetrx = $_POST['kodetrx'];
    $tanggal = $_POST['tanggal'];
    $nama_barang = $_POST['nama_barang'];
    $total_nominal = (int) extractNumber($_POST['total_nominal']);
    $akun = $_POST['akun'];
    $total_jumlah = (float) $_POST['total_jumlah'];
    $nama_sub_sumbangan = $_POST['nama_sub_sumbangan'] ?? null;
    $atas_nama = $_POST['atas_nama'];
    $urut_hewan = $_POST['urut_hewan'];
    $keterangan = $_POST['keterangan'];

    // Input data ke mysql
    $input = "INSERT INTO input_detail (kodetrx_detail, kodetrx, nama_barang, total_jumlah, total_nominal, akun, nama_sub_sumbangan, atas_nama, urut_hewan, keterangan) 
    VALUES ('$kodetrx_detail', 
            '$kodetrx',
            '$tanggal',  
            '$nama_barang', 
            '$total_jumlah',
            '$total_nominal',
            '$akun', 
            '$nama_sub_sumbangan', 
            '$atas_nama', 
            '$urut_hewan', 
            '$keterangan')";

    if (mysqli_query($conn, $input)) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href = '../edit.php?success=1&kodetrx=" . $kodetrx . "#bottom';
          </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
            window.location.href = '../edit_detail.php?error=1';
          </script>";
        exit();
    }
}
