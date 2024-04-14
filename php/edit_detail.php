<?php
session_start();
include "../db_conn.php";
include "../function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx_detail = htmlspecialchars($_POST['kodetrx_detail']);
    $kodetrx = htmlspecialchars($_POST['kodetrx']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $total_nominal = htmlspecialchars((int) extractNumber($_POST['total_nominal']));
    $akun = htmlspecialchars($_POST['akun']);
    $total_jumlah = htmlspecialchars((float) $_POST['total_jumlah']);
    $nama_sub_sumbangan = htmlspecialchars($_POST['nama_sub_sumbangan'] ?? null);
    $atas_nama = htmlspecialchars($_POST['atas_nama']);
    $urut_hewan = htmlspecialchars($_POST['urut_hewan']);
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $kode_kartu = htmlspecialchars($_POST['kode_kartu']);

    // Input data ke mysql
    $input = "INSERT INTO input_detail (kodetrx_detail, kodetrx, tanggal, nama_barang, total_jumlah, total_nominal, akun, nama_sub_sumbangan, atas_nama, urut_hewan, keterangan, kode_kartu) 
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
            '$keterangan',
            '$kode_kartu')";

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

