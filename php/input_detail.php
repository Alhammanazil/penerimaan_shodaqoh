<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx_detail = $_POST['kodetrx_detail'];
    $kodetrx = $_POST['kodetrx'];
    $nama_barang = $_POST['nama_barang'];
    $total_nominal = $_POST['total_nominal'];
    $total_jumlah = $_POST['total_jumlah'];
    $nama_sub_sumbangan = $_POST['nama_sub_sumbangan'];
    $atas_nama = $_POST['atas_nama'];
    $keterangan = $_POST['keterangan'];

    // Submit data to the database
    $sql = "INSERT INTO input_detail (kodetrx_detail, kodetrx, nama_barang, total_nominal, total_jumlah, nama_sub_sumbangan, atas_nama, keterangan) 
    VALUES ('$kodetrx_detail', '$kodetrx', '$nama_barang', '$total_nominal', '$total_jumlah', '$nama_sub_sumbangan', '$atas_nama', '$keterangan')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../input_detail.php?success=1&kodetrx=" . $kodetrx . "';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Data gagal ditambahkan');
                window.location.href = '../input_detail.php?error=1';
              </script>";
        exit();
    }
}
