<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $kodetrx = $_POST['kodetrx'];
    $operator = $_POST['operator'];
    $tanggal = $_POST['tanggal'];
    $gelar1 = $_POST['gelar1'];
    $nama = $_POST['nama'];
    $gelar2 = $_POST['gelar2'];
    $alamat = $_POST['lengkap'];
    $telepon = $_POST['telepon'];
    $total_sumbangan = $_POST['sumbangan_barang'];
    $total_sumbangan_rp = $_POST['sumbangan_uang'];
    $kode_kartu = $_POST['kode_kartu'];
    $ambil_kartu = $_POST['ambil_kartu'];

    //submit data ke database
    $sql = "INSERT INTO input (kodetrx, Operator, tanggal, Gelar1, Nama, Gelar2, Alamat, Telepon, total_sumbangan, total_sumbangan_rp, kode_kartu, ambil_kartu) 
            VALUES ('$kodetrx','$operator', '$tanggal', '$gelar1', '$nama', '$gelar2', '$alamat', '$telepon', '$total_sumbangan', '$total_sumbangan_rp', '$kode_kartu', '$ambil_kartu')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../input.php?success=1';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Data gagal ditambahkan');
                window.location.href = '../input.php?error=1';
              </script>";
        exit();
    }
}

$conn->close();
