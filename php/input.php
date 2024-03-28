<?php
session_start();
include "../db_conn.php";
include "../function.php";

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
    $total_sumbangan_rp = extractNumber($_POST['sumbangan_uang']);
    $kode_kartu = $_POST['kode_kartu'];
    $ambil_kartu = $_POST['ambil_kartu'];

    var_dump($_POST);
    exit();

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
        echo "<script>
            alert('Data berhasil ditambahkan, silahkan masukkan detail sumbangan');
            window.location.href = '../input.php?success=1&kodetrx=" . $kodetrx . "#bottom';
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
