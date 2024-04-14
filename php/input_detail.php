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
    $akun = htmlspecialchars($_POST['akun'] ?? null);
    $lokasi_file_sementara = htmlspecialchars($_FILES['upload_foto']['tmp_name']);
    $total_jumlah = htmlspecialchars((float) $_POST['total_jumlah']);
    $nama_sub_sumbangan = htmlspecialchars($_POST['nama_sub_sumbangan'] ?? null);
    $atas_nama = htmlspecialchars($_POST['atas_nama']);
    $urut_hewan = htmlspecialchars($_POST['urut_hewan']);
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $kode_kartu = htmlspecialchars($_POST['kode_kartu']);

    // Penanganan Unggahan File Gambar
    $direktori = "../uploads/";
    $nama_file = htmlspecialchars($_FILES['upload_foto']['name']);
    move_uploaded_file(htmlspecialchars($_FILES['upload_foto']['tmp_name']), $direktori . $nama_file);

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



