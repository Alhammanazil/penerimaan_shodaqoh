<?php
session_start();
include "../db_conn.php";
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx_detail = $_POST['kodetrx_detail'];
    $kodetrx = $_POST['kodetrx'];
    $nama_barang = $_POST['nama_barang'];
    $total_nominal = (int) extractNumber($_POST['total_nominal']);
    $akun = $_POST['akun'];
    $total_jumlah = (float) $_POST['total_jumlah'];
    $nama_sub_sumbangan = $_POST['nama_sub_sumbangan'];
    $atas_nama = $_POST['atas_nama'];
    $keterangan = $_POST['keterangan'];

    // Input data ke mysql
    $input = "INSERT INTO input_detail (kodetrx_detail, kodetrx, nama_barang, total_jumlah, total_nominal, akun, nama_sub_sumbangan, atas_nama, keterangan) 
    VALUES ('$kodetrx_detail', 
            '$kodetrx', 
            '$nama_barang', 
            '$total_jumlah',
            '$total_nominal',
            '$akun', 
            '$nama_sub_sumbangan', 
            '$atas_nama', 
            '$keterangan')";

    if (mysqli_query($conn, $input)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../input.php?success=1&kodetrx=" . $kodetrx . "#bottom';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan');
                window.location.href = '../input.php?error=1';
              </script>";
        exit();
    }
}
