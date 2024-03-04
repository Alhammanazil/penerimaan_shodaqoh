<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $nama_barang = $_POST['nama_barang'];
    $total_nominal = $_POST['total_nominal'];
    $total_jumlah = $_POST['total_jumlah'];
    $keterangan = $_POST['keterangan'];

    //submit data ke database
    $sql = "INSERT INTO input_detail (kodetrx, nama_barang, total_nominal, total_jumlah, keterangan) 
            VALUES ('2','$nama_barang', '$total_nominal', '$total_jumlah', '$keterangan')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../input_detail.php?success=1';
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