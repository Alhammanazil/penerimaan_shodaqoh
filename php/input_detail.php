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
    $akun = $_POST['akun'] ?? null;
    $lokasi_file_sementara = $_FILES['upload_foto']['tmp_name'];
    $total_jumlah = (float) $_POST['total_jumlah'];
    $nama_sub_sumbangan = $_POST['nama_sub_sumbangan'] ?? null;
    $atas_nama = $_POST['atas_nama'];
    $urut_hewan = $_POST['urut_hewan'];
    $keterangan = $_POST['keterangan'];
    $kode_kartu = $_POST['kode_kartu'];

    // Penanganan Unggahan File Gambar
    $direktori = "../uploads/";
    $nama_file = $_FILES['upload_foto']['name'];
    move_uploaded_file($_FILES['upload_foto']['tmp_name'], $direktori . $nama_file);

    // Input data ke mysql
    $input = "INSERT INTO input_detail (kodetrx_detail, kodetrx, tanggal, nama_barang, total_jumlah, total_nominal, akun, upload_foto, nama_sub_sumbangan, atas_nama, urut_hewan, keterangan, kode_kartu)
    VALUES ('$kodetrx_detail', 
            '$kodetrx', 
            '$tanggal', 
            '$nama_barang', 
            '$total_jumlah',
            '$total_nominal',
            '$akun',
            '$nama_file', 
            '$nama_sub_sumbangan', 
            '$atas_nama', 
            '$urut_hewan', 
            '$keterangan',
            '$kode_kartu')";

    try {
        mysqli_query($conn, $input);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../input.php?success=1&kodetrx=" . $kodetrx . "#bottom';
              </script>";
    } catch (mysqli_sql_exception $e) {
        echo "<script>
                alert('Data gagal ditambahkan karena kodetrx tidak ditemukan. Silahkan tambahkan kodetrx terlebih dahulu.');
                window.location.href = '../input.php?error=1';
              </script>";
    }
}


